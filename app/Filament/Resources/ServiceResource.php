<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationIcon = 'heroicon-o-server-stack';

    protected static function getLastSortValue(): int
    {
        return Service::max('sort') ?? 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Service Details')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('Main Details')
                                    ->description('Fill out the main details of the service')
                                    ->icon('heroicon-o-clipboard')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Title')
                                            ->maxLength(255)
                                            ->columnSpan(2),
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->helperText('Control service visibility')
                                            ->default(true),
                                        Forms\Components\Textarea::make('short_description')
                                            ->label('Short Description')
                                            ->maxLength(255)
                                            ->columnSpan(2),
                                        Forms\Components\MarkdownEditor::make('description')
                                            ->label('Description')
                                            ->helperText('Provide a description for the service')
                                            ->maxLength(500)
                                            ->columnSpanFull(),
                                        Forms\Components\Select::make('locale')
                                            ->options([
                                                'en' => 'English',
                                                'id' => 'Indonesian',
                                                'zh' => 'Chinese',
                                                'ja' => 'Japanese',
                                            ])
                                            ->default('en')
                                            ->required(),
                                    ])
                                    ->compact()
                                    ->columns(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Service Image')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Image')
                                    ->description('Upload service image here')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('services')
                                            ->collection('services')
                                            ->multiple(false)
                                            ->maxFiles(1)
                                            ->imagePreviewHeight('250')
                                            ->panelLayout('compact')
                                            ->imageResizeMode('cover')
                                            ->imageResizeTargetWidth('1200')
                                            ->imageResizeTargetHeight('800')
                                            ->acceptedFileTypes(['image/*'])
                                            ->helperText('Upload a service image. Recommended size: 1200x800px')
                                            ->columnSpanFull(),
                                    ])
                                    ->compact(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Link & Tracking')
                            ->icon('heroicon-o-link')
                            ->schema([
                                Forms\Components\Section::make('Click Settings')
                                    ->description('Configure link and tracking options')
                                    ->schema([
                                        Forms\Components\TextInput::make('click_url')
                                            ->label('Click URL')
                                            ->helperText('Enter the URL to navigate to when the service is clicked')
                                            ->url()
                                            ->maxLength(255),
                                        Forms\Components\Select::make('click_url_target')
                                            ->label('Click URL Target')
                                            ->helperText('Select how the URL should be opened')
                                            ->options([
                                                '_blank' => 'New Tab',
                                                '_self' => 'Current Tab',
                                            ])
                                            ->default('_self')
                                            ->native(false),
                                    ])
                                    ->compact()
                                    ->columns(2),
                                Forms\Components\Section::make('Tracking')
                                    ->description('Service tracking statistics')
                                    ->schema([
                                        Forms\Components\Placeholder::make('impression_count')
                                            ->label('Impressions')
                                            ->content(fn (Project $record): string => number_format($record->impression_count ?? 0)),
                                        Forms\Components\Placeholder::make('click_count')
                                            ->label('Clicks')
                                            ->content(fn (Project $record): string => number_format($record->click_count ?? 0)),
                                        Forms\Components\Placeholder::make('ctr')
                                            ->label('CTR (Click Through Rate)')
                                            ->content(function (Project $record): string {
                                                if (($record->impression_count ?? 0) > 0) {
                                                    $ctr = ($record->click_count / $record->impression_count) * 100;

                                                    return number_format($ctr, 2).'%';
                                                }

                                                return '0.00%';
                                            }),
                                    ])
                                    ->compact()
                                    ->columns(3)
                                    ->visible(fn (?Service $record) => $record !== null),
                            ]),
                        Forms\Components\Tabs\Tab::make('Advanced Settings')
                            ->icon('heroicon-o-cog')
                            ->schema([
                                Forms\Components\Section::make('Settings')
                                    ->description('Additional settings for the service')
                                    ->schema([
                                        Forms\Components\TextInput::make('sort')
                                            ->label('Sort Order')
                                            ->helperText('Set the sort order of the service')
                                            ->required()
                                            ->numeric()
                                            ->default(static::getLastSortValue() + 1),
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
                SpatieMediaLibraryImageColumn::make('services')
                    ->label('Image')
                    ->collection('services')
                    ->conversion('thumbnail')
                    ->size(60)
                    ->circular(false)
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('title')
                    ->badge()
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('short_description')
                    ->description(fn (Model $record): string => Str::limit(strip_tags($record->short_description), 100))
                    ->searchable()
                    ->sortable()
                    ->wrap(),
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
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
                Tables\Filters\SelectFilter::make('locale')
                    ->options([
                        'en' => 'English',
                        'id' => 'Indonesian',
                        'zh' => 'Chinese',
                        'ja' => 'Japanese',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->hiddenLabel()->tooltip('View'),
                Tables\Actions\EditAction::make()->hiddenLabel()->tooltip('Edit'),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('preview')
                        ->label('Preview Image')
                        ->icon('heroicon-m-eye')
                        ->url(fn (Service $record) => $record->getImageUrl('large'))
                        ->openUrlInNewTab(),
                    Tables\Actions\Action::make('clone')
                        ->label('Clone Service')
                        ->icon('heroicon-m-document-duplicate')
                        ->requiresConfirmation()
                        ->action(function (Service $record) {
                            // Get only the fillable attributes
                            $attributes = $record->only($record->getFillable());

                            // Create a new instance and fill it with the attributes
                            $clone = new Service($attributes);

                            // Set the new title
                            $clone->title = "{$record->title} (Clone)";

                            // Update the sort value
                            $clone->sort = static::getLastSortValue() + 1;

                            // Set the creator/updater
                            $clone->created_by = auth()->id();
                            $clone->updated_by = auth()->id();

                            // Reset counters
                            $clone->impression_count = 0;
                            $clone->click_count = 0;

                            // Save the clone
                            $clone->save();

                            // If the original has media, copy it to the clone
                            if ($record->hasMedia('services')) {
                                $media = $record->getFirstMedia('services');
                                $media->copy($clone, 'services');
                            }

                            // Redirect to the edit page of the new clone
                            return redirect()->route('filament.admin.resources.service.edit', ['record' => $clone->id]);
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery();
    }

    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        return $record->title;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'description', 'short_description'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Status' => $record->is_active ? 'Active' : 'Inactive',
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
