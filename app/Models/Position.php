<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

    /*
    * Arreglo de datos que se pueden completar
    */
    protected $fillable = [
        'position'
    ];

    /*
    * Funcion que crea la relación entre las posiciones y las tareas
    * Es una función hasMany que describe una relación de uno a muchos
    * Una posición puede tener una o muchas tareas asignadas
    */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
