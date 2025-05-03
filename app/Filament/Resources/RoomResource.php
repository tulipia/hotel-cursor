<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use App\Models\RoomType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationGroup = 'Hotel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('room_type_id')
                    ->label('Tipo de Quarto')
                    ->relationship('roomType', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('room_number')
                    ->label('Número do Quarto')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('floor')
                    ->label('Andar')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        'available' => 'Disponível',
                        'occupied' => 'Ocupado',
                        'maintenance' => 'Em Manutenção',
                        'cleaning' => 'Em Limpeza',
                    ])
                    ->default('available'),
                Forms\Components\Textarea::make('notes')
                    ->label('Observações')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('room_number')
                    ->label('Número')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roomType.name')
                    ->label('Tipo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('floor')
                    ->label('Andar')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'available' => 'Disponível',
                        'occupied' => 'Ocupado',
                        'maintenance' => 'Em Manutenção',
                        'cleaning' => 'Em Limpeza',
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'occupied' => 'danger',
                        'maintenance' => 'warning',
                        'cleaning' => 'info',
                    }),
                Tables\Columns\TextColumn::make('notes')
                    ->label('Observações')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'available' => 'Disponível',
                        'occupied' => 'Ocupado',
                        'maintenance' => 'Em Manutenção',
                        'cleaning' => 'Em Limpeza',
                    ]),
                Tables\Filters\SelectFilter::make('room_type_id')
                    ->label('Tipo de Quarto')
                    ->relationship('roomType', 'name'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
