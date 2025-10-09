<?php

namespace App\Filament\Resources\SiteFeatureResource\Pages;

use App\Filament\Resources\SiteFeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteFeatures extends ListRecords
{
    protected static string $resource = SiteFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
