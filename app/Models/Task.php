<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /*
    * Arreglo de datos que se pueden completar
    */
    protected $fillable = [
        'user_id',
        'position_id',
        'title',
        'description',
        'end_date'
    ];

    /*
    * Función que crea la relación entre las tareas y los usuarios
    * Es una función BelongsTo que describe una relación de uno a muchos a la inversa "PERTENECE A"
    * Una tarea puede tener un y solo un usuario asignado
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    * Función que crea la relación entre las tareas y los posiciones
    * Es una función BelongsTo que describe una relación de uno a muchos a la inversa "PERTENECE A"
    * Una tarea puede tener una y solo una posición asignado
    */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
}
