<?php
declare(strict_types=1);

namespace Abivia\Plaid\Entities;

class RecipientAddress
{
    /**
     * @var string City
     */
    protected string $city;
    /**
     * @var string Country (2 character ISO)
     */
    protected string $country;
    /**
     * @var string Postal code
     */
    protected string $postalCode;
    /**
     * @var string Street address.
     */
    protected string $street;
    /**
     * @var string|null Additional street address.
     */
    protected ?string $street2;

    /**
     * Address constructor.
     *
     * The Address object is needed for certain requests to Plaid.
     *
     * @param string $street
     * @param string|null $street2
     * @param string $city
     * @param string $postalCode
     * @param string $country
     */
    public function __construct(
        string  $street,
        ?string $street2,
        string  $city,
        string  $postalCode,
        string  $country)
    {
        $this->street = $street;
        $this->street2 = $street2;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->country = $country;
    }

    /**
     * Convert the object into a key=>value pair that can be used in HTTP requests.
     *
     * @return array
     */
    public function toArray(): array
    {
        $streetAddress = [$this->street];

        if ($this->street2) {
            $streetAddress[] = $this->street2;
        }

        return [
            'street' => $streetAddress,
            'city' => $this->city,
            'postal_code' => $this->postalCode,
            'country' => $this->country
        ];
    }
}
