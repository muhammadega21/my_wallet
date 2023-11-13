@extends('layouts.main')
@section('container')
    <div class="content">
        <div class="content-title flex justify-between">
            <h4>Daftar Teman</h4>
            <div class="btn">
                <button class="bg-blue-500">Tambah</button>
            </div>
        </div>
        <div class="content-body">
            <div class="friendlist">
                <div class="top">
                    <span>ID</span>
                    <span>Nama</span>
                    <span>Email</span>
                    <span>No Telp</span>
                    <span>Status</span>
                    <span>Action</span>
                </div>
                <div class="bottom">
                    <a href="" class="friendlist-card">
                        <span class="font-bold">#2108</span>
                        <div class="flex items-center gap-2">
                            <div class="img">
                                <img src="img/kazuma.jpg" alt="image">
                            </div>
                            Muhammad Ega Dermawan
                        </div>
                        <span>dermawane988@gmail.com</span>
                        <span>085763000486</span>
                        <span class="status"><i class="bx bxs-circle"></i>Online</span>
                        <div class="flex items-center gap-1">
                            <form action="">
                                <div class="btn">
                                    <button class="bg-red-500 !p-0 !px-1.5"><i class="bx bxs-user-x text-xl"></i></button>
                                </div>
                            </form>

                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
