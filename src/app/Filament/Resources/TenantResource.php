<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Filament\Resources\TenantResource\RelationManagers\DomainsRelationManager;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    protected static ?string $navigationGroup = 'Tenants';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $modelLabel = 'Tenant';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Forms\Components\Card::make()
                    ->columns(1)
                    ->schema(
                        [
                            Forms\Components\TextInput::make('id')->required()->unique(ignoreRecord: true),
                            Forms\Components\Checkbox::make('has_api')->label('Se integra con Financiero?'),
                            Forms\Components\TextInput::make('api_url')->label('URL API Financiero')
                        ]
                    )

            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable(),
                Tables\Columns\BadgeColumn::make('domains_count')->counts('domains')->label('Dominios')->color('success'),
                Tables\Columns\CheckboxColumn::make('has_api')->label('Se integra con Financiero?'),
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
            DomainsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return self::$model::count();
    }
}
