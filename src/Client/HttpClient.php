<?php

namespace  IPDataExtension\Client;

use Exception;
use GuzzleHttp\Client;
use JsonException;

class HttpClient
{
    const URL = 'http://ip-api.com/json/';

    private static object $response;

    /**
     * Making HTTP Request
     *
     * @param string $endpoint
     * @param array $options
     *
     * @return array
     * @throws Exception
     */
    public function get(string $endpoint, array $options) : array
    {
        $client = new Client();

        self::$response = $client->get(
            self::URL.$endpoint,
                $options
            );

        return $this->response();
    }

    /**
     * Response request
     *
     * @return array
     * @throws Exception
     */
    private function response(): array
    {
        if (self::$response->getStatusCode() !== 200)
            throw new Exception(
                'HTTP Exception - STATUS-CODE '.self::$response->getStatusCode().': '.self::$response->getReasonPhrase()
            );

        try {
            return json_decode(
                self::$response->getBody(),
                true,
                512,
                JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new JsonException(
                $exception->getMessage()
            );
        }
    }
}