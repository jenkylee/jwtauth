<?php

namespace Hyperf\JwtAuth;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\Str;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;

class JwtParser
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var \Lcobucci\JWT\Token
     */
    protected $token;

    /**
     * JWT 字符
     *
     * @var string
     */
    protected $jwt;

    /**
     * @var RequestInterface
     */
    protected $request;

    protected $headerName = 'Authorization';

    public function __construct(array $config, RequestInterface $request)
    {
        $this->config = $config;
        $this->request = $request;

        $this->headerName = $config['header_key'] ?? 'Authorization';
    }

    /**
     * 获取jwt
     *
     * @return string|null
     */
    public function getJwt()
    {
        $header = $this->request->header($this->headerName, '');
        if (Str::startsWith($header, 'Bearer ')) {
            return Str::substr($header, 7);
        }

        if ($this->request->has('token')) {
            return $this->request->input('token');
        }

        return null;
    }

    /**
     * @return bool
     */
    public function hasToken()
    {
        $this->parseToken();

        return (bool) $this->token;
    }

    /**
     * 解析 token
     *
     * @return $this
     */
    public function parseToken()
    {
        if (!$this->token && $jwt = $this->getJwt()) {
            try {
                $this->token = (new Parser)->parse($jwt);
            } catch (\Exception $e) {
            }
        }

        return $this;
    }

    /**
     * 验证 jwt token
     *
     * @return bool
     */
    public function verify()
    {
        if ($this->token) {
            return $this->token->verify(new Sha256, $this->config['secret']);
        }

        return false;
    }

    /**
     * 验证数据
     *
     * @return bool
     */
    public function validate()
    {
        $data = new ValidationData;

        return $this->token->validate($data);
    }

    public function getClaimValue($key)
    {
        if (!$this->token || !$this->token->hasClaim($key)) {
            return null;
        }

        return $this->token->getClaim($key);
    }

    public function getSysId()
    {
        return $this->getClaimValue('sysId');
    }

    public function getSysSource()
    {
        return $this->getClaimValue('sysSource');
    }

    public function getUid()
    {
        return $this->getUserNo();
    }

    /**
     * 获取用户 no
     *
     * @return int|null
     */
    public function getUserNo()
    {
        return $this->getClaimValue('userNo');
    }

    public function getSource()
    {
        return $this->getClaimValue('source');
    }

    public function getAccount()
    {
        return $this->getClaimValue('account');
    }

    /**
     * 获取所有的数据
     *
     * @return array|null
     */
    public function toArray()
    {
        if (!$this->token) {
            return null;
        }

        /** @var \Lcobucci\JWT\Claim[] $claims */
        $claims = $this->token->getClaims();

        $data = [];
        foreach ($claims as $claim) {
            $data[$claim->getName()] = $claim->getValue();
        }

        return $data;
    }
}