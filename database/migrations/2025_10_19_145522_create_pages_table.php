<?php
//Almacena los registros de las páginas estáticas del sitio (ej. "Acerca de", "Servicios", "Contacto").
//Base del CMS. Se enlaza con page_sections para obtener el contenido.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();
            $table->string('title', 200);
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};