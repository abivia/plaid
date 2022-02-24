<?php

namespace Abivia\Plaid\Api;

use Abivia\Plaid\Helpers\CaseMapper;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Abivia\Plaid\Plaid;
use Abivia\Plaid\PlaidRequestException;
use UnexpectedValueException;

abstract class AbstractResource extends CaseMapper
{
    /**
     * @var string Plaid host URL.
     */
    private string $baseUrl;
    /**
     * @var string Plaid client Id.
     */
    private string $clientId;
    /**
     * @var string Plaid client secret.
     */
    private string $clientSecret;

    public object $data;

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $baseUrl
     */
    public function __construct(
        string $clientId,
        string $clientSecret,
        string $baseUrl
    )
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->baseUrl = $baseUrl;
    }

    public function __get(string $property)
    {
        return $this->data->$property;
    }

    /**
     * Build request body with client credentials.
     *
     * @param array $params
     * @return array
     */
    protected function addClientCredentials(array $params = []): array
    {
        return \array_merge(
            ['client_id' => $this->clientId, 'secret' => $this->clientSecret],
            $params
        );
    }

    public function response(): object{
        return $this->data;
    }

    /**
     * Send a request and parse the response.
     *
     * @param string $path
     * @param array $params
     * @param bool $addCredentials
     * @return object
     * @throws PlaidRequestException
     */
    protected function sendRequest(
        string $path, array $params = [], $addCredentials = true
    ): object
    {
        if ($addCredentials) {
            $params = $this->addClientCredentials($params);
        }

        $response = Http::withHeaders(['Plaid-Version' => Plaid::API_VERSION,])
            ->post($this->baseUrl . $path, $params);
        if ($response->failed()) {
            throw new PlaidRequestException($response);
        }

        $decoded = \json_decode($response->body());
        if (\json_last_error() !== JSON_ERROR_NONE || !is_object($decoded)) {
            throw new UnexpectedValueException("Invalid JSON response returned by Plaid");
        }
        $this->data = CaseMapper::map($decoded);

        return $this->data;
    }

    /**
     * Make an HTTP request and return the unmodified Response.
     *
     * @param string $path
     * @param array $params
     * @return Response
     * @throws PlaidRequestException
     */
    protected function sendRequestRawResponse(string $path, array $params = []): Response
    {
        $response = Http::withHeaders(["Plaid-Version" => Plaid::API_VERSION,])
            ->post($path, $params);

        if ($response->failed()) {
            throw new PlaidRequestException($response);
        }

        return $response;
    }
}
