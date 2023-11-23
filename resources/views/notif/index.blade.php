@extends('layouts.main')
@section('container')
    <div class="content">
        <div class="content-title">
            <h4>Notifikasi</h4>
        </div>
        <div class="content-body">
            <div class="friend_request">
                <div class="card-request">
                    @foreach ($notif as $notif)
                        <div class="request-wrapper">
                            <a href="{{ url('user/' . $notif->user->username) }}">
                                <div
                                    class="left border-solid border-r-[3px] {{ $notif->status == 1 ? 'border-slate-500 ' : ($notif->status == 2 ? 'border-green-500' : 'border-red-500') }}">
                                    <div class="user_req">
                                        <div class="img">
                                            @if ($notif->user->img == 'user.png')
                                                <img src="{{ url('img/' . $notif->user->img) }}" alt="image">
                                            @else
                                                <img src="{{ url(asset('storage/' . $notif->user->img)) }}" alt="image">
                                            @endif
                                        </div>
                                        <div class="flex flex-col leading-5">
                                            <h4>{{ $notif->user->name }}</h4>
                                            <p><span class="font-bold">Note : </span>Meminta Pertemanan Kepada Anda</p>
                                        </div>

                                    </div>
                                    <div class="request_action">
                                        <div class="btn flex gap-1">
                                            <form action="{{ url('notification/' . $notif->id) }}" method="POST">
                                                @csrf
                                                @method('put')
                                                @if ($notif->status == 1)
                                                    <button class="bg-blue-500 confirm" name="accept"
                                                        value="2">Terima<i class="bx bx-check"></i></button>
                                                    <button class="bg-red-500 confirm" name="reject" value="3">Tolak<i
                                                            class="bx bx-x top-[1px]"></i></button>
                                                @else
                                                    @if ($notif->status == 2)
                                                        <button type="button" class="bg-green-500 confirm">Berteman<i
                                                                class="bx bx-check"></i></button>
                                                    @else
                                                        <button type="button" class="bg-red-500 confirm">Ditolak<i
                                                                class="bx bx-x"></i></button>
                                                    @endif
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <span class="date">{{ $notif->created_at->subMinute(0)->diffForHumans() }}</span>
                        </div>
                    @endforeach

                    @foreach ($user_notif as $user_notif)
                        @php
                            // Ambil pengguna berdasarkan nilai acceptor
                            $acceptorUser = \App\Models\User::find($user_notif->acceptor);
                        @endphp
                        <div class="request-wrapper">
                            <a href="{{ url('user/' . $acceptorUser->username) }}">
                                <div
                                    class="left border-solid border-r-[3px] {{ $user_notif->status == 1 ? 'border-slate-500 ' : ($user_notif->status == 2 ? 'border-green-500' : 'border-red-500') }}">
                                    <div class="user_req">
                                        <div class="img">
                                            @if ($acceptorUser->img == 'user.png')
                                                <img src="{{ url('img/' . $acceptorUser->img) }}" alt="image">
                                            @else
                                                <img src="{{ url(asset('storage/' . $acceptorUser->img)) }}"
                                                    alt="image">
                                            @endif
                                        </div>
                                        <div class="flex flex-col leading-5">
                                            <h4>{{ $acceptorUser->name }}</h4>
                                            <p><span class="font-bold">Note : </span>Meminta Pertemanan Kepada
                                                {{ $acceptorUser->name }}</p>
                                        </div>

                                    </div>
                                    <div class="request_action">
                                        <div class="btn flex gap-1">
                                            <form action="" method="POST">
                                                @csrf
                                                @method('put')
                                                @if ($user_notif->status == 1)
                                                    <button type="button" class="bg-orange-500 confirm">Menunggu</button>
                                                @elseif ($user_notif->status == 2)
                                                    <button type="button" class="bg-green-500 confirm">Berteman<i
                                                            class="bx bx-check"></i></button>
                                                @else
                                                    <button type="button" class="bg-red-500 confirm">Ditolak<i
                                                            class="bx bx-x"></i></button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <span class="date">{{ $user_notif->created_at->subMinute(0)->diffForHumans() }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
