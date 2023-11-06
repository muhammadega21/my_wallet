@extends('layouts.main')
@section('container')
    <div class="content">
        <div class="content-title ">
            <h1>Riwayat Pembelian</h1>
        </div>
        <div class="content-body">
            <div class="search-box mb-2 float-right !w-[300px]">
                <form action="">
                    <input type="text" name="" id="" placeholder="Search..." />
                    <i class="bx bx-search search-icon"></i>
                    <button>Search</button>
                </form>
            </div>
            <div class="table-wrapper w-full">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>QTY</th>
                                <th>Jumlah Harga</th>
                                <th>Status</th>
                                <th>Pembayaran</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $riwayat)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td class="!whitespace-normal">{{ $riwayat->item_name }}</td>
                                    <td class="saldo">{{ $riwayat->item_price }}</td>
                                    <td>{{ $riwayat->item_qty }}</td>
                                    <td class="saldo">{{ $riwayat->item_total }}</td>
                                    <td class="{{ $riwayat->money_out ? 'text-orange-500' : '' }}">
                                        {{ $riwayat->money_in ? 'Uang Bertambah' : 'Pembelian' }}</td>
                                    <td>{{ $riwayat->wallet_id ? 'Dompet' : $riwayat->rekening->bank }}</td>
                                    <td>{{ $riwayat->created_at->translatedFormat('d F, Y') }}</td>
                                    <td>
                                        <div class="action">
                                            <form action="{{ url('pembelian/' . $riwayat->id . '/edit') }}">
                                                @csrf
                                                <button class="bg-orange-500"><i class="bx bxs-edit"></i></button>
                                            </form>
                                            <form action="{{ url('pembelian/' . $riwayat->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button id="delete" class="bg-red-500"><i
                                                        class="bx bxs-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
