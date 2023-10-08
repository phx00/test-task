<?php

namespace App\Modules\Invoices\Infrastructure\Views;

use App\Domain\Invoice\Entities\Invoice;
use App\Domain\Invoice\Values\Product;

class InvoiceView
{
    public function format(Invoice $invoice): array
    {
        return [
            'Invoice number' => $invoice->getNumber(),
            'Invoice date' => $invoice->getDate(),
            'Due date' => $invoice->getDueDate(),
            'Billed company' => [
                'Name' => $invoice->getCompany()->getName(),
                'Street Address' => $invoice->getCompany()->getStreet(),
                'City' => $invoice->getCompany()->getCity(),
                'Zip code' => $invoice->getCompany()->getZip(),
                'Phone' => $invoice->getCompany()->getPhone(),
                'Email address' => $invoice->getCompany()->getEmail(),
            ],
            'Products' => array_map(function ($prod) {
                /** @var Product $prod */
                return [
                    'name' => $prod->getName(),
                    'Quantity' => $prod->getQuantity(),
                    'Unit Price' => $prod->getPrice(),
                    'Total' => $prod->getTotal(),
                ];
            }, $invoice->getProducts()),
            'Total price' => $invoice->getTotal()
        ];
    }
}
