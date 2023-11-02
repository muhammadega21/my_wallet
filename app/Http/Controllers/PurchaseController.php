<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Rekening;
use App\Models\Wallet;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wallet.pembelian', [
            'title' => 'Pembelian',
            'wallet' => Wallet::find(auth()->user()->id),
            'rekening' => Rekening::where('user_id', auth()->user()->id)->get()
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
            'item_name' => 'required',
            'item_qty' => 'required|numeric',
            'item_price' => 'required|numeric',
        ], [
            'item_name.required' => 'Nama Barang Wajib Di Isi!',

            'item_qty.required' => 'Jumlah Barang/QTY Wajib Di Isi!',
            'item_qty.numeric' => 'Jumlah Barang/QTY Harus Berupa Angka!',

            'item_price.required' => 'Harga Barang Wajib Di Isi',
            'item_price.numeric' => 'Harga Barang Harus Berupa Angka',
        ]);

        $user = auth()->user();
        $wallet_get = Wallet::where('id', $request->input('wallet_id'));
        $rekening_get = Rekening::where('id', $request->input('rekening_id'));
        $wallet = Wallet::find($request->input('wallet_id'));
        $rekening = Rekening::find($request->input('rekening_id'));

        if ($request['wallet_id']) {
            if ($request->input('status') === 'money_in') {
                $wallet_get
                    ->update([
                        'money_total' => $wallet->money_total + $request->input('item_total')
                    ]);
            } else {
                $wallet_get
                    ->update([
                        'money_total' => $wallet->money_total - $request->input('item_total')
                    ]);
            }
        } else {
            if ($request->input('status') === 'money_in') {
                $rekening_get
                    ->update([
                        'money_total' => $rekening->money_total + $request->input('item_total')
                    ]);
            } else {
                $rekening_moneyTotal = $rekening->money_total - $request->input('item_total');
                $rekening_get
                    ->update([
                        'money_total' => $rekening_moneyTotal
                    ]);
            }
        }

        Purchase::create([
            'user_id' => $user->id,
            'wallet_id' => $request->input('wallet_id'),
            'rekening_id' => $request->input('rekening_id'),
            'item_name' => $request->input('item_name'),
            'item_qty' => $request->input('item_qty'),
            'item_price' => $request->input('item_price'),
            'item_total' => $request->input('item_total'),
            'money_in' => $request->input('status') === "money_in" ? $request->input('item_total') : '',
            'money_out' => $request->input('status') === "money_out" ? $request->input('item_total') : '',
            'desc' => $request['desc'],
        ]);

        return redirect('/pembelian')->with('success', 'Berhail Melakukan Pembelian');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $pembelian)
    {
        return view('wallet.editPembelian', [
            'title' => 'Edit Pembelian',
            'riwayat' => $pembelian
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $pembelian)
    {
        $request->validate([
            'item_name' => 'required',
            'item_qty' => 'required|numeric',
            'item_price' => 'required|numeric',
        ], [
            'item_name.required' => 'Nama Barang Wajib Di Isi!',

            'item_qty.required' => 'Jumlah Barang/QTY Wajib Di Isi!',
            'item_qty.numeric' => 'Jumlah Barang/QTY Harus Berupa Angka!',

            'item_price.required' => 'Harga Barang Wajib Di Isi',
            'item_price.numeric' => 'Harga Barang Harus Berupa Angka',
        ]);

        $wallet_get = Wallet::where('id', $request->input('wallet_id'));
        $rekening_get = Rekening::where('id', $request->input('rekening_id'));

        if ($pembelian->wallet_id) {
            if ($pembelian->money_in) {
                if ($request->input('status') == 'money_in') {
                    if ($pembelian->money_in !== $request->input('item_total')) {
                        $wallet_total = $pembelian->wallet->money_total;
                        $wallet_get
                            ->update([
                                'money_total' => $wallet_total - $pembelian->money_in + $request->input('item_total')
                            ]);
                    } else {
                        $wallet_total = $pembelian->wallet->money_total;
                        $wallet_get
                            ->update([
                                'money_total' => $wallet_total - $pembelian->money_in + $request->input('item_total')
                            ]);
                    }
                } else {
                    if ($pembelian->wallet->money_total <= $request->input('item_total')) {
                        return back()->with('error', 'Uang Anda Tidak Cukup!');
                    } else {
                        $wallet_total = $pembelian->wallet->money_total;
                        $wallet_get
                            ->update([
                                'money_total' => $wallet_total - $pembelian->money_in - $request->input('item_total')
                            ]);
                    }
                }
            } else {
                if ($request->input('status') == 'money_out') {
                    if ($pembelian->money_out !== $request->input('item_total')) {
                        if ($pembelian->wallet->money_total < $request->input('item_total')) {
                            return back()->with('error', 'Uang Anda Tidak Cukup!');
                        } else {
                            $wallet_total = $pembelian->wallet->money_total;
                            $wallet_get
                                ->update([
                                    'money_total' => $wallet_total + $pembelian->money_out - $request->input('item_total')
                                ]);
                        }
                    } else {
                        if ($pembelian->wallet->money_total < $request->input('item_total')) {
                            return back()->with('error', 'Uang Anda Tidak Cukup!');
                        } else {
                            $wallet_total = $pembelian->wallet->money_total;
                            $wallet_get
                                ->update([
                                    'money_total' => $wallet_total - $pembelian->money_out + $request->input('item_total')
                                ]);
                        }
                    }
                } else {
                    if ($pembelian->wallet->money_total <= $request->input('item_total')) {
                        return back()->with('error', 'Uang Anda Tidak Cukup!');
                    } else {
                        if ($pembelian->money_out !== $request->input('item_total')) {
                            $wallet_total = $pembelian->wallet->money_total;
                            $wallet_get
                                ->update([
                                    'money_total' => $wallet_total + $pembelian->money_out - $request->input('item_total')
                                ]);
                        } else {
                            $wallet_total = $pembelian->wallet->money_total;
                            $wallet_get
                                ->update([
                                    'money_total' => $wallet_total + $pembelian->money_out + $request->input('item_total')
                                ]);
                        }
                    }
                }
            }
        } else {
            if ($pembelian->money_in) {
                if ($request->input('status') == 'money_in') {
                    if ($pembelian->money_in !== $request->input('item_total')) {
                        $rekening_total = $pembelian->rekening->money_total;
                        $rekening_get
                            ->update([
                                'money_total' => $rekening_total - $pembelian->money_in + $request->input('item_total')
                            ]);
                    } else {
                        $rekening_total = $pembelian->rekening->money_total;
                        $rekening_get
                            ->update([
                                'money_total' => $rekening_total - $pembelian->money_in + $request->input('item_total')
                            ]);
                    }
                } else {
                    if ($pembelian->rekening->money_total <= $request->input('item_total')) {
                        return back()->with('error', 'Uang Anda Tidak Cukup!');
                    } else {
                        $rekening_total = $pembelian->rekening->money_total;
                        $rekening_get
                            ->update([
                                'money_total' => $rekening_total - $pembelian->money_in - $request->input('item_total')
                            ]);
                    }
                }
            } else {
                if ($request->input('status') == 'money_out') {
                    if ($pembelian->money_out !== $request->input('item_total')) {
                        if ($pembelian->rekening->money_total < $request->input('item_total')) {
                            return back()->with('error', 'Uang Anda Tidak Cukup!');
                        } else {
                            $rekening_total = $pembelian->rekening->money_total;
                            $rekening_get
                                ->update([
                                    'money_total' => $rekening_total + $pembelian->money_out - $request->input('item_total')
                                ]);
                        }
                    } else {
                        if ($pembelian->rekening->money_total < $request->input('item_total')) {
                            return back()->with('error', 'Uang Anda Tidak Cukup!');
                        } else {
                            $rekening_total = $pembelian->rekening->money_total;
                            $rekening_get
                                ->update([
                                    'money_total' => $rekening_total - $pembelian->money_out + $request->input('item_total')
                                ]);
                        }
                    }
                } else {
                    if ($pembelian->rekening->money_total <= $request->input('item_total')) {
                        return back()->with('error', 'Uang Anda Tidak Cukup!');
                    } else {
                        if ($pembelian->money_out !== $request->input('item_total')) {
                            $rekening_total = $pembelian->rekening->money_total;
                            $rekening_get
                                ->update([
                                    'money_total' => $rekening_total + $pembelian->money_out - $request->input('item_total')
                                ]);
                        } else {
                            $rekening_total = $pembelian->rekening->money_total;
                            $rekening_get
                                ->update([
                                    'money_total' => $rekening_total + $pembelian->money_out + $request->input('item_total')
                                ]);
                        }
                    }
                }
            }
        }

        Purchase::where('id', $pembelian->id)
            ->update([
                'item_name' => $request->input('item_name'),
                'item_price' => $request->input('item_price'),
                'item_qty' => $request->input('item_qty'),
                'item_total' => $request->input('item_total'),
                'money_in' => $request->input('status') === "money_in" ? $request->input('item_total') : '',
                'money_out' => $request->input('status') === "money_out" ? $request->input('item_total') : '',
                'desc' => $request->input('desc'),
            ]);

        return redirect('/riwayat')->with('success', 'Berhail Update Pembelian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
