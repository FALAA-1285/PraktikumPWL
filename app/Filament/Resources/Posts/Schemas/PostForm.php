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
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Group;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([
                    // Section 1 Post Detail
                    Section::make("Post Details")
                        ->description("Fill in the details of the post.")
                        ->icon(Heroicon::OutlinedDocumentText)
                        ->schema([
                            TextInput::make("title")
                                ->rules(['required', 'min:3', 'max:10']),
                            TextInput::make("slug")
                                ->rule('Required')
                                ->unique()
                                ->validationMessages(['unique' => 'The slug must be unique.',]),
                            Select::make("category_id")
                                ->relationship("category", "name")
                                ->required()
                                ->preload()
                                ->searchable(),
                            ColorPicker::make("color"),
                            MarkdownEditor::make("content")
                                ->columnSpanFull(),
                        ])->columns(2),
                ])->columnSpan(['default' => 3, 'md' => 2]),

                Group::make([
                    // Section 2 Image
                    Section::make("Image Upload")
                        ->icon(Heroicon::OutlinedPhoto)
                        ->schema([
                            FileUpload::make("image")
                                ->required()
                                ->disk("public")
                                ->directory("posts"),
                        ]),
                    // Section 3 Meta Information
                    Section::make("Meta Information")
                        ->icon(Heroicon::OutlinedTag)
                        ->schema([
                            TagsInput::make('tags'),
                            Checkbox::make("published"),
                            DateTimePicker::make("published_at"),
                        ]),
                ])->columnSpan(['default' => 3, 'md' => 1]),
            ])->columns(3);
    }
}
