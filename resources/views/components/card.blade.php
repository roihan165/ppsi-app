<!-- <div>
    It is never too late to be what you might have been. - George Eliot
</div> -->
@props(['title', 'image', 'alt' => 'image.jpg', 'bahan', 'cardTitle' => 'Detail','url' => 'kosong', 'namaFile' => 'Default'])
<div class="growth-card">
    <img src="{{ $image }}" alt="{{ $alt ?? 'image.jpg'}}">
    <div x-data="{ showModal: false }" class="relative">
        <!-- Card -->
        <div @click="showModal = true" class="cursor-pointer p-6 bg-white shadow-lg rounded-lg">
            <span style="position: absolute; top: 8px; right: 12px; font-size: 20px; color: gold;">★Rekomendasi</span>
            <b><h3>{{ $cardTitle ?? 'Detail' }}</h3></b> {{-- Menggunakan $cardTitle untuk judul di dalam card --}}
            <p>
                {{ $slot }}
            </p>
        </div>
        
        <!-- Modal -->
        <div
        x-show="showModal"
        x-transition
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        >
        <div @click.away="showModal = false" class="bg-white p-8 rounded shadow-lg w-96">
            <h3 class="text-lg font-semibold mb-2">{{ $title }}</h3> {{-- Menggunakan $title untuk judul modal --}}
            <p class="mb-4">{!! $bahan !!}</p>
            
            <button @click="showModal = false" class="bg-blue-500 text-white px-4 py-2 rounded">Close</button>
            <a
              href="{{ $url ?? 'kosong' }}"
              target="_blank"
              rel="noopener noreferrer"
              download="{{ $namaFile ?? 'Default'}}.pdf"
              class="bg-red-500 text-white px-4 py-2 rounded inline-block"
            >
              <i class="fas fa-file-pdf mr-2"></i> Unduh Resep
            </a>
        </div>
        </div>
    </div>
</div>
