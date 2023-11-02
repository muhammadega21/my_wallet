<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
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
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wallet $wallet)
    {
        $request->validate([
            'money_total' => 'required|numeric'
        ], [
            'money_total.required' => 'Jumlah Uang Wajib Diisi!',
            'money_total.numeric' => 'Jumlah Uang Harus Berupa Angka!'
        ]);

        Wallet::where('id', $wallet->id)
            ->update([
                'money_total' => $request->input('money_total')
            ]);
        return redirect('/dashboard')->with('success', 'Berhasil Update Jumlah Uang Dompet');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
