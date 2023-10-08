<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Providers;

use App\Domain\Invoice\InvoiceRepositoryInterface;
use App\Modules\Invoices\Api\InvoiceApprovalInterface;
use App\Modules\Invoices\Application\InvoiceApproval;
use App\Modules\Invoices\Infrastructure\Repositories\InvoiceRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class InvoicesServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->singleton(InvoiceApprovalInterface::class, InvoiceApproval::class);
    }

    /** @return array<class-string> */
    public function provides(): array
    {
        return [
            InvoiceRepositoryInterface::class,
            InvoiceApprovalInterface::class,
        ];
    }
}
