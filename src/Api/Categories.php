<?php

namespace Abivia\Plaid\Api;

use Abivia\Plaid\PlaidRequestException;

class Categories extends AbstractResource
{
    /**
     * Get all Plaid categories.
     *
     * @return Categories
     * @throws PlaidRequestException
     */
	public function list(): self
	{
		$this->sendRequest('categories/get', [], false);

        return $this;
	}
}
