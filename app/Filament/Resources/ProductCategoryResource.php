<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationGroup = 'Product';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $slug = 'product/categories';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'fluentui-stack-20';

    protected static ?string $navigationLabel = 'Categories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Category Details')
                    ->tabs([
                        Tabs\Tab::make('Basic Information')
                            ->schema([
                                Forms\Components\Select::make('parent_id')
                                    ->label('Parent Category')
                                    ->options(function () {
                                        // Exclude the current category if editing
                                        $query = ProductCategory::query();
                                        if (request()->route('record')) {
                                            $query->where('id', '!=', request()->route('record'));
                                        }

                                        return $query->pluck('name', 'id');
                                    })
                                    ->searchable()
                                    ->nullable()
                                    ->preload()
                                    ->columnSpan('full'),

                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ProductCategory::class, 'slug', ignoreRecord: true)
                                    ->helperText('URL-friendly name. Will be auto-generated from the name if left empty.'),

                                Forms\Components\Select::make('locale')
                                    ->options([
                                        'en' => 'English',
                                        'id' => 'Indonesian',
                                        // Add more languages as needed
                                    ])
                                    ->default('en')
                                    ->required(),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Active')
                                    ->helperText('Only active categories will be shown on the frontend')
                                    ->default(true),
                            ]),

                        Tabs\Tab::make('Product Category Image')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Image')
                                    ->description('Upload product category image here')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('productcategories')
                                            ->collection('productcategories')
                                            ->multiple(false)
                                            ->maxFiles(1)
                                            ->imagePreviewHeight('250')
                                            ->panelLayout('compact')
                                            ->imageResizeMode('cover')
                                            ->imageResizeTargetWidth('1200')
                                            ->imageResizeTargetHeight('800')
                                            ->acceptedFileTypes(['image/*'])
                                            ->helperText('Upload a products category image.')
                                            ->columnSpanFull(),
                                    ])
                                    ->compact(),
                            ]),

                        Tabs\Tab::make('SEO & Meta')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->maxLength(255)
                                    ->helperText('Leave blank to use the category name'),

                                Forms\Components\Textarea::make('meta_description')
                                    ->maxLength(500)
                                    ->rows(3)
                                    ->helperText('Brief description for search engines. Recommended length: 150-160 characters.'),
                            ]),

                        Tabs\Tab::make('Advanced Options')
                            ->schema([
                                Forms\Components\KeyValue::make('options')
                                    ->keyLabel('Option Name')
                                    ->valueLabel('Option Value')
                                    ->addable()
                                    ->reorderable()
                                    ->columnSpan('full')
                                    ->helperText('Custom options for this category (JSON format)'),
                            ]),
                    ])
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (ProductCategory $record) => $record->parent ? "Child of {$record->parent->name}" : '')
                    ->wrap(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('locale')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable()
                    ->toggleable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('product_count')
                    ->label('Products')
                    ->counts('products')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->since()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('parent_id')
                    ->label('Parent Category')
                    ->options(fn () => ProductCategory::pluck('name', 'id'))
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('locale')
                    ->options([
                        'en' => 'English',
                        'id' => 'Indonesian',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
                Tables\Filters\TernaryFilter::make('root')
                    ->label('Root Categories Only')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNull('parent_id'),
                        false: fn (Builder $query) => $query->whereNotNull('parent_id'),
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->hiddenLabel()->tooltip('View'),
                Tables\Actions\EditAction::make()->hiddenLabel()->tooltip('Edit'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Set Active')
                        ->icon('heroicon-m-check-circle')
                        ->requiresConfirmation()
                        ->action(fn (Category $records) => $records->each->update(['is_active' => true])),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Set Inactive')
                        ->icon('heroicon-m-x-circle')
                        ->requiresConfirmation()
                        ->action(fn (Category $records) => $records->each->update(['is_active' => false])),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/create'),
            'edit' => Pages\EditProductCategory::route('/{record}/edit'),
        ];
    }
}
