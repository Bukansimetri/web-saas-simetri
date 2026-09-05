<?php

namespace App\Filament\Resources\Content\ItemResource\Pages;

use App\Filament\Resources\Content\ItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateItem extends CreateRecord
{
    protected static string $resource = ItemResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return __('Create New Content');
    }
}
