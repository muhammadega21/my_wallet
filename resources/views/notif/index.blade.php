@extends('layouts.main')
@section('container')
    <div class="content">
        <div class="content-title">
            <h4>Notifikasi</h4>
        </div>
        <div class="content-body">
            <div class="friend-request">
                <div class="card-request">
                    @foreach ($notif as $notif)
                        <a href="{{ url('user/' . $notif->user->username) }}">
                            <span>{{ $loop->iteration }}</span>
                            <div class="img">
                                @if ($notif->user->img == 'user.png')
                                    <img src="{{ url('img/' . $notif->user->img) }}" alt="image">
                                @else
                                    <img src="{{ url(asset('storage/' . $notif->user->img)) }}" alt="image">
                                @endif
                            </div>
                            <div class="user_req">
                                <h4>{{ $notif->user->name }}</h4>
                                <span>{{ $notif->created_at->subMinute(0)->diffForHumans() }}</span>
                            </div>
                            <div class="user_message">
                                <span>Meminta Pertemanan Kepada Anda</span>
                            </div>
                            <div class="request_action">
                                <div class="btn flex gap-1">
                                    <form action="">
                                        <button class="bg-blue-500 confirm">Terima<i class="bx bx-check"></i></button>
                                    </form>
                                    <form action="">
                                        <button class="bg-red-500 confirm">Tolak<i class="bx bx-x top-[1px]"></i></button>
                                    </form>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
