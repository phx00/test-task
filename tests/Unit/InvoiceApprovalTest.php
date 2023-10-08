<?php

namespace Tests\Unit;

use App\Domain\Invoice\Entities\Invoice;
use App\Domain\Invoice\InvoiceRepositoryInterface;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Invoices\Application\InvoiceApproval;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class InvoiceApprovalTest extends TestCase
{
    private InvoiceApproval $invoice;
    public function __construct()
    {
        parent::__construct();
        $approveMock = $this->createMock(ApprovalFacadeInterface::class);
        $repositoryMock = $this->createMock(InvoiceRepositoryInterface::class);
        $entity = new Invoice(
            'bf7f3ad1-b208-4e76-a5fa-2b75eef9ce22',
            '831244dd-fd5c-3c36-b8f8-7b9fc8c5847d',
            '2009-03-06',
            '2016-11-30',
            '1',
            'draft',
            '',
            '',
            null,
            [],
        );

        $repositoryMock->method('getByNumber')->willReturn($entity);
        $repositoryMock->method('updateStatus');
        $approveMock->method('approve')->willReturn(true);
        $approveMock->method('reject')->willReturn(true);

        $this->invoice = new InvoiceApproval(
            $approveMock,
            $repositoryMock
        );
    }

    public function test_approve()
    {
        $result = $this->invoice->approve(
            Uuid::fromString('bf7f3ad1-b208-4e76-a5fa-2b75eef9ce22')
        );
        $this->assertTrue($result);
    }

    public function test_reject()
    {
        $result = $this->invoice->reject(
            Uuid::fromString('bf7f3ad1-b208-4e76-a5fa-2b75eef9ce22')
        );
        $this->assertTrue($result);
    }
}
