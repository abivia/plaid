<?php
declare(strict_types=1);

namespace Abivia\Plaid\Entities;

class BacsAccount
{
    /**
     * @var string Account number.
     */
    protected string $account;

    /**
     * @var string Sort code.
     */
    protected string $sortCode;

    public function __construct(string $account, string $sortCode)
    {
        $this->account = $account;
        $this->sortCode = $sortCode;
    }

    public function toArray(): array
    {
        return [
            'account' => $this->account,
            'sort_code' => $this->sortCode
        ];
    }

}
