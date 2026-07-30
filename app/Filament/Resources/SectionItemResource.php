<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionItemResource\Pages;
use App\Filament\Support\TranslatableTabs;
use App\Models\SectionItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SectionItemResource extends Resource
{
    protected static ?string $model = SectionItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationGroup = 'Konten Halaman';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->schema([
                        Forms\Components\Select::make('section_id')
                            ->label('Section')
                            ->relationship('section', 'title', modifyQueryUsing: fn ($query) => $query->with('page'))
                            ->getOptionLabelFromRecordUsing(fn ($record) => ($record->page?->name ?? '-') . ' • ' . ($record->slug ?? $record->title))
                            ->searchable()
                            ->preload()
                            ->required(),
                        TranslatableTabs::make([
                            'title' => fn (string $name) => Forms\Components\TextInput::make($name)
                                ->label('Judul')
                                ->required()
                                ->maxLength(255),
                            'description' => fn (string $name) => Forms\Components\Textarea::make($name)
                                ->label('Deskripsi'),
                        ]),
                    ]),

                Forms\Components\Section::make('Tampilan & Pengaturan')
                    ->schema([
                        Forms\Components\TextInput::make('icon')
                            ->maxLength(255)
                            ->helperText('Contoh: fa-solid fa-star'),
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
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section.title')
                    ->label('Section')
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
            'index' => Pages\ListSectionItems::route('/'),
            'create' => Pages\CreateSectionItem::route('/create'),
            'edit' => Pages\EditSectionItem::route('/{record}/edit'),
        ];
    }
}
