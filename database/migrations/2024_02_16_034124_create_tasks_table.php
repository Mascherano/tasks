<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migración que crea la tabla Tasks, que contendrá las tareas de esta aplicación.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('SET NULL'); //clave foránea para relacionar con la tabla users
            $table->foreignId('position_id')->default(1); //clave foránea para relacionar con tabla positions, estados para las tareas
            $table->string('title')->unique(); //campo que contendrá el título de la tarea, debe ser único en la tabla tasks
            $table->text('description'); //campo que contendrá la descripción de la tarea
            $table->timestamp('end_date'); //campo que contendrá la fecha de finalización de la tarea, solo es un dato
            $table->timestamps();
            $table->softDeletes(); //esta sentencia creara en la tabla tasks, el campo deleted_at que se completara cuando una tarea sea eliminada con softdelete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
