@extends('layouts.app')

@section('title', 'Transaksi Baru')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">🛒 Transaksi Baru</h1>
        <a href="{{ route('transaksi.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi">
        @csrf
        <div class="form-group">
            <label class="form-label">Kode</label>
            <input type="text" name="kode_transaksi" class="form-control" value="{{ $kode }}" readonly>
        </div>
        <div class="form-group">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Kasir</label>
            <input type="text" name="kasir" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Member</label>
            <select name="nama_member" class="form-select">
                <option value="">- Tanpa Member -</option>
                @foreach($member as $m)
                    <option value="{{ $m->nama }}" data-diskon="{{ $m->diskon_persen }}">{{ $m->nama }} (Diskon {{ $m->diskon_persen }}%)</option>
                @endforeach
            </select>
        </div>

        <hr>
        <h3>Item Barang</h3>
        <div id="items-container">
            <div class="item-row" style="border:1px solid #ddd;padding:15px;margin-bottom:15px">
                <div class="d-flex gap-2" style="flex-wrap:wrap">
                    <div style="flex:2;min-width:200px">
                        <label>Barang</label>
                        <select class="form-select select-barang" name="items[0][nama_barang]" required>
                            <option value="">Pilih</option>
                            @foreach($barang as $b)
                                <option value="{{ $b->nama }}" data-ukuran="{{ $b->ukuran }}" data-warna="{{ $b->warna }}" data-harga="{{ $b->harga_jual }}" data-stok="{{ $b->stok }}">{{ $b->nama }} (Stok: {{ $b->stok }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="flex:1;min-width:80px">
                        <label>Ukuran</label>
                        <input type="text" class="form-control input-ukuran" name="items[0][ukuran]" readonly>
                    </div>
                    <div style="flex:1;min-width:80px">
                        <label>Warna</label>
                        <input type="text" class="form-control input-warna" name="items[0][warna]" readonly>
                    </div>
                    <div style="flex:1;min-width:60px">
                        <label>Jumlah</label>
                        <input type="number" class="form-control input-jumlah" name="items[0][jumlah]" min="1" value="1" required>
                    </div>
                    <div style="flex:1;min-width:100px">
                        <label>Harga</label>
                        <input type="number" class="form-control input-harga" name="items[0][harga_satuan]" readonly>
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-sm mt-2 btn-hapus" style="display:none">🗑️</button>
            </div>
        </div>

        <button type="button" class="btn btn-primary mb-3" id="btn-tambah">+ Item</button>

        <hr>
        <div style="font-size:1.2rem">
            <p>Total: <span id="total-bayar">Rp 0</span></p>
            <p>Diskon: <span id="diskon">Rp 0</span></p>
            <p style="color:#e74c3c;font-size:1.5rem">Total Akhir: <span id="total-akhir">Rp 0</span></p>
            <div class="form-group">
                <label>Tunai</label>
                <input type="number" name="tunai" id="input-tunai" class="form-control" style="width:200px" required>
            </div>
            <p>Kembalian: <span id="kembalian" style="color:#2ecc71">Rp 0</span></p>
        </div>

        <button type="submit" class="btn btn-success" style="width:100%;padding:15px;font-size:1.2rem">💾 SIMPAN</button>
    </form>
</div>

@push('scripts')
<script>
let idx = 0;
function updateSubtotal(row) {
    const jml = parseInt(row.querySelector('.input-jumlah').value)||0;
    const hrg = parseInt(row.querySelector('.input-harga').value)||0;
    row.querySelector('.input-subtotal') && (row.querySelector('.input-subtotal').value = jml*hrg);
    updateTotal();
}
function updateTotal() {
    let total = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const jml = parseInt(row.querySelector('.input-jumlah').value)||0;
        const hrg = parseInt(row.querySelector('.input-harga').value)||0;
        total += jml*hrg;
    });
    const diskonPersen = document.querySelector('select[name="nama_member"]').selectedOptions[0]?.dataset.diskon||0;
    const diskon = total * (diskonPersen/100);
    const akhir = total - diskon;
    document.getElementById('total-bayar').textContent = 'Rp '+total.toLocaleString('id-ID');
    document.getElementById('diskon').textContent = 'Rp '+diskon.toLocaleString('id-ID');
    document.getElementById('total-akhir').textContent = 'Rp '+akhir.toLocaleString('id-ID');
    const tunai = parseInt(document.getElementById('input-tunai').value)||0;
    document.getElementById('kembalian').textContent = 'Rp '+(tunai-akhir>=0?(tunai-akhir).toLocaleString('id-ID'):0);
}
document.getElementById('btn-tambah').addEventListener('click', function() {
    idx++;
    const container = document.getElementById('items-container');
    const first = container.querySelector('.item-row');
    const newItem = first.cloneNode(true);
    newItem.querySelectorAll('input,select').forEach(el => {
        el.name = el.name.replace(/items\[0\]/, 'items['+idx+']');
        if(el.tagName==='INPUT' && el.type!=='hidden') el.value = el.classList.contains('input-jumlah')?'1':'';
    });
    newItem.querySelector('.btn-hapus').style.display = 'inline-block';
    container.appendChild(newItem);
    attachEvents(newItem);
});
document.getElementById('items-container').addEventListener('click', function(e) {
    if(e.target.classList.contains('btn-hapus') && document.querySelectorAll('.item-row').length>1) {
        e.target.closest('.item-row').remove();
        updateTotal();
    }
});
function attachEvents(row) {
    const select = row.querySelector('.select-barang');
    select.addEventListener('change', function() {
        const opt = this.selectedOptions[0];
        row.querySelector('.input-ukuran').value = opt.dataset.ukuran||'';
        row.querySelector('.input-warna').value = opt.dataset.warna||'';
        row.querySelector('.input-harga').value = opt.dataset.harga||'';
        updateSubtotal(row);
    });
    row.querySelector('.input-jumlah').addEventListener('input', function() {
        const stok = parseInt(select.selectedOptions[0]?.dataset.stok)||0;
        if(parseInt(this.value)>stok){alert('Stok cuma '+stok);this.value=stok;}
        updateSubtotal(row);
    });
}
document.querySelector('select[name="nama_member"]').addEventListener('change', updateTotal);
document.getElementById('input-tunai').addEventListener('input', updateTotal);
document.querySelectorAll('.item-row').forEach(row => attachEvents(row));
</script>
@endpush
@endsection