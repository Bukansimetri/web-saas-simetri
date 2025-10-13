<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteFeatureResource\Pages;
use App\Models\SiteFeature;
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

class SiteFeatureResource extends Resource
{
    protected static ?string $model = SiteFeature::class;

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Section Content';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Section Feature Details')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('Main Details')
                                    ->description('Fill out the main details of the site feature')
                                    ->icon('heroicon-o-clipboard')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Title')
                                            ->maxLength(255)
                                            ->columnSpan(2),
                                        Forms\Components\Select::make('type')
                                            ->options([
                                                'home-section-top' => 'Home Section Top',
                                                'home-section-top-one' => 'Home Section Top One',
                                                'home-section-top-two' => 'Home Section Top Two',
                                                'home-section-middle' => 'Home Section Middle',
                                                'home-section-bottom' => 'Home Section Bottom',
                                                'about-section-top' => 'About Us Section Top',
                                                'about-section-middle' => 'About Us Section Middle',
                                                'about-section-bottom' => 'About Us Section Bottom',
                                                'portfolio-section-top' => 'Portfolio Section Top',
                                                'portfolio-section-middle' => 'Portfolio Section Middle',
                                                'portfolio-section-bottom' => 'Portfolio Section Bottom',
                                                'service-section-top' => 'Service Section Top',
                                                'service-section-middle' => 'Service Section Middle',
                                                'service-section-bottom' => 'Service Section Bottom',

                                            ])
                                            ->columnSpan(2)
                                            ->required(),
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->helperText('Control client visibility')
                                            ->default(true),
                                        Forms\Components\MarkdownEditor::make('description')
                                            ->label('Description')
                                            ->helperText('Provide a description for the site feature')
                                            ->maxLength(500)
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('icon_class')
                                            ->label('Icon Class')
                                            ->maxLength(255),
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
                        Forms\Components\Tabs\Tab::make('Section Image')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Image')
                                    ->description('Upload section image here')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('sitefeatures')
                                            ->collection('sitefeatures')
                                            ->multiple(false)
                                            ->maxFiles(1)
                                            ->imagePreviewHeight('250')
                                            ->panelLayout('compact')
                                            ->imageResizeMode('cover')
                                            ->imageResizeTargetWidth('1200')
                                            ->imageResizeTargetHeight('800')
                                            ->acceptedFileTypes(['image/*'])
                                            ->helperText('Upload a service image. Recommended size: 1200px ++')
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
                SpatieMediaLibraryImageColumn::make('sitefeatures')
                    ->label('Image')
                    ->collection('siteqfeatures')
                    ->conversion('thumbnail')
                    ->size(60)
                    ->circular(false)
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('title')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('icon_class')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->description(fn (Model $record): string => Str::limit(strip_tags($record->description), 100))
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Update')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->hiddenLabel()->tooltip('View'),
                Tables\Actions\EditAction::make()->hiddenLabel()->tooltip('Edit'),
                Tables\Actions\Action::make('preview')
                    ->label('Preview Image')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Service $record) => $record->getImageUrl('large'))
                    ->openUrlInNewTab(),
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
            ->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListSiteFeatures::route('/'),
            'create' => Pages\CreateSiteFeature::route('/create'),
            'edit' => Pages\EditSiteFeature::route('/{record}/edit'),
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
        return ['title', 'description'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Status' => $record->is_active ? 'Active' : 'Inactive',
        ];
    }
}
