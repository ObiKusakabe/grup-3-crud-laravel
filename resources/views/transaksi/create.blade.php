@extends('layouts.app')

@section('title', 'Transaksi Baru')

@section('content')
    <style>
        /* ===== LAYOUT UTAMA ===== */
        .pos-layout {
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .pos-main {
            flex: 1 1 0;
            min-width: 0;
        }

        .pos-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            padding: 20px;
        }

        .pos-card h5 {
            font-weight: 700;
            margin-bottom: 16px;
        }

        #search {
            max-width: 380px;
        }

        .product-count {
            font-size: 12px;
            color: #999;
            margin-left: 10px;
        }

        /* ===== FILTER KATEGORI ===== */
        .category-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 14px;
        }

        .category-chip {
            border: 1px solid #dee2e6;
            background: #fff;
            color: #495057;
            border-radius: 9999px;
            padding: 6px 16px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
            white-space: nowrap;
        }

        .category-chip:hover {
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .category-chip.active {
            background: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
        }

        .product-empty {
            text-align: center;
            color: #999;
            padding: 40px 15px;
            font-size: 13px;
            grid-column: 1 / -1;
        }

        /* ===== GRID PRODUK (kartu kecil, bukan list panjang) ===== */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 16px;
            margin-top: 16px;
        }

        .product-card {
            cursor: pointer;
            border: 1px solid #eef0f2;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            transition: all 0.2s ease;
        }

        .product-card:hover {
            border-color: #0d6efd;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.12);
            transform: translateY(-2px);
        }

        .product-img-wrap {
            position: relative;
            width: 100%;
            aspect-ratio: 1 / 1;
            background: #f2f3f5;
        }

        .product-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .product-card:hover .product-overlay {
            opacity: 1;
        }

        .product-card-body {
            padding: 10px 12px 12px;
        }

        .product-card-body h6 {
            font-weight: 600;
            font-size: 13px;
            margin: 0 0 6px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
        }

        .stok-badge {
            font-size: 11px;
            color: #e0447b;
            font-weight: 600;
            white-space: nowrap;
        }

        .product-price {
            font-size: 13px;
            font-weight: 700;
            color: #111;
            white-space: nowrap;
        }

        /* ===== SIDEBAR KERANJANG (tetap di pinggir, tidak jatuh ke bawah) ===== */
        .pos-cart {
            flex: 0 0 360px;
            width: 360px;
            position: sticky;
            top: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 40px);
            overflow: hidden;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 18px;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            flex-shrink: 0;
        }

        .cart-header h5 {
            margin: 0;
            font-weight: 700;
            font-size: 16px;
        }

        .cart-items-container {
            overflow-y: auto;
            padding: 15px 18px;
            min-height: 60px;
            background: #fff;
            flex: 0 1 auto;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 13px;
            gap: 8px;
        }

        .cart-item-name {
            flex: 1;
            font-weight: 500;
        }

        .cart-item-qty {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .cart-item-qty button {
            width: 24px;
            height: 24px;
            padding: 0;
            font-size: 12px;
        }

        .cart-item-remove {
            background: #dc3545;
            color: white;
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            flex-shrink: 0;
        }

        .cart-empty {
            text-align: center;
            color: #999;
            padding: 30px 15px;
            font-size: 13px;
        }

        .cart-footer {
            padding: 15px 18px 18px;
            border-top: 1px solid #e9ecef;
            background: #fff;
            overflow-y: auto;
            flex-shrink: 1;
        }

        .form-group-compact {
            margin-bottom: 14px;
        }

        .form-group-compact label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
        }

        /* Stepper look untuk diskon, biar mirip referensi (tombol -/+ ) */
        .stepper-group {
            display: flex;
            align-items: center;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
        }

        .stepper-group button {
            border: none;
            background: #f8f9fa;
            width: 34px;
            height: 34px;
            font-size: 16px;
            font-weight: 600;
            color: #495057;
            cursor: pointer;
            flex-shrink: 0;
        }

        .stepper-group button:hover {
            background: #e9ecef;
        }

        .stepper-group input {
            border: none;
            text-align: center;
            font-size: 13px;
            height: 34px;
            width: 100%;
            box-shadow: none !important;
        }

        .stepper-group input:focus {
            outline: none;
            box-shadow: none;
        }

        .stepper-unit {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #666;
            background: #f8f9fa;
            border-left: 1px solid #dee2e6;
            flex-shrink: 0;
        }

        .discount-options {
            display: flex;
            gap: 16px;
            margin-bottom: 10px;
        }

        .discount-option {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .discount-option input[type="radio"] {
            cursor: pointer;
        }

        .discount-option label {
            cursor: pointer;
            margin: 0;
            font-weight: normal;
            font-size: 13px;
        }

        .total-section {
            background: #fff;
            padding: 14px 0 0;
            border-top: 2px solid #0d6efd;
            margin-top: 6px;
            margin-bottom: 14px;
        }

        .total-section h5 {
            font-size: 15px;
            font-weight: 600;
            margin: 0;
        }

        .total-amount {
            font-size: 18px;
            color: #0d6efd;
            font-weight: 700;
        }

        @media (max-width: 900px) {
            .pos-layout {
                flex-direction: column;
            }

            .pos-cart {
                position: static;
                width: 100%;
                flex-basis: auto;
                max-height: none;
            }
        }
    </style>

    <div class="page-header" style="margin-bottom: 24px;">
        <div>
            <h1 class="page-title">Point of Sale</h1>
            <p class="page-subtitle">Pilih produk dan buat transaksi baru</p>
        </div>
    </div>

    {{-- Form membungkus semua konten, action & method disamakan dengan dokumen transaksi lama --}}
    <form action="{{ route('transaksi.store') }}" method="POST" id="posForm">
        @csrf
        <input type="hidden" name="kode_transaksi" value="{{ $kode }}">
        <input type="hidden" name="tanggal" value="{{ date('Y-m-d') }}">

        <div class="pos-layout">
            <!-- PRODUCT SECTION -->
            <div class="pos-main">
                <div class="pos-card">

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cari produk..."
                        id="search">

                    <div class="category-filter" id="category-filter">
                        <button type="button" class="category-chip active" data-kategori="all">Semua</button>
                        @foreach($kategori as $k)
                            <button type="button" class="category-chip" data-kategori="{{ $k->id }}">{{ $k->nama }}</button>
                        @endforeach
                    </div>

                    <div class="product-grid" id="product-grid">
                        @foreach($barang as $b)
                            <div class="product-list-item product-card"
                                data-id="{{ $b->id }}"
                                data-nama="{{ $b->nama }}"
                                data-harga="{{ $b->harga_jual }}"
                                data-stok="{{ $b->stok }}"
                                data-kategori="{{ $b->kategori_id }}">

                                <div class="product-img-wrap">
                                    <img src="{{ asset('storage/'.$b->foto) }}" alt="{{ $b->nama }}">
                                    <div class="product-overlay">
                                        <i data-lucide="plus" style="color: white; width: 32px; height: 32px;"></i>
                                    </div>
                                </div>

                                <div class="product-card-body">
                                    <h6>{{ $b->nama }}</h6>
                                    <div class="product-meta">
                                        <span class="stok-badge">{{ $b->stok }} Pcs</span>
                                        <span class="product-price">Rp {{ number_format($b->harga_jual,0,',','.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- CART SECTION -->
            <aside class="pos-cart">
                <!-- Header -->
                <div class="cart-header">
                    <h5>Keranjang</h5>
                    <button type="button" class="btn btn-sm btn-link text-secondary p-0" onclick="clearCart()" title="Bersihkan keranjang">Clear</button>
                </div>

                <!-- Cart Items -->
                <div class="cart-items-container" id="cart-items">
                    <div class="cart-empty">Kosong</div>
                </div>

                <!-- Footer -->
                <div class="cart-footer">
                    <!-- Kasir (Hidden) -->
                    <input type="hidden" id="kasir" name="kasir" value="{{ auth()->user()->name }}">

                    <!-- Customer / Member Selection -->
                    <div class="form-group-compact" style="margin-bottom: 12px;">
                        <label>Customer</label>
                        <div style="display: flex; gap: 8px;">
                            <select class="form-select form-select-sm" id="customer" name="nama_member" style="flex: 1;">
                                <option value="" data-diskon="0">Walk-in Customer</option>
                                @if(isset($member))
                                    @foreach($member as $m)
                                        <option value="{{ $m->nama }}" data-diskon="{{ $m->diskon_persen }}">{{ $m->nama }} (Diskon {{ $m->diskon_persen }}%)</option>
                                    @endforeach
                                @endif
                            </select>
                            <a href="#" class="btn btn-sm btn-outline-primary" style="flex: 0 0 auto; display: flex; align-items: center; justify-content: center; font-weight: 600; padding: 0 12px; font-size: 12px; border-color: #dee2e6;">+ Baru</a>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="form-group-compact">
                        <label>Metode pembayaran</label>
                        <select class="form-select form-select-sm" id="payment_method" name="payment_method">
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                            <option value="card">Kartu Kredit</option>
                        </select>
                    </div>

                    <hr class="my-3">

                    <!-- Discount Options (manual, tambahan di luar diskon member) -->
                    <label style="font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Diskon Tambahan</label>
                    <div class="discount-options">
                        <div class="discount-option">
                            <input type="radio" id="discount-percent" name="discount_type" value="percent" checked>
                            <label for="discount-percent">Persen (%)</label>
                        </div>
                        <div class="discount-option">
                            <input type="radio" id="discount-nominal" name="discount_type" value="nominal">
                            <label for="discount-nominal">Nominal (Rp)</label>
                        </div>
                    </div>

                    <div class="stepper-group mb-3">
                        <button type="button" onclick="stepValue('discount_value', -1)">−</button>
                        <input type="number" id="discount_value" name="discount_value" value="0">
                        <span class="stepper-unit" id="discount-unit">%</span>
                    </div>

                    <!-- Payment Amount -->
                    <div class="form-group-compact">
                        <label>Jumlah Pembayaran (Tunai)</label>
                        <div class="stepper-group">
                            <button type="button" onclick="stepValue('payment_amount', -1000)">−</button>
                            <input type="number" id="payment_amount" name="tunai" placeholder="0">
                            <button type="button" onclick="stepValue('payment_amount', 1000)" style="border-left:1px solid #dee2e6;">+</button>
                        </div>
                    </div>

                    <!-- Total Section -->
                    <div class="total-section">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <small style="color: #666;">Subtotal:</small>
                            <small style="color: #666;" id="subtotal-display">Rp0</small>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <small style="color: #666;">Diskon:</small>
                            <small style="color: #666;" id="discount-display">Rp0</small>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-top: 1px solid #e9ecef; padding-top: 8px;">
                            <h5 style="margin: 0;">Total:</h5>
                            <h5 class="total-amount" id="total" style="margin: 0;">Rp0</h5>
                        </div>
                    </div>

                    <!-- Change Display -->
                    <div style="padding: 12px; background: #e8f5e9; border-radius: 8px; margin-bottom: 15px; display: none;" id="change-section">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <small style="color: #2e7d32;">Pembayaran:</small>
                            <small style="color: #2e7d32;" id="payment-display">Rp0</small>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-top: 1px solid #4caf50; padding-top: 5px;">
                            <small style="color: #2e7d32; font-weight: 600;">Kembalian:</small>
                            <small style="color: #2e7d32; font-weight: 600;" id="change-display">Rp0</small>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <button type="button" class="btn btn-success w-100 fw-bold" id="saveBtn">
                        Simpan
                    </button>
                </div>
            </aside>
        </div>
    </form>

    <script>
        let cart = [];

        // Format Rupiah
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        }

        // Tombol stepper (-/+) untuk input angka, hanya bantu ubah value lalu trigger event 'input' yang sudah ada
        function stepValue(id, delta) {
            const input = document.getElementById(id);
            const current = parseInt(input.value) || 0;
            const next = Math.max(0, current + delta);
            input.value = next;
            input.dispatchEvent(new Event('input'));
        }

        // Filter gabungan: pencarian teks + kategori aktif
        let activeKategori = 'all';

        function applyProductFilter() {
            const keyword = document.getElementById('search').value.toLowerCase();
            const items = document.querySelectorAll('.product-list-item');
            let visibleCount = 0;

            items.forEach(item => {
                const nama = item.dataset.nama.toLowerCase();
                const kategori = item.dataset.kategori;

                const matchSearch = nama.includes(keyword);
                const matchKategori = activeKategori === 'all' || kategori === activeKategori;

                if (matchSearch && matchKategori) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            const grid = document.getElementById('product-grid');
            let emptyState = document.getElementById('product-empty-state');
            if (visibleCount === 0) {
                if (!emptyState) {
                    emptyState = document.createElement('div');
                    emptyState.id = 'product-empty-state';
                    emptyState.className = 'product-empty';
                    emptyState.textContent = 'Produk tidak ditemukan';
                    grid.appendChild(emptyState);
                }
            } else if (emptyState) {
                emptyState.remove();
            }
        }

        document.getElementById('search').addEventListener('input', applyProductFilter);

        document.querySelectorAll('.category-chip').forEach(chip => {
            chip.addEventListener('click', function() {
                document.querySelectorAll('.category-chip').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                activeKategori = this.dataset.kategori;
                applyProductFilter();
            });
        });

        // Tambah produk ke keranjang (bisa klik di seluruh area card)
        document.querySelectorAll('.product-list-item').forEach(item => {
            item.addEventListener('click', function(e) {

                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const harga = parseInt(this.dataset.harga);
                const stok = parseInt(this.dataset.stok);

                const existingItem = cart.find(item => item.id == id);

                if (existingItem) {
                    if (existingItem.qty < stok) {
                        existingItem.qty++;
                    } else {
                        alert('Stok tidak cukup');
                    }
                } else {
                    cart.push({
                        id: id,
                        nama: nama,
                        harga: harga,
                        stok: stok,
                        qty: 1
                    });
                }

                renderCart();
            });
        });

        // Render keranjang
        function renderCart() {
            const container = document.getElementById('cart-items');

            if (cart.length === 0) {
                container.innerHTML = '<div class="cart-empty">Kosong</div>';
            } else {
                container.innerHTML = cart.map((item, index) => `
                    <div class="cart-item">
                        <div class="cart-item-name">${item.nama}</div>
                        <div class="cart-item-qty stepper-group" style="height: 28px; width: 85px; margin: 0;">
                            <button type="button" onclick="decreaseQty(${index})" style="height: 28px; width: 28px; padding: 0; display: flex; align-items: center; justify-content: center; font-size: 14px;">-</button>
                            <input type="text" value="${item.qty}" style="height: 28px; padding: 0;" readonly>
                            <button type="button" onclick="increaseQty(${index})" style="height: 28px; width: 28px; padding: 0; display: flex; align-items: center; justify-content: center; font-size: 14px;">+</button>
                        </div>
                        <div style="text-align: right; min-width: 80px;">
                            <div style="font-size: 12px; color: #999;">Rp${number_format(item.harga)}</div>
                            <div style="font-weight: 600;">Rp${number_format(item.harga * item.qty)}</div>
                        </div>
                        <button type="button" class="cart-item-remove" onclick="removeItem(${index})">×</button>
                    </div>
                `).join('');
            }

            updateTotal();
        }

        // Helper format number
        function number_format(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Tambah qty
        function increaseQty(index) {
            if (cart[index].qty < cart[index].stok) {
                cart[index].qty++;
                renderCart();
            } else {
                alert('Stok tidak cukup');
            }
        }

        // Kurangi qty
        function decreaseQty(index) {
            if (cart[index].qty > 1) {
                cart[index].qty--;
                renderCart();
            } else {
                removeItem(index);
            }
        }

        // Hapus item
        function removeItem(index) {
            cart.splice(index, 1);
            renderCart();
        }

        // Ambil diskon persen dari member yang dipilih
        function getMemberDiskonPersen() {
            const select = document.getElementById('customer');
            const opt = select.selectedOptions[0];
            return opt ? (parseFloat(opt.dataset.diskon) || 0) : 0;
        }

        // Update total
        function updateTotal() {
            let subtotal = cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);

            const discountType = document.querySelector('input[name="discount_type"]:checked').value;
            const discountValue = parseInt(document.getElementById('discount_value').value) || 0;

            let manualDiscount = 0;
            if (discountType === 'percent') {
                manualDiscount = Math.round(subtotal * discountValue / 100);
            } else {
                manualDiscount = discountValue;
            }

            const memberDiskonPersen = getMemberDiskonPersen();
            const memberDiscount = Math.round(subtotal * memberDiskonPersen / 100);

            const totalDiscount = manualDiscount + memberDiscount;
            const total = subtotal - totalDiscount;

            // Update display
            document.getElementById('subtotal-display').textContent = formatRupiah(subtotal);
            document.getElementById('discount-display').textContent = formatRupiah(totalDiscount);
            document.getElementById('total').textContent = formatRupiah(total);

            // Update kembalian jika ada input pembayaran
            updateChange(total);
        }

        // Update kembalian
        function updateChange(total) {
            const paymentAmount = parseInt(document.getElementById('payment_amount').value) || 0;
            const changeSection = document.getElementById('change-section');

            if (paymentAmount > 0) {
                const change = paymentAmount - total;
                document.getElementById('payment-display').textContent = formatRupiah(paymentAmount);

                if (change >= 0) {
                    document.getElementById('change-display').textContent = formatRupiah(change);
                    document.getElementById('change-display').style.color = '#2e7d32';
                    changeSection.style.display = 'block';
                } else {
                    document.getElementById('change-display').textContent = 'Kurang: ' + formatRupiah(Math.abs(change));
                    document.getElementById('change-display').style.color = '#d32f2f';
                    changeSection.style.display = 'block';
                }
            } else {
                changeSection.style.display = 'none';
            }
        }

        // Event untuk diskon manual
        document.querySelectorAll('input[name="discount_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const unit = document.getElementById('discount-unit');
                unit.textContent = this.value === 'percent' ? '%' : 'Rp';
                updateTotal();
            });
        });

        document.getElementById('discount_value').addEventListener('input', updateTotal);
        document.getElementById('customer').addEventListener('change', updateTotal);
        document.getElementById('payment_amount').addEventListener('input', function() {
            updateTotal();
        });

        // Bersihkan keranjang
        function clearCart() {
            if (confirm('Yakin ingin mengosongkan keranjang?')) {
                cart = [];
                renderCart();
            }
        }

        // Hapus input hidden item lama sebelum generate ulang
        function clearDynamicItemInputs(form) {
            form.querySelectorAll('.dynamic-item-input').forEach(el => el.remove());
        }

        // Buat input hidden untuk 1 item
        function addHiddenInput(form, name, value) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            input.value = value;
            input.classList.add('dynamic-item-input');
            form.appendChild(input);
        }

        // Simpan transaksi -> submit form biasa (bukan fetch), action & fields disamakan dgn form transaksi lama
        document.getElementById('saveBtn').addEventListener('click', function() {
            if (cart.length === 0) {
                alert('Keranjang masih kosong');
                return;
            }

            const kasir = document.getElementById('kasir').value.trim();
            if (!kasir) {
                alert('Nama kasir wajib diisi');
                document.getElementById('kasir').focus();
                return;
            }

            const paymentMethod = document.getElementById('payment_method').value;
            const paymentAmount = parseInt(document.getElementById('payment_amount').value) || 0;

            const subtotal = cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);
            const discountType = document.querySelector('input[name="discount_type"]:checked').value;
            const discountValue = parseInt(document.getElementById('discount_value').value) || 0;
            let manualDiscount = 0;
            if (discountType === 'percent') {
                manualDiscount = Math.round(subtotal * discountValue / 100);
            } else {
                manualDiscount = discountValue;
            }
            const memberDiskonPersen = getMemberDiskonPersen();
            const memberDiscount = Math.round(subtotal * memberDiskonPersen / 100);
            const total = subtotal - manualDiscount - memberDiscount;

            // Validasi pembayaran cash
            if (paymentMethod === 'cash' && paymentAmount < total) {
                alert('Jumlah pembayaran kurang');
                return;
            }

            const form = document.getElementById('posForm');
            clearDynamicItemInputs(form);

            cart.forEach((item, i) => {
                addHiddenInput(form, `items[${i}][nama_barang]`, item.nama);
                addHiddenInput(form, `items[${i}][jumlah]`, item.qty);
                addHiddenInput(form, `items[${i}][harga_satuan]`, item.harga);
            });

            // Submit form seperti biasa (server-side render / redirect), sama seperti form transaksi lama
            form.submit();
        });
    </script>
@endsection