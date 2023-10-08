<?php

namespace App\Domain\Invoice;

use App\Domain\Invoice\Entities\Invoice;
use Ramsey\Uuid\UuidInterface;

interface InvoiceRepositoryInterface
{
    public function updateStatus(Invoice $invoice);
    public function getByNumber(UuidInterface $number): Invoice;
}
