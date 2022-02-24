<?php

namespace Abivia\Plaid;

use Exception;
use Illuminate\Http\Client\Response;

class PlaidRequestException extends Exception
{
	/**
	 * @var mixed the response body.
	 */
	protected mixed $body;

	/**
	 * PlaidRequestException constructor.
	 *
	 * @param Response $response
	 */
	public function __construct(Response $response)
	{
        parent::__construct();
        $this->body = \json_decode($response->body());
		$this->code = $response->status();
		$this->message = $this->body->display_message ?? ('HTTP error ' . $response->status());
	}

	/**
	 * Get the Plaid specific error response.
	 *
	 * @return object|null|false
	 */
	public function getBody(): mixed
	{
		return $this->body;
	}
}
