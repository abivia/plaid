<?php
declare(strict_types=1);

namespace Abivia\Plaid\Entities;

class AccountFilters
{
    /**
     * @var array<string,array<string,array<string>>> Filters to be applied.
     */
    protected array $filters = [];

    /**
     * AccountFilters constructor.
     *
     * @param array<string,array<string>> $filters
     */
    public function __construct(array $filters = [])
    {
        foreach ($filters as $name => $subtypes) {
            $this->setFilter($name, $subtypes);
        }
    }

    /**
     * Set credit filters.
     *
     * @param array<string> $subtypes Any of all, identity, liabilities, transactions.
     * @return AccountFilters
     */
    public function setCreditFilters(array $subtypes): self
    {
        $this->setFilter('credit', $subtypes);

        return $this;
    }

    /**
     * Set depository subtype filters.
     *
     * @param array<string> $subtypes Any of all, assets, auth, identity, income, transactions.
     * @return AccountFilters
     */
    public function setDepositoryFilters(array $subtypes): self
    {
        $this->setFilter('depository', $subtypes);

        return $this;
    }

    /**
     * Set filters for the given type.
     *
     * @param string $type
     * @param array<string> $subtypes
     * @return AccountFilters
     */
    protected function setFilter(string $type, array $subtypes): self
    {
        if (empty($subtypes)) {
            return $this;
        }

        $this->filters[$type] = ['account_subtypes' => $subtypes];

        return $this;
    }

    /**
     * Set investment filters.
     *
     * @param array<string> $subtypes Any of all, investment
     * @return AccountFilters
     */
    public function setInvestmentFilters(array $subtypes): self
    {
        $this->setFilter('investment', $subtypes);

        return $this;
    }

    /**
     * Set loan filters.
     *
     * @param array<string> $subtypes Any of all, liabilities, transactions
     * @return AccountFilters
     */
    public function setLoanFilters(array $subtypes): self
    {
        $this->setFilter('loan', $subtypes);

        return $this;
    }

    /**
     * Set other filters.
     *
     * @param array<string> $subtypes Any of all, assets, auth, identity, transactions,
     * @return AccountFilters
     */
    public function setOtherFilters(array $subtypes): self
    {
        $this->setFilter('other', $subtypes);

        return $this;
    }

    /**
     * Get all filters as array.
     *
     * @return array<string,array<string,array<string>>>
     */
    public function toArray(): array
    {
        return $this->filters;
    }

}
