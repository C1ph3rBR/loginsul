<?php

// app/Http/Controllers/UsuarioController.php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Listar todos os usuários
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    // Criar um novo usuário
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'cpf' => 'required|string|unique:Usuarios,cpf',
            'ativo' => 'required|boolean',
            'status_usr' => 'required|integer',
            'superior' => 'nullable|integer',
            'matricula' => 'required|string|max:255',
        ]);

        $usuario = Usuario::create([
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
            'cpf' => $validated['cpf'],
            'ativo' => $validated['ativo'],
            'status_usr' => $validated['status_usr'],
            'superior' => $validated['superior'],
            'matricula' => $validated['matricula'],
        ]);

        return response()->json($usuario, 201);
    }

    // Mostrar um usuário específico
    public function show($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado para mostrar'], 404);
        }

        return response()->json($usuario);
    }

    // Atualizar um usuário
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado para atualizar'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'cpf' => 'required|string|unique:Usuarios,cpf,' . $id,
            'ativo' => 'required|boolean',
            'status_usr' => 'required|integer',
            'superior' => 'nullable|integer',
            'matricula' => 'required|string|max:255',
        ]);

        $usuario->update([
            'name' => $validated['name'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $usuario->password,
            'cpf' => $validated['cpf'],
            'ativo' => $validated['ativo'],
            'status_usr' => $validated['status_usr'],
            'superior' => $validated['superior'],
            'matricula' => $validated['matricula'],
        ]);

        return response()->json($usuario);
    }

    // Deletar um usuário
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado para apagar'], 404);
        }

        $usuario->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso']);
    }

    public function checkMatriculaAndPassword(Request $request)
    {
        // Valida os dados da requisição
        $validated = $request->validate([
            'matricula' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        // Verifica se o usuário existe pela matrícula
        $usuario = Usuario::where('matricula', $validated['matricula'])->first();

        if (!$usuario) {
            return response()->json(['message' => 'Matrícula não encontrada'], 404);
        }

        // Verifica se a senha informada corresponde à senha armazenada (sem hash)
        if ($validated['password'] !== $usuario->password) {
            return response()->json(['message' => 'Senha incorreta'], 401);
        }

        return response()->json(['message' => 'Matrícula e senha corretas'], 200);
    }


}


?>