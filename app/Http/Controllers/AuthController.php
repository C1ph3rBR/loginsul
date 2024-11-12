<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\Usuario; // Certifique-se de importar o modelo do usuário
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Função para verificar se o usuário e a senha estão corretos.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validação dos dados da requisição
        $request->validate([
            'cpf' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tente encontrar o usuário pelo CPF
        $usuario = Usuario::where('cpf', $request->cpf)->first();

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        // Verificar se a senha fornecida corresponde à senha armazenada (hash)
        if (Hash::check($request->password, $usuario->password)) {
            return response()->json(['message' => 'Login bem-sucedido', 'usuario' => $usuario], 200);
        } else {
            return response()->json(['message' => 'Senha incorreta'], 401);
        }
    }
}


?>