<?php

namespace App\Filament\Resources\Content;

use App\Filament\Resources\Content\CategoryResource\Pages;
use App\Filament\Resources\Content\CategoryResource\RelationManagers;
use App\Models\Content\Category;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $slug = 'content/categories';

    protected static ?int $navigationSort = -1;

    protected static ?string $navigationIcon = 'fluentui-stack-20';

    protected static ?string $navigationLabel = 'Content Categories';

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
                                        $query = Category::query();
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
                                    ->unique(Category::class, 'slug', ignoreRecord: true)
                                    ->helperText('URL-friendly identifier used in code to query this category, e.g. "testimonial", "faq-home", "portfolio-project"'),

                                Forms\Components\Select::make('locale')
                                    ->options([
                                        'en' => 'English',
                                        'id' => 'Indonesian',
                                    ])
                                    ->default('id')
                                    ->required(),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Active')
                                    ->helperText('Only active categories will be shown on the frontend')
                                    ->default(true),
                            ]),

                        Tabs\Tab::make('Content')
                            ->schema([
                                Forms\Components\MarkdownEditor::make('description')
                                    ->columnSpan('full'),
                            ]),

                        Tabs\Tab::make('SEO & Meta')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('meta_description')
                                    ->maxLength(500)
                                    ->rows(3),
                            ]),

                        Tabs\Tab::make('Advanced Options')
                            ->schema([
                                Forms\Components\KeyValue::make('options')
                                    ->keyLabel('Option Name')
                                    ->valueLabel('Option Value')
                                    ->addable()
                                    ->reorderable()
                                    ->columnSpan('full'),
                            ]),
                    ])
                    ->columnSpan('full'),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Basic Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->size(Infolists\Components\TextEntry\TextEntrySize::Large),
                        Infolists\Components\TextEntry::make('slug'),
                        Infolists\Components\TextEntry::make('parent.name')
                            ->label('Parent Category')
                            ->default('None'),
                        Infolists\Components\IconEntry::make('is_active')
                            ->label('Status')
                            ->boolean(),
                        Infolists\Components\TextEntry::make('locale')
                            ->label('Language'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Statistics')
                    ->schema([
                        Infolists\Components\TextEntry::make('items_count')
                            ->label('Number of Items')
                            ->state(fn (Category $record): int => $record->items()->count()),
                        Infolists\Components\TextEntry::make('updated_at')
                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Category $record) => $record->parent ? "Child of {$record->parent->name}" : '')
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
                Tables\Columns\TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
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
                    ->options(fn () => Category::pluck('name', 'id'))
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('view_items')
                        ->label('View Items')
                        ->icon('heroicon-m-squares-2x2')
                        ->url(fn (Category $record): string => ItemResource::getUrl('index', [
                            'tableFilters[content_category_id][value]' => $record->id,
                        ]))
                        ->openUrlInNewTab(),
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
            ->defaultSort('updated_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
            RelationManagers\ChildrenRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
            'view' => Pages\ViewCategory::route('/{record}'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nav_group.content');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount('items');
    }
}
