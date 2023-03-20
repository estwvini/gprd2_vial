<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DomainResource\Pages;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Stancl\Tenancy\Database\Models\Domain;

class DomainResource extends Resource
{
    protected static ?string $model = Domain::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationGroup = 'Tenants';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Dominios';

    protected static ?string $recordTitleAttribute = 'domain';

    protected static ?string $modelLabel = 'Dominio';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Forms\Components\Card::make()
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('domain')->label('Dominio')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('tenant_id')
                            ->relationship('tenant', 'id')
                            ->required()
                            ->preload()
                    ]));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('domain')->label('Dominio')->searchable(),
                Tables\Columns\TextColumn::make('tenant_id')->label('Tenant')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->since()->label('Creado'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDomains::route('/'),
            'create' => Pages\CreateDomain::route('/create'),
            'edit' => Pages\EditDomain::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return self::$model::count();
    }
}
