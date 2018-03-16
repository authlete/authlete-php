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


namespace Authlete\Tests\Dto;


require_once('vendor/autoload.php');


use PHPUnit\Framework\TestCase;
use Authlete\Dto\Address;


class AddressTest extends TestCase
{
    private const FORMATTED      = '_formatted_';
    private const STREET_ADDRESS = '_street_address_';
    private const LOCALITY       = '_locality_';
    private const REGION         = '_region_';
    private const POSTAL_CODE    = '_postal_code_';
    private const COUNTRY        = '_country_';


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


    /**
     * @expectedException InvalidArgumentException
     */
    public function testFormattedInvalidValue()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testStreetAddressInvalidValue()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testLocalityInvalidValue()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testRegionInvalidValue()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testPostalCodeInvalidValue()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testCountryInvalidArray()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonFormattedInvalidBool()
    {
        $json = '{"formatted":true}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonFormattedInvalidNumber()
    {
        $json = '{"formatted":123}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonFormattedInvalidArray()
    {
        $json = '{"formatted":["a","b"]}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonFormattedInvalidObject()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonStreetAddressInvalidBool()
    {
        $json = '{"street_address":true}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonStreetAddressInvalidNumber()
    {
        $json = '{"street_address":123}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonStreetAddressInvalidArray()
    {
        $json = '{"street_address":["a","b"]}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonStreetAddressInvalidObject()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonLocalityInvalidBool()
    {
        $json = '{"locality":true}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonLocalityInvalidNumber()
    {
        $json = '{"locality":123}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonLocalityInvalidArray()
    {
        $json = '{"locality":["a","b"]}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonLocalityInvalidObject()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRegionInvalidBool()
    {
        $json = '{"region":true}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRegionInvalidNumber()
    {
        $json = '{"region":123}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRegionInvalidArray()
    {
        $json = '{"region":["a","b"]}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonRegionInvalidObject()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonPostalCodeInvalidBool()
    {
        $json = '{"postal_code":true}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonPostalCodeInvalidNumber()
    {
        $json = '{"postal_code":123}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonPostalCodeInvalidArray()
    {
        $json = '{"postal_code":["a","b"]}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonPostalCodeInvalidObject()
    {
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


    /** @expectedException InvalidArgumentException */
    public function testFromJsonCountryInvalidBool()
    {
        $json = '{"country":true}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonCountryInvalidNumber()
    {
        $json = '{"country":123}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonCountryInvalidArray()
    {
        $json = '{"country":["a","b"]}';
        $obj  = Address::fromJson($json);
    }


    /** @expectedException InvalidArgumentException */
    public function testFromJsonCountryInvalidObject()
    {
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
}
?>
