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
namespace HyperfTest\Cases;

use Hyperf\Utils\ApplicationContext;
use Hyperf\JwtAuth\JwtManager;

/**
 * @internal
 * @coversNothing
 */
class ExampleTest extends AbstractTestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
        $this->assertTrue(extension_loaded('swoole'));
    }

    public function testJwtFunc()
    {
        $this->assertTrue(jwt() instanceof JwtManager);
    }

    public function testJwtParser()
    {
        $jwt = $this->jwt();
       // $token = $auth->builder()->withUid('1001')->getToken();
        //echo $token."\n";
        $token = $jwt->parser()->getJwt();
        echo $token;
        $this->assertTrue(true);
    }

    protected function jwt()
    {
        return ApplicationContext::getContainer()->get(JwtManager::class);
    }
}
