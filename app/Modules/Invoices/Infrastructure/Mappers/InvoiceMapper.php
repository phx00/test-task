<?php

namespace App\Modules\Invoices\Infrastructure\Mappers;

use App\Domain\Invoice\Entities\Invoice;
use App\Domain\Invoice\Values\Company;
use App\Domain\Invoice\Values\Product;
use Illuminate\Support\Collection;

class InvoiceMapper
{
    public static function mapRowToInvoice(object $invoice, Collection $products): Invoice
    {
        return new Invoice(
            $invoice->id,
            $invoice->number,
            $invoice->date,
            $invoice->due_date,
            $invoice->company_id,
            $invoice->status,
            $invoice->created_at,
            $invoice->updated_at,
            self::mapRowToCompany($invoice),
            $products->map(fn($prod) => self::mapRowToProduct($prod))->toArray()
        );
    }

    public static function mapRowToCompany(object $company): Company
    {
        return new Company(
            $company->name,
            $company->street,
            $company->city,
            $company->zip,
            $company->phone,
            $company->email,
        );
    }

    public static function mapRowToProduct(object $product): Product
    {
        return new Product(
            $product->name,
            $product->quantity,
            $product->price
        );
    }
}
