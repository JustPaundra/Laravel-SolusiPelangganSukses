<!-- views/admin/dashboard.blade.php -->

@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="widget">
            <h3>Jumlah Data Analisa</h3>
            <p>{{ $jumlahAnalisa }}</p>
        </div>
        <!-- Konten Dashboard -->
    </div>
@endsection
