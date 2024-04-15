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


namespace Tests\Dto;



use Authlete\Dto\Address;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class AddressTest extends TestCase
{
    const FORMATTED      = '_formatted_';
    const STREET_ADDRESS = '_street_address_';
    const LOCALITY       = '_locality_';
    const REGION         = '_region_';
    const POSTAL_CODE    = '_postal_code_';
    const COUNTRY        = '_country_';


    public function testFormattedValidValue()
    {
        $obj = new Address();
        $obj->setFormatted(self::FORMATTED);

        $this->assertEquals(self::FORMATTED, $obj->getFormatted());
    }


    public function testFormattedValidNull()
    {
        $obj = new Address();
        $obj->setFormatted(null);

        $this->assertNull($obj->getFormatted());
    }


    public function testFormattedInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Address();

        $invalid = array();
        $obj->setFormatted($invalid);
    }


    public function testStreetAddressValidValue()
    {
        $obj = new Address();
        $obj->setStreetAddress(self::STREET_ADDRESS);

        $this->assertEquals(self::STREET_ADDRESS, $obj->getStreetAddress());
    }


    public function testStreetAddressValidNull()
    {
        $obj = new Address();
        $obj->setStreetAddress(null);

        $this->assertNull($obj->getStreetAddress());
    }


    public function testStreetAddressInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Address();

        $invalid = array();
        $obj->setStreetAddress($invalid);
    }


    public function testLocalityValidValue()
    {
        $obj = new Address();
        $obj->setLocality(self::LOCALITY);

        $this->assertEquals(self::LOCALITY, $obj->getLocality());
    }


    public function testLocalityValidNull()
    {
        $obj = new Address();
        $obj->setLocality(null);

        $this->assertNull($obj->getLocality());
    }


    public function testLocalityInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Address();

        $invalid = array();
        $obj->setLocality($invalid);
    }


    public function testRegionValidValue()
    {
        $obj = new Address();
        $obj->setRegion(self::REGION);

        $this->assertEquals(self::REGION, $obj->getRegion());
    }


    public function testRegionValidNull()
    {
        $obj = new Address();
        $obj->setRegion(null);

        $this->assertNull($obj->getRegion());
    }


    public function testRegionInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Address();

        $invalid = array();
        $obj->setRegion($invalid);
    }


    public function testPostalCodeValidValue()
    {
        $obj = new Address();
        $obj->setPostalCode(self::POSTAL_CODE);

        $this->assertEquals(self::POSTAL_CODE, $obj->getPostalCode());
    }


    public function testPostalCodeValidNull()
    {
        $obj = new Address();
        $obj->setPostalCode(null);

        $this->assertNull($obj->getPostalCode());
    }


    public function testPostalCodeInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Address();

        $invalid = array();
        $obj->setPostalCode($invalid);
    }


    public function testCountryValidValue()
    {
        $obj = new Address();
        $obj->setCountry(self::COUNTRY);

        $this->assertEquals(self::COUNTRY, $obj->getCountry());
    }


    public function testCountryValidNull()
    {
        $obj = new Address();
        $obj->setCountry(null);

        $this->assertNull($obj->getCountry());
    }


    public function testCountryInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $obj = new Address();

        $invalid = array();
        $obj->setCountry($invalid);
    }


    public function testFromJsonInstanceValid()
    {
        $json = '{}';
        $obj  = Address::fromJson($json);

        $this->assertInstanceof(Address::class, $obj);
    }


    public function testFromJsonFormattedValidValue()
    {
        $json = '{"formatted":"' . self::FORMATTED . '"}';
        $obj  = Address::fromJson($json);

        $this->assertEquals(self::FORMATTED, $obj->getFormatted());
    }


    public function testFromJsonFormattedValidNull()
    {
        $json = '{"formatted":null}';
        $obj  = Address::fromJson($json);

        $this->assertNull($obj->getFormatted());
    }


    public function testFromJsonFormattedInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"formatted":true}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonFormattedInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"formatted":123}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonFormattedInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"formatted":["a","b"]}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonFormattedInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"formatted":{"a":"b"}}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonStreetAddressValidValue()
    {
        $json = '{"street_address":"' . self::STREET_ADDRESS . '"}';
        $obj  = Address::fromJson($json);

        $this->assertEquals(self::STREET_ADDRESS, $obj->getStreetAddress());
    }


    public function testFromJsonStreetAddressValidNull()
    {
        $json = '{"street_address":null}';
        $obj  = Address::fromJson($json);

        $this->assertNull($obj->getStreetAddress());
    }


    public function testFromJsonStreetAddressInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"street_address":true}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonStreetAddressInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"street_address":123}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonStreetAddressInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"street_address":["a","b"]}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonStreetAddressInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"street_address":{"a":"b"}}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonLocalityValidValue()
    {
        $json = '{"locality":"' . self::LOCALITY . '"}';
        $obj  = Address::fromJson($json);

        $this->assertEquals(self::LOCALITY, $obj->getLocality());
    }


    public function testFromJsonLocalityValidNull()
    {
        $json = '{"locality":null}';
        $obj  = Address::fromJson($json);

        $this->assertNull($obj->getLocality());
    }


    public function testFromJsonLocalityInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"locality":true}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonLocalityInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"locality":123}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonLocalityInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"locality":["a","b"]}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonLocalityInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"locality":{"a":"b"}}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonRegionValidValue()
    {
        $json = '{"region":"' . self::REGION . '"}';
        $obj  = Address::fromJson($json);

        $this->assertEquals(self::REGION, $obj->getRegion());
    }


    public function testFromJsonRegionValidNull()
    {
        $json = '{"region":null}';
        $obj  = Address::fromJson($json);

        $this->assertNull($obj->getRegion());
    }


    public function testFromJsonRegionInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"region":true}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonRegionInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"region":123}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonRegionInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"region":["a","b"]}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonRegionInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"region":{"a":"b"}}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonPostalCodeValidValue()
    {
        $json = '{"postal_code":"' . self::POSTAL_CODE . '"}';
        $obj  = Address::fromJson($json);

        $this->assertEquals(self::POSTAL_CODE, $obj->getPostalCode());
    }


    public function testFromJsonPostalCodeValidNull()
    {
        $json = '{"postal_code":null}';
        $obj  = Address::fromJson($json);

        $this->assertNull($obj->getPostalCode());
    }


    public function testFromJsonPostalCodeInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"postal_code":true}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonPostalCodeInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"postal_code":123}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonPostalCodeInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"postal_code":["a","b"]}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonPostalCodeInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"postal_code":{"a":"b"}}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonCountryValidValue()
    {
        $json = '{"country":"' . self::COUNTRY . '"}';
        $obj  = Address::fromJson($json);

        $this->assertEquals(self::COUNTRY, $obj->getCountry());
    }


    public function testFromJsonCountryValidNull()
    {
        $json = '{"country":null}';
        $obj  = Address::fromJson($json);

        $this->assertNull($obj->getCountry());
    }


    public function testFromJsonCountryInvalidBool()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"country":true}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonCountryInvalidNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"country":123}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonCountryInvalidArray()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"country":["a","b"]}';
        $obj  = Address::fromJson($json);
    }


    public function testFromJsonCountryInvalidObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $json = '{"country":{"a":"b"}}';
        $obj  = Address::fromJson($json);
    }


    public function testToJson()
    {
        $obj = new Address();
        $obj->setFormatted(self::FORMATTED)
            ->setStreetAddress(self::STREET_ADDRESS)
            ->setLocality(self::LOCALITY)
            ->setRegion(self::REGION)
            ->setPostalCode(self::POSTAL_CODE)
            ->setCountry(self::COUNTRY)
            ;

        $json  = $obj->toJson();
        $array = json_decode($json, true);

        // formatted
        $this->assertArrayHasKey('formatted', $array);
        $this->assertEquals(self::FORMATTED, $array['formatted']);

        // street_address
        $this->assertArrayHasKey('street_address', $array);
        $this->assertEquals(self::STREET_ADDRESS, $array['street_address']);

        // locality
        $this->assertArrayHasKey('locality', $array);
        $this->assertEquals(self::LOCALITY, $array['locality']);

        // region
        $this->assertArrayHasKey('region', $array);
        $this->assertEquals(self::REGION, $array['region']);

        // postal_code
        $this->assertArrayHasKey('postal_code', $array);
        $this->assertEquals(self::POSTAL_CODE, $array['postal_code']);

        // country
        $this->assertArrayHasKey('country', $array);
        $this->assertEquals(self::COUNTRY, $array['country']);
    }


    public function testFromArray()
    {
        $array = array(
            'formatted'      => self::FORMATTED,
            'street_address' => self::STREET_ADDRESS,
            'locality'       => self::LOCALITY,
            'region'         => self::REGION,
            'postal_code'    => self::POSTAL_CODE,
            'country'        => self::COUNTRY
        );

        $obj = Address::fromArray($array);

        $this->assertEquals(self::FORMATTED,      $obj->getFormatted());
        $this->assertEquals(self::STREET_ADDRESS, $obj->getStreetAddress());
        $this->assertEquals(self::LOCALITY,       $obj->getLocality());
        $this->assertEquals(self::REGION,         $obj->getRegion());
        $this->assertEquals(self::POSTAL_CODE,    $obj->getPostalCode());
        $this->assertEquals(self::COUNTRY,        $obj->getCountry());
    }


    public function testToArray()
    {
        $obj = new Address();
        $obj->setFormatted(self::FORMATTED)
            ->setStreetAddress(self::STREET_ADDRESS)
            ->setLocality(self::LOCALITY)
            ->setRegion(self::REGION)
            ->setPostalCode(self::POSTAL_CODE)
            ->setCountry(self::COUNTRY)
            ;

        $array = $obj->toArray();

        // formatted
        $this->assertArrayHasKey('formatted', $array);
        $this->assertEquals(self::FORMATTED, $array['formatted']);

        // street_address
        $this->assertArrayHasKey('street_address', $array);
        $this->assertEquals(self::STREET_ADDRESS, $array['street_address']);

        // locality
        $this->assertArrayHasKey('locality', $array);
        $this->assertEquals(self::LOCALITY, $array['locality']);

        // region
        $this->assertArrayHasKey('region', $array);
        $this->assertEquals(self::REGION, $array['region']);

        // postal_code
        $this->assertArrayHasKey('postal_code', $array);
        $this->assertEquals(self::POSTAL_CODE, $array['postal_code']);

        // country
        $this->assertArrayHasKey('country', $array);
        $this->assertEquals(self::COUNTRY, $array['country']);
    }
}

