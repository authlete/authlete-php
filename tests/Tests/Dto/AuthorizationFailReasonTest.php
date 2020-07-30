<?php
//
// Copyright (C) 2018-2020 Authlete, Inc.
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
use Authlete\Dto\AuthorizationFailReason;


class AuthorizationFailReasonTest extends TestCase
{
    public function testNameOfUnkown()
    {
        $action = AuthorizationFailReason::$UNKNOWN;

        $this->assertEquals('UNKNOWN', $action->name());
    }


    public function testValueOfUnknown()
    {
        $action = AuthorizationFailReason::$UNKNOWN;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('UNKNOWN'));
    }


    public function testNameOfNotLoggedIn()
    {
        $action = AuthorizationFailReason::$NOT_LOGGED_IN;

        $this->assertEquals('NOT_LOGGED_IN', $action->name());
    }


    public function testValueOfNotLoggedIn()
    {
        $action = AuthorizationFailReason::$NOT_LOGGED_IN;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('NOT_LOGGED_IN'));
    }


    public function testNameOfMaxAgeNotSupported()
    {
        $action = AuthorizationFailReason::$MAX_AGE_NOT_SUPPORTED;

        $this->assertEquals('MAX_AGE_NOT_SUPPORTED', $action->name());
    }


    public function testValueOfMaxAgeNotSupported()
    {
        $action = AuthorizationFailReason::$MAX_AGE_NOT_SUPPORTED;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('MAX_AGE_NOT_SUPPORTED'));
    }


    public function testNameOfExceedsMaxAge()
    {
        $action = AuthorizationFailReason::$EXCEEDS_MAX_AGE;

        $this->assertEquals('EXCEEDS_MAX_AGE', $action->name());
    }


    public function testValueOfExceedsMaxAge()
    {
        $action = AuthorizationFailReason::$EXCEEDS_MAX_AGE;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('EXCEEDS_MAX_AGE'));
    }


    public function testNameOfServerError()
    {
        $action = AuthorizationFailReason::$SERVER_ERROR;

        $this->assertEquals('SERVER_ERROR', $action->name());
    }


    public function testNameOfDifferentSubject()
    {
        $action = AuthorizationFailReason::$DIFFERENT_SUBJECT;

        $this->assertEquals('DIFFERENT_SUBJECT', $action->name());
    }


    public function testValueOfDifferentSubject()
    {
        $action = AuthorizationFailReason::$DIFFERENT_SUBJECT;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('DIFFERENT_SUBJECT'));
    }


    public function testNameOfAcrNotSatisfied()
    {
        $action = AuthorizationFailReason::$ACR_NOT_SATISFIED;

        $this->assertEquals('ACR_NOT_SATISFIED', $action->name());
    }


    public function testValueOfAcrNotSatisfied()
    {
        $action = AuthorizationFailReason::$ACR_NOT_SATISFIED;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('ACR_NOT_SATISFIED'));
    }


    public function testNameOfDenied()
    {
        $action = AuthorizationFailReason::$DENIED;

        $this->assertEquals('DENIED', $action->name());
    }


    public function testValueOfDenied()
    {
        $action = AuthorizationFailReason::$DENIED;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('DENIED'));
    }


    public function testValueOfServerError()
    {
        $action = AuthorizationFailReason::$SERVER_ERROR;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('SERVER_ERROR'));
    }


    public function testNameOfNotAuthenticated()
    {
        $action = AuthorizationFailReason::$NOT_AUTHENTICATED;

        $this->assertEquals('NOT_AUTHENTICATED', $action->name());
    }


    public function testValueOfNotAuthenticated()
    {
        $action = AuthorizationFailReason::$NOT_AUTHENTICATED;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('NOT_AUTHENTICATED'));
    }


    public function testNameOfAccountSelectionRequired()
    {
        $action = AuthorizationFailReason::$ACCOUNT_SELECTION_REQUIRED;

        $this->assertEquals('ACCOUNT_SELECTION_REQUIRED', $action->name());
    }


    public function testValueOfAccountSelectionRequired()
    {
        $action = AuthorizationFailReason::$ACCOUNT_SELECTION_REQUIRED;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('ACCOUNT_SELECTION_REQUIRED'));
    }


    public function testNameOfConsentRequired()
    {
        $action = AuthorizationFailReason::$CONSENT_REQUIRED;

        $this->assertEquals('CONSENT_REQUIRED', $action->name());
    }


    public function testValueOfConsentRequired()
    {
        $action = AuthorizationFailReason::$CONSENT_REQUIRED;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('CONSENT_REQUIRED'));
    }


    public function testNameOfInteractionRequired()
    {
        $action = AuthorizationFailReason::$INTERACTION_REQUIRED;

        $this->assertEquals('INTERACTION_REQUIRED', $action->name());
    }


    public function testValueOfInteractionRequired()
    {
        $action = AuthorizationFailReason::$INTERACTION_REQUIRED;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('INTERACTION_REQUIRED'));
    }


    public function testNameOfInvalidTarget()
    {
        $action = AuthorizationFailReason::$INVALID_TARGET;

        $this->assertEquals('INVALID_TARGET', $action->name());
    }


    public function testValueOfInvalidTarget()
    {
        $action = AuthorizationFailReason::$INVALID_TARGET;

        $this->assertSame($action, AuthorizationFailReason::valueOf($action));
        $this->assertSame($action, AuthorizationFailReason::valueOf('INVALID_TARGET'));
    }


    public function testValueOfNull()
    {
        $this->assertNull(AuthorizationFailReason::valueOf(null));
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidValue()
    {
        AuthorizationFailReason::valueOf('__INVALID_VALUE__');
    }


    /** @expectedException InvalidArgumentException */
    public function testValueOfInvalidArray()
    {
        AuthorizationFailReason::valueOf(array());
    }
}
?>
