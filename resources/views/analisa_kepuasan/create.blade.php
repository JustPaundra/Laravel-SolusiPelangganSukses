@extends('layouts.admin')

@section('title', 'Input Dashboard')

@section('content')
<div class="container">
    <h2>Input Data</h2>
    <form action="{{ route('analisa_kepuasan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="pemesan">Pemesan</label>
            <input type="text" id="pemesan" name="pemesan" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="sektor">Sektor</label>
            <input type="text" id="sektor" name="sektor" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="skor_kepuasan">Skor Kepuasan</label>
            <input type="number" id="skor_kepuasan" name="skor_kepuasan" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="skor_customer_effort">Skor Customer Effort</label>
            <input type="number" id="skor_customer_effort" name="skor_customer_effort" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="foto_bukti">Foto Dokumen</label>
            <input type="file" id="foto_bukti" name="foto_bukti" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
