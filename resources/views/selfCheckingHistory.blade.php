<x-layout title="Riwayat Self Checking Motorik Anak">
    <div class="container">
        <h1>Riwayat Pemeriksaan Motorik Kasar Anak</h1>
        <select id="childSelector">
            <option value="">-- Pilih Anak --</option>
            <!-- @foreach($anak as $a)
                <option value="{{ $a->anak_NIK }}">{{ $a->name }}</option>
            @endforeach -->
        </select>
        <div id="historyContainer">
            <p>Memuat data...</p>
        </div>
    </div>

    <script>
        const daftarAnak = @json($anak);
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/api/self-checking/history',{
                headers: {
                    'Accept': 'application/json'
                },
                credentials: 'include'
            }).then(async res => {
                const contentType = res.headers.get('content-type');
                        
                if (!res.ok) {
                    throw new Error('Gagal mengambil data riwayat.');
                }
            
                if (contentType && contentType.includes('application/json')) {
                    return res.json();
                } else {
                    const text = await res.text();
                    throw new Error('Respon non-JSON: ' + text.slice(0, 100)); // potong agar tidak error panjang
                }
            }).then(res => {
                console.log('Respon JSON:', res);
                // tampilkan datanya ke halaman
                const selfCheckData = res.data; // dari response API
                if (selfCheckData.length === 0) {
                  html = `<p>Silakan Masukkan Data anak terlebih dahulu.</p>`;
                }
                // Isi dropdown anak
                const selectEl = document.getElementById('childSelector');
                daftarAnak.forEach(anak => {
                    const option = document.createElement('option');
                    option.value = anak.anak_NIK;
                    option.textContent = anak.name;
                    selectEl.appendChild(option);
                });
                
                // Event listener saat anak dipilih
                selectEl.addEventListener('change', (e) => {
                    const selectedNik = e.target.value;
                    const anak = daftarAnak.find(a => a.anak_NIK === selectedNik);
                    const hasil = selfCheckData.find(d => d.anak_nik === selectedNik);
                
                    let html = '';
                    if (!selectedNik) {
                        html = `<p>Silakan pilih anak terlebih dahulu.</p>`;
                    } else if (hasil) {
                        const tanggal = new Date(hasil.created_at).toLocaleDateString('id-ID', {
                            day: 'numeric', month: 'long', year: 'numeric'
                        });
                    
                        html = `
                            <div class="result-box">
                                <div class="result-header">
                                    <div class="child-name">👶 ${anak.name} (Usia: ${hasil.child_age_months} bulan)</div>
                                    <div class="timestamp">📅 ${tanggal}</div>
                                </div>
                    
                                <div class="overall-status status-${hasil.overall_status}">
                                    Status Motorik: ${hasil.overall_status.toUpperCase()}
                                </div>
                    
                                <ul class="milestone-list">
                                    ${hasil.milestone_results.map(h => `
                                        <li class="milestone-item ${h.evaluation}">
                                            ${h.message}
                                        </li>
                                    `).join('')}
                                </ul>
                            </div>
                        `;
                    } else {
                        html = `
                            <div class="result-box">
                                <div class="result-header">
                                    <div class="child-name">👶 ${anak.name}</div>
                                </div>
                                <div class="overall-status warning">
                                    Anak belum melakukan monitoring perkembangan motorik.
                                </div>
                            </div>
                        `;
                    }
                
                    document.getElementById('historyContainer').innerHTML = html;
                });
            
            }).catch(err => {
                    document.getElementById('historyContainer').innerHTML = '<p>Gagal memuat data riwayat.</p>';
                    console.error(err);
                });
        });
    </script>

<style>
    .result-box {
        border: 1px solid #ccc;
        padding: 1em;
        margin-bottom: 1em;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .child-name {
        font-weight: bold;
        font-size: 1.2em;
    }

    .timestamp {
        font-size: 0.9em;
        color: #777;
    }

    .overall-status {
        margin-top: 0.5em;
        font-weight: bold;
    }

    .status-good { color: green; }
    .status-warning { color: orange; }
    .status-danger { color: red; }

    .milestone-list {
        list-style: none;
        padding-left: 1em;
        margin-top: 0.5em;
    }

    .milestone-item.good { color: green; }
    .milestone-item.warning { color: orange; }
    .milestone-item.danger { color: red; }
</style>
</x-layout>
