@extends('layouts/master')
@section('content')
<div class="card">
    <h5 class="card-header">Daftarkan Admin</h5>
    <div class="card-body">
        <form method="POST" action="{{ url('register_admin') }}">
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
                Daftar
            </button>
        </form>
    </div>
</div>
@endsection