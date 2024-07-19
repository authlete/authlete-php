<?php

namespace Authlete\Types;

enum FapiMode: string implements Valuable
{
    use EnumTrait;

    /**
     * {@code "fapi1_baseline"} (1).
     *
     * <p>
     * The FAPI mode for "<a href="https://openid.net/specs/openid-financial-api-part-1-1_0.html">
     * Financial-grade API Security Profile 1.0 - Part 1: Baseline</a>".
     * </p>
     */
    case FAPI1_BASELINE = 'fapi1_baseline';


    /**
     * {@code "fapi1_advanced"} (2).
     *
     * <p>
     * The FAPI mode for "<a href="https://openid.net/specs/openid-financial-api-part-2-1_0.html">
     * Financial-grade API Security Profile 1.0 - Part 2: Advanced</a>".
     * </p>
     */
    case FAPI1_ADVANCED = 'fapi1_advanced';


    /**
     * {@code "fapi2_security"} (3).
     *
     * <p>
     * The FAPI mode for "<a href="https://openid.net/specs/fapi-2_0-security-02.html">
     * FAPI 2.0 Security Profile</a>".
     * </p>
     */
    case FAPI2_SECURITY = 'fapi2_security';


    /**
     * {@code "fapi2_message_signing_auth_req"} (4).
     *
     * <p>
     * The FAPI mode for "<a href="https://openid.net/specs/fapi-2_0-message-signing.html#section-5.3">
     * 5.3. Signing Authorization Requests</a>" of "<a href="
     * https://openid.net/specs/fapi-2_0-message-signing.html">FAPI 2.0
     * Message Signing Profile</a>".
     * </p>
     */
    case FAPI2_MESSAGE_SIGNING_AUTH_REQ = 'fapi2_message_signing_auth_req';


    /**
     * {@code "fapi2_message_signing_auth_res"} (5).
     *
     * <p>
     * The FAPI mode for "<a href="https://openid.net/specs/fapi-2_0-message-signing.html#section-5.4">
     * 5.4. Signing Authorization Responses</a>" of "<a href="
     * https://openid.net/specs/fapi-2_0-message-signing.html">FAPI 2.0
     * Message Signing Profile</a>".
     * </p>
     */
    case FAPI2_MESSAGE_SIGNING_AUTH_RES = 'fapi2_message_signing_auth_res';


    /**
     * {@code "fapi2_message_signing_introspection_res"} (6).
     *
     * <p>
     * The FAPI mode for "<a href="https://openid.net/specs/fapi-2_0-message-signing.html#section-5.5">
     * 5.5. Signing Introspection Responses</a>" of "<a href="
     * https://openid.net/specs/fapi-2_0-message-signing.html">FAPI 2.0
     * Message Signing Profile</a>".
     * </p>
     */
    case FAPI2_MESSAGE_SIGNING_INTROSPECTION_RES = 'fapi2_message_signing_introspection_res';


}