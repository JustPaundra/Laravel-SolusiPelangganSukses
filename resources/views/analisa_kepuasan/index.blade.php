@extends('layouts.admin')

@section('title', 'Analisa Kepuasan')

@section('content')
<div class="tabel-wrapper">
    <h3 class="main-title">Analisa Kepuasan</h3>
    <div class="button-container">
        <a href="{{ route('analisa.create') }}" class="move-button">Input Data</a>
        <a href="{{ route('analisa.print') }}" class="move-button">Print</a>
    </div>
    <div class="tabel-container">
        <table>
            <thead>
                <tr>
                    <th>ID Tiket</th>
                    <th>Pemesan</th>
                    <th>Sektor</th>
                    <th>Foto Bukti</th>
                    <th>Skor Kepuasan</th>
                    <th>Skor Customer Effort</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($analisaKepuasans as $analisa)
                <tr>
                    <td>{{ $analisa->id_tiket }}</td>
                    <td>{{ $analisa->pemesan }}</td>
                    <td>{{ $analisa->sektor }}</td>
                    <td>
                        @if ($analisa->foto_bukti)
                        <img src="{{ asset('image/'.$analisa->foto_bukti) }}" alt="Foto bukti" style="width: 100px;">
                        @else
                        Tidak ada foto
                        @endif
                    </td>
                    <td>{{ $analisa->skor_kepuasan }}</td>
                    <td>{{ $analisa->skor_customer_effort }}</td>
                    <td>
                        <span class="status status-{{ strtolower($analisa->status) }}">
                            {{ $analisa->status }}
                        </span>
                    </td>
                    <td>
                        <div class="button-container">
                            <a href="{{ route('analisa.edit', $analisa->id_tiket) }}" class="edit-button">Edit</a>
                            <form action="{{ route('analisa.destroy', $analisa->id_tiket) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-button" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Total Task: {{ count($analisaKepuasans) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
