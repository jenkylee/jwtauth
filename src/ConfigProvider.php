<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\JwtAuth;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
            ],
            'commands' => [
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'jwt',
                    'description' => 'jwt 组件配置.', // 描述
                    'source' => __DIR__ . '/../publish/jwt.php',  // 对应的配置文件路径
                    'destination' => BASE_PATH . '/config/autoload/jwt.php', // 复制为这个路径下的该文件
                ],
            ],
        ];
    }
}
