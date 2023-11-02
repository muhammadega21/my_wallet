@extends('layouts.main')
@section('container')
    <div class="content">
        <div class="content-title">
            <h1>Edit Pembelian</h1>
        </div>
        <div class="content-body">
            <div class="form-input">
                <form action="{{ url('pembelian/' . $riwayat->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="{{ $riwayat->wallet_id ? 'wallet_id' : 'rekening_id' }}"
                        value="{{ $riwayat->wallet_id ? $riwayat->wallet_id : $riwayat->rekening_id }}">
                    <div class="form-group flex-wrap lg:flex-nowrap">
                        <div class="input-box @error('item_name') is-invalid @enderror">
                            <label class="required">Nama Barang</label>
                            <input class="" type="text" name="item_name" placeholder="Nama Barang"
                                value="{{ old('item_name', $riwayat->item_name) }}">
                        </div>
                        <div class="input-box  @error('item_price') is-invalid @enderror">
                            <label class="required">Harga Barang</label>
                            <div class="item_price">
                                <div class="price">
                                    <input class="" type="text" id="item_price" name="item_price"
                                        placeholder="Harga Barang" value="{{ old('item_price', $riwayat->item_price) }}">
                                </div>
                                <div class="qty">
                                    <i class="bx bx-minus"></i>
                                    <input class="" type="text" id="item_qty" name="item_qty" placeholder="QTY"
                                        value="{{ old('item_qty', $riwayat->item_qty) }}">
                                    <i class="bx bx-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group flex-wrap lg:flex-nowrap">
                        <div class="input-box @error('item_total') is-invalid @enderror">
                            <label class="required">Total Harga</label>
                            <input class="readonly" type="text" id="item_total" name="item_total"
                                placeholder="Total Harga" value="{{ old('item_total', $riwayat->item_total) }}" readonly>
                        </div>
                        <div class="input-box  @error('status') is-invalid @enderror">
                            <label>Kategori</label>
                            <select name="status" id="status">
                                <option hidden>Pilih Kategori</option>
                                <option value="money_in" {{ $riwayat->money_in ? 'selected' : '' }}>Uang Masuk</option>
                                <option value="money_out" {{ $riwayat->money_out ? 'selected' : '' }}>Pembelian</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group flex-wrap lg:flex-nowrap">
                        <div class="input-box @error('desc') is-invalid @enderror">
                            <label class="required">Deskripsi</label>
                            <textarea name="desc" id="desc">{{ old('desc', $riwayat->desc) }}</textarea>
                        </div>
                    </div>
                    <div class="btn flex justify-end mt-3 me-0 lg:me-3">
                        <button class="bg-blue-500">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
