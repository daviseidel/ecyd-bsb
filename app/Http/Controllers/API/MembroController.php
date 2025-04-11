<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Membro;

class MembroController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|size:11|unique:membros',
            'celular' => 'required|string|max:15',
            'restricao_alimentar' => 'nullable|string',
            'etapa_ecyd' => 'required|string',
            'idade' => 'required|integer|min:0'
        ]);

        $validated['user_id'] = auth()->id();

        $membro = Membro::create($validated);

        return response()->json($membro, 201);
    }
}
