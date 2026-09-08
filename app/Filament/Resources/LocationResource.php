<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
use App\Filament\Resources\LocationResource\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\LocationResource\RelationManagers\HoursRelationManager;
use App\Filament\Resources\LocationResource\RelationManagers\PhotosRelationManager;
use App\Filament\Support\TranslatableTabs;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Lokasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Sampul')
                            ->image()
                            ->directory('locations')
                            ->columnSpanFull(),
                        TranslatableTabs::make([
                            'name' => fn (string $name) => Forms\Components\TextInput::make($name)
                                ->label('Nama')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (?string $state, callable $set, callable $get) use ($name) {
                                    if (str_ends_with($name, '.id') && blank($get('slug'))) {
                                        $set('slug', Str::slug((string) $state));
                                    }
                                }),
                            'address' => fn (string $name) => Forms\Components\Textarea::make($name)
                                ->label('Alamat')
                                ->required(),
                        ]),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('phone')
                            ->label('Telepon')
                            ->tel()
                            ->maxLength(255),
                    ]),

                Forms\Components\Section::make('Video Sanggar')
                    ->description('Video profil atau kegiatan sanggar (opsional).')
                    ->schema([
                        Forms\Components\FileUpload::make('video')
                            ->label('Video')
                            ->directory('locations/videos')
                            ->maxSize(51200)
                            ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg']),
                    ]),

                Forms\Components\Section::make('Tuntunan')
                    ->description('Nama dan foto tuntunan yang membina sanggar ini.')
                    ->schema([
                        Forms\Components\FileUpload::make('tuntunan_photo')
                            ->label('Foto Tuntunan')
                            ->image()
                            ->directory('locations/tuntunan'),
                        Forms\Components\TextInput::make('tuntunan_name')
                            ->label('Nama Tuntunan')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Lokasi Peta')
                    ->schema([
                        Forms\Components\TextInput::make('latitude')
                            ->numeric(),
                        Forms\Components\TextInput::make('longitude')
                            ->numeric(),
                        Forms\Components\Textarea::make('maps_link')
                            ->label('Tautan Google Maps')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

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
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tuntunan_name')
                    ->label('Tuntunan'),
                Tables\Columns\TextColumn::make('phone')
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

    public static function getRelations(): array
    {
        return [
            PhotosRelationManager::class,
            HoursRelationManager::class,
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
