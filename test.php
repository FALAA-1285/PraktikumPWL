<?php
use App\Filament\Resources\Posts\Schemas\PostForm;
use Filament\Forms\Form;
use Livewire\Component;

$form = Form::make(new class extends Component {});
try {
    PostForm::configure($form);
    echo "SUCCESS\n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "TRACE:\n" . $e->getTraceAsString() . "\n";
}
