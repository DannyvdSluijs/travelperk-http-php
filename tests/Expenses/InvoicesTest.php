<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Tests;

use Mockery;
use Namelivia\TravelPerk\Api\TravelPerk;
use Namelivia\TravelPerk\Expenses\InvoiceLinesInputParams;
use Namelivia\TravelPerk\Expenses\Invoices;
use Namelivia\TravelPerk\Expenses\InvoicesInputParams;

class InvoicesTest extends TestCase
{
    private $travelPerk;
    private $invoices;

    public function setUp(): void
    {
        parent::setUp();
        $this->travelPerk = Mockery::mock(TravelPerk::class);
        $this->invoices = new Invoices($this->travelPerk);
    }

    public function testGettingAllInvoicesNoParams()
    {
        $this->travelPerk->shouldReceive('getJson')
            ->once()
            ->with('invoices')
            ->andReturn('allInvoices');
        $this->assertEquals(
            'allInvoices',
            $this->invoices->all()
        );
    }

    public function testGettingAllInvoicesWithParams()
    {
        $this->travelPerk->shouldReceive('getJson')
            ->once()
            ->with('invoices?offset=5&limit=10')
            ->andReturn('allInvoices');
        $params = (new InvoicesInputParams())
            ->setOffset(5)
            ->setLimit(10);
        $this->assertEquals(
            'allInvoices',
            $this->invoices->all($params)
        );
    }

    public function testGettingAllInvoicesWithParamsUsingQuery()
    {
        $this->travelPerk->shouldReceive('getJson')
            ->once()
            ->with('invoices?offset=5&limit=10')
            ->andReturn('allInvoices');
        $this->assertEquals(
            'allInvoices',
            $this->invoices->query()
                 ->setOffset(5)
                 ->setLimit(10)
                 ->get()
        );
    }

    public function testGettingAnInvoiceDetail()
    {
        $this->travelPerk->shouldReceive('getJson')
            ->once()
            ->with('invoices/serialNumber')
            ->andReturn('invoiceDetail');
        $this->assertEquals(
            'invoiceDetail',
            $this->invoices->get('serialNumber')
        );
    }

    public function testGettingAnInvoicePDF()
    {
        $this->travelPerk->shouldReceive('get')
            ->once()
            ->with('invoices/serialNumber/pdf')
            ->andReturn('invoicePDF');
        $this->assertEquals(
            'invoicePDF',
            $this->invoices->pdf('serialNumber')
        );
    }

    public function testGettingAllInvoiceLinesWithParams()
    {
        $this->travelPerk->shouldReceive('getJson')
            ->once()
            ->with('invoices/lines?offset=5&limit=10')
            ->andReturn('invoiceLines');
        $params = (new InvoiceLinesInputParams())
            ->setOffset(5)
            ->setLimit(10);
        $this->assertEquals(
            'invoiceLines',
            $this->invoices->lines($params)
        );
    }

    public function testGettingAllInvoiceLinesWithParamsUsingQuery()
    {
        $this->travelPerk->shouldReceive('getJson')
            ->once()
            ->with('invoices/lines?offset=5&limit=10')
            ->andReturn('invoiceLines');
        $this->assertEquals(
            'invoiceLines',
            $this->invoices->linesQuery()
                ->setOffset(5)
                ->setLimit(10)
                ->get()
        );
    }

    public function testGettingAllInvoiceLinesNoParams()
    {
        $this->travelPerk->shouldReceive('getJson')
            ->once()
            ->with('invoices/lines')
            ->andReturn('invoiceLines');
        $this->assertEquals(
            'invoiceLines',
            $this->invoices->lines()
        );
    }
}
