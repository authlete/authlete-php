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


namespace Tests\Web;



use Authlete\Web\HttpHeaders;
use PHPUnit\Framework\TestCase;


class HttpHeadersTest extends TestCase
{
    private function doTestMultipleValues($headers)
    {
        // Key's case-insensitivity for lookup.
        $this->assertEquals('Apple', $headers->getFirst('Fruits'));
        $this->assertEquals('Apple', $headers->getFirst('fruits'));
        $this->assertEquals('Apple', $headers->getFirst('FRUITS'));

        // Multiple values.
        $array = $headers->get('Fruits');
        $this->assertCount(3, $array);
        $this->assertEquals('Apple',  $array[0]);
        $this->assertEquals('Banana', $array[1]);
        $this->assertEquals('Cherry', $array[2]);

        // Case-sensitivity of original keys.
        $map = $headers->getMap();
        $this->assertTrue(array_key_exists('Fruits', $map));
        $this->assertFalse(array_key_exists('fruits', $map));
        $this->assertCount(3, $map['Fruits']);
    }


    private function doTestMultipleKeys($headers)
    {
        // Multiple keys.
        $this->assertEquals('Apple', $headers->getFirst('Fruits'));
        $this->assertEquals('Cat',   $headers->getFirst('Animals'));
        $this->assertNull($headers->getFirst('Unknown'));

    }


    public function testMultipleValues()
    {
        $headers = new HttpHeaders();
        $headers->add('Fruits', 'Apple')
                ->add('fruits', 'Banana')
                ->add('FRUITS', 'Cherry')
                ;

        $this->doTestMultipleValues($headers);
    }


    public function testMultipleKeys()
    {
        $headers = new HttpHeaders();
        $headers->add('Fruits',  'Apple')
                ->add('Animals', 'Cat')
                ;

        $this->doTestMultipleKeys($headers);
    }


    public function testParseMultipleValues()
    {
        $input = "Fruits: Apple\r\n"
               . "fruits: Banana\n"
               . "FRUITS: Cherry\r\n"
               . "\r\n"
               ;

        $headers = HttpHeaders::parse($input);

        $this->doTestMultipleValues($headers);
    }


    public function testParseMultipleKeys()
    {
        $input = "Fruits:  Apple\r\n"
               . "Animals: Cat"
               ;

        $headers = HttpHeaders::parse($input);

        $this->doTestMultipleKeys($headers);
    }
}
