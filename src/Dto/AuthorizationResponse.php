<?php
//
// Copyright (C) 2018-2021 Authlete, Inc.
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
 * File containing the definition of AuthorizationResponse class.
 */


namespace Authlete\Dto;


use Authlete\Types\Display;
use Authlete\Types\Prompt;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Response from Authlete's /api/auth/authorization API.
 *
 * Note: In the description below, "authorization server" is always used even
 * where "OpenID provider" should be used.
 *
 * Authlete's `/api/auth/authorization` API returns JSON which can be mapped
 * to this class. The authorization server implementation should retrieve the
 * value of the `action` response parameter (which can be obtained by
 * `getAction()` method) from the response and take the following steps
 * according to the value.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `AuthorizationAction::$INTERNAL_SERVER_ERROR`, it means that the request
 * from the authorization server implementation was wrong or that an error
 * occurred in Authlete. In either case, from a viewpoint of the client
 * application, it is an error on the server side. Therefore, the
 * authorization server implementation should generate a response to the
 * client application with the HTTP status of `500 Internal Server Error`.
 * Authlete recommends `application/json` as the content type although OAuth
 * 2.0 specification does not mention the format of the error response when
 * the redirect URI is not usable.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * describes the error, so it can be used as the entity body of the response.
 * The following illustrates the response which the authorization server
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 500 Internal Server Error
 * Content-Type: application/json
 * Cache-Control: no-store
 * Pragma: no-cache
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `AuthorizationAction::$BAD_REQUEST`, it means that the request from the
 * client application was invalid. The HTTP status of the response returned
 * to the client application should be `400 Bad Request` and Authlete
 * recommends `application/json` as the content type although OAuth 2.0
 * specification does not mention the format of the error response when the
 * redirect URI is not usable.
 *
 * In this case, `getResponseContent()` method returns a JSON string which
 * describes the error, so it can be used as the entity body of the response.
 * The following illustrates the response which the authorization server
 * implementation should generate and return to the client application.
 *
 * ```
 * HTTP/1.1 400 Bad Request
 * Content-Type: application/json
 * Cache-Control: no-store
 * Pragma: no-cache
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `AuthorizationAction::$LOCATION`, it means that the request from the
 * client application is invalid but the redirect URI to which the error
 * should be reported has been determined. The HTTP status of the response
 * returned to the client application should be `302 Found` and the `Location`
 * header must have a redirect URI with an `error` response parameter.
 *
 * In this case, `getResponseContent()` method returns the redirect URI which
 * has the `error` response parameter, so it can be used as the value of
 * `Location` header. The following illustrates the response which the
 * authorization server implementation should generate and return to the
 * client application.
 *
 * ```
 * HTTP/1.1 302 Found
 * Location: (The value returned from getResponseContent())
 * Cache-Control: no-store
 * Pragma: no-cache
 * ```
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `AuthorizationAction::$FORM`, it means that the request from the client
 * application is invalid but the redirect URI to which the error should be
 * reported has been determined, and that the request contains
 * `response_mode=form_post` as is defined in
 * [OAuth 2.0 Form Post Response Mode](https://openid.net/specs/oauth-v2-form-post-response-mode-1_0.html).
 * The HTTP status of the response returned to the client application should
 * be `200 OK` and the content type should be `text/html;charset=UTF-8`.
 *
 * In this case, `getResponseContent()` method returns an HTML which satisfies
 * the requirements of `response_mode=form_post`, so it can be used as the
 * entity body of the response. The following illustrates the response which
 * the authorization server implementation should generate and return to the
 * client application.
 *
 * ```
 * HTTP/1.1 200 OK
 * Content-Type: text/html;charset=UTF-8
 * Cache-Control: no-store
 * Pragma: no-cache
 *
 * (The value returned from getResponseContent())
 * ```
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `AuthorizationAction::$NO_INTERACTION`, it means that the request from the
 * client application has no problem and requires the authorization server to
 * process the request without displaying any user interface for authentication
 * and/or consent. This happens when the request contains `prompt=none`.
 *
 * In this case, the authorization server implementation should follow the
 * steps below.
 *
 * + **[END-USER AUTHENTICATION]**
 *
 *     Check whether an end-user has already logged in. If an end-user has
 *     logged in, go to the next step (**[MAX AGE]**).
 *     Otherwise, call Authlete's `/api/auth/authorization/fail` API with
 *     `reason=NOT_LOGGED_IN` and use the response from the API to generate
 *     a response to the client application.
 *
 * <br/>
 * + **[MAX AGE]**
 *
 *     Get the value of the max age by `getMaxAge()` method. The value
 *     represents the maximum authentication age which has come from the
 *     `max_age` request parameter or the `default_max_age` configuration
 *     parameter of the client application. If the value is 0, go to the
 *     next step (**[SUBJECT]**). Otherwise, follow the sub steps described
 *     below.
 *
 *     1. Get the time at which the end-user was authenticated. Note that
 *        this value is not managed by Authlete, meaning that it is expected
 *        that the authorization server implementation manages the value.
 *        If the authorization server implementation does not manage
 *        authentication time of end-users, call Authlete's
 *        `/api/auth/authorization/fail` API with
 *        `reason=MAX_AGE_NOT_SUPPORTED` and use the response from the API
 *        to generate a response to the client application.
 *
 *     2. Add the value of the maximum authentication age (which is
 *        represented in seconds to the authentication time.
 *
 *     3. Check whether the calculated value is equal to or greater than
 *        the current time. If this condition is satisfied, go to the next
 *        step (**[SUBJECT]**). Otherwise, call Authlete's
 *        `/api/auth/authorization/fail` API with `reason=EXCEEDS_MAX_AGE`
 *        and use the response from the API to generate a response to the
 *        client application.
 *
 * <br/>
 * + **[SUBJECT]**
 *
 *     Get the value of the requested subject by `getSubject()` method.
 *     The value represents an end-user who the client application expects
 *     to grant authorization. If the value is `null`, go to the next step
 *     (**[ACRs]**). Otherwise, follow the sub steps described below.
 *
 *     1. Compare the value of the requested subject to the subject (=
 *        unique user ID) of the current end-user.
 *
 *     2. If they are equal, go to the next step (**[ACRs]**).
 *
 *     3. If they are not equal, call Authlete's `/api/auth/authorization/fail`
 *        API with `reason=DIFFERENT_SUBJECT` and use the response from the
 *        API to generate a response to the client application.
 *
 * <br/>
 * + **[ACRs]**
 *
 *     Get the value of ACRs (Authentication Context Class References) by
 *     `getAcrs()` method. The value has come from (1) the `acr` claim in
 *     the `claims` request parameter, (2) the `acr_values` request parameter,
 *     or (3) the `default_acr_values` configuration parameter of the client
 *     application.
 *
 *     It is ensured that all the ACRs returned by `getAcrs()` method are
 *     supported by the authorization server implementation. In other words,
 *     it is ensured that all the ACRs are listed in the
 *     `acr_values_supported` configuration parameter of the authorization
 *     server.
 *
 *     If the value of ACRs is `null`, go to the next step (**[SCOPES]**).
 *     Otherwise, follow the sub steps described below.
 *
 *     1. Get the ACR performed for the authentication of the current
 *        end-user. Note that this value is managed not by Authlete but by
 *        the authorization server implementation. (If the authorization
 *        server implementation cannot handle ACRs, it should not have
 *        listed ACRs in the `acr_values_supported` configuration parameter.)
 *
 *     2. Compare the ACR value obtained in the above step to each element
 *        in the ACR array obtained by `getAcrs()` method in the listed
 *        order. If the ACR value was found in the array, go to the next
 *        step (**[SCOPES]**).
 *
 *     3. If the ACR value was not found in the ACR array (= if the ACR
 *        performed for the authentication of the current end-user did not
 *        match any one of the ACRs requested by the client application),
 *        check whether one of the requested ACRs must be satisfied or not
 *        by calling `isAcrEssential()` method. If `isAcrEssential()`
 *        returns `true`, call Authlete's `/api/auth/authorization/fail`
 *        API with `reason=ACR_NOT_SATISFIED` and use the response from
 *        the API to generate a response to the client application.
 *        Otherwise, go to the next step (**[SCOPES]**).
 *
 * <br/>
 * + **[SCOPES]**
 *
 *     Get the scopes by `getScopes()` method. If the array contains one or
 *     more scopes which have not been granted to the client application by
 *     the end-user in the past, call Authlete's
 *     `/api/auth/authorization/fail` API with `reason=CONSENT_REQUIRED` and
 *     use the response from the API to generate a response to the client
 *     application. Otherwise, go to the next step (**[ISSUE]**).
 *
 *     Note that Authlete provides APIs to manage records of granted scopes
 *     (`/api/client/granted_scopes/*` APIs), but the APIs work only in the
 *     case the Authlete server you use is a dedicated Authlete server
 *     (contact [sales@authlete.com](mailto:sales@authlete.com) for details).
 *     In other words, the APIs of the shared Authlete server are disabled
 *     intentionally (in order to prevent garbage data from being accumulated)
 *     and they return `403 Forbidden`.
 *
 * <br/>
 * + **[ISSUE]**
 *
 *     If all the above steps succeeded, the last step is to issue an
 *     authorization code, an ID token and/or an access token
 *     (`response_type=none` is a special case where nothing is issued).
 *     The last step can be performed by calling Authlete's
 *     `/api/auth/authorization/issue` API. The API requires the following
 *     parameters, which are represented as properties of the
 *     `AuthorizationIssueRequest` class. Prepare these parameters and call
 *     the `/api/auth/authorization/issue` API.
 *
 *     * `ticket` (required): This parameter represents a ticket which is
 *       exchanged with tokens at the `/api/auth/authorization/issue` API.
 *       Use the value returned from `getTicket()` method as it is.
 *
 *     * `subject` (required): This parameter represents the unique identifier
 *       of the current end-user. It is often called "User ID" and it may or
 *       may not be visible to the end-user. In any case, it is a number or a
 *       string assigned to the end-user by your service. Authlete does not
 *       care about the format of the value of the subject, but it must
 *       consist of only ASCII letters and its length must be equal to or less
 *       than 100.
 *
 *       When `getSubject()` method of `AuthorizationResponse` class
 *       returns a non-null value, the value of `subject` request parameter
 *       to `/api/auth/authorization/issue` API is necessarily identical.
 *
 *       The value of this request parameter will be embedded in an ID token
 *       as the value of the `sub` claim. When the value of the `subject_type`
 *       configuration parameter of the client is `PAIRWISE`, the value of the
 *       `sub` claim is different from the value specified here, but `PAIRWISE`
 *       is not supported by Authlete yet. See
 *       [8. Subject Identifier Types](https://openid.net/specs/openid-connect-core-1_0.html#SubjectIDTypes)
 *       of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
 *       for details about subject types.
 *
 *       You can use the `sub` request parameter to adjust the value of the
 *       `sub` claim in an ID token. See the description of the `sub` request
 *       parameter for details.
 *
 *     * `authTime` (optional): This parameter represents the time when the
 *       end-user authentication occurred. Its value is the number of seconds
 *       since the Unix epoch (1970-Jan-1). The value of this parameter will
 *       be embedded in an ID token as the value of the `auth_time` claim.
 *
 *     * `acr` (optional): This parameter represents the ACR (Authentication
 *       Context Class Reference) which the authentication of the end-user
 *       satisifes. When `getAcrs()` method returns a non-empty array and
 *       `isAcrEssential()` method returns `true`, the value of this parameter
 *       must be one of the array elements. Otherwise, even `null` is allowed.
 *       The value of this parameter will be embedded in an ID token as the
 *       value of the `acr` claim.
 *
 *     * `claims` (optional): This parameter represents claims of the end-user.
 *       "Claims" here are pieces of information about the end-user such as
 *       `name`, `email` and `birthdate`. The authorization server
 *       implementation is required to gather claims of the end-user, format
 *       the claim values into JSON and set the JSON string as the value of
 *       this parameter.
 *
 *       The claims which the authorization server implementation is required
 *       to gather can be obtained by `getClaims()` method.
 *
 *       For example, if `getClaims()` method returns an array which contains
 *       `name`, `email` and `birthdate`, the value of this parameter should
 *       look like the following.
 *
 *       ```
 *       {
 *           "name": "John Smith",
 *           "email": "john@example.com",
 *           "birthdate": "1974-05-06"
 *       }
 *       ```
 *
 *       `getClaimsLocales()` methods lists the end-user's preferred languages
 *       and scripts for claim values, ordered by preference. When
 *       `getClaimsLocales()` method returns a non-empty array, its elements
 *       should be taken into consideration when the authorization server
 *       implementation gathers claim values. Especially, note the excerpt
 *       below from
 *       [5.2. Claims Languages and Scripts](https://openid.net/specs/openid-connect-core-1_0.html#ClaimsLanguagesAndScripts)
 *       of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
 *
 *       > *"When the OP determines, either through the `claims_locales`
 *       > parameter, or by other means, that End-User and Client are
 *       > requesting Claims in only one set of languages and scripts,
 *       > it is RECOMMENDED that OPs return Claims without language
 *       > tags when they employ this language and script. It is also
 *       > RECOMMENDED that Clients be written in a manner that they
 *       > can handle and utilize Claims using language tags."*
 *
 *       If `getClaims()` method returns `null` or an empty array, the value
 *       of this parameter should be `null`.
 *
 *       See [5.1. Standard Claims](https://openid.net/specs/openid-connect-core-1_0.html#StandardClaims)
 *       of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
 *       for claim names and their value formats. Note (1) that the
 *       authorization server implementation may support its special claims
 *       ([5.1.2. Additional Claims](https://openid.net/specs/openid-connect-core-1_0.html#AdditionalClaims))
 *       and (2) that claim names may be followed by a language tag
 *       ([5.2. Claims Languages and Scripts](https://openid.net/specs/openid-connect-core-1_0.html#ClaimsLanguagesAndScripts)).
 *       Read the specification of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
 *       for details.
 *
 *       The claim values in this parameter will be embedded in an ID token.
 *
 *       `getIdTokenClaims()` is available since version 1.7. The method
 *       returns the value of the `id_token` property in the `claims`
 *       request parameter or in the `claims` property in a request object.
 *       The value returned from the method should be considered when you
 *       prepare claim values. See the description of the method for details.
 *
 *     * `properties` (optional): Extra properties to be associated with an
 *       access token and/or an authorization code that may be issued from
 *       the Authlete API. Note that the `properties` request parameter is
 *       accepted only when `Content-Type` of the request to Authlete's
 *       `/api/auth/authorization/issue` API is `application/json`, so don't
 *       use `application/x-www-form-urlencoded` if you want to use this
 *       request parameter.
 *
 *     * `scopes` (optional): Scopes to be associated with an access token
 *       and/or an authorization code. If this parameter is `null`, the
 *       scopes specified in the original authorization request from the
 *       client application are used. In other cases, the specified scopes
 *       by this parameter will replace the scopes contained in the original
 *       authorization request.
 *
 *       Even scopes that are not included in the original authorization
 *       request can be specified. However, as an exception, the `openid`
 *       scope is ignored on Authlete server side if it is not included in
 *       the original request. It is because the existence of the `openid`
 *       scope considerably changes the validation steps and because adding
 *       `openid` triggers generation of an ID token (although the client
 *       application has not requested it) and the behavior is a major
 *       violation against the specification.
 *
 *       If you add the `offline_access` scope although it is not included
 *       in the original request, keep in mind that the specification
 *       requires explicit consent from the end-user for the scope
 *       ([11. Offline Access](https://openid.net/specs/openid-connect-core-1_0.html#OfflineAccess)
 *       of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)).
 *       When `offline_access` is included in the original authorization
 *       request, the current implementation of Authlete's
 *       `/api/auth/authorization` API checks whether the authorization
 *       request has come along with the `prompt` request parameter and its
 *       value includes `consent`. However, note that the implementation of
 *       Authlete's `/api/auth/authorization/issue` API does not perform the
 *       same validation even if the `offline_access` scope is added via this
 *       `scopes` parameter.
 *
 *     * `sub` (optional): The value of the `sub` claim in an ID token which
 *       may be issued. If the value of this request parameter is not empty,
 *       it is used as the value of the `sub` claim. Otherwise, the value of
 *       the `subject` request parameter is used as the value of the `sub`
 *       claim. The main purpose of this parameter is to hide the actual
 *       value of the subject from client applications.
 *
 *     `/api/auth/authorization/issue` API returns a response in JSON format
 *     which can be mapped to `AuthorizationIssueResponse`. Use the response
 *     from the API to generate a response to the client application. See the
 *     description of `AuthorizationIssueResponse` for details.
 *
 * ---
 *
 * When the value returned from `getAction()` method is
 * `AuthorizationAction::$INTERACTION`, it means that the request from the
 * client application has no problem and requires the authorization server
 * to process the request with user interaction by an HTML form.
 *
 * The purpose of the UI displayed to the end-user is to ask the end-user to
 * grant authorization to a client application. The items described below are
 * some points which the authorization server implementation should take into
 * consideration when it builds the UI.
 *
 * + **[DISPLAY MODE]**
 *
 *     `AuthorizationResponse` contains `display` parameter. The value can be
 *     obtained by `getDisplay()` method and it is one of `PAGE` (default),
 *     `POPUP`, `TOUCH` and `WAP`. The meanings of the values are described in
 *     [3.1.2.1. Authentication Request](https://openid.net/specs/openid-connect-core-1_0.html#AuthRequest)
 *     of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
 *     Basically, the authorization server implementation should display the
 *     UI which is suitable for the display mode, but it is okay for the
 *     authorization server implementation to *"attempt to detect the
 *     capabilities of the User Agent and present an appropriate display."*
 *
 *     It is ensured that the value returned from `getDisplay()` method is
 *     one of the supported display values which are specified by the
 *     `display_values_supported` configuration parameter of the authorization
 *     server.
 *
 * <br/>
 * + **[UI LOCALE]**
 *
 *     `AuthorizationResponse` contains `ui_locales` parameter. The value can
 *     be obtained by `getUiLocales()` method and it is an array of language
 *     tag values (such as `fr-CA` and `en`) ordered by preference. The
 *     authorization server implementation should display the UI in one of
 *     the languages listed in the `ui_locales` parameter when possible.
 *
 *     It is ensured that language tags returned from `getUiLocales()`
 *     method are contained in the list of supported UI locales which are
 *     specified by the `ui_locales_supported` configuration parameter of
 *     the authorization server.
 *
 * <br/>
 * + **[CLIENT INFORMATION]**
 *
 *     The authorization server implementation should show the end-user
 *     information about the client application. The information can be
 *     obtained by `getClient()` method.
 *
 * <br/>
 * + **[SCOPES]**
 *
 *     A client application requires authorization for specific permissions.
 *     In OAuth 2.0 specification, *"scope"* is a technical term which
 *     represents a permission. `getScopes()` method returns scopes
 *     requested by the client application. The authorization server
 *     implementation should show the end-user the scopes.
 *
 *     The authorization server implementation may choose not to show scopes
 *     to which the end-user has given consent in the past. To put it the
 *     other way around, the authorization server implementation may show
 *     only the scopes to which the end-user has not given consent yet.
 *     However, if the value returned from `getPrompts()` method contains
 *     `Prompt::$CONSENT`, the authorization server implementation has to
 *     obtain explicit consent from the end-user even if the end-user has
 *     given consent to all the requested scopes in the past.
 *
 *     Note that Authlete provides APIs to manage records of granted scopes
 *     (`/api/client/granted_scopes/*` APIs), but the APIs work only in the
 *     case the Authlete server you use is a dedicated Authlete server
 *     (contact [sales@authlete.com](mailto:sales@authlete.com) for details).
 *     In other words, the APIs of the shared Authlete server are disabled
 *     intentionally (in order to prevent garbage data from being accumulated)
 *     and they return `403 Forbidden`.
 *
 *     It is ensured that scopes returned from `getScopes()` method are
 *     contained in the list of supported scopes parameter of the
 *     authorization server.
 *
 * <br/>
 * + **[END-USER AUTHENTICATION]**
 *
 *     Necessarily, the end-user must be authenticated (= must login your
 *     service) before granting authorization to the client application.
 *     Simply put, a login form is expected to be displayed for end-user
 *     authentication. The authorization server implementation must follow
 *     the steps described below to comply with OpenID Connect. (Or just
 *     always show a login form if it's too much of a bother to follow the
 *     steps below).
 *
 *     1. Get the value from `getPrompts()` method. It corresponds to the
 *        value of the `prompt` request parameter. Details of the request
 *        parameter are described in
 *        [3.1.2.1. Authentication Request](https://openid.net/specs/openid-connect-core-1_0.html#AuthRequest)
 *        of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
 *
 *     2. If the value returned from `getPrompts()` method contains
 *        `Prompt::$SELECT_ACCOUNT`, display a form to urge the end-user
 *        to select one of his/her accounts for login. If `getSubject()`
 *        method returns a non-null value, it is the end-user ID that the
 *        client application expects, so the value should be used to
 *        determine the value of the login ID. Note that a subject and a
 *        login ID are not necessarily equal. If `getSubject()` method
 *        returns `null`, the value returned from `getLoginHint()` method
 *        should be referred to as a hint to determine the value of the
 *        login ID. `getLoginHint()` method simply returns the value of
 *        the `login_hint` request parameter.
 *
 *     3. If the value returned from `getPrompts()` method contains
 *        `Prompt::$LOGIN`, display a form to urge the end-user to login
 *        even if the end-user has already logged in. If `getSubject()`
 *        method returns a non-null value, it is the end-user ID that the
 *        client application expects, so the value should be used to
 *        determine the value of the login ID. Note that a subject and a
 *        login ID are not necessarily equal. If `getSubject()` method
 *        returns `null`, the value returned from `getLoginHint()` should
 *        be referred to as a hint to determine the value of the login ID.
 *        `getLoginHint()` method simply returns the value of the
 *        `login_hint` request parameter.
 *
 *     4. If the value returned from `getPrompts()` method does not contain
 *        `Prompt::$LOGIN`, the authorization server implementation does not
 *        have to authenticate the end-user if all the conditions described
 *        below are satisfied. If any one of the condisionts is not satisfied,
 *        show a login form to authenticate the end-user.
 *
 *        * An end-user has already logged in your service.
 *
 *        * The login ID of the current end-user matches the value returned
 *          from the `getSubject()` method. This check is required only when
 *          the `getSubject()` method returns a non-null value.
 *
 *        * The max age, which is the number of seconds obtained by
 *          `getMaxAge()` method, has not passed since the current end-user
 *          logged in your service. This check is required only when
 *          `getMaxAge()` method returns a non-zero value.
 *
 *          If the authorization server implementation does not manage
 *          authentication time of end-users (= if the authorization server
 *          implementation cannot know when end-users logged in) and if
 *          `getMaxAge()` method returns a non-zero value, a login form
 *          should be displayed.
 *
 *        * The ACR (Authentication Context Class Reference) of the
 *          authentication performed for the current end-user satisfies one
 *          of the ACRs listed in the value returned from `getAcrs()` method.
 *          This check is required only when `getAcrs()` method returns a
 *          non-empty array.
 *
 *     In every case, the end-user authentication must satisfy one of the ACRs
 *     listed in the value returned from `getAcrs()` method when the method
 *     returns a non-empty array and `isAcrEssential()` method returns `true`.
 *
 * <br/>
 * + **[GRANT/DENY BUTTONS]**
 *
 *     The end-user is supposed to choose either (1) to grant authorization
 *     to the client application or (2) to deny the authorization request.
 *     The UI must have UI components to accept the decision by the end-user.
 *     Usually, a button to grant authorization and a button to deny the
 *     request are provided.
 *
 * <br/>
 * When the subject returned from `getSubject()` method is not `null`, the
 * end-user authentication must be performed for the subject, meaning that
 * the authorization server implemetation should repeatedly show a login
 * form until the subject is succesfully authenticated.
 *
 * The end-user will choose either (1) to grant authorization to the client
 * application or (2) to deny the authorization request. When the end-user
 * chose to deny the authorization request, call Authlete's
 * `/api/auth/authorization/fail` API with `reason=DENIED` and use the
 * response from the API to generate a response to the client application.
 *
 * When the end-user chose to grant authorization to the client application,
 * the authorization server implementation has to issue an authorization code,
 * an ID token, and/or an access token to the client application
 * (`response_type=none` is a special case where nothing is issued). Issuing
 * the tokens can be performed by calling Authlete's
 * `/api/auth/authorization/issue` API. Read **[ISSUE]** written above in the
 * description for the case of `action=NO_INTERACTION`.
 */
class AuthorizationResponse extends ApiResponse
{
    private ?AuthorizationAction $action   = null;
    private ?Service $service              = null;
    private ?Client $client                = null;
    private bool $clientIdAliasUsed        = false;
    private ?Display $display              = null;
    private string|int|null $maxAge        = null;
    private ?array $scopes                 = null;  // array of \Authlete\Dto\Scope
    private ?array $uiLocales              = null;  // array of string
    private ?array $claimsLocales          = null;  // array of string
    private ?array $claims                 = null;  // array of string
    private bool $acrEssential             = false;
    private ?array $acrs                   = null;  // array of string
    private ?string $subject               = null;
    private ?string $loginHint             = null;
    private ?array $prompts                = null;  // array of \Authlete\Types\Prompt
    private ?string $requestObjectPayload  = null;
    private ?string $idTokenClaims         = null;
    private ?string $userInfoClaims        = null;
    private ?array $resources              = null;  // array of string
    private ?string $purpose               = null;
    private ?string $responseContent       = null;
    private ?string $ticket                = null;


    /**
     * Get the next action that the authorization server implementation should
     * take.
     *
     * @return AuthorizationAction|null The next action that the authorization server implementation should
     *     The next action that the authorization server implementation should
     *     take.
     */
    public function getAction(): ?AuthorizationAction
    {
        return $this->action;
    }


    /**
     * Set the next action that the authorization server implementation should
     * take.
     *
     * @param AuthorizationAction|null $action
     *     The next action that the authorization server implementation should
     *     take.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setAction(AuthorizationAction $action = null): AuthorizationResponse
    {
        $this->action = $action;

        return $this;
    }


    /**
     * Get the information about the service.
     *
     * @return Service|null
     *     The information about the service.
     */
    public function getService(): ?Service
    {
        return $this->service;
    }


    /**
     * Set the information about the service.
     *
     * @param Service|null $service
     *     The information about the service.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setService(Service $service = null): AuthorizationResponse
    {
        $this->service = $service;

        return $this;
    }


    /**
     * Get the information about the client application that has made the
     * authorization request.
     *
     * @return Client|null
     *     The information about the client application.
     */
    public function getClient(): ?Client
    {
        return $this->client;
    }


    /**
     * Set the information about the client application that has made the
     * authorization request.
     *
     * @param Client|null $client
     *     The information about the client application.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setClient(Client $client = null): AuthorizationResponse
    {
        $this->client = $client;

        return $this;
    }


    /**
     * Get the flag which indicates whether the value of the `client_id`
     * request parameter included in the authorization request is the client
     * ID alias or the original numeric client ID.
     *
     * @return boolean
     *     The flag which indicates whether the client ID alias was used.
     *
     * @since 1.5
     */
    public function isClientIdAliasUsed(): bool
    {
        return $this->clientIdAliasUsed;
    }


    /**
     * Set the flag which indicates whether the value of the `client_id`
     * request parameter included in the authorization request is the client
     * ID alias or the original numeric client ID.
     *
     * @param boolean $used
     *     The flag which indicates whether the client ID alias was used.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     *
     * @since 1.5
     */
    public function setClientIdAliasUsed(bool $used): AuthorizationResponse
    {
        ValidationUtility::ensureBoolean('$used', $used);

        $this->clientIdAliasUsed = $used;

        return $this;
    }


    /**
     * Get the display mode which the client application requested by the
     * `display` request parameter.
     *
     * When the authorization request does not contain the `display` request
     * parameter, this method returns `Display::$PAGE` as the default value.
     *
     * @return Display|null
     *     The display mode.
     */
    public function getDisplay(): ?Display
    {
        return $this->display;
    }


    /**
     * Set the display mode which the client application requested by the
     * `display` request parameter.
     *
     * @param Display|null $display
     *     The display mode.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setDisplay(Display $display = null): AuthorizationResponse
    {
        $this->display = $display;

        return $this;
    }


    /**
     * Get the maximum authentication age which is the allowable elapsed time
     * in seconds since the last time the end-user was actively authenticated
     * by the authorization server implementation.
     *
     * The value of this property comes from either (1) the `max_age` request
     * parameter or (2) the `default_max_age` configuration parameter of the
     * client application. 0 may be returned which means that the max age
     * constraint does not have to be imposed.
     *
     * Regarding the `max_age` request parameter, see
     * [3.1.2.1. Authentication Request](https://openid.net/specs/openid-connect-core-1_0.html#AuthRequest)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * Regarding the `default_max_age` configuration parameter, see
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return int|string|null
     *     The maximum authentication age.
     */
    public function getMaxAge(): int|string|null
    {
        return $this->maxAge;
    }


    /**
     * Set the maximum authentication age which is the allowable elapsed time
     * in seconds since the last time the end-user was actively authenticated
     * by the authorization server implementation.
     *
     * @param integer|string $maxAge
     *     The maximum authentication age.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setMaxAge(int|string $maxAge): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrStringOrInteger('$maxAge', $maxAge);

        $this->maxAge = $maxAge;

        return $this;
    }


    /**
     * Get the scopes which the client application requested by the `scope`
     * request parameter.
     *
     * When the authorization request did not contain the `scope` request
     * parameter, this property returns a list of scopes which are marked
     * as default. `null` may be returned if the authorization request did
     * not contain valid scopes and none of registered scopes is marked as
     * default.
     *
     * You may want to enable end-users to select/deselect scopes in the
     * authorization page. In other words, you may want to use a different
     * set of scopes than the set specified by the original authorization
     * request. You can replace scopes when you call Authlete's
     * `/api/authorization/issue` API. See the description of
     * `AuthorizationIssueRequest::setScopes()` for details.
     *
     * @return array|null The scopes requested by the client application.
     *     The scopes requested by the client application.
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }


    /**
     * Set the scopes which the client application requested by the `scope`
     * request parameter.
     *
     * @param Scope[] $scopes
     *     The scopes requested by the client application.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setScopes(array $scopes = null): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$scopes', __NAMESPACE__ . '\Scope', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the list of preferred languages and scripts for the user interface.
     *
     * The value of this property comes from the `ui_locales` request
     * parameter. See
     * [3.1.2.1. Authentication Request](https://openid.net/specs/openid-connect-core-1_0.html#AuthRequest)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * @return array|null
     *     The list of preferred languages and scripts for the user interface.
     */
    public function getUiLocales(): ?array
    {
        return $this->uiLocales;
    }


    /**
     * Set the list of preferred languages and scripts for the user interface.
     *
     * @param string[] $uiLocales
     *     The list of preferred languages and scripts for the user interface.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setUiLocales(array $uiLocales = null): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$uiLocales', $uiLocales);

        $this->uiLocales = $uiLocales;

        return $this;
    }


    /**
     * Get the list of preferred languages and scripts for claim values
     * contained in an ID token.
     *
     * The value of this property comes from the `claims_locales` request
     * parameter. See
     * [3.1.2.1. Authentication Request](https://openid.net/specs/openid-connect-core-1_0.html#AuthRequest)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * @return array|null
     *     The list of preferred languages and scripts for claim values.
     */
    public function getClaimsLocales(): ?array
    {
        return $this->claimsLocales;
    }


    /**
     * Set the list of preferred languages and scripts for claim values
     * contained in an ID token.
     *
     * @param string[] $claimsLocales
     *     The list of preferred languages and scripts for claim values.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setClaimsLocales(array $claimsLocales = null): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$claimsLocales', $claimsLocales);

        $this->claimsLocales = $claimsLocales;

        return $this;
    }


    /**
     * Get the list of claims that the client application requested to be
     * embedded in an ID token.
     *
     * The value of this property comes from the `scope` and/or `claims`
     * request parameters of the original authorization request.
     *
     * @return array|null
     *     The list of claims requested by the client application.
     */
    public function getClaims(): ?array
    {
        return $this->claims;
    }


    /**
     * Set the list of claims that the client application requested to be
     * embedded in an ID token.
     *
     * @param string[] $claims
     *     The list of claims requested by the client application.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setClaims(array $claims = null): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$claims', $claims);

        $this->claims = $claims;

        return $this;
    }


    /**
     * Get the flag which indicates whether the end-user authentication must
     * satisfy one of the requested ACRs.
     *
     * This method returns `true` only when the authorization request from
     * the client application contains the `claims` request parameter and it
     * contains an entry for the `acr` claim with `"essential":true`. See
     * [5.5.1. Individual Claims Requests](https://openid.net/specs/openid-connect-core-1_0.html#IndividualClaimsRequests)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
     * for details.
     *
     * @return boolean
     *     `true` if one of the requested ACRs must be satisfied.
     */
    public function isAcrEssential(): bool
    {
        return $this->acrEssential;
    }


    /**
     * Set the flag which indicates whether the end-user authentication must
     * satisfy one of the requested ACRs.
     *
     * @param boolean $essential
     *     `true` if one of the requested ACRs must be satisfied.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setAcrEssential(bool $essential): AuthorizationResponse
    {
        ValidationUtility::ensureBoolean('$essential', $essential);

        $this->acrEssential = $essential;

        return $this;
    }


    /**
     * Get the list of ACRs (Authentication Context Class References)
     * requested by the client application.
     *
     * The value of this property comes from (1) the `acr` claim in the
     * `claims` request parameter, (2) the `acr_values` request parameter,
     * or (3) the `default_acr_values` configuration parameter of the client
     * application.
     *
     * Regarding the `claims` request parameter, see
     * [5.5. Requesting Claims using the "claims" Request Parameter](https://openid.net/specs/openid-connect-core-1_0.html#ClaimsParameter)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * Regarding the `acr_values` request parameter, see
     * [3.1.2.1. Authentication Request](https://openid.net/specs/openid-connect-core-1_0.html#AuthRequest)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * Regarding the `default_acr_values` configuration parameter of the
     * client application, see
     * [2. Client Metadata](https://openid.net/specs/openid-connect-registration-1_0.html#ClientMetadata)
     * of [OpenID Connect Dynamic Client Registration 1.0](https://openid.net/specs/openid-connect-registration-1_0.html).
     *
     * @return array|null
     *     The ACRs requested by the client application.
     */
    public function getAcrs(): ?array
    {
        return $this->acrs;
    }


    /**
     * Set the list of ACRs (Authentication Context Class References)
     * requested by the client application.
     *
     * @param string[] $acrs
     *     The ACRs requested by the client application.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setAcrs(array $acrs = null): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$acrs', $acrs);

        $this->acrs = $acrs;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the end-user that the client
     * application requested.
     *
     * The value of this property comes from the `sub` claim in the `claims`
     * request parameter.
     *
     * Regarding the `claims` request parameter, see
     * [5.5. Requesting Claims using the "claims" Request Parameter](https://openid.net/specs/openid-connect-core-1_0.html#ClaimsParameter)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * @return string|null
     *     The subject of the end-user that the client application requested.
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the end-user that the client
     * application requested.
     *
     * @param string $subject
     *     The subject of the end-user that the client application requested.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setSubject(string $subject): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the loogin hint specified by the "login_hint" request parameter.
     *
     * Regarding the `login_hint` request parameter, see
     * [3.1.2.1. Authentication Request](https://openid.net/specs/openid-connect-core-1_0.html#AuthRequest)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * @return string|null
     *     The value of the `login_hint` request parameter.
     */
    public function getLoginHint(): ?string
    {
        return $this->loginHint;
    }


    /**
     * Set the loogin hint specified by the "login_hint" request parameter.
     *
     * @param string $hint
     *     The value of the `login_hint` request parameter.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setLoginHint(string $hint): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$hint', $hint);

        $this->loginHint = $hint;

        return $this;
    }


    /**
     * Get the list of prompts contained in the authorization request.
     *
     * The value of this property comes from the `prompt` request parameter.
     * See
     * [3.1.2.1. Authentication Request](https://openid.net/specs/openid-connect-core-1_0.html#AuthRequest)
     * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * @return array|null
     *     The list of prompts requested by the client application.
     */
    public function getPrompts(): ?array
    {
        return $this->prompts;
    }


    /**
     * Set the list of prompts contained in the authorization request.
     *
     * @param Prompt[] $prompts
     *     The list of prompts requested by the client application.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setPrompts(array $prompts = null): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$prompts', '\Authlete\Types\Prompt', $prompts);

        $this->prompts = $prompts;

        return $this;
    }


    /**
     * Get the payload part of the request object.
     *
     * This method returns `null` if the authorization request does not
     * include a request object.
     *
     * @return string|null
     *     The payload part of the request object in JSON format.
     *
     * @since 1.7
     */
    public function getRequestObjectPayload(): ?string
    {
        return $this->requestObjectPayload;
    }


    /**
     * Set the payload part of the request object.
     *
     * @param string $payload
     *     The payload part of the request object.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setRequestObjectPayload(string $payload): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$payload', $payload);

        $this->requestObjectPayload = $payload;

        return $this;
    }


    /**
     * Get the value of the "id_token" property in the "claims" request
     * parameter or in the "claims" property in a request object.
     *
     * A client application may request certain claims be embedded in an
     * ID token or in a response from the UserInfo endpoint. There are
     * several ways. Including the `claims` request parameter and including
     * the `claims` property in a request object are such examples. In both
     * the cases, the value of the `claims` parameter/property is JSON. Its
     * format is described in
     * [5.5. Requesting Claims using the "claims" Request Parameter](https://openid.net/specs/openid-connect-core-1_0.html#ClaimsParameter)
     * of
     * [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * The following is an excerpt from the specification. You can find
     * `userinfo` and `id_token` are top-level properties.
     *
     * ```
     * {
     *  "userinfo":
     *   {
     *    "given_name": {"essential": true},
     *    "nickname": null,
     *    "email": {"essential": true},
     *    "email_verified": {"essential": true},
     *    "picture": null,
     *    "http://example.info/claims/groups": null
     *   },
     *  "id_token":
     *   {
     *    "auth_time": {"essential": true},
     *    "acr": {"values": ["urn:mace:incommon:iap:silver"] }
     *   }
     * }
     * ```
     *
     * This method (`getIdTokenClaims`) returns the value of the `id_token`
     * property in JSON format. For example, if the JSON above is included
     * in an authorization request, this method returns JSON equivalent to
     * the following.
     *
     * ```
     * {
     *  "auth_time": {"essential": true},
     *  "acr": {"values": ["urn:mace:incommon:iap:silver"] }
     * }
     * ```
     *
     * Note that if a request object is given and it contains the `claims`
     * property and if the `claims` request parameter is also given, this
     * method returns the value in the former.
     *
     * @return string|null
     *     The value of the `id_token` property in the `claims` in JSON
     *     format.
     *
     * @since 1.7
     */
    public function getIdTokenClaims(): ?string
    {
        return $this->idTokenClaims;
    }


    /**
     * Set the value of the `id_token` property in the `claims` request
     * parameter or in the `claims` property in a request object.
     *
     * @param string $claims
     *     The value of the `id_token` property in the `claims` in JSON
     *     format.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setIdTokenClaims(string $claims): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$claims', $claims);

        $this->idTokenClaims = $claims;

        return $this;
    }


    /**
     * Get the value of the "userinfo" property in the "claims" request
     * parameter or in the "claims" property in a request object.
     *
     * A client application may request certain claims be embedded in an
     * ID token or in a response from the UserInfo endpoint. There are
     * several ways. Including the `claims` request parameter and including
     * the `claims` property in a request object are such examples. In both
     * the cases, the value of the `claims` parameter/property is JSON. Its
     * format is described in
     * [5.5. Requesting Claims using the "claims" Request Parameter](https://openid.net/specs/openid-connect-core-1_0.html#ClaimsParameter)
     * of
     * [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html).
     *
     * The following is an excerpt from the specification. You can find
     * `userinfo` and `id_token` are top-level properties.
     *
     * ```
     * {
     *  "userinfo":
     *   {
     *    "given_name": {"essential": true},
     *    "nickname": null,
     *    "email": {"essential": true},
     *    "email_verified": {"essential": true},
     *    "picture": null,
     *    "http://example.info/claims/groups": null
     *   },
     *  "id_token":
     *   {
     *    "auth_time": {"essential": true},
     *    "acr": {"values": ["urn:mace:incommon:iap:silver"] }
     *   }
     * }
     * ```
     *
     * This method (`getUserInfoClaims`) returns the value of the `userinfo`
     * property in JSON format. For example, if the JSON above is included
     * in an authorization request, this method returns JSON equivalent to
     * the following.
     *
     * ```
     * {
     *  "given_name": {"essential": true},
     *  "nickname": null,
     *  "email": {"essential": true},
     *  "email_verified": {"essential": true},
     *  "picture": null,
     *  "http://example.info/claims/groups": null
     * }
     * ```
     *
     * Note that if a request object is given and it contains the `claims`
     * property and if the `claims` request parameter is also given, this
     * method returns the value in the former.
     *
     * @return string|null The value of the `userinfo` property in the `claims` in JSON
     *     The value of the `userinfo` property in the `claims` in JSON
     *     format.
     *
     * @since 1.7
     */
    public function getUserInfoClaims(): ?string
    {
        return $this->userInfoClaims;
    }


    /**
     * Set the value of the `userinfo` property in the `claims` request
     * parameter or in the `claims` property in a request object.
     *
     * @param string $claims
     *     The value of the `userinfo` property in the `claims` in JSON
     *     format.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     *
     * @since 1.7
     */
    public function setUserInfoClaims(string $claims): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$claims', $claims);

        $this->userInfoClaims = $claims;

        return $this;
    }


    /**
     * Get the resources specified by the `resource` request parameters or by
     * the `resource` property in the request object. If both are given, the
     * values in the request object take precedence.
     *
     * @return array|null
     *     Resources to be associated with tokens being issued.
     *
     * @see https://tools.ietf.org/html/rfc8707 RFC 8707 Resource Indicators for OAuth 2.0
     *
     * @since 1.8
     */
    public function getResources(): ?array
    {
        return $this->resources;
    }


    /**
     * Set the resources specified by the `resource` request parameters or by
     * the `resource` property in the request object. If both are given, the
     * values in the request object should be set.
     *
     * @param string[] $resources
     *     Resources to be associated with tokens being issued.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setResources(array $resources = null): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrArrayOfString('$resources', $resources);

        $this->resources = $resources;

        return $this;
    }


    /**
     * Set the value of the `purpose` request parameter.
     *
     * @param string $purpose
     *     The value of the `purpose` request parameter.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     *
     * @see https://openid.net/specs/openid-connect-4-identity-assurance-1_0.html OpenID Connect for Identity Assurance 1.0
     *
     * @since 1.8
     */
    public function setPurpose(string $purpose): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$purpose', $purpose);

        $this->purpose = $purpose;

        return $this;
    }


    /**
     * Get the response content which can be used to generate a response to
     * the client application.
     *
     * The format of the value varies depending on the value returned from
     * `getAction()` method.
     *
     * @return string|null
     *     The response content.
     */
    public function getResponseContent(): ?string
    {
        return $this->responseContent;
    }


    /**
     * Set the response content which can be used to generate a response to
     * the client application.
     *
     * @param string $responseContent
     *     The response content.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setResponseContent(string $responseContent): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$responseContent', $responseContent);

        $this->responseContent = $responseContent;

        return $this;
    }


    /**
     * Get the ticket issued from Authlete's `/api/auth/authorization` API
     * to the authorization server implementation.
     *
     * This ticket is necessary to call the `/api/auth/authorization/issue`
     * API or the `/api/auth/authorization/fail` API.
     *
     * @return string|null
     *     The ticket issued from `/api/auth/authorization` API.
     */
    public function getTicket(): ?string
    {
        return $this->ticket;
    }


    /**
     * Set the ticket issued from Authlete's `/api/auth/authorization` API
     * to the authorization server implementation.
     *
     * @param string $ticket
     *     The ticket issued from `/api/auth/authorization` API.
     *
     * @return AuthorizationResponse
     *     `$this` object.
     */
    public function setTicket(string $ticket): AuthorizationResponse
    {
        ValidationUtility::ensureNullOrString('$ticket', $ticket);

        $this->ticket = $ticket;

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
    public function copyToArray(array &$array): void
    {
        parent::copyToArray($array);

        $array['action']               = LanguageUtility::toString($this->action);
        $array['service']              = LanguageUtility::convertArrayCopyableToArray($this->service);
        $array['client']               = LanguageUtility::convertArrayCopyableToArray($this->client);
        $array['clientIdAliasUsed']    = $this->clientIdAliasUsed;
        $array['display']              = LanguageUtility::toString($this->display);
        $array['maxAge']               = LanguageUtility::orZero($this->maxAge);
        $array['scopes']               = LanguageUtility::convertArrayOfArrayCopyableToArray($this->scopes);
        $array['uiLocales']            = $this->uiLocales;
        $array['claimsLocales']        = $this->claimsLocales;
        $array['claims']               = $this->claims;
        $array['acrEssential']         = $this->acrEssential;
        $array['acrs']                 = $this->acrs;
        $array['subject']              = $this->subject;
        $array['loginHint']            = $this->loginHint;
        $array['prompts']              = LanguageUtility::convertArrayToStringArray($this->prompts);
        $array['requestObjectPayload'] = $this->requestObjectPayload;
        $array['idTokenClaims']        = $this->idTokenClaims;
        $array['userInfoClaims']       = $this->userInfoClaims;
        $array['resources']            = $this->resources;
        $array['purpose']              = $this->purpose;
        $array['responseContent']      = $this->responseContent;
        $array['ticket']               = $this->ticket;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyFromArray(array &$array): void
    {
        parent::copyFromArray($array);

        // action
        $this->setAction(
            AuthorizationAction::valueOf(
                LanguageUtility::getFromArray('action', $array)));

        // service
        $_service = LanguageUtility::getFromArray('service', $array);
        $this->setService(
            LanguageUtility::convertArrayToArrayCopyable(
                __NAMESPACE__ . '\Service', $_service));

        // client
        $_client = LanguageUtility::getFromArray('client', $array);
        $this->setClient(
            LanguageUtility::convertArrayToArrayCopyable(
                __NAMESPACE__ . '\Client', $_client));

        // clientIdAliasUsed
        $this->setClientIdAliasUsed(
            LanguageUtility::getFromArrayAsBoolean('clientIdAliasUsed', $array));

        // display
        $this->setDisplay(
            Display::valueOf(
                LanguageUtility::getFromArray('display', $array)));

        // maxAge
        $this->setMaxAge(
            LanguageUtility::getFromArray('maxAge', $array));

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $_scopes = LanguageUtility::convertArrayToArrayOfArrayCopyable(__NAMESPACE__ . '\Scope', $_scopes);
        $this->setScopes($_scopes);

        // uiLocales
        $_ui_locales = LanguageUtility::getFromArray('uiLocales', $array);
        $this->setUiLocales($_ui_locales);

        // claimsLocales
        $_claims_locales = LanguageUtility::getFromArray('claimsLocales', $array);
        $this->setClaimsLocales($_claims_locales);

        // claims
        $_claims = LanguageUtility::getFromArray('claims', $array);
        $this->setClaims($_claims);

        // acrEssential
        $this->setAcrEssential(
            LanguageUtility::getFromArrayAsBoolean('acrEssential', $array));

        // acrs
        $_acrs = LanguageUtility::getFromArray('acrs', $array);
        $this->setAcrs($_acrs);

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // loginHint
        $this->setLoginHint(
            LanguageUtility::getFromArray('loginHint', $array));

        // prompts
        $_prompts = LanguageUtility::getFromArray('prompts', $array);
        $_prompts = LanguageUtility::convertArray('\Authlete\Types\Prompt::valueOf', $_prompts);
        $this->setPrompts($_prompts);

        // requestObjectPayload
        $this->setRequestObjectPayload(
            LanguageUtility::getFromArray('requestObjectPayload', $array));

        // idTokenClaims
        $this->setIdTokenClaims(
            LanguageUtility::getFromArray('idTokenClaims', $array));

        // userInfoClaims
        $this->setUserInfoClaims(
            LanguageUtility::getFromArray('userInfoClaims', $array));

        // resources
        $_resources = LanguageUtility::getFromArray('resources', $array);
        $this->setResources($_resources);

        // purpose
        $this->setPurpose(
            LanguageUtility::getFromArray('purpose', $array));

        // responseContent
        $this->setResponseContent(
            LanguageUtility::getFromArray('responseContent', $array));

        // ticket
        $this->setTicket(
            LanguageUtility::getFromArray('ticket', $array));
    }
}

