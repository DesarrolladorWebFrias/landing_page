
<?php
// Almacena los diferentes roles de usuario (ej. Administrador, Editor, Suscriptor).
//Fundamental para el sistema de autorización. Sigue el principio de 3NF: los usuarios tienen un rol, y los roles tienen permisos.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 50)->unique();
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });

        // Tabla pivot role_user
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('role_id');
            
            $table->primary(['user_id', 'role_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
};