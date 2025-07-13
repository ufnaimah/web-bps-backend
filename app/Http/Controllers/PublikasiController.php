<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function index()
    {
        return Publikasi::all();
    }

    public function show($id)
    {
        return Publikasi::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'releaseDate' => 'required|date',
        'description' => 'nullable|string',
        'coverUrl' => 'nullable|url',
    ]);

    $publikasi = Publikasi::create($validated);
        return response()->json($publikasi, 201);
    }

    public function update(Request $request, $id)
    {
        $publikasi = Publikasi::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'releaseDate' => 'required|date',
            'coverUrl' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        $publikasi->update($data);
        return response()->json($publikasi);
    }

    public function destroy($id)
    {
        $publikasi = Publikasi::findOrFail($id);
        $publikasi->delete();

        return response()->json(['message' => 'Dihapus']);
    }
    public function me()
    {
        try {
            return response()->json(Publikasi::all());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
