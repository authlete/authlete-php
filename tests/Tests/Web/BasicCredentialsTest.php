<?php
//
// Copyright (C) 2018 Authlete, Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing,
// software distributed under the License is distributed on an
// "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
// either express or implied. See the License for the specific
// language governing permissions and limitations under the
// License.
//


namespace Authlete\Tests\Web;


require_once('vendor/autoload.php');


use PHPUnit\Framework\TestCase;
use Authlete\Web\BasicCredentials;


class BasicCredentialsTest extends TestCase
{
    private static $USERID      = 'userid';
    private static $PASSWORD    = 'password';
    private static $CREDENTIALS = 'userid:password';


    public function testConstructorTypical()
    {
        $obj = new BasicCredentials(self::$USERID, self::$PASSWORD);

        $this->assertEquals(self::$USERID,      $obj->getUserId());
        $this->assertEquals(self::$PASSWORD,    $obj->getPassword());
        $this->assertEquals(self::$CREDENTIALS, $obj->getCredentials());
    }


    public function testConstructorNull()
    {
        $obj = new BasicCredentials(null, null);

        $this->assertNull($obj->getUserId());
        $this->assertNull($obj->getPassword());
        $this->assertEquals(':', $obj->getCredentials());
    }


    public function testConstructorUserId()
    {
        $obj = new BasicCredentials(self::$USERID, null);

        $this->assertEquals(self::$USERID, $obj->getUserId());
        $this->assertNull($obj->getPassword());
        $this->assertEquals(self::$USERID . ':', $obj->getCredentials());
    }


    public function testConstructorPassword()
    {
        $obj = new BasicCredentials(null, self::$PASSWORD);

        $this->assertNull($obj->getUserId());
        $this->assertEquals(self::$PASSWORD, $obj->getPassword());
        $this->assertEquals(':' . self::$PASSWORD, $obj->getCredentials());
    }


    public function testParseTypical()
    {
        $input = "Basic " . base64_encode(self::$CREDENTIALS);
        $obj   = BasicCredentials::parse($input);

        $this->assertEquals(self::$USERID,      $obj->getUserId());
        $this->assertEquals(self::$PASSWORD,    $obj->getPassword());
        $this->assertEquals(self::$CREDENTIALS, $obj->getCredentials());
    }


    public function testParseNull()
    {
        $obj = BasicCredentials::parse(null);

        $this->assertNull($obj->getUserId());
        $this->assertNull($obj->getPassword());
        $this->assertEquals(':', $obj->getCredentials());
    }


    public function testParseInvalid()
    {
        $obj = BasicCredentials::parse("XXX ");

        $this->assertNull($obj->getUserId());
        $this->assertNull($obj->getPassword());
        $this->assertEquals(':', $obj->getCredentials());
    }


    public function testParseEmpty()
    {
        $obj = BasicCredentials::parse("Basic ");

        $this->assertNull($obj->getUserId());
        $this->assertNull($obj->getPassword());
        $this->assertEquals(':', $obj->getCredentials());
    }


    public function testParseUserId()
    {
        $input = "Basic " . base64_encode(self::$USERID . ':');
        $obj   = BasicCredentials::parse($input);

        $this->assertEquals(self::$USERID,       $obj->getUserId());
        $this->assertEquals(null,                $obj->getPassword());
        $this->assertEquals(self::$USERID . ':', $obj->getCredentials());
    }


    public function testParsePassword()
    {
        $input = "Basic " . base64_encode(':' . self::$PASSWORD);
        $obj   = BasicCredentials::parse($input);

        $this->assertEquals(null,                 $obj->getUserId());
        $this->assertEquals(self::$PASSWORD,      $obj->getPassword());
        $this->assertEquals(':' . self::$PASSWORD, $obj->getCredentials());
    }
}
?>
