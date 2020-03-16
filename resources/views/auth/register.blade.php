<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('/assets/img/logo.png') }}" type="image/png" />
    <title>Register Siswa SIPrakerin</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/components.css') }}">
</head>

<body class="register">
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-5 offset-md-3">
                        <div class="login-brand">
                            <img src="{{ asset('/assets/img/logo.png') }}" alt="logo" width="100"
                                class="shadow-light rounded-circle">
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>

                            @if (Session::get('message-success') !== null)
                            <div class="card-header">
                                <div class="alert alert-success">
                                    <b>{{ Session::get('message-success') }}</b>
                                </div>
                            </div>
                            @endif
                            <div class="card-header">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#kepalaProdi"
                                            data-toggle="tab">Kepala Prodi</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#guru-pembimbing"
                                            data-toggle="tab">Guru Pembimbing</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#siswa" data-toggle="tab">Siswa</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body tab-content">
                                <div class="active tab-pane fadeIn" id="kepalaProdi">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <!-- pill kepala prodi -->
                                        <input type="hidden" name="privilege" value="3">
                                        <div class="form-group">
                                            @if (Session::get('message-error') !== null)
                                            <span class="invalid-feedback" style="display: block !important;">
                                                <strong>{{ Session::get('message-error') }}</strong>
                                            </span>
                                            @endif
                                            <label for="nama">Nama </label>
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                placeholder="Masukan Nama Anda" required="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan">Jurusan </label>
                                            <select type="text" name="jurusan" id="jurusan" class="form-control"
                                                required="">
                                                @php
                                                $datas = \App\JurusanModel::all();
                                                @endphp
                                                @foreach($datas as $jurusan)
                                                <option value='{{ $jurusan->id }}'>{{ $jurusan->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">NIY </label>
                                            <input type="text" name="username" id="username" class="form-control"
                                                placeholder="Masukan NIY Anda" required="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Password" required="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" id="password"
                                                class="form-control" placeholder="Ketik kembali password anda"
                                                required="" />
                                        </div>
                                        <div>
                                            <button class="btn btn-primary btn-lg btn-block submit"
                                                type="submit">Daftar</button>
                                            <br>
                                            Sudah punya akun? <a class="login" href="{{ route('login') }}">Masuk
                                                Disini</a>
                                            <br>
                                        </div>
                                    </form>
                                </div>

                                <!-- pill siswa -->
                                <div class="tab-pane fade" id="siswa">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <input type="hidden" name="privilege" value="4">
                                        <div class="form-group">
                                            <label for="nama">Nama </label>
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                placeholder="Masukan Nama Anda" required="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan">Jurusan </label>
                                            <select type="text" name="jurusan" id="jurusan" class="form-control"
                                                required="">
                                                @php
                                                $datas = \App\JurusanModel::all();
                                                @endphp
                                                @foreach($datas as $jurusan)
                                                <option value='{{ $jurusan->id }}'>{{ $jurusan->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">NIS </label>
                                            <input type="text" name="username" id="username" class="form-control"
                                                placeholder="Masukan NIS Anda" required="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Password" required="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" id="password"
                                                class="form-control" placeholder="Ketik kembali password anda"
                                                required="" />
                                        </div>
                                        <div>
                                            <button class="btn btn-primary btn-lg btn-block submit"
                                                type="submit">Daftar</button>
                                            <br>
                                            Sudah punya akun? <a class="reset_pass" href="{{ route('login') }}">Masuk
                                                Disini</a>
                                            <div class="clearfix"></div>
                                            <div class="separator">

                                            </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="guru-pembimbing">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <input type="hidden" name="privilege" value="2">

                                    <div class="form-group">
                                        <label for="nama">Nama </label>
                                        <input type="text" name="nama" id="nama" class="form-control"
                                            placeholder="Masukan Nama Anda" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan </label>
                                        <select type="text" name="jurusan" id="jurusan" class="form-control"
                                            required="">
                                            @php
                                            $datas = \App\JurusanModel::all();
                                            @endphp
                                            @foreach($datas as $jurusan)
                                            <option value='{{ $jurusan->id }}'>{{ $jurusan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">NIY </label>
                                        <input type="text" name="username" id="email" class="form-control"
                                            placeholder="Masukan NIY Anda" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Password" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" id="password"
                                            class="form-control" placeholder="Ketik kembali password anda"
                                            required="" />
                                    </div>
                                    <div>
                                        <button class="btn btn-primary btn-lg btn-block submit"
                                            type="submit">Daftar</button>
                                        <br>
                                        Sudah punya akun? <a class="reset_pass" href="{{ route('login') }}">Masuk
                                            Disini</a>
                                        <div class="clearfix"></div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>

    </div>


    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <script>
        $(".nav li").on("click", function () {
            $(".nav li").removeClass("active");
            $(this).addClass("active");
        })

    </script>

    <!--Page Specific JS File-->
</body>

</html>
