<?php

namespace Hyperf\JwtAuth;

use Hyperf\Contract\ConfigInterface;

class JwtManager
{
    /**
     * @var array
     */
    protected $config;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config->get('jwt');
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

    public function __call($name, $arguments)
    {
        $config = $this->config;
        $guard = make(jwtGuard::class, compact('config'));

        if (method_exists($guard, $name)) {
            return call_user_func_array([$guard, $name], $arguments);
        }

        throw new \Exception('Method not defined. method:' . $name);
    }
}