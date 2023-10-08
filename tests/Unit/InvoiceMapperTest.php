<?php

namespace Tests\Unit;

use App\Domain\Invoice\Entities\Invoice;
use App\Domain\Invoice\Values\Company;
use App\Domain\Invoice\Values\Product;
use App\Modules\Invoices\Infrastructure\Mappers\InvoiceMapper;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class InvoiceMapperTest extends TestCase
{
    public function test_map_row_to_invoice()
    {
        $collection = new Collection();
        $collection->add((object)['name' => 'bar', 'quantity' => 1, 'price' => 42]);
        $invoiceObj = (object)[
            'id' => 'bf7f3ad1-b208-4e76-a5fa-2b75eef9ce22',
            'number' => 'bf7f3ad1-b208-4e76-a5fa-2b75eef9ce22',
            'date' => '2016-11-30',
            'due_date' => '2016-11-30',
            'company_id' => 'bf7f3ad1-b208-4e76-a5fa-2b75eef9ce22',
            'status' => 'draft',
            'created_at' => '2016-11-30',
            'updated_at' => '2016-11-30',
            'name' => 'Rolfson LLC',
            'street' => '2891 Haskell Garden',
            'city' => 'East Raeside',
            'zip' => '37917',
            'phone' => '1-269-934-3103',
            'email' => 'test@example.net',
        ];
        $company = new Company(
            'Rolfson LLC',
            '2891 Haskell Garden',
            'East Raeside',
            '37917',
            '1-269-934-3103',
            'test@example.net',
        );
        $product = new Product('bar', 1, 42);
        $expected = new Invoice(
            'bf7f3ad1-b208-4e76-a5fa-2b75eef9ce22',
            'bf7f3ad1-b208-4e76-a5fa-2b75eef9ce22',
            '2016-11-30',
            '2016-11-30',
            'bf7f3ad1-b208-4e76-a5fa-2b75eef9ce22',
            'draft',
            '2016-11-30',
            '2016-11-30',
            $company,
            [$product],
        );
        $result = InvoiceMapper::mapRowToInvoice($invoiceObj, $collection);

        $this->assertEquals($result, $expected);
    }
}
