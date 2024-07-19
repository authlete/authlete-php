<?php

namespace Authlete\Types;


/**
 * Values for the {```client_registration_types```} RP metadata and the
 * {```client_registration_types_supported```} OP metadata that are defined in
 * OpenID Federation 1&#x002E;0: https://openid.net/specs/openid-federation-1_0.html
 *
 * @see https://openid.net/specs/openid-federation-1_0.html OpenID Federation 1.0
 *
 */
enum ClientRegistrationType: string implements Valuable
{
    use EnumTrait;

    /**
     * {@code "automatic"} (1).
     */
    case AUTOMATIC = 'automatic';


    /**
     * {@code "explicit"} (2).
     */
    case EXPLICIT = 'explicit';

}
