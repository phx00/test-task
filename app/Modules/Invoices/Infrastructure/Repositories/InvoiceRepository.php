<?php

namespace App\Modules\Invoices\Infrastructure\Repositories;

use App\Domain\Invoice\Entities\Invoice;
use App\Domain\Invoice\InvoiceRepositoryInterface;
use App\Modules\Invoices\Infrastructure\Exceptions\InvoiceNotFoundException;
use App\Modules\Invoices\Infrastructure\Mappers\InvoiceMapper;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\UuidInterface;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function updateStatus(Invoice $invoice): void
    {
        DB::table('invoices')
            ->where('id', $invoice->getId())
            ->update(['status' => $invoice->getStatus()->value]);
    }

    public function getByNumber(UuidInterface $number): Invoice
    {
        $invoice = DB::table('invoices as i')
            ->select('i.*', 'c.name', 'c.street', 'c.city', 'c.zip', 'c.phone', 'c.email')
            ->join('companies as c', 'i.company_id', '=', 'c.id')
            ->where('i.number', $number->toString())
            ->first();

        if (!$invoice) throw new InvoiceNotFoundException('invoice not exists');

        $products = DB::table('invoice_product_lines as ipl')
            ->select('p.name', 'ipl.quantity', 'p.price')
            ->join('products as p', 'ipl.product_id', '=', 'p.id')
            ->where('ipl.invoice_id', $invoice->id)
            ->get();

        return InvoiceMapper::mapRowToInvoice($invoice, $products);
    }
}
