<?php

namespace App\Http\Controllers;

use App\Models\Friendlist;
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
            'title' => "Daftar Teman"
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
        Friendlist::create([
            'user_id' => $user->id,
            'user_req' => $user->id,
            'acceptor' => $frienID,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Berhasil Meminta Pertemanan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Friendlist $friendlist)
    {
        return $friendlist;
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
    public function destroy(Friendlist $friendlist)
    {
        //
    }
}
