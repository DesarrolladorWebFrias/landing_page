<?php

//Almacena la información de redes sociales (enlaces, iconos, IDs).
//Proporciona una forma centralizada de gestionar los enlaces a redes sociales que se muestran en el pie de página o encabezado.
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Configuración de redes sociales
        Schema::create('social_settings', function (Blueprint $table) {
            $table->id();
            $table->string('platform', 50)->unique(); // facebook, twitter, linkedin, instagram, whatsapp
            $table->boolean('is_active')->default(true);
            $table->text('share_text')->nullable();
            $table->string('whatsapp_number', 20)->nullable()->default('9141247950');
            $table->text('whatsapp_message')->nullable();
            $table->string('button_color', 7)->nullable()->default('#1877F2'); // Color por plataforma
            $table->timestamps();
        });

        // Métricas de compartidos
        Schema::create('social_shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('testimonial_id')->nullable()->constrained('testimonials')->onDelete('set null');
            $table->string('social_platform', 50); // facebook, twitter, etc.
            $table->unsignedInteger('share_count')->default(0);
            $table->timestamps();
            
            $table->unique(['testimonial_id', 'social_platform']);
            $table->index(['social_platform', 'created_at']);
        });

        // Configuración del botón flotante
        Schema::create('floating_button_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->enum('position', ['bottom-right', 'bottom-left', 'top-right', 'top-left'])->default('bottom-right');
            $table->string('button_color', 7)->default('#25D366');
            $table->string('icon_color', 7)->default('#FFFFFF');
            $table->string('button_text', 50)->default('Contáctanos');
            $table->boolean('show_on_landing_only')->default(true);
            $table->integer('z_index')->default(9999);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('floating_button_settings');
        Schema::dropIfExists('social_shares');
        Schema::dropIfExists('social_settings');
    }
};