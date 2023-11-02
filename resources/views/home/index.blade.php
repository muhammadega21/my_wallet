@extends('layouts.main')
@section('container')
    <div class="content">
        <div class="content-title">
            <h1>Dashboard</h1>
        </div>
        <div class="content-body">
            <div class="top-content flex-col xl:flex-row">
                <div class="cards">
                    <a href="#" class="card">
                        <div class="card-body">
                            <div class="body-top">
                                <h4>Total Uang </h4>
                            </div>
                            <div class="body-bottom">
                                <h2 class="saldo">{{ $money_total }}</h2>
                                <div class="flex text-[12px]">
                                    <p>{{ now()->translatedFormat('F') }}, {{ date('Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-icon">
                            <i class="bx bxs-dollar-circle"></i>
                        </div>
                    </a>
                    <a href="#" class="card">
                        <div class="card-body w-full">
                            <div class="body-top">
                                <h4>Dompet</h4>
                            </div>
                            <div class="body-bottom flex flex-col w-full">
                                <h2 class="saldo">{{ $wallet }}</h2>
                                <div class="flex justify-between text-[12px]">
                                    <p class="my-auto">{{ now()->translatedFormat('F') }}, {{ date('Y') }}</p>
                                    <div class="action">
                                        <button class="bg-orange-500 text-base add-popup"><i
                                                class="bx bxs-edit"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-icon">
                            <i class="bx bxs-wallet"></i>
                        </div>
                    </a>
                    <a href="{{ url('/rekening') }}" class="card">
                        <div class="card-body">
                            <div class="body-top">
                                <h4>E-Wallet</h4>
                            </div>
                            <div class="body-bottom">
                                <h2 class="saldo">{{ $rekening }}</h2>
                                <div class="flex text-[12px]">
                                    <p>{{ now()->translatedFormat('F') }}, {{ date('Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-icon">
                            <i class="bx bxs-credit-card"></i>
                        </div>
                    </a>
                    <a href="#" class="card">
                        <div class="card-body">
                            <div class="body-top">
                                <h4>Total Pengeluaran</h4>
                            </div>
                            <div class="body-bottom">
                                <h2 class="saldo">{{ $pengeluaran }}</h2>
                                <div class="flex text-[12px]">
                                    <p>{{ now()->translatedFormat('F') }}, {{ date('Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-icon">
                            <i class="bx bx-trending-down"></i>
                        </div>
                    </a>
                </div>
                <div class="w-full overflow-x-auto">
                    <div class="graphBox w-[500px] md:w-full ">
                        <div class="box">
                            <div>
                                <canvas id="lineChart" class=""></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-content flex-col xl:flex-row">
                <div class="table-wrapper w-full xl:w-[70%]">
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
                <div class="userList h-full w-full xl:w-[30%]">
                    <div class="title">
                        <h4>Daftar Teman</h4>
                        <button>Tambah</button>
                    </div>
                    <div class="list-wrapper grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-1">
                        <a href="" class="list">
                            <div class="img">
                                <img src="img/kazuma.jpg" alt="image" />
                            </div>
                            <div class="userProfile">
                                <h4>Muhammad Ega Dermawan</h4>
                                <span class="online"><i class="bx bxs-circle"></i>Online</span>
                            </div>
                        </a>
                        <a href="" class="list">
                            <div class="img">
                                <img src="img/user.png" alt="image" />
                            </div>
                            <div class="userProfile">
                                <h4>Ega Dermawan</h4>
                                <span class="offline"><i class="bx bxs-circle"></i>Offline (last seen - 25
                                    minute ago)</span>
                            </div>
                        </a>
                        <a href="" class="list">
                            <div class="img">
                                <img src="img/user.png" alt="image" />
                            </div>
                            <div class="userProfile">
                                <h4>Ega Dermawan</h4>
                                <span class="offline"><i class="bx bxs-circle"></i>Offline (last seen - 25
                                    minute ago)</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Popup --}}
    <div class="create-popup top-5 w-[calc(100%-50px)] md:w-[80%] lg:w-[50%]">
        <div class="form-input">
            <div class="title">
                <h4>Update Dompet</h4>
            </div>
            <form action="{{ url('wallet/' . $my_wallet->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="input-box">
                    <label for="money_total">Jumlah Uang Dompet</label>
                    <input type="text" name="money_total" id="money_total" placeholder="Masukkan Jumlah Uang"
                        value="{{ $my_wallet->money_total }}">
                </div>
                <div class="btn mt-3 flex justify-end gap-2">
                    <button type="button" class="close bg-red-500">Batal</button>
                    <button type="submit" class="bg-blue-500">Tambah</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Popup --}}
@endsection
