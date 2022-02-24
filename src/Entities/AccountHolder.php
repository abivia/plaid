<?php
declare(strict_types=1);

namespace Abivia\Plaid\Entities;

class AccountHolder
{
    /**
     * @var string|null Email address of account holder.
     */
    protected ?string $email;
    /**
     * @var string Legal name of account holder.
     */
    protected string $legalName;

    public function __construct(string $legalName, string $email = null)
    {
        $this->legalName = $legalName;
        $this->email = $email;
    }

    public function toArray(): array
    {
        return [
            'legal_name' => $this->legalName,
            'email' => $this->email
        ];
    }
}
