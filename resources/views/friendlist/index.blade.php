@extends('layouts.main')
@section('container')
    <div class="content">
        <div class="content-title flex justify-between ">
            <h4>Daftar Teman</h4>
            <div class="btn">
                <button class="bg-blue-500 addFriend-btn">Tambah</button>
            </div>
        </div>
        <div class="content-body">
            <div class="friendlist-wrapper overflow-x-auto xl:overflow-visible">
                <div class="friendlist">
                    <div class="top">
                        <span>ID</span>
                        <span>Nama</span>
                        <span>Email</span>
                        <span>No Telp</span>
                        <span>Status</span>
                        <span>Action</span>
                    </div>
                    <div class="bottom ">
                        @foreach ($friendlist as $friendlist)
                            @php
                                $friend = \App\Models\User::find($friendlist->friend);
                            @endphp
                            <a href="{{ url('user/' . $friend->username) }}" class="friendlist-card">
                                <span class="font-bold">#{{ $friend->id_user }}</span>
                                <div class="flex items-center gap-2">
                                    <div class="img">
                                        @if ($friend->img == 'user.png')
                                            <img src="{{ url('img/' . $friend->img) }}" alt="image">
                                        @else
                                            <img src="{{ url(asset('storage/' . $friend->img)) }}" alt="image">
                                        @endif
                                    </div>
                                    {{ $friend->name }}
                                </div>
                                <span>{{ $friend->email }}</span>
                                <span>{{ $friend->phone }}</span>
                                @if ($friend->is_online >= now()->subMinutes(2) || $friendlist->user->is_online >= now()->subMinutes(2))
                                    <span class="status online"><i class="bx bxs-circle"></i>Online</span>
                                @else
                                    <span class="status offline"><i class="bx bxs-circle"></i>Online</span>
                                @endif
                                <div class="flex items-center gap-1">
                                    <form action="{{ url('friendlist/' . $friendlist->id . '/' . $friendlist->notif_id) }}">
                                        <div class="btn">
                                            <button id="delete" class="bg-red-500 !p-0 !px-1.5"><i
                                                    class="bx bxs-user-x text-xl"></i></button>
                                        </div>
                                    </form>

                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Friend Popup --}}
    <div class="addFriend-popup !p-0 top-5 w-[80%] lg:w-auto">
        <div class="form-input !shadow-none">
            <div class="title">
                <h4>Tambah Teman</h4>
            </div>
            <form action="">
                <div class="form-input p-0 bg-none shadow-none">
                    <div class="form-group flex flex-col lg:flex-row items-center gap-1">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="input-box">
                            <input id="friendUsername" class="username" type="text" name="username"
                                placeholder="Username">
                        </div>
                        <div class="input-box">
                            <input id="friendID" class="id_user" type="text" name="id_user" placeholder="#ID">
                        </div>
                    </div>
                </div>
                <div class="userList w-full my-4">
                    <div class="list-wrapper friendList">
                    </div>
                </div>
                <div class="btn flex justify-end">
                    <button type="button" class="close bg-red-500">Batal</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Add Friend Popup --}}
@endsection
