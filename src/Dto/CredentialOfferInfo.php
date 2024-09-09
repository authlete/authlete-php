<?php
//
// Copyright (C) 2024 Authlete, Inc.
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


/**
 * File containing the definition of CredentialOfferInfo class.
 */


namespace Authlete\Dto;


use Authlete\Types\Arrayable;
use Authlete\Types\ArrayCopyable;
use Authlete\Types\Jsonable;
use Authlete\Util\ArrayTrait;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Information about a credential offer.
 *
 * @since 1.13.0
 */
class CredentialOfferInfo implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $identifier                     = null;  // string
    private $credentialOffer                = null;  // string
    private $credentialIssuer               = null;  // string
    private $credentialConfigurationIds     = null;  // array of string
    private $authorizationCodeGrantIncluded = false; // boolean
    private $issuerStateIncluded            = false; // boolean
    private $issuerState                    = null;  // string
    private $preAuthorizedCodeGrantIncluded = false; // boolean
    private $preAuthorizedCode              = null;  // string
    private $subject                        = null;  // subject
    private $expiresAt                      = null;  // string or (64-bit) integer
    private $context                        = null;  // string
    private $properties                     = null;  // array of \Authlete\Dto\Property
    private $jwtAtClaims                    = null;  // string
    private $authTime                       = null;  // string or (64-bit) integer
    private $acr                            = null;  // string
    private $txCode                         = null;  // string
    private $txCodeInputMode                = null;  // string
    private $txCodeDescription              = null;  // string


    /**
     * Get the identifier of the credential offer.
     *
     * The identifier is a base64url string with 256-bit entropy consisting of
     * 43 characters.
     *
     * @return string
     *     The identifier of the credential offer.
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }


    /**
     * Set the identifier of the credential offer.
     *
     * The identifier is a base64url string with 256-bit entropy consisting of
     * 43 characters.
     *
     * @param string $identifier
     *     The identifier of the credential offer.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setIdentifier($identifier)
    {
        ValidationUtility::ensureNullOrString('$identifier', $identifier);

        $this->identifier = $identifier;

        return $this;
    }


    /**
     * Get the credential offer in the JSON format.
     *
     * @return string
     *     The credential offer in the JSON format.
     */
    public function getCredentialOffer()
    {
        return $this->credentialOffer;
    }


    /**
     * Set the credential offer in the JSON format.
     *
     * @param string $offer
     *     The credential offer in the JSON format.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setCredentialOffer($offer)
    {
        ValidationUtility::ensureNullOrString('$offer', $offer);

        $this->credentialOffer = $offer;

        return $this;
    }


    /**
     * Get the identifier of the credential issuer.
     *
     * @return string
     *     The identifier of the credential issuer.
     */
    public function getCredentialIssuer()
    {
        return $this->credentialIssuer;
    }


    /**
     * Set the identifier of the credential issuer.
     *
     * @param string $issuer
     *     The identifier of the credential issuer.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setCredentialIssuer($issuer)
    {
        ValidationUtility::ensureNullOrString('$issuer', $issuer);

        $this->credentialIssuer = $issuer;

        return $this;
    }


    /**
     * Get the value of the `credential_configuration_ids` property of
     * the credential offer.
     *
     * @return string[]
     *      The value of the `credential_configuration_ids` property of
     *      the credential offer.
     */
    public function getCredentialConfigurationIds()
    {
        return $this->credentialConfigurationIds;
    }


    /**
     * Set the value of the `credential_configuration_ids` property of
     * the credential offer.
     *
     * @param string[] $ids
     *      The value of the `credential_configuration_ids` property of
     *      the credential offer.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setCredentialConfigurationIds(array $ids = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$ids', $ids);

        $this->credentialConfigurationIds = $ids;

        return $this;
    }


    /**
     * Get the flag indicating whether the `authorization_code` object is
     * included in the `grants` object.
     *
     * @return boolean
     *     `true` if the `authorization_code` object is included in the
     *     `grants` object.
     */
    public function isAuthorizationCodeGrantIncluded()
    {
        return $this->authorizationCodeGrantIncluded;
    }


    /**
     * Set the flag indicating whether the `authorization_code` object is
     * included in the `grants` object.
     *
     * @param boolean $included
     *     `true` to indicate that the `authorization_code` object is included
     *     in the `grants` object.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setAuthorizationCodeGrantIncluded($included)
    {
        ValidationUtility::ensureBoolean('$included', $included);

        $this->authorizationCodeGrantIncluded = $included;

        return $this;
    }


    /**
     * Get the flag indicating whether the `issuer_state` object is
     * included in the `grants` object.
     *
     * @return boolean
     *     `true` if the `issuer_state` object is included in the
     *     `grants` object.
     */
    public function isIssuerStateIncluded()
    {
        return $this->issuerStateIncluded;
    }


    /**
     * Set the flag indicating whether the `issuer_state` object is
     * included in the `grants` object.
     *
     * @param boolean $included
     *     `true` to indicate that the `issuer_state` object is included
     *     in the `grants` object.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setIssuerStateIncluded($included)
    {
        ValidationUtility::ensureBoolean('$included', $included);

        $this->issuerStateIncluded = $included;

        return $this;
    }


    /**
     * Get the value of the `issuer_state` property in the
     * `authorization_code` object in the `grants` object.
     *
     * @return string
     *     The value of the `issuer_state` property in the
     *     `authorization_code` object in the `grants` object.
     */
    public function getIssuerState()
    {
        return $this->issuerState;
    }


    /**
     * Set the value of the `issuer_state` property in the
     * `authorization_code` object in the `grants` object.
     *
     * @param string $state
     *     The value of the `issuer_state` property in the
     *     `authorization_code` object in the `grants` object.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setIssuerState($state)
    {
        ValidationUtility::ensureNullOrString('$state', $state);

        $this->issuerState = $state;

        return $this;
    }


    /**
     * Get the flag indicating whether the
     * `urn:ietf:params:oauth:grant-type:pre-authorized_code` object is
     * included in the `grants` object.
     *
     * @return boolean
     *     `true` if the `urn:ietf:params:oauth:grant-type:pre-authorized_code`
     *     object is included in the `grants` object.
     */
    public function isPreAuthorizedCodeGrantIncluded()
    {
        return $this->preAuthorizedCodeGrantIncluded;
    }


    /**
     * Set the flag indicating whether the
     * `urn:ietf:params:oauth:grant-type:pre-authorized_code` object is
     * included in the `grants` object.
     *
     * @param boolean $included
     *     `true` to indicate that the
     *     `urn:ietf:params:oauth:grant-type:pre-authorized_code` object is
     *     included in the `grants` object.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setPreAuthorizedCodeGrantIncluded($included)
    {
        ValidationUtility::ensureBoolean('$included', $included);

        $this->preAuthorizedCodeGrantIncluded = $included;

        return $this;
    }


    /**
     * Get the value of the `pre-authorized_code` property in the
     * `urn:ietf:params:oauth:grant-type:pre-authorized_code` object in the
     * `grant` object.
     *
     * @return string
     *     The value of the `pre-authorized_code` property in the
     *     `urn:ietf:params:oauth:grant-type:pre-authorized_code` object
     *     in the `grant` object.
     */
    public function getPreAuthorizedCode()
    {
        return $this->preAuthorizedCode;
    }


    /**
     * Set the value of the `pre-authorized_code` property in the
     * `urn:ietf:params:oauth:grant-type:pre-authorized_code` object in the
     * `grant` object.
     *
     * @param string $code
     *     The value of the `pre-authorized_code` property in the
     *     `urn:ietf:params:oauth:grant-type:pre-authorized_code` object
     *     in the `grant` object.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setPreAuthorizedCode($code)
    {
        ValidationUtility::ensureNullOrString('$code', $code);

        $this->preAuthorizedCode = $code;

        return $this;
    }


    /**
     * Get the subject associated with the credential offer.
     *
     * This property holds the value specified by the `subject` request
     * parameter passed to the `/vci/offer/create` API.
     *
     * @return string
     *     The value of the subject.
     */
    public function getSubject()
    {
        return $this->subject;
    }


    /**
     * Set the subject associated with the credential offer.
     *
     * This property holds the value specified by the `subject` request
     * parameter passed to the `/vci/offer/create` API.
     *
     * @param string $subject
     *     The value of the subject.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setSubject($subject)
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the time at which the credential offer will expire.
     *
     * @return integer|string
     *     The time at which the credential offer will expire. The value
     *     represents milliseconds elapsed since the Unix epoch.
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }


    /**
     * Set the time at which the credential offer will expire.
     *
     * @param integer|string $expiresAt
     *     The time at which the credential offer will expire. The value
     *     represents milliseconds elapsed since the Unix epoch.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setExpiresAt($expiresAt)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$expiresAt', $expiresAt);

        $this->expiresAt = $expiresAt;

        return $this;
    }


    /**
     * Get the general-purpose arbitrary string.
     *
     * This property holds the value specified by the `context` request
     * parameter passed to the `/vci/offer/create` API.
     *
     * @return string
     *     The general-purpose arbitrary string.
     */
    public function getContext()
    {
        return $this->context;
    }


    /**
     * Set the general-purpose arbitrary string.
     *
     * This property holds the value specified by the `context` request
     * parameter passed to the `/vci/offer/create` API.
     *
     * @param string $context
     *     The general-purpose arbitrary string.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setContext($context)
    {
        ValidationUtility::ensureNullOrString('$context', $context);

        $this->context = $context;

        return $this;
    }


    /**
     * Get the properties associated with the credential offer.
     *
     * @return Property[]
     *     Properties.
     */
    public function getProperties()
    {
        return $this->properties;
    }


    /**
     * Set the properties associated with the credential offer.
     *
     * @param Property[] $properties
     *     Properties.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setProperties(array $properties = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$properties', $properties, __NAMESPACE__ . '\Property');

        $this->properties = $properties;

        return $this;
    }


    /**
     * Get the additional claims in JSON object format that are added to the
     * payload part of the JWT access token.
     *
     * This property has a meaning only when the format of access tokens issued
     * by the service is JWT. In other words, it has a meaning only when the
     * `accessTokenSignAlg` property of the `Service` holds a non-null value.
     *
     * The additional claims will be eventually associated with an access token
     * which will be created based on the credential offer.
     *
     * @return string
     *     Additional claims that are added to the payload part of the JWT
     *     access token.
     */
    public function getJwtAtClaims()
    {
        return $this->jwtAtClaims;
    }


    /**
     * Set the additional claims in JSON object format that are added to the
     * payload part of the JWT access token.
     *
     * This property has a meaning only when the format of access tokens issued
     * by the service is JWT. In other words, it has a meaning only when the
     * `accessTokenSignAlg` property of the `Service` holds a non-null value.
     *
     * The additional claims will be eventually associated with an access token
     * which will be created based on the credential offer.
     *
     * @param string $claims
     *     Additional claims that are added to the payload part of the JWT
     *     access token.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setJwtAtClaims($claims)
    {
        ValidationUtility::ensureNullOrString('$claims', $claims);

        $this->jwtAtClaims = $claims;

        return $this;
    }


    /**
     * Get the time when the user authentication was performed during the course
     * of issuing the credential offer.
     *
     * @return integer|string
     *     The time of the user authentication in seconds since the Unix epoch.
     */
    public function getAuthTime()
    {
        return $this->authTime;
    }


    /**
     * Set the time when the user authentication was performed during the course
     * of issuing the credential offer.
     *
     * @param integer|string $authTime
     *     The time of the user authentication in seconds since the Unix epoch.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setAuthTime($authTime)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$authTime', $authTime);

        $this->authTime = $authTime;

        return $this;
    }


    /**
     * Get the Authentication Context Class Reference of the user authentication
     * performed during the course of issuing the credential offer.
     *
     * @return string
     *     The Authentication Context Class Reference.
     */
    public function getAcr()
    {
        return $this->acr;
    }


    /**
     * Set the Authentication Context Class Reference of the user authentication
     * performed during the course of issuing the credential offer.
     *
     * @param string $acr
     *     The Authentication Context Class Reference.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setAcr($acr)
    {
        ValidationUtility::ensureNullOrString('$acr', $acr);

        $this->acr = $acr;

        return $this;
    }


    /**
     * Get the transaction code.
     *
     * @return string
     *     The transaction code.
     */
    public function getTxCode()
    {
        return $this->txCode;
    }


    /**
     * Set the transaction code.
     *
     * @param string $txCode
     *     The transaction code.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setTxCode($txCode)
    {
        ValidationUtility::ensureNullOrString('$txCode', $txCode);

        $this->txCode = $txCode;

        return $this;
    }


    /**
     * Get the input mode of the transaction code.
     *
     * @return string
     *     The input mode of the transaction code such as `numeric` and `text`.
     */
    public function getTxCodeInputMode()
    {
        return $this->txCodeInputMode;
    }


    /**
     * Set the input mode of the transaction code.
     *
     * @param string $inputMode
     *     The input mode of the transaction code such as `numeric` and `text`.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setTxCodeInputMode($inputMode)
    {
        ValidationUtility::ensureNullOrString('$inputMode', $inputMode);

        $this->inputMode = $inputMode;

        return $this;
    }


    /**
     * Get the description of the transaction code.
     *
     * @return string
     *     The description of the transaction code.
     */
    public function getTxCodeDescription()
    {
        return $this->txCodeDescription;
    }


    /**
     * Set the description of the transaction code.
     *
     * @param string $description
     *     The description of the transaction code.
     *
     * @return CredentialOfferInfo
     *     `$this` object.
     */
    public function setTxCodeDescription($description)
    {
        ValidationUtility::ensureNullOrString('$description', $description);

        $this->txCodeDescription = $description;

        return $this;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyToArray(array &$array)
    {
        $array['identifier']                     = $this->identifier;
        $array['credentialOffer']                = $this->credentialOffer;
        $array['credentialIssuer']               = $this->credentialIssuer;
        $array['credentialConfigurationIds']     = $this->credentialConfigurationIds;
        $array['authorizationCodeGrantIncluded'] = $this->authorizationCodeGrantIncluded;
        $array['issuerStateIncluded']            = $this->issuerStateIncluded;
        $array['issuerState']                    = $this->issuerState;
        $array['preAuthorizedCodeGrantIncluded'] = $this->preAuthorizedCodeGrantIncluded;
        $array['preAuthorizedCode']              = $this->preAuthorizedCode;
        $array['subject']                        = $this->subject;
        $array['expiresAt']                      = $this->expiresAt;
        $array['context']                        = $this->context;
        $array['properties']                     = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
        $array['jwtAtClaims']                    = $this->jwtAtClaims;
        $array['authTime']                       = $this->authTime;
        $array['acr']                            = $this->acr;
        $array['txCode']                         = $this->txCode;
        $array['txCodeInputMode']                = $this->txCodeInputMode;
        $array['txCodeDescription']              = $this->txCodeDescription;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyFromArray(array &$array)
    {
        // identifier
        $this->setIdentifier(
            LanguageUtility::getFromArray('identifier', $array));

        // credentialOffer
        $this->setCredentialOffer(
            LanguageUtility::getFromArray('credentialOffer', $array));

        // credentialIssuer
        $this->setCredentialIssuer(
            LanguageUtility::getFromArray('credentialIssuer', $array));

        // credentialConfigurationIds
        $_ids = LanguageUtility::getFromArray('credentialConfigurationIds', $array);
        $this->setCredentialConfigurationIds($_ids);

        // authorizationCodeGrantIncluded
        $this->setAuthorizationCodeGrantIncluded(
            LanguageUtility::getFromArrayAsBoolean('authorizationCodeGrantIncluded', $array));

        // issuerStateIncluded
        $this->setIssuerStateIncluded(
            LanguageUtility::getFromArrayAsBoolean('issuerStateIncluded', $array));

        // issuerState
        $this->setIssuerState(
            LanguageUtility::getFromArray('issuerState', $array));

        // preAuthorizedCodeGrantIncluded
        $this->setPreAuthorizedCodeGrantIncluded(
            LanguageUtility::getFromArrayAsBoolean('preAuthorizedCodeGrantIncluded', $array));

        // preAuthorizedCode
        $this->setPreAuthorizedCode(
            LanguageUtility::getFromArray('preAuthorizedCoe', $array));

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // expiresAt
        $this->setExpiresAt(
            LanguageUtility::getFromArray('expiresAt', $array));

        // context
        $this->setContext(
            LanguageUtility::getFromArray('context', $array));

        // properties
        $_properties = LanguageUtility::getFromArray('properties', $array);
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable($_properties, __NAMESPACE__ . '\Property');
        $this->setProperties($_properties);

        // jwtAtClaims
        $this->setJwtAtClaims(
            LanguageUtility::getFromArray('jwtAtClaims', $array));

        // authTime
        $this->setAuthTime(
            LanguageUtility::getFromArray('authTime', $array));

        // acr
        $this->setAcr(
            LanguageUtility::getFromArray('acr', $array));

        // txCode
        $this->setTxCode(
            LanguageUtility::getFromArray('txCode', $array));

        // txCodeInputMode
        $this->setTxCodeInputMode(
            LanguageUtility::getFromArray('txCodeInputMode', $array));

        // txCodeDescription
        $this->setTxCodeDescription(
            LanguageUtility::getFromArray('txCodeDescription', $array));
    }
}
?>
