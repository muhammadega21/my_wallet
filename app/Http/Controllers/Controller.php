<?php

namespace App\Http\Controllers;

use App\Models\Friendlist;
use App\Models\Notification;
use App\Models\Purchase;
use App\Models\Rekening;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

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
            'riwayat' => Purchase::where('user_id', auth()->user()->id)->get()->take(10),
            'pengeluaran' => $pengeluaran->sum('money_out'),
            'friendlist' => Friendlist::where('user_id', auth()->user()->id)->get()->take(5)
        ]);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $username = $request->input('username');
            $id_user = $request->input('id_user');

            $data = User::where('username', $username)->where('id_user', $id_user)->get();
            if (count($data) > 0) {
                if ($username == auth()->user()->username && $id_user == auth()->user()->id_user) {
                    $output = '<span class="notfound">Username dan ID User Yang Anda Masukkan Salah!</span>';
                } else {
                    foreach ($data as $user) {
                        $output .= '<a id="addFriend-list" href="' . url('user/' . $user->username) . '" class="list">
                                    <div class="img">';

                        if ($user->img == "user.png") {
                            $output .= '<img src="' . url("img/" . $user->img) . '" alt="image">';
                        } else {
                            $output .= '<img src="' . url(asset("storage/" . $user->img)) . '" alt="image">';
                        }

                        $output .= '</div>
                                    <div class="userProfile">
                                        <h4>' . $user->name . '</h4>';
                        if ($user->is_online >= now()->subMinutes(2)) {
                            $output .= '<span class="online"><i class="bx bxs-circle"></i>Online</span>';
                        } else {
                            $output .= '<span class="offline"><i class="bx bxs-circle"></i>Offline</span>';
                        }
                        $output .= '</div>
                                </a>';
                    }
                }
            } else {
                $output = '<span class="notfound">Sedang Mencari...</span>';
            }
            return response($output);
        }
    }

    public function riwayat()
    {
        Paginator::defaultView('paginator');
        return view('wallet.riwayat', [
            'title' => 'Riwayat Pembelian',
            'riwayats' => Purchase::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(20)
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
                ->sum('money_out');

            // money in
            $totalMoneyIn = Purchase::where('user_id', auth()->user()->id)
                ->whereMonth('created_at', $month)
                ->sum('money_in');

            $money_out[] = [
                $totalMoneyOut
            ];
            $money_in[] = [
                $totalMoneyIn
            ];
        }
        return response()->json(['money_out' => $money_out, 'money_in' => $money_in]);
    }

    public function profile()
    {
        return view('profile.index', [
            'title' => 'Profile',
            // 'user' => User::where('id', auth()->user()->id)->first(),
            'user' => User::find(auth()->user()->id),
            'wallet' => Wallet::where('user_id', auth()->user()->id)->value('money_total'),
            'rekening' => Rekening::where('user_id', auth()->user()->id)->sum('money_total')
        ]);
    }

    public function profileUpdate(Request $request, User $user)
    {
        $validatedData = $request->validate(
            [
                'img' => 'image|file|max:5120'
            ],
            [

                'img.image' => 'File Harus Berupa Gambar!',
                'img.max' => 'Size Gambar Tidak Boleh Lebih Dari 5mb!'
            ]
        );

        if ($user->img == 'user.png') {

            if ($request->file('img')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $image = $validatedData['img'] = $request->file('img')->store('images');
            } else {
                $image = 'user.png';
            }
        } else {
            if ($request->file('img')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $image = $validatedData['image'] = $request->file('img')->store('images');
            } else {
                $image = $user->img;
            }
        }

        User::where('id', $user->id)
            ->update([
                'img' => $image
            ]);

        return redirect('/profile')->with('success', 'Berhasil Update Profile');
    }

    public function userUpdate(Request $request, User $user)
    {
        $validasi = [];
        if ($request->username != $user->username) {
            $validasi['username'] = 'required|max:30|unique:users,username';
        }
        if ($request->email != $user->email) {
            $validasi['email'] = 'required|email|unique:users,email';
        }

        $request->validate(
            $validasi,
            [
                'username.required' => 'Username Tidak Boleh Kosong!',
                'username.unique' => 'Username Sudah Ada!',
                'username.max' => 'Max 30 Character!',

                'email.required' => 'Email Tidak Boleh Kosong!',
                'email.email' => 'Email Harus Berupa Email Yang Benar!',
                'email.unique' => 'Email Sudah Ada!',
            ]
        );

        User::where('id', $user->id)
            ->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ]);

        return redirect('profile')->with('success', 'Berhasil Update Profile');
    }

    public function showUser(User $user)
    {
        $user_req = Notification::where('user_id', auth()->user()->id)->where('acceptor', $user->id)->latest('created_at')->first();
        $user_friendlist = Notification::where('acceptor', auth()->user()->id)->where('user_id', $user->id)->latest('created_at')->first();

        Paginator::defaultView('paginator');

        return view('home.showUser', [
            'title' => 'User',
            'user' => $user,
            'user_req' => $user_req,
            'user_friendlist' => $user_friendlist,
            'rekening' => Rekening::where('user_id', $user->id)->get()->sortBy('created_at'),
            'wallet' => Wallet::where('user_id', $user->id)->sum('money_total'),
            'rekeningTotal' => Rekening::where('user_id', $user->id)->sum('money_total'),
            'riwayats' => Purchase::where('user_id', $user->id)->paginate(6),
        ]);
    }
}
