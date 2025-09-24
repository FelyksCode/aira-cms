<?php

namespace App\Filament\Resources\News\Schemas;

use App\Models\News;
use App\Models\NewsCategory;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Malzariey\FilamentLexicalEditor\LexicalEditor;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(string $context, $state, Set $set) => $context === 'create' || $context === 'edit' ? $set('slug', Str::slug($state)) : null),

                TextInput::make('slug')
                    ->required()
                    ->unique(News::class, 'slug', ignoreRecord: true),

                LexicalEditor::make('body')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('image_url')
                    ->label("Thumbnail Image")
                    ->image(),

                TextInput::make('source_url')
                    ->label("Source URL")
                    ->url(),

                TextInput::make('category')
                    ->required(),

                TextInput::make('created_by')
                    ->required(),
            ]);
    }
}
