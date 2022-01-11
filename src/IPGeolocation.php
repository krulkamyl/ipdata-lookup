<?php

namespace  IPDataExtension;

use Exception;
use IPDataExtension\Model\Data;

class IPGeolocation
{
    private string $ip;

    private \IPDataExtension\Client\HttpClient $request;

    const FORM_FIELDS = '8243';

    /**
     * Constructor
     *
     * @throws Exception
     */
    public function __construct($ip) {
        $this->request = new \IPDataExtension\Client\HttpClient();
        $this->ip = $ip;
    }

    /**
     *
     * Calling HttpClient to create get request
     *
     * @throws Exception
     */
    public function getIpData() : Data {

        $response = $this->request->get(
            $this->ip, [
                'fields' => self::FORM_FIELDS
            ]
        );

        return $this->makeModel($response);
    }

    /**
     * Create model from API response
     *
     * @param array $data
     * @return Data
     */
    private function makeModel(array $data) : Data {
        return new Model\Data($data);
    }
}