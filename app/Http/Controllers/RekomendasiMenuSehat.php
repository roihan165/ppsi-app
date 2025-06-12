<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekomendasiMenuSehat extends Controller
{
    public function index() {
        return view('rekomendasimenusehat',[
            'bahanTelor' => '
            <ul>
                    <li>1 butir telur ayam ukuran besar</li>
                    <li>1 sdt minyak zaitun / mentega tanpa garam</li>
                    <li>1 sdm susu cair (opsional, agar tekstur lembut)</li>
                    <li>Sejumput lada halus (opsional, hindari garam untuk anak &lt;2 tahun)</li>
                    <li>1 sdm parutan keju (opsional, menambah kalsium dan rasa)</li>
                    <li>Sayuran cincang halus (misalnya: 1 sdm wortel parut atau bayam rebus)</li>
                </ul>
            '
        ]);
    }
}
