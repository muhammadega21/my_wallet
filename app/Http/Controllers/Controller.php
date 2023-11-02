<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Rekening;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $wallet = Wallet::where('user_id', auth()->user()->id);
        $rekening = Rekening::where('user_id', auth()->user()->id);
        $pengeluaran = Purchase::where('user_id', auth()->user()->id);


        return view('home.index', [
            'title' => 'Dashboard',
            'money_total' => $wallet->sum('money_total') + $rekening->sum('money_total'),
            'wallet' => $wallet->sum('money_total'),
            'my_wallet' => Wallet::find(auth()->user()->id),
            'rekening' => $rekening->sum('money_total'),
            'riwayat' => Purchase::where('user_id', auth()->user()->id)->get(),
            'pengeluaran' => $pengeluaran->sum('money_out')
        ]);
    }
    public function riwayat()
    {
        return view('wallet.riwayat', [
            'title' => 'Riwayat Pembelian',
            'riwayat' => Purchase::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function walletApi()
    {
        $money_out = [];
        $money_in = [];
        for ($month = 1; $month <= 12; $month++) {
            // money out
            $totalMoneyOut = Purchase::where('user_id', auth()->user()->id)
                ->whereMonth('created_at', $month)
                ->sum('money_in');

            // money in
            $totalMoneyIn = Purchase::where('user_id', auth()->user()->id)
                ->whereMonth('created_at', $month)
                ->sum('money_out');

            $money_out[] = [
                $totalMoneyOut
            ];
            $money_in[] = [
                $totalMoneyIn
            ];
        }
        return response()->json(['money_out' => $money_out, 'money_in' => $money_in]);
    }
}
