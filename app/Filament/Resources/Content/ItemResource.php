<?php

namespace App\Filament\Resources\Content;

use App\Filament\Resources\Content\ItemResource\Pages;
use App\Models\Content\Category;
use App\Models\Content\Item;
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

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $slug = 'content/items';

    protected static int $globalSearchResultsLimit = 10;

    protected static ?int $navigationSort = -2;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static function getLastSortValue(): int
    {
        return Item::max('sort') ?? 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Content Details')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('Main Details')
                                    ->description('Fill out the main details of the content item')
                                    ->icon('heroicon-o-clipboard')
                                    ->schema([
                                        Forms\Components\Select::make('content_category_id')
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
                                                    ->unique(Category::class, 'slug', ignoreRecord: true)
                                                    ->helperText('URL-friendly version of the name - generated automatically'),
                                                Forms\Components\Select::make('parent_id')
                                                    ->label('Parent Category')
                                                    ->options(fn () => Category::pluck('name', 'id'))
                                                    ->searchable()
                                                    ->preload()
                                                    ->nullable(),
                                                Forms\Components\Toggle::make('is_active')
                                                    ->label('Active')
                                                    ->default(true),
                                            ])
                                            ->required(),
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->helperText('Control content visibility on the site')
                                            ->default(true),
                                        Forms\Components\TextInput::make('title')
                                            ->label('Title')
                                            ->maxLength(255)
                                            ->columnSpan(2),
                                        Forms\Components\MarkdownEditor::make('description')
                                            ->label('Description')
                                            ->helperText('Main text content (question answer, quote, feature description, etc.)')
                                            ->columnSpanFull(),
                                        Forms\Components\Select::make('locale')
                                            ->options([
                                                'en' => 'English',
                                                'id' => 'Indonesian',
                                            ])
                                            ->default('id')
                                            ->required(),
                                    ])
                                    ->compact()
                                    ->columns(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Image')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Primary Image')
                                    ->description('Icon, photo, or logo for this content item')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('images')
                                            ->collection('images')
                                            ->multiple(false)
                                            ->maxFiles(1)
                                            ->imagePreviewHeight('200')
                                            ->panelLayout('compact')
                                            ->acceptedFileTypes(['image/*'])
                                            ->columnSpanFull(),
                                    ])
                                    ->compact(),
                                Forms\Components\Section::make('Secondary Image')
                                    ->description('Used for before/after comparisons - leave empty otherwise')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('images_secondary')
                                            ->collection('images_secondary')
                                            ->multiple(false)
                                            ->maxFiles(1)
                                            ->imagePreviewHeight('200')
                                            ->panelLayout('compact')
                                            ->acceptedFileTypes(['image/*'])
                                            ->columnSpanFull(),
                                    ])
                                    ->compact()
                                    ->collapsed(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Link')
                            ->icon('heroicon-o-link')
                            ->schema([
                                Forms\Components\Section::make('Click Settings')
                                    ->schema([
                                        Forms\Components\TextInput::make('click_url')
                                            ->label('Click URL')
                                            ->url()
                                            ->maxLength(255),
                                        Forms\Components\Select::make('click_url_target')
                                            ->label('Click URL Target')
                                            ->options([
                                                '_blank' => 'New Tab',
                                                '_self' => 'Current Tab',
                                            ])
                                            ->default('_self')
                                            ->native(false),
                                    ])
                                    ->compact()
                                    ->columns(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Advanced Settings')
                            ->icon('heroicon-o-cog')
                            ->schema([
                                Forms\Components\Section::make('Settings')
                                    ->schema([
                                        Forms\Components\TextInput::make('sort')
                                            ->label('Sort Order')
                                            ->required()
                                            ->numeric()
                                            ->default(static::getLastSortValue() + 1),
                                        Forms\Components\KeyValue::make('options')
                                            ->keyLabel('Option Name')
                                            ->valueLabel('Option Value')
                                            ->helperText('Extra attributes, e.g. percent (skill), price/unit (pricing plan), step_number (work process), role (testimonial)')
                                            ->addable()
                                            ->reorderable()
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
                SpatieMediaLibraryImageColumn::make('images')
                    ->label('Image')
                    ->collection('images')
                    ->conversion('thumbnail')
                    ->size(60)
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('title')
                    ->description(fn (Model $record): string => Str::limit(strip_tags((string) $record->description), 100))
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
                Tables\Filters\SelectFilter::make('content_category_id')
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('clone')
                        ->label('Clone')
                        ->icon('heroicon-m-document-duplicate')
                        ->requiresConfirmation()
                        ->action(function (Item $record) {
                            $attributes = $record->only($record->getFillable());

                            $clone = new Item($attributes);
                            $clone->title = "{$record->title} (Clone)";
                            $clone->sort = static::getLastSortValue() + 1;
                            $clone->created_by = auth()->id();
                            $clone->updated_by = auth()->id();
                            $clone->save();

                            if ($record->hasMedia('images')) {
                                $record->getFirstMedia('images')->copy($clone, 'images');
                            }

                            Notification::make()->title('Content cloned')->success()->send();

                            return redirect()->route('filament.admin.resources.content.items.edit', ['record' => $clone->id]);
                        }),
                    Tables\Actions\DeleteAction::make()->hiddenLabel()->tooltip('Delete'),
                ]),
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
            ->defaultSort('sort', 'asc')
            ->reorderable('sort');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
            'view' => Pages\ViewItem::route('/{record}'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['category']);
    }

    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        return $record->title;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'description', 'category.name'];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nav_group.content');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'gray';
    }
}
