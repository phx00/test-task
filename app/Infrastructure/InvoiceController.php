<?php

namespace App\Infrastructure;

use App\Domain\Invoice\InvoiceRepositoryInterface;
use App\Modules\Invoices\Api\InvoiceApprovalInterface;
use App\Modules\Invoices\Infrastructure\Exceptions\InvoiceNotFoundException;
use App\Modules\Invoices\Infrastructure\Views\InvoiceView;
use LogicException;
use Ramsey\Uuid\Uuid;

class InvoiceController extends Controller
{
    public function show(string $n, InvoiceRepositoryInterface $invoiceRepository, InvoiceView $view): array
    {
        try {
            $invoice = $invoiceRepository->getByNumber(Uuid::fromString($n));
        } catch (LogicException|InvoiceNotFoundException $e) {
            return ['error' => $e->getMessage()];
        }
        return $view->format($invoice);
    }

    public function approve(string $n, InvoiceApprovalInterface $approval): array
    {
        try {
            $approval->approve(Uuid::fromString($n));
        } catch (LogicException|InvoiceNotFoundException $e) {
            return ['error' => $e->getMessage()];
        }

        return ['success'];
    }

    public function reject(string $n, InvoiceApprovalInterface $approval): array
    {
        try {
            $approval->reject(Uuid::fromString($n));
        } catch (LogicException|InvoiceNotFoundException $e) {
            return ['error' => $e->getMessage()];
        }

        return ['success'];
    }
}
