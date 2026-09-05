<?php

namespace App\Filament\Resources\Content\CategoryResource\Pages;

use App\Filament\Resources\Content\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return __('Create Content Category');
    }
}
