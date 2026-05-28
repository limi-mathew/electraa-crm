<?php

namespace App\Filament\Admin\Resources\Customers\Pages;

use App\Filament\Admin\Resources\Customers\CustomerResource;
use Filament\Resources\Pages\Page;

class Chat extends Page
{
    protected static string $resource = CustomerResource::class;

    protected string $view = 'filament.admin.resources.customers.pages.chat';
}
