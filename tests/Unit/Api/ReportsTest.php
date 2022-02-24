<?php

namespace Abivia\Plaid\Tests\Unit\Api;

use Abivia\Plaid\Api\Reports;
use Abivia\Plaid\Plaid as PlaidCore;
use Abivia\Plaid\PlaidRequestException;
use Abivia\Plaid\Tests\TestCase;
use GuzzleHttp\Psr7\Response as PsrResponse;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * @covers \Abivia\Plaid\Plaid
 * @covers \Abivia\Plaid\Api\AbstractResource
 * @covers \Abivia\Plaid\Api\Reports
 * @covers \Abivia\Plaid\PlaidRequestException
 */
class ReportsTest extends TestCase
{
    public function testCreateAssetReport(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('asset_report/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'access_tokens' =>
                        [
                            0 => 'access_token1',
                            1 => 'access_token2',
                        ],
                    'days_requested' => 30,
                    'options' => (object)[],
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Reports('id', 'secret', '');
        $obj->createAssetReport(['access_token1', 'access_token2'], 30);
    }

    public function testCreateAssetReportAuditCopy(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('asset_report/audit_copy/create',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'asset_report_token' => 'asset_report_token',
                    'auditor_id' => 'auditor_id',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Reports('id', 'secret', '');
        $obj->createAssetReportAuditCopy('asset_report_token', 'auditor_id');
    }

    public function testFilterAssetReport(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('asset_report/filter',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'asset_report_token' => 'asset_report_token',
                    'account_ids_to_exclude' =>
                        [
                            0 => 'account1',
                            1 => 'account2',
                        ],
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Reports('id', 'secret', '');
        $obj->filterAssetReport('asset_report_token', ['account1', 'account2']);
    }

    public function testGetAssetReport(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('asset_report/get',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'asset_report_token' => 'asset_report_token',
                    'include_insights' => true,
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Reports('id', 'secret', '');
        $obj->getAssetReport('asset_report_token', true);
    }

    public function testGetAssetReportPdf(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('asset_report/pdf/get',
                [
                    'asset_report_token' => 'asset_report_token',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Reports('id', 'secret', '');
        $obj->getAssetReportPdf('asset_report_token');
    }

    public function testGetAssetReportPdfThrowsOnFail(): void
    {
        $psrResponse = (new PsrResponse(400, [], '{}'));
        Http::shouldReceive('post')
            ->with('asset_report/pdf/get',
                [
                    'asset_report_token' => 'asset_report_token',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Reports('id', 'secret', '');
        $this->expectException(PlaidRequestException::class);
        $obj->getAssetReportPdf('asset_report_token', true);
    }

    public function testRefreshAssetReport(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('asset_report/refresh',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'asset_report_token' => 'asset_report_token',
                    'days_requested' => 30,
                    'options' => (object)[],
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Reports('id', 'secret', '');
        $obj->refreshAssetReport('asset_report_token', 30);
    }

    public function testRemoveAssetReport(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('asset_report/remove',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'asset_report_token' => 'asset_report_token',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Reports('id', 'secret', '');
        $obj->removeAssetReport('asset_report_token');
    }

    public function testRemoveAssetReportAuditCopy(): void
    {
        $psrResponse = (new PsrResponse(200, [], '{}'));
        Http::shouldReceive('post')
            ->with('asset_report/audit_copy/remove',
                [
                    'client_id' => 'id',
                    'secret' => 'secret',
                    'audit_copy_token' => 'audit_copy_token',
                ]
            )
            ->andReturn(new Response($psrResponse));
        $this->expectPlaidHeader();
        $obj = new Reports('id', 'secret', '');
        $obj->removeAssetReportAuditCopy('audit_copy_token');
    }
}
