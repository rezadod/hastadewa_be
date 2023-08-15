@extends('layouts.master')
@section('content')

    <form action="{{ ('login') }}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input id="email" type="text" name="email" require autocomplete="off">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" require>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>

@endsection