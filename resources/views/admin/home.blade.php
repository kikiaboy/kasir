    @extends('layouts.mainLayout')

    @section('tittle','Admin-Home')

     @section('content')

    <h1>Ini halaman Admin</h1>
    <h2>Anda login sebagai {{Auth::user()->nama_lengkap}}</h2>
    <h2>Email : {{Auth::user()->email}}</h2>
    <h2>Hak Akses : {{Auth::user()->hak_akses}}</h2>
     @endsection

