<?php

namespace IPDataExtension\Model;

class Data
{
    private array $raw;

    protected string|null $country;

    protected string|null $countryCode;

    protected string|null $city;

    protected string|null $zip;

    /**
     * Constructor with parsing data to model
     *
     * @param array $data
     */
    public function __construct(array $data) {
        $this->raw = $data;

        $this->country = $this->getKeyAttribute('country');
        $this->countryCode = $this->getKeyAttribute('countryCode');
        $this->city = $this->getKeyAttribute('city');
        $this->zip = $this->getKeyAttribute('zip');
    }

    /**
     * Checks if key attribute exists and assign it
     *
     * @param string $key
     * @return null
     */
    protected function getKeyAttribute(string $key)
    {
        if (isset($this->raw[$key]))
        {
            return $this->raw[$key];
        }
        return null;
    }

}