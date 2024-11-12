<?php

// app/Models/Usuario.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'Usuarios'; // Nome da tabela no banco de dados

    protected $primaryKey = 'id'; // Chave primária

    protected $fillable = [
        'name',
        'password',
        'cpf',
        'ativo',
        'status_usr',
        'superior',
        'matricula',
    ];

    public $timestamps = true; // Laravel gerenciará created_at e updated_at
}

?>