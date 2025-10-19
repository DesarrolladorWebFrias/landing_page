<?php
//Almacena los registros de los testimonios de clientes (nombre, contenido, rating).
//Contenido dinámico reutilizable en varias páginas
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->text('body');
            $table->string('author_name', 150)->nullable();
            $table->string('author_position', 150)->nullable();
            $table->string('organization', 150)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->integer('view_count')->default(0);
            $table->timestamps();

            $table->index(['is_published', 'published_at']);
            $table->index(['is_featured', 'is_published']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};