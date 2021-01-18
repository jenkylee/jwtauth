<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\Di\Container;
use Hyperf\Di\Definition\DefinitionSourceFactory;
use Hyperf\Utils\ApplicationContext;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Request;
use Hyperf\JwtAuth\JwtManager;

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

define('BASE_PATH', $dir = dirname(__DIR__, 1));

$container = new Container((new DefinitionSourceFactory(false))());
ApplicationContext::setContainer($container);

$container->define(RequestInterface::class, function() {
    $request = new Request();
    $request->withHeader('Authorization', 'JeyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzeXNJZCI6MTUsInN5c1NvdXJjZSI6MSwidXNlck5vIjozMjQwMDQwLCJzb3VyY2UiOjAsImV4cCI6MTY0MTQ2MjUyNSwiaWF0IjoxNjA5OTI2NTI1LCJhY2NvdW50Ijo0MjcwMDQwfQ.4nv1ZOkoPOjqcP1TPzIR-MwFWScWdc5Dha8wxY5oovA');
   return $request;
});

$container->define(JwtManager::class, function() {
   return new JwtManager(new \Hyperf\Config\Config(['jwt' => [
       'enabled' => true,
       'secret' => '75HkSDxkHgDAthb0',
       'header_key' => 'Authorization'
   ]]));
});
