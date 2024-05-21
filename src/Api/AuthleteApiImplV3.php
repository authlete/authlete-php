<?php

namespace Authlete\Api;


use Authlete\Conf\AuthleteConfiguration;
use Authlete\Dto\ClientListResponse;
use Authlete\Dto\Service;
use Authlete\Dto\ServiceListResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class AuthleteApiImplV3
{

    private static string $AUTH_AUTHORIZATION_API_PATH = "/api/%d/auth/authorization";
    private static string $AUTH_AUTHORIZATION_FAIL_API_PATH = "/api/%d/auth/authorization/fail";
    private static string $AUTH_AUTHORIZATION_ISSUE_API_PATH = "/api/%d/auth/authorization/issue";
    private static string $AUTH_AUTHORIZATION_TICKET_INFO_API_PATH = "/api/%d/auth/authorization/ticket/info";
    private static string $AUTH_AUTHORIZATION_TICKET_UPDATE_API_PATH = "/api/%d/auth/authorization/ticket/update";
    private static string $AUTH_TOKEN_API_PATH = "/api/%d/auth/token";
    private static string $AUTH_TOKEN_CREATE_API_PATH = "/api/%d/auth/token/create";
    private static string $AUTH_TOKEN_DELETE_API_PATH = "/api/%d/auth/token/delete/%s";
    private static string $AUTH_TOKEN_FAIL_API_PATH = "/api/%d/auth/token/fail";
    private static string $AUTH_TOKEN_GET_LIST_API_PATH = "/api/%d/auth/token/get/list";
    private static string $AUTH_TOKEN_ISSUE_API_PATH = "/api/%d/auth/token/issue";
    private static string $AUTH_TOKEN_REVOKE_API_PATH = "/api/%d/auth/token/revoke";
    private static string $AUTH_TOKEN_UPDATE_API_PATH = "/api/%d/auth/token/update";
    private static string $AUTH_REVOCATION_API_PATH = "/api/%d/auth/revocation";
    private static string $AUTH_USERINFO_API_PATH = "/api/%d/auth/userinfo";
    private static string $AUTH_USERINFO_ISSUE_API_PATH = "/api/%d/auth/userinfo/issue";
    private static string $AUTH_INTROSPECTION_API_PATH = "/api/%d/auth/introspection";
    private static string $AUTH_INTROSPECTION_STANDARD_API_PATH = "/api/%d/auth/introspection/standard";
    private static string $SERVICE_CONFIGURATION_API_PATH = "/api/%d/service/configuration";
    private static string $SERVICE_CREATE_API_PATH = "/api/service/create";
    private static string $SERVICE_DELETE_API_PATH = "/api/%d/service/delete";
    private static string $SERVICE_GET_API_PATH = "/api/%d/service/get";
    private static string $SERVICE_GET_LIST_API_PATH = "/api/service/get/list";
    private static string $SERVICE_JWKS_GET_API_PATH = "/api/%d/service/jwks/get";
    private static string $SERVICE_UPDATE_API_PATH = "/api/%d/service/update";
    private static string $CLIENT_CREATE_API_PATH = "/api/%d/client/create";
    private static string $CLIENT_REGISTRATION_API_PATH = "/api/%d/client/registration";
    private static string $CLIENT_REGISTRATION_GET_API_PATH = "/api/%d/client/registration/get";
    private static string $CLIENT_REGISTRATION_UPDATE_API_PATH = "/api/%d/client/registration/update";
    private static string $CLIENT_REGISTRATION_DELETE_API_PATH = "/api/%d/client/registration/delete";
    private static string $CLIENT_DELETE_API_PATH = "/api/%d/client/delete/%s";
    private static string $CLIENT_GET_API_PATH = "/api/%d/client/get/%s";
    private static string $CLIENT_GET_LIST_API_PATH = "/api/%d/client/get/list";
    private static string $CLIENT_SECRET_REFRESH_API_PATH = "/api/%d/client/secret/refresh/%s";
    private static string $CLIENT_SECRET_UPDATE_API_PATH = "/api/%d/client/secret/update/%s";
    private static string $CLIENT_UPDATE_API_PATH = "/api/%d/client/update/%d";
    private static string $REQUESTABLE_SCOPES_DELETE_API_PATH = "/api/%d/client/extension/requestable_scopes/delete/%d";
    private static string $REQUESTABLE_SCOPES_GET_API_PATH = "/api/%d/client/extension/requestable_scopes/get/%d";
    private static string $REQUESTABLE_SCOPES_UPDATE_API_PATH = "/api/%d/client/extension/requestable_scopes/update/%d";
    private static string $GRANTED_SCOPES_GET_API_PATH = "/api/%d/client/granted_scopes/get/%d";
    private static string $GRANTED_SCOPES_DELETE_API_PATH = "/api/%d/client/granted_scopes/delete/%d";
    private static string $CLIENT_AUTHORIZATION_DELETE_API_PATH = "/api/%d/client/authorization/delete/%d";
    private static string $CLIENT_AUTHORIZATION_GET_LIST_API_PATH = "/api/%d/client/authorization/get/list";
    private static string $CLIENT_AUTHORIZATION_UPDATE_API_PATH = "/api/%d/client/authorization/update/%d";
    private static string $JOSE_VERIFY_API_PATH = "/api/%d/jose/verify";
    private static string $BACKCHANNEL_AUTHENTICATION_API_PATH = "/api/%d/backchannel/authentication";
    private static string $BACKCHANNEL_AUTHENTICATION_COMPLETE_API_PATH = "/api/%d/backchannel/authentication/complete";
    private static string $BACKCHANNEL_AUTHENTICATION_FAIL_API_PATH = "/api/%d/backchannel/authentication/fail";
    private static string $BACKCHANNEL_AUTHENTICATION_ISSUE_API_PATH = "/api/%d/backchannel/authentication/issue";
    private static string $DEVICE_AUTHORIZATION_API_PATH = "/api/%d/device/authorization";
    private static string $DEVICE_COMPLETE_API_PATH = "/api/%d/device/complete";
    private static string $DEVICE_VERIFICATION_API_PATH = "/api/%d/device/verification";
    private static string $PUSHED_AUTH_REQ_API_PATH = "/api/%d/pushed_auth_req";
    private static string $HSK_CREATE_API_PATH = "/api/%d/hsk/create";
    private static string $HSK_DELETE_API_PATH = "/api/%d/hsk/delete/%s";
    private static string $HSK_GET_API_PATH = "/api/%d/hsk/get/%s";
    private static string $HSK_GET_LIST_API_PATH = "/api/%d/hsk/get/list";
    private static string $ECHO_API_PATH = "/api/misc/echo";
    private static string $GM_API_PATH = "/api/%d/gm";
    private static string $CLIENT_LOCK_FLAG_UPDATE_API_PATH = "/api/%d/client/lock_flag/update/%s";
    private static string $FEDERATION_CONFIGURATION_API_PATH = "/api/%d/federation/configuration";
    private static string $FEDERATION_REGISTRATION_API_PATH = "/api/%d/federation/registration";
    private static string $VCI_JWKS_API_PATH = "/api/%d/vci/jwks";
    private static string $VCI_JWT_ISSUER_API_PATH = "/api/%d/vci/jwtissuer";
    private static string $VCI_METADATA_API_PATH = "/api/%d/vci/metadata";
    private static string $VCI_OFFER_CREATE_API_PATH = "/api/%d/vci/offer/create";
    private static string $VCI_OFFER_INFO_API_PATH = "/api/%d/vci/offer/info";
    private static string $VCI_SINGLE_PARSE_API_PATH = "/api/%d/vci/single/parse";
    private static string $VCI_SINGLE_ISSUE_API_PATH = "/api/%d/vci/single/issue";
    private static string $VCI_BATCH_PARSE_API_PATH = "/api/%d/vci/batch/parse";
    private static string $VCI_BATCH_ISSUE_API_PATH = "/api/%d/vci/batch/issue";
    private static string $VCI_DEFERRED_PARSE_API_PATH = "/api/%d/vci/deferred/parse";
    private static string $VCI_DEFERRED_ISSUE_API_PATH = "/api/%d/vci/deferred/issue";
    private static string $ID_TOKEN_REISSUE_API_PATH = "/api/%d/idtoken/reissue";


    private int $mServiceId;
    private string $mAuth;
    private string $baseUrl;
    private Client $httpClient;
    private Serializer $serializer;


    /**
     * Constructor.
     *
     * @param AuthleteConfiguration $configuration
     *     An object that implements the `AuthleteConfiguration` interface.
     */
    public function __construct(AuthleteConfiguration $configuration)
    {
        $this->mAuth = $configuration->getServiceAccessToken();
        $this->mServiceId = $configuration->getServiceApiKey();
        $this->baseUrl = self::createBaseUrl($configuration);
        $this->httpClient = self::createHttpClient();
        $this->serializer = new Serializer(
            [new ObjectNormalizer()],
            [new JsonEncoder()]
        );


    }


    private function createBaseUrl(AuthleteConfiguration $configuration): string
    {
        $url = $configuration->getBaseUrl();

        if (is_null($url)) {
            throw new InvalidArgumentException(
                'The configuration does not have information about the base URL.');
        }

        return $url;
    }


    /**
     * @param Service $service
     * @return Service|null
     * @throws AuthleteApiException
     */
    public function createService(Service $service): ?Service
    {
        $uri = sprintf(self::$SERVICE_CREATE_API_PATH, $this->mServiceId);
        $sendGetRequest = self::sendPostRequest($uri, $service, $this->httpClient);
        return $this->serializer->deserialize($sendGetRequest, Service::class, 'json');
    }


    /**
     * @return Service|null
     * @throws AuthleteApiException
     */
    public function getService(): ?Service
    {
        $uri = sprintf(self::$SERVICE_GET_API_PATH, $this->mServiceId);
        $sendGetRequest = self::sendGetRequest($uri, null);
        return $this->serializer->deserialize($sendGetRequest, Service::class, 'json');
    }


    /**
     * @return ServiceListResponse
     * @throws AuthleteApiException
     */
    public function getServiceList(): ServiceListResponse
    {
        $uri = sprintf(self::$SERVICE_GET_LIST_API_PATH, $this->mServiceId);
        $queryParams = [
            'start' => 0,
            'end' => 5,
        ];
        $json = self::sendGetRequest($uri, $queryParams);
        return ServiceListResponse::fromJson($json);
    }


    /**
     * @return void
     * @throws AuthleteApiException
     */
    public function deleteService(): void
    {
        $uri = sprintf(self::$SERVICE_DELETE_API_PATH, $this->mServiceId);
        self::sendDeleteRequest($uri);
    }


    /**
     * @return string|null
     * @throws AuthleteApiException
     */
    public function getServiceConfiguration(): ?string
    {
        try {
            $uri = sprintf(self::$SERVICE_CONFIGURATION_API_PATH, $this->mServiceId);
            return $this->sendGetRequest($uri, null);
        } catch (GuzzleException $exception) {
            throw new AuthleteApiException($exception->getMessage(), $exception->getCode());
        }

    }


    /**
     * @throws AuthleteApiException
     */
    public function createClient(\Authlete\Dto\Client $client): ?\Authlete\Dto\Client
    {
        $uri = sprintf(self::$CLIENT_CREATE_API_PATH, $this->mServiceId);
        $sendGetRequest = self::sendPostRequest($uri, $client, $this->httpClient);
        return $this->serializer->deserialize($sendGetRequest, Client::class, 'json');
    }


    /**
     * @return \Authlete\Dto\Client
     * @throws AuthleteApiException
     */
    public function getClient(): \Authlete\Dto\Client
    {
        $uri = sprintf(self::$CLIENT_GET_API_PATH, $this->mServiceId);
        $json = self::sendGetRequest($uri, null);
        return \Authlete\Dto\Client::fromJson($json);
    }


    /**
     * @throws AuthleteApiException
     */
    public function getClientList(): ClientListResponse
    {
        $uri = sprintf(self::$CLIENT_GET_LIST_API_PATH, $this->mServiceId);
        $queryParams = [
            'start' => 0,
            'end' => 5,
        ];
        $json = self::sendGetRequest($uri, $queryParams);
        return ClientListResponse::fromJson($json);
    }


    /**
     * @return void
     * @throws AuthleteApiException
     */
    public function deleteClient(): void
    {
        $uri = sprintf(self::$CLIENT_DELETE_API_PATH, $this->mServiceId);
        self::sendDeleteRequest($uri);
    }


    private function createHttpClient(): Client
    {
        // Create a new GuzzleHttp client
        return new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 2.0,
        ]);
    }


    /**
     * @param string $uri
     * @param array|null $queryParams
     * @return string
     * @throws AuthleteApiException
     */
    private function sendGetRequest(string $uri, ?array $queryParams): string
    {
        try {
            $response = $this->httpClient->request('GET', $uri, [
                'query' => $queryParams, // URL Query parameters
                'headers' => $this->getHeaders()
            ]);
            return $response->getBody()->getContents();
        } catch (GuzzleException $exception) {
            throw new AuthleteApiException($exception->getMessage(), $exception->getCode());
        }
    }


    /**
     * @param string $uri
     * @return void
     * @throws AuthleteApiException
     */
    private function sendDeleteRequest(string $uri): void
    {
        try {
            $response = $this->httpClient->request('DELETE', $uri, [
//            'query' => ['key' => 'value'] // URL Query parameters
                'headers' => $this->getHeaders()
            ]);
        } catch (GuzzleException $exception) {
            throw new AuthleteApiException($exception->getMessage(), $exception->getCode());
        }
    }


    /**
     * @throws AuthleteApiException
     */
    private function sendPostRequest(string $uri, mixed $content, $client): string
    {
        try {
            $response = $client->request('POST', $uri, [
                'json' => $content, // Sending JSON payload
                'headers' => $this->getHeaders()
            ]);
            if ($response->getStatusCode() > 200 && $response->getStatusCode() < 300) {
                return $response->getBody()->getContents();
            }
        } catch (GuzzleException $exception) {
            throw new AuthleteApiException($exception->getMessage(), $exception->getCode());
        }

        $data = json_decode($response->getBody()->getContents(), true);
        throw new AuthleteApiException($data['resultMessage'], $response->getStatusCode(), $response->getHeaders());
    }


    private function getHeaders(): array
    {
        return [
            'Authorization' => sprintf('Bearer %s', $this->mAuth),
            'Accept' => 'application/json',
        ];
    }
}