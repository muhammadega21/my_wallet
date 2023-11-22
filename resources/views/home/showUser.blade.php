@extends('layouts.main')
@section('container')
    <div class="content">
        <div class="content-title">
            <h1>User</h1>
        </div>
        <div class="content-body">
            <div class="profileWrapper grid-cols-1 md:grid-cols-[minmax(255px,_auto)_11fr]">
                <div class="profileLeft">
                    <div class="profileImage">
                        <div class="img">
                            @if ($user->img)
                                @if ($user->img == 'user.png')
                                    <img src="{{ url('img/' . $user->img) }}" class="img-preview" alt="image">
                                @else
                                    <img src="{{ url(asset('storage/' . $user->img)) }}" class="img-preview" alt="image">
                                @endif
                            @else
                                <img class="img-preview">
                            @endif
                        </div>
                    </div>
                    <div class="profileInfo">
                        <div class="personal">
                            <h4>Info Profile</h4>
                            <table class="profile text-left">
                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td><span class="status "><i class="bx bxs-circle"></i>Online</span></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>No Hp</th>
                                    <td>:</td>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="wallet">
                            <h4>Info Keuangan</h4>
                            <table class="profile inline">
                                <tr>
                                    <th>Wallet</th>
                                    <td class="px-2">:</td>
                                    <td
                                        class="saldo {{ $user_friendlist ? ($user_friendlist->status == 2 ? '' : 'hiddenText') : '' }}">
                                        {{ $user_friendlist ? ($user_friendlist->status == 2 ? $wallet : '0') : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Rekening</th>
                                    <td class="px-2">:</td>
                                    <td
                                        class="saldo {{ $user_friendlist ? ($user_friendlist->status == 2 ? '' : 'hiddenText') : '' }}">
                                        {{ $user_friendlist ? ($user_friendlist->status == 2 ? $rekeningTotal : '0') : '' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="btn flex justify-end gap-1">
                        @if ($user_friendlist)
                            @if ($user_friendlist->status == 1)
                                <form action="{{ url('notification/' . $user_friendlist->id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    @if ($user_friendlist->status == 1)
                                        <button class="bg-blue-500 confirm" name="accept" value="2">Terima<i
                                                class="bx bx-check"></i></button>
                                        <button class="bg-red-500 confirm" name="reject" value="3">Tolak<i
                                                class="bx bx-x top-[1px]"></i></button>
                                    @endif
                                </form>
                            @elseif($user_friendlist->status == 2)
                                <button type="button" class="bg-green-500">Berteman</button>
                            @else
                                <form action="{{ url('notification/' . auth()->user()->id . '/' . $user->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('post')
                                    <button class="bg-blue-500">Tambah Teman</button>
                                </form>
                            @endif
                        @else
                            <form action="{{ url('notification/' . auth()->user()->id . '/' . $user->id) }}"
                                method="POST">
                                @csrf
                                @method('post')
                                @if ($user_req)
                                    @if ($user_req->status == 1)
                                        <button type="button" class="bg-orange-500">Menunggu</button>
                                    @elseif ($user_req->status == 2)
                                        <button type="button" class="bg-green-500">Berteman</button>
                                    @else
                                        <button class="bg-blue-500">Tambah Teman</button>
                                    @endif
                                @else
                                    <button class="bg-blue-500">Tambah Teman</button>
                                @endif
                            </form>
                        @endif
                    </div>
                </div>
                <div class="profileRight">
                    @if ($user_friendlist)
                        @if ($user_friendlist->status == 2)
                            <div class="rekening">
                                <div class="cards">
                                    <a href="#" class="card">
                                        <div class="card-body">
                                            <div class="body-top">
                                                <h4>Dompet </h4>
                                            </div>
                                            <div class="body-bottom">
                                                <h2 class="saldo">{{ $wallet }}</h2>
                                                <div class="flex text-[12px]">
                                                    <p>{{ now()->translatedFormat('F') }}, {{ date('Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-icon">
                                            <i class="bx bxs-wallet"></i>
                                        </div>
                                    </a>
                                    @foreach ($rekening as $rekening)
                                        <a href="#" class="card">
                                            <p class="hidden rekening_id">{{ $rekening->id }}</p>
                                            <div class="card-body w-full">
                                                <div class="body-top">
                                                    <h2 class="text-base text-green-600 rekening_name">
                                                        {{ $rekening->bank }}
                                                    </h2>
                                                </div>
                                                <div class="body-bottom">
                                                    <h2 class="saldo">{{ $rekening->money_total }}</h2>
                                                    <div class="flex justify-between text-[12px]">
                                                        <p class="my-auto !opacity-60">No.Rekening : <span
                                                                class="rekening_number !font-bold !opacity-100">{{ $rekening->number }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-icon">
                                                <i class='bx bxs-dollar-circle'></i>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="bottom-content flex-col xl:flex-row">
                                <div class="table-wrapper w-full">
                                    <div class="title">Riwayat Pembelian</div>
                                    <div class="table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Barang</th>
                                                    <th>QTY</th>
                                                    <th>Jumlah Harga</th>
                                                    <th>Jenis</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayat as $riwayat)
                                                    <tr>
                                                        <th>{{ $loop->iteration }}</th>
                                                        <td>{{ $riwayat->item_name }}</td>
                                                        <td>{{ $riwayat->item_qty }}</td>
                                                        <td class="saldo">{{ $riwayat->item_total }}</td>
                                                        <td class="{{ $riwayat->money_out ? 'text-red-500' : '' }}">
                                                            {{ $riwayat->money_in ? 'Uang Masuk' : 'Uang Keluar' }}</td>
                                                        <td>{{ $riwayat->created_at->translatedFormat('d F, Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @elseif($user_friendlist->status == 1 || $user_friendlist->status == 3)
                            <span class="hiddenText">Anda Harus Berteman Untuk Melihat Informasi Detailnya</span>
                        @endif
                    @elseif ($user_req)
                        @if ($user_req->status == 2)
                            <div class="rekening">
                                <div class="cards">
                                    <a href="#" class="card">
                                        <div class="card-body">
                                            <div class="body-top">
                                                <h4>Dompet </h4>
                                            </div>
                                            <div class="body-bottom">
                                                <h2 class="saldo">{{ $wallet }}</h2>
                                                <div class="flex text-[12px]">
                                                    <p>{{ now()->translatedFormat('F') }}, {{ date('Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-icon">
                                            <i class="bx bxs-wallet"></i>
                                        </div>
                                    </a>
                                    @foreach ($rekening as $rekening)
                                        <a href="#" class="card">
                                            <p class="hidden rekening_id">{{ $rekening->id }}</p>
                                            <div class="card-body w-full">
                                                <div class="body-top">
                                                    <h2 class="text-base text-green-600 rekening_name">
                                                        {{ $rekening->bank }}
                                                    </h2>
                                                </div>
                                                <div class="body-bottom">
                                                    <h2 class="saldo">{{ $rekening->money_total }}</h2>
                                                    <div class="flex justify-between text-[12px]">
                                                        <p class="my-auto !opacity-60">No.Rekening : <span
                                                                class="rekening_number !font-bold !opacity-100">{{ $rekening->number }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-icon">
                                                <i class='bx bxs-dollar-circle'></i>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="bottom-content flex-col xl:flex-row">
                                <div class="table-wrapper w-full">
                                    <div class="title">Riwayat Pembelian</div>
                                    <div class="table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Barang</th>
                                                    <th>QTY</th>
                                                    <th>Jumlah Harga</th>
                                                    <th>Jenis</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayat as $riwayat)
                                                    <tr>
                                                        <th>{{ $loop->iteration }}</th>
                                                        <td>{{ $riwayat->item_name }}</td>
                                                        <td>{{ $riwayat->item_qty }}</td>
                                                        <td class="saldo">{{ $riwayat->item_total }}</td>
                                                        <td class="{{ $riwayat->money_out ? 'text-red-500' : '' }}">
                                                            {{ $riwayat->money_in ? 'Uang Masuk' : 'Uang Keluar' }}</td>
                                                        <td>{{ $riwayat->created_at->translatedFormat('d F, Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @elseif($user_req->status == 1 || $user_req->status == 3)
                            <span class="hiddenText">Anda Harus Berteman Untuk Melihat Informasi Detailnya</span>
                        @endif
                    @else
                        <span class="hiddenText">Anda Harus Berteman Untuk Melihat Informasi Detailnya</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
