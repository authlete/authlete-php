README (日本語)
===============

概要
--------

[Authlete Web APIs][2] のための PHP ライブラリです。

[Authlete][1] は [OAuth 2.0][3] と [OpenID Connect][4] の実装を提供するクラウドサービスです。
Authlete が提供する Web API を使い、DB-less (データベース無し)
の認可サーバーを構築することができます。「DB-less」とは、認可データ (アクセストークン等)、
認可サーバーの設定、クライアントアプリケーションの設定を保存するデータベースを管理する必要が無い、という意味です。
これらのデータはクラウド上にある Authlete サーバーに保存されます。

Authlete のアーキテクチャーの詳細については、
*[New Architecture of OAuth 2.0 and OpenID Connect Implementation][5]*
をお読みください。真のエンジニアであれば、このアーキテクチャーを気に入ってくれるはずです ;-)
なお、日本語版は「[OAuth 2.0 / OIDC 実装の新アーキテクチャー][6]」です。

> The primary advantage of this architecture is in that the
> backend service can focus on implementing OAuth 2.0 and OpenID
> Connect without caring about other components such as identity
> management, user authentication, login session management, API
> management and fraud detection. And, consequently, it leads to
> another major advantage which enables the backend service
> (implementation of OAuth 2.0 and OpenID Connect) to be combined
> with any solution of other components and thus gives flexibility
> to frontend server implementations.
>
> このアーキテクチャーの一番の利点は、アイデンティティー管理やユーザー認証、
> ログインセッション管理、API 管理、不正検出などの機能について気にすることなく、
> バックエンドサービスが OAuth 2.0 と OpenID Connect の実装に集中できることにあります。
> この帰結として、バックエンドサービス (OAuth 2.0 と OpenID Connect の実装)
> をどのような技術部品とも組み合わせることが可能というもう一つの大きな利点が得られ、
> フロントエンドサーバーの実装に柔軟性がもたらされます。


ライセンス
--------

  Apache License, Version 2.0


Composer
--------

```json
"require" : {
    "authlete/authlete" : "{version}"
}
```


Packagist
---------

  <code>https://packagist.org/packages/authlete/authlete</code>


ソースコード (authlete-php)
---------------------------

  <code>https://github.com/authlete/authlete-php</code>


API リファレンス (authlete-php)
----------------------------------

  <code>https://authlete.github.io/authlete-php/</code>


API リファレンス (Authlete)
---------------------------

  <code>https://docs.authlete.com/</code>


説明
----

#### AuthleteApi の取得方法

[Authlete Web API][2] とやりとりするメソッドは全て `AuthleteApi`
インターフェースに集められています。
現在のところ、このインターフェースを実装するクラスは `AuthleteApiImpl` クラスのみです。

`AuthleteApiImpl` クラスのコンストラクターは `AuthleteConfiguration`
インターフェースの実装を要求します。 `AuthleteConfiguration`
インタフェースの実装が用意できれば、次のようにして `AuthleteApi`
のインスタンスを作成することができます。

```php
// Authlete Web API にアクセスするための設定を用意する。
$conf = ...;

// AuthleteApi を実装するインスタンスを生成する。
$api = new AuthleteApiImpl($conf);
```

`AuthleteConfiguration` は、Authlete サーバーの URL やサービスの
API クレデンシャルズなどの、Authlete Web API
にアクセスするのに必要な設定値を保持するインターフェースです。
具体的には、このインターフェースには次のようなメソッド群があります。

| メソッド                     | 説明                                  |
|:-----------------------------|:--------------------------------------|
| `getBaseUrl()`               | Authlete サーバーの URL               |
| `getServiceApiKey()`         | サービスの API キー                   |
| `getServiceApiSecret()`      | サービスの API シークレット           |
| `getServiceOwnerApiKey()`    | あなたのアカウントの API キー         |
| `getServiceOwnerApiSecret()` | あなたのアカウントの API シークレット |

authlete-php には `AuthleteConfiguration` インターフェースの実装が三つ含まれています。

| クラス                            | 説明                           |
|:----------------------------------|:-------------------------------|
| `AuthleteEnvConfiguration`        | 環境変数による設定             |
| `AuthleteIniConfiguration`        | INI ファイルによる設定         |
| `AuthleteSimpleConfiguration`     | C# プロパティーによる設定      |


#### AuthleteIniConfiguration

`AuthleteConfiguration` インターフェースの三つの実装のうち、ここでは `AuthleteIniConfiguration`
クラスについて説明します。

`AuthleteIniConfiguration` クラスは、Authlete Web API へのアクセスに必要な設定を INI
ファイルでおこなう仕組みを提供します。 `AuthleteIniConfiguration` に渡す INI ファイルのフォーマットは
[parse_ini_file()][7] 関数で解析可能である必要があります。

`AuthleteIniConfiguration` クラスのコンストラクターは、オプショナルの引数 `$file` をとります。
これは、INI ファイルの名前です。 この引数が省略された場合、コンストラクターは、環境変数
`AUTHLETE_CONFIGURATION_FILE` の値を調べます。 この環境変数の値が空でなければ、それを INI
ファイルの名前とみなします。 INI ファイルの名前が得られない場合、コンストラクターは `authlete.ini`
を用います。

下記はコンストラクターの使用例です。

```php
// (1) 引数無しのコンストラクター。 "authlete.ini" という名前のファイルを
//     読もうとする。 AUTHLETE_CONFIGURATION_FILE という環境変数を用いて
//     他のファイル名を指定することもできる。
$conf = new AuthleteIniConfiguration();

// (2) 設定ファイル名を引数にとるコンストラクター。
$conf = new AuthleteIniConfiguration("authlete.ini");
```

`AuthleteIniConfiguration` クラスは、与えられた設定ファイル内に次の項目があることを期待しています。

| プロパティーキー           | 説明                                  |
|:---------------------------|:--------------------------------------|
| `base_url`                 | Authlete サーバーの URL               |
| `service.api_key`          | サービスの API キー                   |
| `service.api_secret`       | サービスの API シークレット           |
| `service_owner.api_key`    | あなたのアカウントの API キー         |
| `service_owner.api_secret` | あなたのアカウントの API シークレット |

下記は設定ファイルの例です。

```
base_url                 = https://api.authlete.com
service_owner.api_key    = 1532787510
service_owner.api_secret = 9Y0ZARGatedJRhsYLNfiK_aKQIBCug2O3JQU6srZrpk
service.api_key          = 9463955934
service.api_secret       = AAw0rner_wjRCpk-y1A6J9s20Bvez3GxEBoL9jOJVR0
```


#### AuthleteApi の設定

`AuthleteApi` の `getSettings()` メッソドは `Settings` インターフェースの実装を返します。
これを介して `AuthleteApi` インターフェースの実装の動作を調整することができます。

```php
// AuthleteApi インターフェースの実装を取得する。
$api = ...;

// 実装の設定を保持するインスタンスを取得する。
$settings = $api->getSettings();

// コネクションタイムアウトを秒単位で指定する。
$settings->setConnectionTimeout(5);

// プロキシーを設定する。
$settings->setProxyHost("proxy.example.com");
$settings->setProxyPort(8080);
$settings->setProxyTunnelUsed(false);
```


#### AuthleteApi メソッドのカテゴリー

`AuthleteApi` インターフェースのメソッド群は幾つかのカテゴリーに分けることができます。

  1. 認可エンドポイント実装のためのメソッド群

    - `authorization(AuthorizationRequest $request)`
    - `authorizationFail(AuthorizationFailRequest $request)`
    - `authorizationIssue(AuthorizationIssueRequest $request)`

  2. トークンエンドポイント実装のためのメソッド群

    - `token(TokenRequest $request)`
    - `tokenFail(TokenFailRequest $request)`
    - `tokenIssue(TokenIssueRequest $request)`

  3. サービス管理のためのメソッド群

    - `createService(Service $service)`
    - `deleteService($serviceApiKey)`
    - `getService($serviceApiKey)`
    - `getServiceList()`
    - `getServiceList($start = 0, $end = 5)`
    - `updateService(Service $service)`

  4. クライアントアプリケーション管理のためのメソッド群

    - `createClient(Client $client)`
    - `deleteClient($clientId)`
    - `getClient($clientId)`
    - `getClientList($developer = null, $start = 0, $end = 5)`
    - `updateClient(Client $client)`
    - `refreshClientSecret($clientId)`
    - `updateClientSecret($clientId, $clientSecret)`

  5. アクセストークンの情報取得のためのメソッド群

    - `introspection(IntrospectionRequest $request)`
    - `standardIntrospection(StandardIntrospectionRequest $request)`

  6. アクセストークン取り消しエンドポイント実装のためのメソッド群

    - `revocation(RevocationRequest $request)`

  7. ユーザー情報エンドポイント実装のためのメソッド群

    - `userinfo(UserInfoRequest $request)`
    - `userinfoIssue(UserInfoIssueRequest $request)`

  8. JWK セットエンドポイント実装のためのメソッド群

    - `getServiceJwks($pretty = false, $includePrivateKeys = false)`

  9. OpenID Connect Discovery のためのメソッド群

    - `getServiceConfiguration($pretty = true)`

  10. トークン操作のためのメソッド群

    - `tokenCreate(TokenCreateRequest $request)`
    - `tokenDelete($token)`
    - `tokenUpdate(TokenUpdateRequest $request)`

  11. 付与されたスコープの記録に関するメソッド群

    - `getGrantedScopes($clientId, $subject)`
    - `deleteGrantedScopes($clientId, $subject)`

  12. ユーザー・クライアント単位の認可管理に関するメソッド群

    - `deleteClientAuthorization($clientId, $subject)`
    - `getClientAuthorizationList(ClientAuthorizationGetListRequest $request)`
    - `updateClientAuthorization($clientId, ClientAuthorizationUpdateRequest $request)`

  13. CIBA (Client Initiated Backchannel Authentication) のためのメソッド群

    - `backchannelAuthentication(BackchannelAuthenticationRequest $request)`
    - `backchannelAuthenticationIssue(BackchannelAuthenticationIssueRequest $request)`
    - `backchannelAuthenticationFail(BackchannelAuthenticationFailRequest $request)`
    - `backchannelAuthenticationComplete(BackchannelAuthenticationCompleteRequest $request)`

  14. デバイスフロー (RFC 8628) のためのメソッド群

    - `deviceAuthorization(DeviceAuthorizationRequest $request)`
    - `deviceVerification(DeviceVerificationRequest $request)`
    - `deviceComplete(DeviceCompleteRequest $request)`

  15. PAR (Pushed Authorization Requests) のためのメソッド群

    - `pushAuthorizationRequest(PushedAuthReqRequest $request)`

*例*

次のコードは既存のサービスのリストを取得する例です。
各サービスは一つの認可サーバーに対応します。

```php
// Authlete API にアクセスするための設定を用意する。ここでは
// IAuthleteConfiguration インターフェースの実装の一つとして
// AuthleteSimpleConfiguration を用いている。前述のとおり、
// AuthleteIniConfiguration など、他の実装もある。
$conf = new AuthleteSimpleConfiguration();
$conf->setBaseUrl("https://api.authlete.com")
     ->setServiceOwnerApiKey("1532787510")
     ->setServiceOwnerApiSecret("9Y0ZARGatedJRhsYLNfiK_aKQIBCug2O3JQU6srZrpk")
     ->setServiceApiKey("9463955934")
     ->setServiceApiSecret("AAw0rner_wjRCpk-y1A6J9s20Bvez3GxEBoL9jOJVR0")
     ;

// AuthleteApi インターフェースの実装を取得する。
// 現在のところ AuthleteApi インターフェースを
// 実装しているのは AuthleteApiImpl クラスのみ。
$api = new AuthleteApiImpl($conf);

// サービスのリストを取得する。 getServiceList() メソッドは
// ServiceListResponse クラスのインスタンスを返す。
$response = $api->getServiceList();

// Service インスタンスの配列。
$services = $response->getServices();
```


テスト手順
----------

#### 1. ユニットテスト

    $ vendor/bin/phpunit tests


#### 2. 互換性チェック

    $ PHPCMD={php54 へのパス}
        # 例 PHPCMD=/usr/local/Cellar/php54/5.4.45_7/bin/php

    $ find src -name '*.php' -exec $PHPCMD -l '{}' \;


リリース手順
------------

#### 1. ドキュメント更新

`CHANGES.md` と `CHANGES.ja.md` を更新する。 必要があれば `README.md` と
`README.ja.md` も更新する。

#### 2. User-Agent 更新

`AuthleteApiImpl.php` 内の `$USER_AGENT` 変数の値を更新する。

#### 3. バージョン更新

[Packagist][8] (このライブラリの登録先) は git タグを参照する。 その仕組みを利用するため、
新しいバージョン用の新しいタグを作成する。 詳細は [Versions and constraints][9] を参照のこと。

    $ git tag X.Y.Z
    $ git push origin X.Y.Z

#### 4. ライブラリ公開

[GitHub Service Hook][10] が正しく動いていれば、[Packagist][8] が変更を自動的に検出する。

#### 5. API リファレンス更新

次のコマンドで `docs` 以下の文書が更新される。

    $ rm -rf docs
    $ phpdoc

#### 6. API リファレンス公開

    $ git add docs
    $ git commit -m 'Updated API reference for version X.Y.Z.'
    $ git push

詳細は [Configuring a publishing source for GitHub Pages][11] を参照のこと。


コンタクト
----------

| 目的 | メールアドレス       |
|:-----|:---------------------|
| 一般 | info@authlete.com    |
| 営業 | sales@authlete.com   |
| 広報 | pr@authlete.com      |
| 技術 | support@authlete.com |


[1]: https://www.authlete.com/
[2]: https://docs.authlete.com/
[3]: https://tools.ietf.org/html/rfc6749
[4]: https://openid.net/connect/
[5]: https://medium.com/@darutk/new-architecture-of-oauth-2-0-and-openid-connect-implementation-18f408f9338d
[6]: https://qiita.com/TakahikoKawasaki/items/b2a4fc39e0c1a1949aab
[7]: http://php.net/manual/en/function.parse-ini-file.php
[8]: https://packagist.org
[9]: https://getcomposer.org/doc/articles/versions.md
[10]: https://packagist.org/about#how-to-update-packages
[11]: https://help.github.com/articles/configuring-a-publishing-source-for-github-pages/
