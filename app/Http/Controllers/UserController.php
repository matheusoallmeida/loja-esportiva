<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $clientes = User::where('role', 'cliente')->get();

        return view('users.index', compact('clientes'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $cliente = User::findOrFail($id);

        return view('users.show', compact('cliente'));
    }

    public function edit(string $id)
    {
        $cliente = User::findOrFail($id);

        return view('users.edit', compact('cliente'));
    }

    public function update(Request $request, string $id)
    {
        $cliente = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:users,cpf,' . $cliente->id,
            'data_nascimento' => 'nullable|date',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . $cliente->id,
        ]);

        $cliente->update($request->only([
            'name',
            'cpf',
            'data_nascimento',
            'telefone',
            'email',
        ]));

        return redirect()->route('users.index')->with('success', 'Cliente atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        $cliente = User::findOrFail($id);
        $cliente->delete();

        return redirect()->route('users.index')->with('success', 'Cliente removido com sucesso.');
    }
}