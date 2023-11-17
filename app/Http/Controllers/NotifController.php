<?php

namespace App\Http\Controllers;

use App\Models\Friendlist;
use App\Models\User;
use Illuminate\Http\Request;

class NotifController extends Controller
{
    public function notif()
    {
        return view('notif.index', [
            'title' => 'Notifikasi',
            'notif' => Friendlist::where('acceptor', auth()->user()->id)->get()
        ]);
    }
}
