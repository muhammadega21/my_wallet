@extends('layouts.main')
@section('container')
    <div class="content">
        <div class="content-title">
            <h1>Profile</h1>
        </div>
        <div class="content-body">
            <div class="profileWrapper grid-cols-1 md:grid-cols-[minmax(255px,_auto)_11fr]">
                <div class="profileLeft">
                    <form action="{{ url('profile/update/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="profileImage">
                            <div class="img">
                                @if ($user->img)
                                    @if ($user->img == 'user.png')
                                        <img src="{{ url('img/' . $user->img) }}" class="img-preview" alt="image">
                                    @else
                                        <img src="{{ url(asset('storage/' . $user->img)) }}" class="img-preview"
                                            alt="image">
                                    @endif
                                @else
                                    <img class="img-preview">
                                @endif
                            </div>
                            <div class="img-upload">
                                <div class="upload-file">
                                    <input class="" type="file" id="image" name="img"
                                        onchange="previewImage()">
                                    <div class="flex items-center gap-2">
                                        <div class="btn"><button id="btnUpdate"
                                                class="bg-blue-500 !p-0 !py-[10px] !px-[12px]">Update</button>
                                        </div>
                                        <label for="image" id="btnUpload"><i
                                                class='bx bxs-cloud-upload'></i>Upload</label>

                                    </div>
                                </div>
                                <input type="hidden" name="oldImage" value="{{ $user->img }}">
                            </div>
                        </div>
                    </form>
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
                                    <th>UserID</th>
                                    <td>:</td>
                                    <td>{{ $user->username . '#' . $user->id_user }}</td>
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
                            <table class="profile text-left">
                                <tr>
                                    <th>Wallet</th>
                                    <td>:</td>
                                    <td class="saldo">{{ $wallet }}</td>
                                </tr>
                                <tr>
                                    <th>Rekening</th>
                                    <td>:</td>
                                    <td class="saldo">{{ $rekening }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="btn flex justify-end">
                        <form action="">
                            <button id="delete" class="bg-red-500">Hapus Akun</button>
                        </form>
                    </div>
                </div>
                <div class="profileRight">
                    <div class="profileSetting">
                        <div class="form-input">
                            <h4 class="title">Edit Profile</h4>
                            <form action="{{ url('user/update/' . $user->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group flex-wrap lg:flex-nowrap">
                                    <div class="input-box @error('name') is-invalid @enderror">
                                        <label class="required">Nama</label>
                                        <input type="text" name="name" placeholder="Masukkan Nama"
                                            value="{{ old('name', $user->name) }}">
                                    </div>
                                    <div class="input-box @error('username') is-invalid @enderror">
                                        <label class="required">Username</label>
                                        <input type="text" name="username" placeholder="Masukkan Username"
                                            value="{{ old('username', $user->username) }}">
                                    </div>
                                </div>
                                <div class="form-group flex-wrap lg:flex-nowrap">
                                    <div class="input-box @error('email') is-invalid @enderror">
                                        <label class="required">Email</label>
                                        <input type="email" name="email" placeholder="Masukkan Email"
                                            value="{{ old('email', $user->email) }}">
                                    </div>
                                    <div class="input-box @error('phone') is-invalid @enderror">
                                        <label class="required">No Hp</label>
                                        <input type="text" name="phone" placeholder="Masukkan No Hp"
                                            value="{{ old('phone', $user->phone) }}">
                                    </div>
                                </div>
                                <div class="btn flex justify-end mt-3 me-0 lg:me-3">
                                    <button id="asd" class="bg-blue-500">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="accountSetting">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
