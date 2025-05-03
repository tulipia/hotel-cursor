<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomTypeResource\Pages;
use App\Filament\Resources\RoomTypeResource\RelationManagers;
use App\Models\RoomType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomTypeResource extends Resource
{
    protected static ?string $model = RoomType::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'Hotel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price_per_night')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->maxValue(999999.99),
                Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(10),
                Forms\Components\TextInput::make('bed_count')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(4),
                Forms\Components\Select::make('bed_type')
                    ->required()
                    ->options([
                        'Single' => 'Single',
                        'Double' => 'Double',
                        'Queen' => 'Queen',
                        'King' => 'King',
                    ]),
                Forms\Components\CheckboxList::make('amenities')
                    ->options([
                        'tv' => 'TV',
                        'ac' => 'Ar Condicionado',
                        'wifi' => 'WiFi',
                        'balcony' => 'Varanda',
                        'sea_view' => 'Vista para o Mar',
                        'bathtub' => 'Banheira',
                        'minibar' => 'Frigobar',
                    ])
                    ->columns(2)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_per_night')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bed_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bed_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amenities')
                    ->formatStateUsing(function ($state) {
                        if (!is_array($state)) {
                            $state = json_decode($state, true) ?? [];
                        }

                        $amenities = [
                            'tv' => 'TV',
                            'ac' => 'Ar Condicionado',
                            'wifi' => 'WiFi',
                            'balcony' => 'Varanda',
                            'sea_view' => 'Vista para o Mar',
                            'bathtub' => 'Banheira',
                            'minibar' => 'Frigobar',
                        ];

                        return implode(', ', array_map(function($amenity) use ($amenities) {
                            return $amenities[$amenity] ?? $amenity;
                        }, $state));
                    })
                    ->wrap(),
            ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoomTypes::route('/'),
            'create' => Pages\CreateRoomType::route('/create'),
            'edit' => Pages\EditRoomType::route('/{record}/edit'),
        ];
    }
}
