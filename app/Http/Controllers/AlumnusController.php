<?php

namespace App\Http\Controllers;

use App\Models\Alumnus;
use App\Http\Requests\StoreAlumnusRequest;
use App\Http\Requests\UpdateAlumnusRequest;
use App\Models\Major;

class AlumnusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request(['search']);


        $alumni = Alumnus::orderBy('updated_at', 'desc')->search($search)->get();

        return view('pages.alumni.index', compact('alumni'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $majors = Major::all();
        return view('pages.alumni.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlumnusRequest $request)
    {
        //
        $request->validate([
            'nim' => 'required|unique:alumni,nim',
            'nama' => 'required',
            'jurusan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat_lengkap' => 'required',
            'pekerjaan' => 'required',
            'ipk' => 'required|numeric',
        ]);

        Alumnus::create($request->all());
        return redirect()->route('alumni.index')->with('success', 'Alumnus created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nim)
    {
        //
        $alumnus = Alumnus::findOrFail($nim);
        $majors = Major::all();
        return view('pages.alumni.edit', compact('alumnus', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlumnusRequest $request, $nim)
    {
        //
        $request->validate([
            'jurusan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat_lengkap' => 'required',
            'pekerjaan' => 'required',
            'ipk' => 'required|numeric',
        ]);

        $alumnus = Alumnus::findOrFail($nim);
        $alumnus->update($request->all());

        return redirect()->route('alumni.index')->with('success', 'Alumni updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nim)
    {
        //
        $alumnus = Alumnus::findOrFail($nim);
        $alumnus->delete();

        return redirect()->route('alumni.index')->with('success', 'Alumni deleted successfully');
    }
}
