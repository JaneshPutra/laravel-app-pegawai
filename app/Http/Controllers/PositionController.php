<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        return view('jabatan.index', compact('positions'));
    }

    public function create()
    {
        return view('jabatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required|numeric'
        ]);
        Position::create($request->all());
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function show(Position $position)
    {
        return view('jabatan.show', compact('position'));
    }

    public function edit(Position $position)
    {
        return view('jabatan.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required|numeric'
        ]);
        $position->update($request->all());
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diupdate.');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}

