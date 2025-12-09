<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function index()
    {
        $departemens = Departemen::with([
            'employees' => function ($query) {
                $query->where('status', 'aktif');
            }
        ])->withCount('employees')->get();

        return view('departemens.index', compact('departemens'));
    }

    public function create()
    {
        return view('departemens.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_departemen' => 'required']);
        Departemen::create($request->all());
        return redirect()->route('departemens.index')->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function show($id)
    {
        $departemen = Departemen::findOrFail($id);

        // Ambil pegawai aktif di departemen ini
        $activeEmployees = $departemen->employees()
            ->where('status', 'aktif')
            ->with('jabatan')
            ->get();
        $totalEmployees  = $departemen->employees()->count();
        return view('departemens.show', compact('departemen', 'activeEmployees', 'totalEmployees'));
    }

    public function edit(Departemen $departemen)
    {
        return view('departemens.edit', compact('departemen'));
    }

    public function update(Request $request, Departemen $departemen)
    {
        $request->validate(['nama_departemen' => 'required']);
        $departemen->update($request->all());
        return redirect()->route('departemens.index')->with('success', 'Departemen berhasil diupdate.');
    }

    public function destroy(Departemen $departemen)
    {
        $departemen->delete();
        return redirect()->route('departemens.index')->with('success', 'Departemen berhasil dihapus.');
    }
}

