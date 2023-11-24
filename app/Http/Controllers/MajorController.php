<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $majors = Major::all();
        return view('pages.majors.index', compact('majors'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMajorRequest $request)
    {
        //
        $request->validate([
            'kode_jurusan' => 'required|unique:majors',
            'jurusan' => 'required',
        ]);

        Major::create([
            'kode_jurusan' => $request->kode_jurusan,
            'jurusan' => $request->jurusan,
        ]);

        $majors = Major::all();
        $success = 'Jurusan berhasil ditambahkan.';
        return view('pages.majors.index', compact('majors', 'success'));
        // return redirect()->route('majors.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMajorRequest $request, $kode_jurusan)
    {
        //
        $request->validate([
            'jurusan' => 'required',
        ]);

        $major = Major::findOrFail($kode_jurusan);
        $major->update([
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kode_jurusan)
    {
        //
        Major::findOrFail($kode_jurusan)->delete();
        $majors = Major::all();
        $success = 'Jurusan berhasil dihapus.';
        return view('pages.majors.index', compact('majors', 'success'));
        // return redirect()->route('majors.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}
