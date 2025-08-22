<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Imports\ProductImporter;
use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use HayderHatem\FilamentExcelImport\Actions\FullImportAction;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            FullImportAction::make()
                ->label('Import Excel/CSV')
                ->icon('heroicon-o-arrow-up-tray')
                ->importer(ProductImporter::class)
                ->chunkSize(1000)        // proses per 1000 baris
                ->maxRows(10000)         // batas maksimal baris
                ->activeSheet(0)         // sheet pertama (0-based)
                ->useStreaming(null)     // auto: memory efisien
                ->streamingThreshold(10 * 1024 * 1024) // 10MB
                ->fileValidationRules([
                    'file',
                    'mimetypes:text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                ]),
        ];
    }
}
