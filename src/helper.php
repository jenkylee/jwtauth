<?php
declare(strict_types=1);

use Hyperf\Utils\ApplicationContext;
use Hyperf\JwtAuth\JwtManager;

if (!function_exists('jwt')) {
    /**
     * 建议视图中使用该函数，其他地方请使用注入.
     */
    function jwt()
    {
        $jwt = ApplicationContext::getContainer()->get(JwtManager::class);
        return $jwt;
    }
}