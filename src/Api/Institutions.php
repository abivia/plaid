<?php

namespace Abivia\Plaid\Api;

use Abivia\Plaid\PlaidRequestException;

class Institutions extends AbstractResource
{
    /**
     * Get a specific Institution.
     *
     * @param string $institutionId
     * @param array<string> $countryCodes
     * @param array<string,mixed> $options
     * @return Institutions
     * @throws PlaidRequestException
     */
    public function get(string $institutionId, array $countryCodes, array $options = []): self
    {
        $this->sendRequest(
            'institutions/get_by_id',
            [
                'institution_id' => $institutionId,
                'country_codes' => $countryCodes,
                'options' => (object)$options
            ]
        );

        return $this;
    }

    /**
     * Get all Institutions.
     *
     * @param integer $count
     * @param integer $offset
     * @param array<string> $countryCodes
     * @param array<string,mixed> $options
     * @return Institutions
     * @throws PlaidRequestException
     */
    public function list(int $count, int $offset, array $countryCodes, array $options = []): self
    {
        $this->sendRequest(
            'institutions/get',
            [
                'count' => $count,
                'offset' => $offset,
                'country_codes' => $countryCodes,
                'options' => (object)$options
            ]
        );

        return $this;
    }

    /**
     * Find an Institution by a search query.
     *
     * @param string $query
     * @param array<string> $countryCodes Possible values: US, GB, ES, NL, FR, IE, CA
     * @param array<string> $products
     * @param array<string,mixed> $options
     * @return Institutions
     * @throws PlaidRequestException
     */
    public function find(
        string $query,
        array $countryCodes,
        array $products = [],
        array $options = []): self
    {
        $this->sendRequest(
            'institutions/search',
            [
                'query' => $query,
                'products' => $products ? $products : null,
                'country_codes' => $countryCodes,
                'options' => (object)$options
            ]
        );

        return $this;
    }

}
