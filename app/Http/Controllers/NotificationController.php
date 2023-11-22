<?php

namespace App\Http\Controllers;

use App\Models\Friendlist;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_notif = Notification::where('user_id', auth()->user()->id)->pluck('acceptor');
        return view('notif.index', [
            'title' => 'Notifikasi',
            'notif' => Notification::where('acceptor', auth()->user()->id)->orderBy('status')->orderBy('created_at', 'desc')->get(),
            'user_notif' => Notification::where('user_id', auth()->user()->id)->whereIn('acceptor', $user_notif)->orderBy('status')->orderBy('created_at', 'desc')->get()
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
    public function store(User $user, $frienID)
    {
        Notification::create([
            'user_id' => $user->id,
            'user_req' => $user->id,
            'acceptor' => $frienID,
            'status' => 1
        ]);

        return back()->with('success', 'Berhasil Meminta Pertemanan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        $status = '';
        if ($request->accept) {
            $status = $request->accept;
        } else {
            $status = $request->reject;
        }
        Notification::where('id', $notification->id)
            ->update([
                'status' => $status
            ]);

        if ($request->accept) {
            Friendlist::create([
                'user_id' => $notification->user_id,
                'notif_id' => $notification->id,
                'friend' => $notification->acceptor
            ]);
            Friendlist::create([
                'user_id' => $notification->acceptor,
                'notif_id' => $notification->id,
                'friend' => $notification->user_id
            ]);
            return redirect('notification')->with('success', 'Anda Sekarang Berteman Dengan ' . $notification->user->name);
        } else {
            return redirect('notification')->with('success', 'Anda Menolak Pertemanan ' . $notification->user->name);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
