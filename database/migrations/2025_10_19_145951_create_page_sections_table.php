<?php
//Almacena las secciones o bloques de contenido dentro de una página específica (ej. un Hero Banner, un bloque de texto, un carrusel).
//Descompone el contenido de una página en partes modulares. Es la clave para la flexibilidad del CMS.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->string('section_key', 100); // 'mision', 'vision', 'equipo'
            $table->string('title', 200)->nullable();
            $table->text('content')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['page_id', 'section_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};