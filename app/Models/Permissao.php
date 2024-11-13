<?php

// app/Models/Permissao.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    // Define a tabela associada ao modelo
    protected $table = 'permissoes';

    // Defina os campos que podem ser preenchidos
    protected $fillable = [
        'sistema', 'usuario', 'tem_permissao', 'data_alteracao',
    ];

    // Desativa o uso de timestamps automáticos, pois estamos usando a coluna `data_alteracao`
    public $timestamps = false;
}


?>