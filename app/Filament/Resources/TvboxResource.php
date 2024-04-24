<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TvboxResource\Pages;
use App\Filament\Resources\TvboxResource\RelationManagers;
use App\Models\Tvbox;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TvboxResource extends Resource
{
    protected static ?string $model = Tvbox::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
    ->schema([
        Forms\Components\Select::make('client_id') // Asegúrate de que el nombre del campo coincida con tu modelo y base de datos
            ->relationship('client', 'nombre') // 'client' es el método de la relación en el modelo TvBox, y 'nombre' es el atributo del Cliente para mostrar
            ->required()
            ->searchable() // Permite buscar clientes por 'nombre', útil si tienes muchos registros
            ->preload(), // Pre-carga las opciones; considera remover si tienes muchos clientes
        Forms\Components\TextInput::make('codigo')
            ->required()
            ->maxLength(191),

    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_vencimiento')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListTvboxes::route('/'),
            'create' => Pages\CreateTvbox::route('/create'),
            'edit' => Pages\EditTvbox::route('/{record}/edit'),
        ];
    }
}
