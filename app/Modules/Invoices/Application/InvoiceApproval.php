<?php

namespace App\Modules\Invoices\Application;

use App\Domain\Enums\StatusEnum;
use App\Domain\Invoice\Entities\Invoice;
use App\Domain\Invoice\InvoiceRepositoryInterface;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Modules\Invoices\Api\InvoiceApprovalInterface;
use Ramsey\Uuid\UuidInterface;

readonly class InvoiceApproval implements InvoiceApprovalInterface
{
    public function __construct(
        private ApprovalFacadeInterface    $approvalFacade,
        private InvoiceRepositoryInterface $invoiceRepository,
    )
    {
    }

    public function approve(UuidInterface $uuid): true
    {
        $invoice = $this->invoiceRepository->getByNumber($uuid);
        $this->approvalFacade->approve(
            new ApprovalDto($uuid, $invoice->getStatus(), Invoice::class)
        );
        $invoice->setStatus(StatusEnum::APPROVED);
        $this->invoiceRepository->updateStatus($invoice);
        return true;
    }

    public function reject(UuidInterface $uuid): true
    {
        $invoice = $this->invoiceRepository->getByNumber($uuid);
        $this->approvalFacade->reject(
            new ApprovalDto($uuid, $invoice->getStatus(), Invoice::class)
        );
        $invoice->setStatus(StatusEnum::REJECTED);
        $this->invoiceRepository->updateStatus($invoice);
        return true;
    }
}
