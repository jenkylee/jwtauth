<?php

namespace Hyperf\JwtAuth;

use Hyperf\HttpServer\Contract\RequestInterface;

class jwtGuard
{
    protected $config;

    protected $parser;

    protected $builder;

    /**
     * @var RequestInterface
     */
    protected $request;

    public function __construct(array $config, RequestInterface $request)
    {
        $this->config = $config;
        $this->request = $request;
    }

    public function enabled()
    {
        return (bool) $this->config['enabled'];
    }

    /**
     * Get / Set config
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed|null
     */
    public function config($key, $value = null)
    {
        if (isset($this->config[$key])) {
            return $this->config[$key];
        }

        return null;
    }

    /**
     * @return JwtBuilder
     */
    public function builder()
    {
        if (is_null($this->builder)) {
            $this->builder = new JwtBuilder($this->config);
        }

        return $this->builder;
    }

    /**
     * @return JwtParser
     */
    public function parser()
    {
        if (is_null($this->parser)) {
            $this->parser = new JwtParser($this->config, $this->request);
        }

        return $this->parser;
    }
}