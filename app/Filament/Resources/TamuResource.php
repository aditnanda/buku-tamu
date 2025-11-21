<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TamuResource\Pages;
use App\Filament\Resources\TamuResource\RelationManagers;
use App\Models\Tamu;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;


class TamuResource extends Resource
{
    protected static ?string $model = Tamu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor')
                    ->maxLength(255),

                Forms\Components\DatePicker::make('tanggal'),

                Forms\Components\TextInput::make('nama')
                    ->maxLength(255),

                Forms\Components\Select::make('jenis_pengunjung_id')
                    ->label('Jenis Pengunjung')
                    ->relationship('jenisPengunjung', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('instansi')
                    ->maxLength(255),
                Forms\Components\TextInput::make('keperluan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('janji')
                    ->maxLength(255),

                FileUpload::make('foto')
                    ->image()
                    ->downloadable()
                    ->openable(),

                Forms\Components\TextInput::make('waktu_masuk'),
                Forms\Components\TextInput::make('waktu_keluar'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenisPengunjung.nama')
                    ->label('Jenis Pengunjung')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('instansi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keperluan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('janji')
                    ->searchable(),
                Tables\Columns\TextColumn::make('waktu_masuk'),
                Tables\Columns\TextColumn::make('waktu_keluar'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
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
            'index' => Pages\ListTamus::route('/'),
            'create' => Pages\CreateTamu::route('/create'),
            'edit' => Pages\EditTamu::route('/{record}/edit'),
        ];
    }
}
