<?php

namespace App\Http\Controllers;

use App\Models\AnalisaKepuasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;

class AnalisaController extends Controller
{
    public function index()
    {
        $analisaKepuasans = AnalisaKepuasan::all();
        return view('analisa_kepuasan.index', compact('analisaKepuasans'));
    }

    public function create()
    {
        return view('analisa_kepuasan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemesan' => 'required',
            'sektor' => 'required',
            'skor_kepuasan' => 'required|integer',
            'skor_customer_effort' => 'required|integer',
            'foto_bukti' => 'nullable|image',
        ]);

        $path = $request->file('foto_bukti') ? $request->file('foto_bukti')->store('uploads', 'public') : null;

        AnalisaKepuasan::create([
            'pemesan' => $request->pemesan,
            'sektor' => $request->sektor,
            'skor_kepuasan' => $request->skor_kepuasan,
            'skor_customer_effort' => $request->skor_customer_effort,
            'foto_bukti' => $path,
        ]);

        return redirect()->route('analisa_kepuasan.index');
    }

    public function edit($id)
    {
        $analisaKepuasan = AnalisaKepuasan::findOrFail($id);
        return view('analisa_kepuasan.edit', compact('analisaKepuasan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pemesan' => 'required',
            'sektor' => 'required',
            'skor_kepuasan' => 'required|integer',
            'skor_customer_effort' => 'required|integer',
            'foto_bukti' => 'nullable|image',
        ]);

        $analisaKepuasan = AnalisaKepuasan::findOrFail($id);

        if ($request->hasFile('foto_bukti')) {
            if ($analisaKepuasan->foto_bukti) {
                Storage::delete('public/' . $analisaKepuasan->foto_bukti);
            }
            $path = $request->file('foto_bukti')->store('uploads', 'public');
        } else {
            $path = $analisaKepuasan->foto_bukti;
        }

        $analisaKepuasan->update([
            'pemesan' => $request->pemesan,
            'sektor' => $request->sektor,
            'skor_kepuasan' => $request->skor_kepuasan,
            'skor_customer_effort' => $request->skor_customer_effort,
            'foto_bukti' => $path,
        ]);

        return redirect()->route('analisa_kepuasan.index');
    }

    public function destroy($id)
    {
        $analisaKepuasan = AnalisaKepuasan::findOrFail($id);
        if ($analisaKepuasan->foto_bukti) {
            Storage::delete('public/' . $analisaKepuasan->foto_bukti);
        }
        $analisaKepuasan->delete();

        return redirect()->route('analisa_kepuasan.index');
    }

    public function print()
    {
        // Query data dari database
        $analisaKepuasans = DB::table('analisa_kepuasan')->get();

        // Membuat objek Dompdf
        $dompdf = new Dompdf();

        // Mengatur HTML yang akan dicetak
        $html = "<html><body>";
        $html .= "<h1>Analisa Kepuasan</h1>";
        $html .= "<table border='1' cellspacing='0' cellpadding='10'>";
        $html .= "<thead>";
        $html .= "<tr>";
        $html .= "<th>ID Tiket</th>";
        $html .= "<th>Pemesan</th>";
        $html .= "<th>Sektor</th>";
        $html .= "<th>Foto Bukti</th>";
        $html .= "<th>Skor Kepuasan</th>";
        $html .= "<th>Skor Customer Effort</th>";
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";

        foreach ($analisaKepuasans as $row) {
            $html .= "<tr>";
            $html .= "<td>" . htmlspecialchars($row->id_tiket) . "</td>";
            $html .= "<td>" . htmlspecialchars($row->pemesan) . "</td>";
            $html .= "<td>" . htmlspecialchars($row->sektor) . "</td>";
            $html .= "<td>";
            if ($row->foto_bukti) {
                $html .= "<img src='../uploads/" . basename($row->foto_bukti) . "' alt='Foto bukti' style='width: 100px;'>";
            } else {
                $html .= "Tidak ada foto";
            }
            $html .= "</td>";
            $html .= "<td>" . htmlspecialchars($row->skor_kepuasan) . "</td>";
            $html .= "<td>" . htmlspecialchars($row->skor_customer_effort) . "</td>";
            $html .= "</tr>";
        }

        $html .= "</tbody>";
        $html .= "</table>";
        $html .= "</body></html>";

        // Memasukkan HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Mengatur ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Output PDF ke browser
        return $dompdf->stream("analisa_kepuasan.pdf", array("Attachment" => false));
    }
}

