<?php

namespace Tests\Api;

use Authlete\Api\AuthleteApiImplV3;
use Authlete\Conf\AuthleteSimpleConfiguration;
use Authlete\Dto\Service;
use Authlete\Util\LanguageUtility;
use PHPUnit\Framework\TestCase;

class IntegrationTestBase extends TestCase
{
    private static string $ENV_BASE_URL = 'AUTHLETE_BASE_URL';
    private static string $ENV_SERVICE_ACCESS_TOKEN = 'AUTHLETE_SERVICE_ACCESS_TOKEN';
    private static string $ENV_SERVICE_API_VERSION = 'AUTHLETE_API_VERSION';

    static AuthleteSimpleConfiguration $configuration;

    public static function setUpBeforeClass(): void
    {
        // Create an instance which implements the AuthleteConfiguration
        // interface which holds parameters to access Authlete APIs.
        //
        // AuthleteEnvConfiguration reads the parameters from the
        // following environment variables.
        //
        //   - AUTHLETE_BASE_URL
        //   - AUTHLETE_SERVICEOWNER_APIKEY
        //   - AUTHLETE_SERVICEOWNER_APISECRET
        //   - AUTHLETE_SERVICE_APIKEY
        //   - AUTHLETE_SERVICE_APISECRET
        //
        $conf = new AuthleteSimpleConfiguration();
        $conf->setBaseUrl(LanguageUtility::getFromEnv(self::$ENV_BASE_URL));
        $conf->setServiceAccessToken(LanguageUtility::getFromEnv(self::$ENV_SERVICE_ACCESS_TOKEN));
        $conf->setApiVersion(LanguageUtility::getFromEnv(self::$ENV_SERVICE_API_VERSION));
        self::$configuration = $conf;

    }

    public function setUp(): void
    {
        $this->skipIfEmpty(self::$configuration->getBaseUrl(), 'AUTHLETE_BASE_URL') ||
        $this->skipIfEmpty(self::$configuration->getServiceAccessToken(), 'AUTHLETE_SERVICE_ACCESS_TOKEN');
        $this->skipIfEmpty(self::$configuration->getApiVersion(), 'AUTHLETE_API_VERSION');

        $apiVersion = self::$configuration->getApiVersion();
        // Skip all tests if the version is 3.0.0
        if (self::$configuration->getApiVersion() < '3.0.0') {
            $this->markTestSkipped("Skipping all tests for version $apiVersion");
        }
        ;
    }


    public function apiFor(?Service $service): AuthleteApiImplV3|null
    {
        $config = new AuthleteSimpleConfiguration();
        $config->setBaseUrl(LanguageUtility::getFromEnv(self::$ENV_BASE_URL));
        $config->setServiceAccessToken(LanguageUtility::getFromEnv(self::$ENV_SERVICE_ACCESS_TOKEN));

        if ($service == null) {
            $config->setServiceApiKey(123);
        }
        else {
            $config->setServiceApiKey((int)$service->getApiKey());
        }
        try {
            return new AuthleteApiImplV3($config);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    private function skipIfEmpty($value, $envname): bool
    {
        if (empty($value)) {
            $this->markTestSkipped("The environment variable, {$envname}, is not set.");
        }

        return false;
    }
}