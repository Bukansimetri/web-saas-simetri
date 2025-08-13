<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomPageResource\Pages;
use App\Models\CustomPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomPageResource extends Resource
{
    protected static ?string $model = CustomPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('group')
                    ->options(function () {
                        return CustomPage::distinct()->pluck('group', 'group');
                    })
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('name', ucwords(str_replace('-', ' ', $state)));
                    }),

                Forms\Components\TextInput::make('name')
                    ->required(),

                Forms\Components\Select::make('section')
                    ->options([
                        'head' => 'Head',
                        'main' => 'Main',
                        'footer' => 'Footer',
                    ])
                    ->required(),

                Forms\Components\Toggle::make('locked'),

                Forms\Components\Fieldset::make('Payload Content')
                    ->schema(function ($get) {
                        $section = $get('section');
                        $group = $get('group');

                        // Dynamic form based on section
                        if ($section === 'head') {
                            return [
                                Forms\Components\TextInput::make('payload.title')
                                    ->label('Title'),
                                Forms\Components\Textarea::make('payload.description')
                                    ->label('Description'),
                                Forms\Components\TextInput::make('payload.call_to_action')
                                    ->label('Call to Action'),
                            ];
                        } elseif ($section === 'main') {
                            return [
                                Forms\Components\Textarea::make('payload.content')
                                    ->label('Content'),
                                Forms\Components\FileUpload::make('payload.image')
                                    ->label('Image')
                                    ->image(),
                            ];
                        }

                        // Default schema if section doesn't match
                        return [
                            Forms\Components\KeyValue::make('payload')
                                ->label('Payload Data')
                                ->keyLabel('Field')
                                ->valueLabel('Value'),
                        ];
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('group'),
                Tables\Columns\TextColumn::make('section'),
                Tables\Columns\IconColumn::make('locked')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options(function () {
                        return CustomPage::distinct()->pluck('group', 'group');
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListCustomPages::route('/'),
            'create' => Pages\CreateCustomPage::route('/create'),
            'edit' => Pages\EditCustomPage::route('/{record}/edit'),
        ];
    }
}
