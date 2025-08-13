<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationGroup = 'Product';

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Main Details')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('Main Details')
                                    ->description('Fill out the main details of the product')
                                    ->icon('heroicon-o-clipboard')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->maxLength(255)
                                            ->placeholder('Enter product name')
                                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                        Forms\Components\TextInput::make('slug')
                                            ->disabled()
                                            ->dehydrated()
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(Product::class, 'slug', ignoreRecord: true)
                                            ->helperText('URL-friendly version of the title - generated automatically')
                                            ->suffixAction(function (string $operation) {
                                                if ($operation === 'edit') {
                                                    return Forms\Components\Actions\Action::make('editSlug')
                                                        ->icon('heroicon-o-pencil-square')
                                                        ->modalHeading('Edit Slug')
                                                        ->modalDescription('Customize the URL slug for this product. Use lowercase letters, numbers, and hyphens only.')
                                                        ->modalIcon('heroicon-o-link')
                                                        ->modalSubmitActionLabel('Update Slug')
                                                        ->form([
                                                            Forms\Components\TextInput::make('new_slug')
                                                                ->hiddenLabel()
                                                                ->required()
                                                                ->maxLength(255)
                                                                ->live(debounce: 500)
                                                                ->afterStateUpdated(function (string $state, Forms\Set $set) {
                                                                    $set('new_slug', Str::slug($state));
                                                                })
                                                                ->unique(Product::class, 'slug', ignoreRecord: true)
                                                                ->helperText('The slug will be automatically formatted as you type.'),
                                                        ])
                                                        ->action(function (array $data, Forms\Set $set) {
                                                            $set('slug', $data['new_slug']);
                                                            Notification::make()
                                                                ->title('Slug updated')
                                                                ->success()
                                                                ->send();
                                                        });
                                                }

                                                return null;
                                            }),
                                        Forms\Components\Select::make('product_category_id')
                                            ->label('Category')
                                            ->relationship('category', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                                                Forms\Components\TextInput::make('slug')
                                                    ->disabled()
                                                    ->dehydrated()
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->unique(ProductCategory::class, 'slug', ignoreRecord: true)
                                                    ->helperText('URL-friendly version of the title - generated automatically')
                                                    ->suffixAction(
                                                        Forms\Components\Actions\Action::make('editSlug')
                                                            ->icon('heroicon-o-pencil-square')
                                                            ->modalHeading('Edit Slug')
                                                            ->modalDescription('Customize the URL slug for this Category. Use lowercase letters, numbers, and hyphens only.')
                                                            ->modalIcon('heroicon-o-link')
                                                            ->modalSubmitActionLabel('Update Slug')
                                                            ->form([
                                                                Forms\Components\TextInput::make('new_slug')
                                                                    ->hiddenLabel()
                                                                    ->required()
                                                                    ->maxLength(255)
                                                                    ->live(debounce: 500)
                                                                    ->afterStateUpdated(function (string $state, Forms\Set $set) {
                                                                        $set('new_slug', Str::slug($state));
                                                                    })
                                                                    ->unique(ProductCategory::class, 'slug', ignoreRecord: true)
                                                                    ->helperText('The slug will be automatically formatted as you type.'),
                                                            ])
                                                            ->action(function (array $data, Forms\Set $set) {
                                                                $set('slug', $data['new_slug']);

                                                                Notification::make()
                                                                    ->title('Slug updated')
                                                                    ->success()
                                                                    ->send();
                                                            })
                                                    ),
                                                Forms\Components\Toggle::make('is_active')
                                                    ->label('Active')
                                                    ->default(true),
                                            ])
                                            ->required(),
                                        Forms\Components\TextInput::make('stock')
                                            ->label('Stock')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('price')
                                            ->label('Price')
                                            ->numeric()
                                            ->prefix('Rp.'),
                                        Forms\Components\Select::make('tag')
                                            ->label('Tag Product')
                                            ->options([
                                                'new' => 'New',
                                                'hot' => 'Hot',
                                            ]),
                                        Forms\Components\TextInput::make('tag_disc')
                                            ->label('Tag Discount'),
                                        Forms\Components\Select::make('locale')
                                            ->options([
                                                'en' => 'English',
                                                'id' => 'Indonesian',
                                            ])
                                            ->default('en')
                                            ->required(),
                                        Forms\Components\MarkdownEditor::make('description')
                                            ->label('Description')
                                            ->helperText('Provide a description for the product')
                                            ->maxLength(500)
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('meta_title')
                                            ->label('Meta Title'),
                                        Forms\Components\TextInput::make('meta_description')
                                            ->label('Meta Description'),
                                        Forms\Components\TextInput::make('url_grab_mart')
                                            ->label('Grab Url')
                                            ->columnSpanFull(),
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->helperText('Control product visibility')
                                            ->default(true),
                                    ])
                                    ->compact()
                                    ->columns(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Product Image')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Image')
                                    ->description('Upload product image here')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('products')
                                            ->collection('products')
                                            ->multiple(false)
                                            ->maxFiles(1)
                                            ->imagePreviewHeight('250')
                                            ->panelLayout('compact')
                                            ->imageResizeMode('cover')
                                            ->imageResizeTargetWidth('1200')
                                            ->imageResizeTargetHeight('800')
                                            ->acceptedFileTypes(['image/*'])
                                            ->helperText('Upload a products image.')
                                            ->columnSpanFull(),
                                    ])
                                    ->compact(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('products')
                    ->label('Image')
                    ->collection('products')
                    ->conversion('thumbnail')
                    ->size(60)
                    ->circular(false)
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('name')
                    ->description(fn (Model $record): string => Str::limit(strip_tags($record->description), 100))
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('tag')
                    ->label('Tag')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('locale')
                    ->badge()
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Update')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('product_category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
                Tables\Filters\SelectFilter::make('locale')
                    ->options([
                        'en' => 'English',
                        'id' => 'Indonesian',
                    ]),
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
                        ->action(fn (\Illuminate\Database\Eloquent\Collection $records) => $records->each->update(['is_active' => true])),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Set Inactive')
                        ->icon('heroicon-m-x-circle')
                        ->requiresConfirmation()
                        ->action(fn (\Illuminate\Database\Eloquent\Collection $records) => $records->each->update(['is_active' => false])),
                ]),
            ])
            ->defaultSort('created_at', 'asc')
            ->reorderable('created_at');
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->with('category');
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['category']);
    }

    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        return $record->name;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'description', 'category.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Category' => $record->category->name,
            'Status' => $record->is_active ? 'Active' : 'Inactive',
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'gray';
    }
}
