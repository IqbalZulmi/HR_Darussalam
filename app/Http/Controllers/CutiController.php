<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function showVerifikasiCutiPage(){
        return view('admin.kelola-verifikasi-cuti',[

        ]);
    }

    public function showPengajuanCutiPage(){
        return view('pegawai.pengajuan-cuti',[
            
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(cuti $cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cuti $cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cuti $cuti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cuti $cuti)
    {
        //
    }
}
