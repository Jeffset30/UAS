<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeminjamanResource\Pages;
use App\Filament\Resources\PeminjamanResource\RelationManagers;
use App\Models\Peminjaman;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
        Select::make('buku_id')
            ->relationship('buku', 'judul', fn ($query) => $query->tersedia())
            ->required(),
        TextInput::make('peminjam')->required(),
        DatePicker::make('tanggal_pinjam')->required(),
    ]);
    }

    public static function table(Table $table): Table
{
    return $table->columns([
        TextColumn::make('buku.judul')->label('Buku'),
        TextColumn::make('peminjam'),
        TextColumn::make('tanggal_pinjam')->date(),
        TextColumn::make('tanggal_kembali')->date()->sortable(),
    ])->actions([
        Action::make('Kembalikan')
            ->visible(fn ($record) => $record->tanggal_kembali === null)
            ->action(fn ($record) => $record->update(['tanggal_kembali' => now()])),
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
            'index' => Pages\ListPeminjamen::route('/'),
            'create' => Pages\CreatePeminjaman::route('/create'),
            'edit' => Pages\EditPeminjaman::route('/{record}/edit'),
        ];
    }
}
