README
======

Overview
--------

This is a PHP library for [Authlete Web APIs][2].

[Authlete][1] is a cloud service that provides an implementation of
[OAuth 2.0][3] & [OpenID Connect][4]. By using the Web APIs provided by
Authlete, you can develop a _DB-less_ authorization server and/or OpenID
provider. "DB-less" here means that you don't have to manage a database
server that stores authorization data (e.g. access tokens), settings of
authorization servers and settings of client applications. These data are
stored in the Authlete server on cloud.

Please read
*[New Architecture of OAuth 2.0 and OpenID Connect Implementation][5]*
for details about the architecture of Authlete. True engineers will love
the architecture ;-)

> The primary advantage of this architecture is in that the backend service
> can focus on implementing OAuth 2.0 and OpenID Connect without caring about
> other components such as identity management, user authentication, login
> session management, API management and fraud detection. And, consequently,
> it leads to another major advantage which enables the backend service
> (implementation of OAuth 2.0 and OpenID Connect) to be combined with any
> solution of other components and thus gives flexibility to frontend server
> implementations.


License
-------

  Apache License, Version 2.0


Composer
--------

```json
"require" : {
    "authlete/authlete" : "{version}"
}
```


Source Code (authlete-php)
--------------------------

  <code>https://github.com/authlete/authlete-php</code>


API Reference (authlete-php)
-------------------------------

  <code>https://authlete.github.io/authlete-php/</code>


API Reference (Authlete)
------------------------

  <code>https://docs.authlete.com/</code>


Description
-----------

#### How To Get AuthleteApi

All the methods to communicate with [Authlete Web APIs][2] are gathered in
`AuthleteApi` interface. Currently, `AuthleteApiImpl` class is the only class
that implements the interface.

The constructor of `AuthleteApiImpl` class requires an implementation of
`AuthleteConfiguration` interface. Once you prepare an implementation of
`AuthleteConfiguration` interface, you can create an `AuthleteApi` instance
as follows.

```php
// Prepare configuration to access Authlete Web APIs.
$conf = ...;

// Create an instance that implements AuthleteApi.
$api = new AuthleteApiImpl($conf);
```

`AuthleteConfiguration` is an interface that holds configuration values to
access Authlete Web APIs such as the URL of an Authlete server and API
credentials of a service. To be concrete, the interface has the following
methods.

| Method                       | Description                |
|:-----------------------------|:---------------------------|
| `getBaseUrl()`               | URL of an Authlete server  |
| `getServiceApiKey()`         | API key of a service       |
| `getServiceApiSecret()`      | API secret of a service    |
| `getServiceOwnerApiKey()`    | API key of your account    |
| `getServiceOwnerApiSecret()` | API secret of your account |

authlete-php includes three implementations of `AuthleteConfiguration`
interface as listed below.

| Class                         | Description                            |
|:------------------------------|:---------------------------------------|
| `AuthleteEnvConfiguration`    | Configuration by environment variables |
| `AuthleteIniConfiguration`    | Configuration by an ini file           |
| `AuthleteSimpleConfiguration` | Configuration by C# properties         |


#### AuthleteIniConfiguration

Among the three implementations of `AuthleteConfiguration` interface, this
section explains `AuthleteIniConfiguration` class.

`AuthleteIniConfiguration` class provides a mechanism to use an ini file to
set configuration values to access Authlete Web APIs. The format of the ini
file given to `AuthleteIniConfiguration` must be able to be parsed by
[parse_ini_file()][7] function.

The constructor of `AuthleteIniConfiguration` class has an optional argument,
`$file`, which is a name of an ini file. If the argument is omitted, the
constructor checks the value of the environment variable,
`AUTHLETE_CONFIGURATION_FILE`, and if the environment variable holds a
non-empty value, it is regarded as a name of an ini file. If a name of an ini
file is not available, the constructor assumes `authlete.ini`.

The following examples show the usage of the constructor.

```php
// (1) Constructor with no argument. This tries to read a file
//     named "authlete.ini". The environment variable,
//     AUTHLETE_CONFIGURATION_FILE, can be used to specify
//     another different file name.
$conf = new AuthleteIniConfiguration();

// (2) Constructor with the name of a configuration file.
$conf = new AuthleteIniConfiguration("authlete.ini");
```

`AuthleteIniConfiguration` class expects entries in the table below to be found
in the given configuration file.

| Property Key               | Description                |
|:---------------------------|:---------------------------|
| `base_url`                 | URL of an Authlete server  |
| `service.api_key`          | API key of a service       |
| `service.api_secret`       | API secret of a service    |
| `service_owner.api_key`    | API key of your account    |
| `service_owner.api_secret` | API secret of your account |

Below is an example of a configuration file.

```
base_url                 = https://api.authlete.com
service_owner.api_key    = 1532787510
service_owner.api_secret = 9Y0ZARGatedJRhsYLNfiK_aKQIBCug2O3JQU6srZrpk
service.api_key          = 9463955934
service.api_secret       = AAw0rner_wjRCpk-y1A6J9s20Bvez3GxEBoL9jOJVR0
```


#### AuthleteApi Settings

`getSettings()` method of `AuthleteApi` returns an instance of `Settings`
interface whereby you can adjust the behaviors of the implementation of
`AuthleteApi` interface.

```php
// Get an implementation of AuthleteApi interface.
$api = ...;

// Get the instance which holds settings of the implementation.
$settings = $api->getSettings();

// Set a connection timeout in seconds.
$settings->setConnectionTimeout(5);

// Set a proxy.
$settings->setProxyHost("proxy.example.com");
$settings->setProxyPort(8080);
$settings->setProxyTunnelUsed(false);
```


#### AuthleteApi Method Categories

Methods in the `AuthleteApi` interface can be divided into some categories.

  1. Methods for Authorization Endpoint Implementation

    - `authorization(AuthorizationRequest $request)`
    - `authorizationFail(AuthorizationFailRequest $request)`
    - `authorizationIssue(AuthorizationIssueRequest $request)`

  2. Methods for Token Endpoint Implementation

    - `token(TokenRequest $request)`
    - `tokenFail(TokenFailRequest $request)`
    - `tokenIssue(TokenIssueRequest $request)`

  3. Methods for Service Management

    - `createService(Service $service)`
    - `deleteService($serviceApiKey)`
    - `getService($serviceApiKey)`
    - `getServiceList()`
    - `getServiceList($start = 0, $end = 5)`
    - `updateService(Service $service)`

  4. Methods for Client Application Management

    - `createClient(Client $client)`
    - `deleteClient($clientId)`
    - `getClient($clientId)`
    - `getClientList($developer = null, $start = 0, $end = 5)`
    - `updateClient(Client $client)`
    - `refreshClientSecret($clientId)`
    - `updateClientSecret($clientId, $clientSecret)`

  5. Methods for Access Token Introspection

    - `introspection(IntrospectionRequest $request)`
    - `standardIntrospection(StandardIntrospectionRequest $request)`

  6. Methods for Revocation Endpoint Implementation

    - `revocation(RevocationRequest $request)`

  7. Methods for User Info Endpoint Implementation

    - `userinfo(UserInfoRequest $request)`
    - `userinfoIssue(UserInfoIssueRequest $request)`

  8. Methods for JWK Set Endpoint Implementation

    - `getServiceJwks($pretty = false, $includePrivateKeys = false)`

  9. Methods for OpenID Connect Discovery

    - `getServiceConfiguration($pretty = true)`

  10. Methods for Token Operations

    - `tokenCreate(TokenCreateRequest $request)`
    - `tokenUpdate(TokenUpdateRequest $request)`

  11. Methods for Records of Granted Scopes

    - `getGrantedScopes($clientId, $subject)`
    - `deleteGrantedScopes($clientId, $subject)`

  12. Methods for Authorization Management on a User-Client Combination Basis

    - `deleteClientAuthorization($clientId, $subject)`
    - `getClientAuthorizationList(ClientAuthorizationGetListRequest $request)`
    - `updateClientAuthorization($clientId, ClientAuthorizationUpdateRequest $request)`

*Example*

The following code snippet is an example to get the list of your services.
Each service corresponds to an authorization server.

```php
// Prepare configuration to access Authlete APIs.
// AuthleteSimpleConfiguration is used here as one
// implementation of AuthleteConfiguration interface.
// As described above, there are other implementations
// such as AuthleteIniConfiguraiton.
$conf = new AuthleteSimpleConfiguration();
$conf->setBaseUrl("https://api.authlete.com")
     ->setServiceOwnerApiKey("1532787510")
     ->setServiceOwnerApiSecret(9Y0ZARGatedJRhsYLNfiK_aKQIBCug2O3JQU6srZrpk")
     ->setServiceApiKey("9463955934")
     ->setServiceApiSecret("AAw0rner_wjRCpk-y1A6J9s20Bvez3GxEBoL9jOJVR0")
     ;

// Get an implementation of AuthleteApi interface.
// Currently, AuthleteApiImpl is the only class that
// implements the AuthleteApi interface.
$api = new AuthleteApiImpl($conf);

// Get the list of services. getServiceList() method
// returns an instance of ServiceListResponse class.
$response = $api->getServiceList();

// Array of Service instances.
$services = $response->getServices();
```


How To Test
-----------

#### 1. Unit Tests

    $ vendor/bin/phpunit tests


#### 2. Compatibility Check

    $ PHPCMD={path-to-php54}
        # e.g. PHPCMD=/usr/local/Cellar/php54/5.4.45_7/bin/php

    $ find src -name '*.php' -exec $PHPCMD -l '{}' \;


How To Release
--------------

#### 1. Update Documents

Update `CHANGES.md` and `CHANGES.ja.md`. Update `README.md` and `README.ja.md`,
too, if necessary.

#### 2. Update Version

[Packagist][8] (which this library is registered into) refers to git tags.
To utilize the mechanism, create a new tag for a new version. See
[Versions and constraints][9] for details.

    $ git tag X.Y.Z
    $ git push origin X.Y.Z

#### 3. Publish Library

If [GitHub Service Hook][10] is working correctly, changes are automatically
detected by [Packagist][8].

#### 4. Update API Reference

The following command updates documents under `docs` folder.

    $ rm -rf docs
    $ phpdoc

#### 5. Publish API Reference

    $ git add docs
    $ git commit -m 'Updated API reference for version X.Y.Z.'
    $ git push

See [Configuring a publishing source for GitHub Pages][11] for details.


Contact
-------

| Purpose   | Email Address        |
|:----------|:---------------------|
| General   | info@authlete.com    |
| Sales     | sales@authlete.com   |
| PR        | pr@authlete.com      |
| Technical | support@authlete.com |


[1]: https://www.authlete.com/
[2]: https://docs.authlete.com/
[3]: https://tools.ietf.org/html/rfc6749
[4]: https://openid.net/connect/
[5]: https://medium.com/@darutk/new-architecture-of-oauth-2-0-and-openid-connect-implementation-18f408f9338d
[7]: http://php.net/manual/en/function.parse-ini-file.php
[8]: https://packagist.org
[9]: https://getcomposer.org/doc/articles/versions.md
[10]: https://packagist.org/about#how-to-update-packages
[11]: https://help.github.com/articles/configuring-a-publishing-source-for-github-pages/
