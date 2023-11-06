@extends('layouts.main')
@section('container')
    <div class="content">
        <div class="content-title">
            <h1>Rekening</h1>
        </div>
        <div class="content-body">
            <div class="popup-btn">
                <button class="add-popup">Tambah Rekening</button>
            </div>
            <div class="rekening">
                <div class="cards">
                    @foreach ($rekening as $rekening)
                        <a href="#" class="card">
                            <p class="hidden rekening_id">{{ $rekening->id }}</p>
                            <div class="card-body w-full">
                                <div class="body-top">
                                    <h2 class="text-base text-green-600 rekening_name">{{ $rekening->bank }}</h2>
                                </div>
                                <div class="body-bottom">
                                    <h2 class="saldo">{{ $rekening->money_total }}</h2>
                                    <div class="flex justify-between text-[12px]">
                                        <p class="my-auto !opacity-60">No.Rekening : <span
                                                class="rekening_number !font-bold !opacity-100">{{ $rekening->number }}</span>
                                        </p>
                                        <div class="action popup-btn !mr-0 !pr-0">
                                            <button class="!bg-orange-500 !m-0 !px-[8px] !py-1 edit-popup"><i
                                                    class="bx bxs-edit"></i></button>
                                        </div>
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
            {{-- Add Popoup --}}
            <div class="create-popup w-full md:w-[80%] lg:w-[50%]">
                <div class="form-input">
                    <div class="title">
                        <h4>Tambah Rekening</h4>
                    </div>
                    <form action="{{ url('/rekening') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="input-box">
                            <label for="bank">Nama Rekening</label>
                            <input type="text" name="bank" id="bank" placeholder="Nama Rekening/E-Wallet">
                        </div>
                        <div class="input-box">
                            <label for="number">Nomor Rekening</label>
                            <input type="text" name="number" id="number" placeholder="No.Rekening/No.hp">
                        </div>
                        <div class="input-box">
                            <label for="money_total">Saldo</label>
                            <input type="text" name="money_total" id="money_total" placeholder="Saldo Sekarang">
                        </div>
                        <div class="btn mt-3 flex justify-end gap-2">
                            <button type="button" class="close bg-red-500">Batal</button>
                            <button type="submit" class="bg-blue-500">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Add Popoup --}}
            {{-- Edit Popoup --}}
            <div class="update-popup w-full md:w-[80%] lg:w-[50%]">
                <div class="form-input">
                    <div class="title flex justify-between">
                        <h4>Update Rekening</h4>
                        <form id="formDelete" action="{{ url('') }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="btn">
                                <button id="delete" type="button" class="bg-red-500 !p-0 !px-1.5"><i
                                        class="bx bxs-trash text-lg"></i></button>
                            </div>
                        </form>
                    </div>
                    <form id="formUpdate" action="{{ url('') }}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" id="id">
                        <div class="input-box">
                            <label for="bank">Nama Rekening</label>
                            <input type="text" name="bank" id="bank" placeholder="Nama Rekening/E-Wallet">
                        </div>
                        <div class="input-box">
                            <label for="number">Nomor Rekening</label>
                            <input type="text" name="number" id="number" placeholder="No.Rekening/No.hp">
                        </div>
                        <div class="input-box">
                            <label for="money_total">Saldo</label>
                            <input type="text" name="money_total" id="money_total" placeholder="Saldo Sekarang">
                        </div>
                        <div class="btn mt-3 flex justify-end gap-2">
                            <button type="button" class="close bg-red-500">Batal</button>
                            <button type="submit" class="bg-blue-500">Update</button>
                        </div>
                    </form>

                </div>
            </div>
            {{-- Edit Popoup --}}
        </div>
    </div>
@endsection
