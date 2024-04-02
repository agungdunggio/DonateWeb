<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index', [
            'charities' => Charity::latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'daerah' => 'required|max:100',
            'max_dana' => 'required|numeric',
            'exp_date' => 'required|date',
            'foto' => 'required|image|file|max:2024',
            'cerita' => 'required',
        ]);

        $validatedData['foto'] = $request->file('foto')->store('charity-images');
        $validatedData['dana_terkumpul'] = 0;

        Charity::create($validatedData);

        return redirect('/dashboard')->with('success', 'Charity Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Charity  $charity
     * @return \Illuminate\Http\Response
     */
    public function show(Charity $dashboard)
    {
        return view('dashboard.read', [
            'charity' => $dashboard,
            'donaturs' => Donatur::where('charity_id', $dashboard->id)->latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Charity  $charity
     * @return \Illuminate\Http\Response
     */
    public function edit(Charity $dashboard)
    {
        return view('dashboard.edit', [
            'charity' => $dashboard
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Charity  $charity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Charity $dashboard)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'daerah' => 'required|max:100',
            'max_dana' => 'required|numeric',
            'exp_date' => 'required|date',
            'foto' => 'image|file|max:2024',
            'cerita' => 'required',
        ]);

        if ($request->file('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['foto'] = $request->file('foto')->store('charity-images');
        }


        Charity::where('id', $dashboard->id)->update($validatedData);

        return redirect('/dashboard')->with('success', 'Charity Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Charity  $charity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Charity $dashboard)
    {
        if ($dashboard->foto) {
            Storage::delete($dashboard->foto);
        }

        Charity::destroy($dashboard->id);

        return redirect('/dashboard')->with('success', 'Data Berhasil Dihapus!');
    }
}
