<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PokokAjaranItemResource\Pages;
use App\Filament\Support\TranslatableTabs;
use App\Models\PokokAjaran;
use App\Models\PokokAjaranItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PokokAjaranItemResource extends Resource
{
    protected static ?string $model = PokokAjaranItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationGroup = 'Ajaran';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->schema([
                        Forms\Components\Select::make('pokok_ajaran_id')
                            ->label('Pokok Ajaran')
                            ->relationship('pokokAjaran', 'title')
                            ->getOptionLabelFromRecordUsing(fn (PokokAjaran $record) => $record->title)
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->directory('pokok-ajaran-items')
                            ->required(),
                        TranslatableTabs::make([
                            'title' => fn (string $name) => Forms\Components\TextInput::make($name)
                                ->label('Judul')
                                ->required()
                                ->maxLength(255),
                            'description' => fn (string $name) => Forms\Components\RichEditor::make($name)
                                ->label('Deskripsi')
                                ->required(),
                            'quote' => fn (string $name) => Forms\Components\Textarea::make($name)
                                ->label('Kutipan'),
                        ]),
                    ]),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'publish' => 'Publish',
                            ])
                            ->native(false)
                            ->default('publish')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->defaultImageUrl(asset('images/no-image.png')),
                Tables\Columns\TextColumn::make('pokokAjaran.title')
                    ->label('Pokok Ajaran')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'publish' ? 'success' : 'gray'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPokokAjaranItems::route('/'),
            'create' => Pages\CreatePokokAjaranItem::route('/create'),
            'edit' => Pages\EditPokokAjaranItem::route('/{record}/edit'),
        ];
    }
}
