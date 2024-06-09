@extends('layouts.admin')

@section('title', 'Edit Dashboard')

@section('content')
<div class="container">
    <h2>Edit Data</h2>
    <form action="{{ route('analisa_kepuasan.update', $analisaKepuasan->id_tiket) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="pemesan">Pemesan</label>
            <input type="text" id="pemesan" name="pemesan" class="form-control" value="{{ $analisaKepuasan->pemesan }}" required>
        </div>
        <div class="form-group">
            <label for="sektor">Sektor</label>
            <input type="text" id="sektor" name="sektor" class="form-control" value="{{ $analisaKepuasan->sektor }}" required>
        </div>
        <div class="form-group">
            <label for="skor_kepuasan">Skor Kepuasan</label>
            <input type="number" id="skor_kepuasan" name="skor_kepuasan" class="form-control" value="{{ $analisaKepuasan->skor_kepuasan }}" required>
        </div>
        <div class="form-group">
            <label for="skor_customer_effort">Skor Customer Effort</label>
            <input type="number" id="skor_customer_effort" name="skor_customer_effort" class="form-control" value="{{ $analisaKepuasan->skor_customer_effort }}" required>
        </div>
        <div class="form-group">
            <label for="foto_bukti">Foto Dokumen</label>
            <input type="file" id="foto_bukti" name="foto_bukti" class="form-control">
            @if ($analisaKepuasan->foto_bukti)
                <img src="{{ Storage::url($analisaKepuasan->foto_bukti) }}" alt="Foto bukti" style="width: 100px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
