<?php

/**
 * RESTful API test file
 *
 * Just a exsample for api test!
 *
 * PHP version 5.5.9
 *
 * @category Test
 * @package  CS
 * @author   Jensyn <zhangyongjun369@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  GIT: 
 * @link     https://github.com/xiyou-linuxer/cs-xiyoulinux
 */

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * RESTfulApiTest class
 *
 * @category Test
 * @package  CS
 * @author   Jensyn <zhangyongjun369@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 1.0
 * @link     https://github.com/xiyou-linuxer/cs-xiyoulinux
 */
class RESTfulApiTest extends TestCase
{
    /**
     * A basic functional test restful api.
     *
     * @return void
     */
    public function testRESTfulApi()
    {
        $this->visit('/')
            ->seeJson(['error' => 'null']);
    }
}