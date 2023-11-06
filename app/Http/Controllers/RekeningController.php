<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('wallet.rekening', [
            'title' => 'Rekening',
            'rekening' => Rekening::where('user_id', auth()->user()->id)->get()->sortBy('created_at')
        ]);
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
        $request->validate([
            'bank' => 'required|max:15',
            'number' => 'required|numeric',
            'money_total' => 'nullable|numeric',
        ], [
            'bank.required' => 'Nama Rekening Wajib Diisi!',
            'bank.max' => 'Nama Rekening Tidak Lebih 15 Karakter',

            'number.required' => 'Nomor Rekening Wajib Diisi!',
            'number.numeric' => 'Nomor Rekening Harus Berupa Angka!',

            'money_total.numeric' => 'Saldo Harus Berupa Angka!',
        ]);

        Rekening::create([
            'user_id' => auth()->user()->id,
            'bank' => $request->input('bank'),
            'number' => $request->input('number'),
            'money_total' => $request->input('money_total') ? $request->input('money_total') : 0
        ]);

        return redirect('/rekening')->with('success', 'Berhasil Menambah Rekening!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rekening $rekening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rekening $rekening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rekening $rekening)
    {
        $request->validate([
            'bank' => 'required|max:15',
            'number' => 'required|numeric',
            'money_total' => 'nullable|numeric',
        ], [
            'bank.required' => 'Nama Rekening Wajib Diisi!',
            'bank.max' => 'Nama Rekening Tidak Lebih 15 Karakter',

            'number.required' => 'Nomor Rekening Wajib Diisi!',
            'number.numeric' => 'Nomor Rekening Harus Berupa Angka!',

            'money_total.numeric' => 'Saldo Harus Berupa Angka!',
        ]);

        Rekening::where('id', $request->input('id'))
            ->update([
                'bank' => $request->input('bank'),
                'number' => $request->input('number'),
                'money_total' => $request->input('money_total')
            ]);

        return redirect('/rekening')->with('success', 'Berhasil Menambah Rekening!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rekening $rekening)
    {
        Rekening::destroy($rekening->id);
        return redirect('rekening')->with('success', 'Berhasil Menghapus Rekening');
    }
}
