<?php

namespace Tests\Api;

use Authlete\Api\AuthleteApiException;
use Authlete\Dto\Service;

class ServiceTestV3 extends IntegrationTestBase
{
    public function testCreateService()
    {
        try {
            $service = new Service();
            $service->setServiceName("phpTest")->setDescription("Dummy service for testing php lib")
                ->setRefreshTokenDuration(10000)->setAccessTokenDuration(10000);
            $api = $this->apiFor(null);
            $service = $api->createService($service);
            $this->assertNotNull($service);
            return $service;
        } catch (AuthleteApiException $exception) {
            error_log("Authlete API Exception: " . $exception->getMessage());
            return null;
        }
    }


    /**
     * @depends testCreateService
     */
    public function testGetServiceConfiguration(Service $service)
    {
        try {
            $api = $this->apiFor($service);
            $serviceConfiguration = $api->getServiceConfiguration();
            $this->assertNotNull($serviceConfiguration);
        } catch (AuthleteApiException $exception) {
            error_log("Authlete API Exception: " . $exception->getMessage());
        }
    }


    /**
     * @depends testCreateService
     */
    public function testGetServiceList(Service $service)
    {
        try {
            $serviceListResponse = $this->apiFor($service)->getServiceList();
            $this->assertNotNull($serviceListResponse);
        } catch (AuthleteApiException $exception) {
            error_log("Authlete API Exception: " . $exception->getMessage());
        }
    }


    /**
     * @depends testCreateService
     */
    public function testDeleteService(Service $service)
    {
        try {
            $this->apiFor($service)->deleteService();
        } catch (AuthleteApiException $exception) {
            error_log("Authlete API Exception: " . $exception->getMessage());
        }
    }
}