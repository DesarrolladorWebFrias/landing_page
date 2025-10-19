<?php
//Almacena archivos multimedia asociados a los testimonios (ej. foto del cliente, logo de la empresa).
//Separa la información binaria (archivos) de los metadatos principales, optimizando la consulta
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonial_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('testimonial_id')->constrained()->onDelete('cascade');
            $table->string('media_type', 50); // 'image', 'video'
            $table->string('file_name');
            $table->string('original_name');
            $table->string('mime_type');
            $table->string('path');
            $table->string('url');
            $table->string('alt_text', 255)->nullable();
            $table->unsignedInteger('file_size')->default(0);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->index(['testimonial_id', 'media_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonial_media');
    }
};