<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Pengeluaran;

class PengeluaranExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {   
        $pengeluaran = Pengeluaran::all();

        return view('Pengeluaran.export', compact('pengeluaran'));
    }
}
