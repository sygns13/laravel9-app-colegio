<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Cliente registrado desde el formulario público de promociones/novedades.
 *
 * Tabla independiente de `clientes` (ventas). Sigue la convención de
 * soft-delete por flags del proyecto: `activo` (1/0) y `borrado` (0/1).
 */
class ClientePromocion extends Model
{
    use HasFactory;

    protected $table = 'clientes_promociones';

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombres_apellidos',
        'celular',
        'correo',
        'acepta_privacidad',
        'acepta_promociones',
        'activo',
        'borrado',
    ];

    protected $guarded = ['id'];
}
