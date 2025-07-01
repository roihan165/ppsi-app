<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekomendasiMenuSehat extends Controller
{
    public function index() {
        $pembuatan = [
            'BuburSingkong' => '
            <ul>
                <li>Tumis bumbu halus, lalu masukkan daun salam dan sereh. </li>
                <li>Tambahkan air kaldu, masukkan singkong putih, daging ikan, daging ayam cincang rebus, aduk-aduk hingga setengah matang.</li>
                <li>Masukkan daun bayam, aduk hingga matang. Jika airnya mengental dapat ditambahkan air matang.</li>
                <li>Angkat, lalu saring halus atau diblender. Sebelum disajikan tambahkan saus jeruk.</li>
            </ul>
            ',
            'BuburSotoAyam' => '
            <ul>
                <li>Tumis bumbu halus sampai harum, masukan ayam cincang sampai berubah warna.</li>
                <li>Masukan air kaldu ayam, santan, salam, sereh dan daun jeruk masak sampai mendidih.</li>
                <li>Masukan nasi, tahu dan labu siam dan wortel yang sudah diiris kecil-kecil masak sampai semua bahan matang dan empuk.</li>
                <li>Haluskan sampai tekstur yang diinginkan. Sajikan selagi hangat</li>
            </ul>
            ',
            'BuburSupDaging' => '
            <ul>
                <li>Didihkan air kaldu ayam, masukkan kacang merah dan masak sampai empuk</li>
                <li>Tumis bumbu halus sampai harum, masukkan daging ayam cincang, masak sampai berubah warna</li>
                <li>Masukan tumisan daging ayam kedalam air kaldu masak sampai daging empuk</li>
                <li>Masukkan nasi, buncis, dan wortel.</li>
                <li>Tambahkan kocokan telur, aduk merata dan masak sampai matang</li>
                <li>Haluskan bubur sampai tekstur yang diinginkan, lalu sajikan</li>
            </ul>
            '

        ];
        return view('rekomendasimenusehat',compact('pembuatan'));
    }
}
