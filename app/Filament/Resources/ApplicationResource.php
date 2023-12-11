<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Application;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ApplicationResource\Pages;
use App\Filament\Resources\ApplicationResource\RelationManagers;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
// use PhpParser\Node\Stmt\Label;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('artical')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('Affiliation')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('Co_authors')
                    ->required(),
                Forms\Components\Textarea::make('abstract_file_path')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('figures_file_path')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('SCHFS')
                    ->numeric(),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Infolists\Components\TextEntry::make('user.First_name')->label('First Name'),
            Infolists\Components\TextEntry::make('user.Last_name')->label('Last Name'),
            Infolists\Components\TextEntry::make('user.Id_number')->label('ID Number'),
            Infolists\Components\TextEntry::make('title')->label('Article Title'),
            Infolists\Components\TextEntry::make('artical')->label('Article Type'),
            Infolists\Components\TextEntry::make('Affiliation')->label('Affiliation'),
            Infolists\Components\TextEntry::make('author')->label('Presenting author'),
            Infolists\Components\TextEntry::make('SCHFS')->label('SCHFS'),
            // Infolists\Components\TextEntry::make('Co_authors')->label('Co_authors')
            // ->value(function ($record) {
            //     $co_authors = json_decode($record->getModel()->Co_authors, true);
            //     return implode(', ', array_column($co_authors, 'co_authors'));
            // }),,
            Infolists\Components\TextEntry::make('Co_authors')->label('Co_authors'),
            // ->value(function ($record) {
            //     $co_authors = json_decode($record->getModel()->Co_authors, true);
            //     $co_authors = array_filter($co_authors, function ($author) {
            //         return isset($author['co_authors']);
            //     });
            //     return implode(', ', array_column($co_authors, 'co_authors'));
            // }),

          Infolists\Components\TextEntry::make('created_at')->label('Registration Date')
                ->columnSpanFull(),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.First_name')->Label('F.Name')
                    ->sortable() ->searchable()  ,
                Tables\Columns\TextColumn::make('user.Last_name')->Label('L.Name')
                    ->sortable() ->searchable()  ,
                Tables\Columns\TextColumn::make('title')->label('Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('artical')->label('Artical Type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('author')->label('Presenting author')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('user.email')->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Affiliation')
                    ->searchable(),

                //  Tables\Columns\TextColumn::make('co_authors')
                //     ->json(),
                Tables\Columns\TextColumn::make('SCHFS')
                    ->numeric()
                    ->sortable()  ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('user.Id_number')->label('id number')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\Action::make('abstract')
                ->label('abstract')
                ->icon('heroicon-o-document')
                ->url(fn ($record) => Storage::url($record->getModel()->abstract_file_path))
                ->openUrlInNewTab(true),
                Tables\Actions\Action::make('figures')
                ->label('figures')
                ->icon('heroicon-o-document')
                ->url(fn ($record) => Storage::url($record->getModel()->figures_file_path))
                ->openUrlInNewTab(true),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListApplications::route('/'),
            'view' => Pages\ViewApplication::route('/{record}'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }    
}
