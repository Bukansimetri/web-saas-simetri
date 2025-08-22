<?php

namespace App\Filament\Imports;

use App\Models\Product;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Illuminate\Support\Str;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'string', 'max:255'])
                ->examples(['Honey Latte', 'Cold Brew']),

            ImportColumn::make('slug')
                ->rules(['nullable', 'string', 'max:255'])
                ->examples(['honey-latte', 'cold-brew']),

            // Import relasi category lewat "name" atau "slug".
            // Header Excel cukup "category".
            ImportColumn::make('category')
                ->relationship(resolveUsing: ['slug', 'name'])
                ->rules(['nullable']),

            ImportColumn::make('stock')
                ->numeric()
                ->rules(['nullable', 'integer', 'min:0'])
                ->examples([100, 25]),

            ImportColumn::make('price')
                ->numeric()
                ->rules(['nullable', 'integer', 'min:0'])
                ->examples([35000, 42000]),

            ImportColumn::make('tag')
                ->rules(['nullable', 'in:new,hot'])
                ->examples(['new', 'hot']),

            ImportColumn::make('tag_disc')
                ->rules(['nullable', 'string', 'max:255'])
                ->examples(['-10%', '']),

            ImportColumn::make('locale')
                ->requiredMapping()
                ->rules(['required', 'in:en,id'])
                ->examples(['id', 'en']),

            ImportColumn::make('description')
                ->rules(['nullable', 'string', 'max:500']),

            ImportColumn::make('meta_title')
                ->rules(['nullable', 'string', 'max:255']),

            ImportColumn::make('meta_description')
                ->rules(['nullable', 'string', 'max:255']),

            ImportColumn::make('url_grab_mart')
                ->rules(['nullable', 'url']),

            ImportColumn::make('is_active')
                ->boolean()
                ->rules(['nullable', 'boolean'])
                ->examples([1, 0]),
        ];
    }

    // Upsert berdasarkan slug (atau buat dari name jika slug kosong).
    public function resolveRecord(): ?Product
    {
        $slug = $this->data['slug'] ?? null;
        $name = $this->data['name'] ?? null;

        if ($slug) {
            return Product::firstOrNew(['slug' => $slug]);
        }

        if ($name) {
            return Product::firstOrNew(['slug' => Str::slug($name)]);
        }

        return null; // baris tanpa name/slug akan dianggap gagal
    }

    public static function afterFill(Product $record, array $data): void
    {
        if (blank($record->slug) && filled($data['name'] ?? null)) {
            $record->slug = Str::slug($data['name']);
        }
    }

    public static function getCompletedNotificationBody(ImportResult $result): string
    {
        return "Imported {$result->successfulRows} products, "
            ."{$result->getFailedRowsCount()} failed.";
    }
}
