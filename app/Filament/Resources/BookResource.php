<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Support\TranslatableTabs;
use App\Models\Book;
use App\Models\BookCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Buku';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->description('Kategori dan slug buku.')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->getOptionLabelFromRecordUsing(fn (BookCategory $record) => $record->name)
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Detail Buku')
                    ->schema([
                        Forms\Components\TextInput::make('author')
                            ->label('Penulis')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('publisher')
                            ->label('Penerbit')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('isbn')
                            ->label('ISBN')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('year')
                            ->label('Tahun Terbit')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue((int) date('Y')),
                    ])
                    ->columns(4),

                Forms\Components\Section::make('Konten')
                    ->schema([
                        TranslatableTabs::make([
                            'title' => fn (string $name) => Forms\Components\TextInput::make($name)
                                ->label('Judul')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $state, callable $set) use ($name) {
                                    if (str_ends_with($name, '.id')) {
                                        $set('slug', Str::slug($state));
                                    }
                                }),
                            'description' => fn (string $name) => Forms\Components\RichEditor::make($name)
                                ->label('Deskripsi'),
                        ]),
                    ]),

                Forms\Components\Section::make('Media & File')
                    ->schema([
                        Forms\Components\FileUpload::make('cover')
                            ->label('Sampul')
                            ->image()
                            ->directory('books/covers')
                            ->required(),
                        Forms\Components\FileUpload::make('pdf')
                            ->label('File PDF')
                            ->directory('books/pdf')
                            ->acceptedFileTypes(['application/pdf'])
                            ->openable()
                            ->downloadable(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Statistik')
                    ->schema([
                        Forms\Components\TextInput::make('downloads')
                            ->label('Diunduh')
                            ->numeric()
                            ->default(0)
                            ->disabled(),
                        Forms\Components\TextInput::make('views')
                            ->label('Dilihat')
                            ->numeric()
                            ->default(0)
                            ->disabled(),
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
                Tables\Columns\ImageColumn::make('cover')
                    ->defaultImageUrl(asset('images/no-image.png')),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('author')
                    ->searchable(),
                Tables\Columns\TextColumn::make('downloads')
                    ->numeric()
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('category_id')
                    ->options(fn () => BookCategory::query()->get()->pluck('name', 'id'))
                    ->label('Kategori'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'publish' => 'Publish',
                    ]),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
