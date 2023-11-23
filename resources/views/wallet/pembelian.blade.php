@extends('layouts.main')
@section('container')
    <div class="content">
        <div class="content-title">
            <h1>Pembelian</h1>
        </div>
        <div class="content-body">
            <div class="form-input">
                <form action="{{ url('/pembelian') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group flex-wrap lg:flex-nowrap">
                        <div class="input-box @error('item_name') is-invalid @enderror">
                            <label class="required">Nama Barang</label>
                            <input class="" type="text" name="item_name" placeholder="Nama Barang" value="">
                        </div>
                        <div class="input-box  @error('item_price') is-invalid @enderror">
                            <label class="required">Harga Barang</label>
                            <div class="item_price">
                                <div class="price">
                                    <input class="" type="text" id="item_price" name="item_price"
                                        placeholder="Harga Barang" value="">
                                </div>
                                <div class="qty">
                                    <i class="bx bx-minus"></i>
                                    <input class="" type="text" id="item_qty" name="item_qty" placeholder="QTY"
                                        value="">
                                    <i class="bx bx-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="input-box @error('item_total') is-invalid @enderror">
                            <label class="required">Total Harga</label>
                            <input class="readonly" type="text" id="item_total" name="item_total"
                                placeholder="Total Harga" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group flex-wrap lg:flex-nowrap">
                        <div class="input-box  @error('status') is-invalid @enderror">
                            <label>Kategori</label>
                            <select name="status" id="status">
                                <option hidden>Pilih Kategori</option>
                                <option value="money_in">Uang Masuk</option>
                                <option value="money_out">Pembelian</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <label class="required">Metode Pembayaran</label>
                            <select name="metode" id="metode">
                                <option hidden>Pilih Metode Pembayaran</option>
                                <option id="wallet_value" value="{{ $wallet->id }}">Dompet</option>
                                <option value="rekening">Rekening / E-Wallet</option>
                            </select>
                            <input type="hidden" name="wallet_id" id="wallet_id" value="">
                        </div>
                        <div class="input-box rekening invisible @error('rekening_id') is-invalid @enderror">
                            <label class="required">Rekening</label>
                            <select name="rekening_id" id="rekening_id">
                                <option hidden></option>
                                @foreach ($rekening as $rekening)
                                    <option value="{{ $rekening->id }}">{{ $rekening->bank }} - ({{ $rekening->number }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="btn flex justify-end mt-3 me-0 lg:me-3">
                        <button id="asd" class="bg-blue-500">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
