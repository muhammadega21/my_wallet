<?php

namespace App\Http\Controllers;

use App\Models\Friendlist;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class FriendlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('friendlist.index', [
            'title' => "Daftar Teman",
            'friendlist' => Friendlist::where('user_id', auth()->user()->id)->get()
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Friendlist $friendlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Friendlist $friendlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Friendlist $friendlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Friendlist $friendlist, Notification $notif)
    {
        $nextFriend = $friendlist->id - 1;

        Friendlist::destroy($friendlist->id);
        Friendlist::destroy($nextFriend);
        Notification::destroy($notif->id);

        return redirect('friendlist')->with('success', 'Berhasil Menghapus Pertemanan');
    }
}
