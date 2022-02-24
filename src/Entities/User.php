<?php
declare(strict_types=1);

namespace Abivia\Plaid\Entities;

use function array_filter;

class User
{
    /**
     * @var string|null User date of birth
     */
    protected ?string $dateOfBirth;
    /**
     * @var string|null User email address
     */
    protected ?string $emailAddress;
    /**
     * @var string User ID
     */
    protected string $id;
    /**
     * @var ?string string|null User legal full name
     */
    protected $name;
    /**
     * @var string|null User phone number
     */
    protected ?string $phoneNumber;
    /**
     * @var string|null User phone number verified timestamp.
     */
    protected ?string $phoneNumberVerifiedTime;
    /**
     * @var string|null User social security number
     */
    protected ?string $ssn;

    public function __construct(
        string  $id,
        ?string $name = null,
        ?string $phoneNumber = null,
        ?string $phoneNumberVerifiedTime = null,
        ?string $emailAddress = null,
        ?string $ssn = null,
        ?string $dateOfBirth = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->phoneNumberVerifiedTime = $phoneNumberVerifiedTime;
        $this->emailAddress = $emailAddress;
        $this->ssn = $ssn;
        $this->dateOfBirth = $dateOfBirth;
    }

    public function toArray(): array
    {
        return array_filter(
            [
                "client_user_id" => $this->id,
                "legal_name" => $this->name,
                "phone_number" => $this->phoneNumber,
                "phone_number_verified_time" => $this->phoneNumberVerifiedTime,
                "email_address" => $this->emailAddress,
                "ssn" => $this->ssn,
                "date_of_birth" => $this->dateOfBirth
            ],
            function ($value): bool {
                return $value !== null;
            }
        );
    }

}
