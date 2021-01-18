<?php

declare(strict_types = 1);

namespace Hyperf\JwtAuth;

use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Builder;

class JwtBuilder
{
    /**
     * @var array
     */
    protected $config;

    protected $jwtBuilder;

    public function __construct(array $config)
    {
        $this->config = $config;

        $now = time();

        $this->jwtBuilder = (new Builder)
            ->issuedAt($now)
            ->expiresAt($now + 31536000);
    }

    /**
     * 添加 用户 id
     *
     * @param int $id
     *
     * @return $this
     */
    public function withUid($id)
    {
        $this->jwtBuilder->withClaim('uid', $id);

        return $this;
    }

    /**
     * 添加其它数据
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function withClaim($name, $value)
    {
        $this->jwtBuilder->withClaim($name, $value);

        return $this;
    }

    /**
     * @return \Lcobucci\JWT\Token
     */
    public function getToken()
    {
        return $this->jwtBuilder->getToken(new Sha256, new Key($this->config['secret']));
    }

    /**
     * 生成 token
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getToken();
    }
}
