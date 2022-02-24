<?php

namespace Abivia\Plaid\Facades;

use Abivia\Plaid\Api\Accounts;
use Abivia\Plaid\Api\Auth;
use Abivia\Plaid\Api\BankTransfers;
use Abivia\Plaid\Api\Categories;
use Abivia\Plaid\Api\Institutions;
use Abivia\Plaid\Api\Investments;
use Abivia\Plaid\Api\Items;
use Abivia\Plaid\Api\Liabilities;
use Abivia\Plaid\Api\Payments;
use Abivia\Plaid\Api\Processors;
use Abivia\Plaid\Api\Reports;
use Abivia\Plaid\Api\Sandbox;
use Abivia\Plaid\Api\Tokens;
use Abivia\Plaid\Api\Transactions;
use Abivia\Plaid\Api\Webhooks;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Abivia\Plaid\Plaid
 * @method static Accounts accounts
 * @method static Auth auth
 * @method static BankTransfers bankTransfers
 * @method static \Abivia\Plaid\Plaid baseUrl
 * @method static Categories categories
 * @method static Plaid client
 * @method static Plaid environment
 * @method static Institutions institutions
 * @method static Investments investments
 * @method static Items items
 * @method static Liabilities liabilities
 * @method static Tokens tokens
 * @method static Payments payments
 * @method static Processors processors
 * @method static Reports reports
 * @method static Sandbox sandbox
 * @method static Plaid secret
 * @method static Transactions transactions
 * @method static Webhooks webhooks
 */
class Plaid extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'plaid';
    }
}
