<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BukuResource\Pages;
use App\Filament\Resources\BukuResource\RelationManagers;
use App\Models\Buku;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BukuResource extends Resource
{
    protected static ?string $model = Buku::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form->schema([
        TextInput::make('judul')->required(),
        TextInput::make('pengarang')->required(),
        Select::make('kategori')
            ->options([
                'Fiksi' => 'Fiksi',
                'Non Fiksi' => 'Non Fiksi',
            ])
            ->required(),
    ]);
}

    public static function table(Table $table): Table
{
    return $table->columns([
        TextColumn::make('judul')->searchable(),
        TextColumn::make('pengarang'),
        TextColumn::make('kategori'),
        IconColumn::make('tersedia')
            ->boolean()
            ->label('Tersedia')
            ->getStateUsing(function ($record) {
                return $record->peminjamans()->whereNull('tanggal_kembali')->count() == 0;
            }),
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
            'index' => Pages\ListBukus::route('/'),
            'create' => Pages\CreateBuku::route('/create'),
            'edit' => Pages\EditBuku::route('/{record}/edit'),
        ];
    }
}
