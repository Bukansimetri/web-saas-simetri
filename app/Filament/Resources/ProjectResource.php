<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
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

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';

    protected static function getLastSortValue(): int
    {
        return Project::max('sort') ?? 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Banner Details')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('Main Details')
                                    ->description('Fill out the main details of the project')
                                    ->icon('heroicon-o-clipboard')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Title')
                                            ->maxLength(255)
                                            ->columnSpan(2),
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->helperText('Control banner visibility')
                                            ->default(true),
                                        Forms\Components\Textarea::make('short_description')
                                            ->label('Short Description')
                                            ->columnSpan(2),
                                        Forms\Components\MarkdownEditor::make('description')
                                            ->label('Description')
                                            ->helperText('Provide a description for the banner')
                                            ->maxLength(500)
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('client')
                                            ->label('Client Name'),
                                        Forms\Components\TextInput::make('terms')
                                            ->label('Project Terms'),
                                        Forms\Components\TextInput::make('project_type')
                                            ->label('Project Type'),
                                        Forms\Components\TextInput::make('production_year')
                                            ->label('Production Year'),
                                        Forms\Components\TextInput::make('length')
                                            ->label('Length (in meters)')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('width')
                                            ->label('Width (in meters)')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('height')
                                            ->label('Height (in meters)')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('area')
                                            ->label('Area (in meters)')
                                            ->numeric(),
                                        Forms\Components\Select::make('locale')
                                            ->options([
                                                'en' => 'English',
                                                'id' => 'Indonesian',
                                                'zh' => 'Chinese',
                                                'ja' => 'Japanese',
                                                // Add more languages as needed
                                            ])
                                            ->default('en')
                                            ->required(),
                                    ])
                                    ->compact()
                                    ->columns(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Project Image')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Image')
                                    ->description('Upload project image here')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('projects')
                                            ->collection('projects')
                                            ->multiple(true)
                                            ->reorderable()
                                            ->appendFiles(true)
                                            ->imagePreviewHeight('250')
                                            ->panelLayout('grid')
                                            ->imageResizeMode('cover')
                                            ->imageResizeTargetWidth('1200')
                                            ->imageResizeTargetHeight('800')
                                            ->acceptedFileTypes(['image/*'])
                                            ->helperText('Upload a project image. Recommended size: 1200x800px')
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
                                            ->helperText('Enter the URL to navigate to when the banner is clicked')
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
                                    ->description('Project tracking statistics')
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
                                    ->visible(fn (?Project $record) => $record !== null),
                            ]),
                        Forms\Components\Tabs\Tab::make('Advanced Settings')
                            ->icon('heroicon-o-cog')
                            ->schema([
                                Forms\Components\Section::make('Settings')
                                    ->description('Additional settings for the project')
                                    ->schema([
                                        Forms\Components\TextInput::make('sort')
                                            ->label('Sort Order')
                                            ->helperText('Set the sort order of the project')
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
                SpatieMediaLibraryImageColumn::make('projects')
                    ->label('Image')
                    ->collection('projects')
                    ->conversion('thumbnail')
                    ->size(60)
                    ->circular(false)
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('client')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('click_count')
                    ->label('Clicks')
                    ->numeric()
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
                        ->url(fn (Project $record) => $record->getImageUrl('large'))
                        ->openUrlInNewTab(),
                    Tables\Actions\Action::make('clone')
                        ->label('Clone Project')
                        ->icon('heroicon-m-document-duplicate')
                        ->requiresConfirmation()
                        ->action(function (Project $record) {
                            // Get only the fillable attributes
                            $attributes = $record->only($record->getFillable());

                            // Create a new instance and fill it with the attributes
                            $clone = new Project($attributes);

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
                            if ($record->hasMedia('projects')) {
                                $media = $record->getFirstMedia('projects');
                                $media->copy($clone, 'projects');
                            }

                            // Redirect to the edit page of the new clone
                            return redirect()->route('filament.admin.resources.project.edit', ['record' => $clone->id]);
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
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
        return ['title', 'description', 'short_description', 'client', 'terms', 'project_type'];
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
