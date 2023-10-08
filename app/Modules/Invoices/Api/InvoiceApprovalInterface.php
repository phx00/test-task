<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Api;

use Ramsey\Uuid\UuidInterface;

interface InvoiceApprovalInterface
{
    public function approve(UuidInterface $uuid): true;

    public function reject(UuidInterface $uuid): true;
}
