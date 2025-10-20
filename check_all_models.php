<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$models = [
    'Role', 'Page', 'PageSection', 'PageSectionVersion', 
    'Testimonial', 'TestimonialMedia', 'ContactMessage', 
    'Setting', 'ActivityLog', 'SocialSetting', 'SocialShare', 'FloatingButtonSetting'
];

foreach ($models as $model) {
    $exists = class_exists("App\\Models\\{$model}");
    echo "{$model}: " . ($exists ? '✅' : '❌') . PHP_EOL;
    
    if (!$exists) {
        // Crear modelo básico si no existe
        $content = "<?php\n\nnamespace App\\Models;\n\nuse Illuminate\\Database\\Eloquent\\Factories\\HasFactory;\nuse Illuminate\\Database\\Eloquent\\Model;\n\nclass {$model} extends Model\n{\n    use HasFactory;\n\n    protected \$fillable = [];\n}\n";
        file_put_contents(__DIR__ . "/app/Models/{$model}.php", $content);
        echo "   📝 Modelo {$model} creado automáticamente\n";
    }
}

echo "Verificación completada.\n";