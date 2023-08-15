@extends('layouts/master')

<!-- <link rel="stylesheet" href="../node_modules/selectric/public/selectric.css"> -->

@section('content')
    <form method="POST" action="{{ ('register') }}">
        @csrf
        <div class="row">
            <div class="form-group col-6">
                <label for="first_name">Username</label>
                <input id="username" type="text" class="form-control" name="username" autofocus>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email">
                <div class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="nama_pemilik">Nama Pemilik</label>
                <input id="nama_pemilik" type="text" class="form-control" name="nama_pemilik">
            </div>
            <div class="form-group">
                <label for="nama_toko">Nama Toko</label>
                <input id="nama_toko" type="text" class="form-control" name="nama_toko">
            </div>
            <div class="form-group col-6">
                <label for="password" class="d-block">Password</label>
                <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                <div id="pwindicator" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                </div>
            </div>
            <div class="form-group col-6">
                <label for="password2" class="d-block">Password Confirmation</label>
                <input id="password2" type="password" class="form-control" name="password-confirm">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </form>
@endsection

<!-- {% block plugins_js %} -->
  <!-- <script src="../node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="../node_modules/selectric/public/jquery.selectric.min.js"></script> -->
<!-- {% endblock %} -->

<!-- {% block page_js %} -->
  <!-- <script src="../assets/js/page/auth-register.js"></script> -->
<!-- {% endblock %} -->