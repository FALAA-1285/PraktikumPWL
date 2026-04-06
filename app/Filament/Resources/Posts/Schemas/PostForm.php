<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\DateTimePicker;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make("title")->required()->minLength(5),
                TextInput::make("slug")->required()->unique(),
                select::make("category_id")
                ->label("Category")->options
                (\App\Models\Category::all()->pluck('name', 'id'))
                ->searchable()
                ->required(),
                ColorPicker::make("color"),
                MarkdownEditor::make("content")->required(),
                // RichEditor::make("content")->required(),
                FileUpload::make("image")->disk("public")->directory("posts"),
                TagsInput::make('tags'),
                Checkbox::make("published"),
                DateTimePicker::make("published_at"),
            ]);
    }
}
