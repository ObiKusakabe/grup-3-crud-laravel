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

        .add-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #28a745;
            color: #fff;
            border: none;
            font-size: 16px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            transition: background 0.2s ease;
        }

        .add-btn:hover {
            background: #218838;
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

    <div class="pos-layout">
        <!-- PRODUCT SECTION -->
        <div class="pos-main">
            <div class="pos-card">
                <h5>Point of Sale</h5>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Cari produk..."
                    id="search">

                <div class="product-grid" id="product-grid">
                    @foreach($barang as $b)
                        <div class="product-list-item product-card"
                            data-id="{{ $b->id }}"
                            data-nama="{{ $b->nama }}"
                            data-harga="{{ $b->harga_jual }}"
                            data-stok="{{ $b->stok }}">

                            <div class="product-img-wrap">
                                <img src="{{ asset('storage/'.$b->foto) }}" alt="{{ $b->nama }}">
                                <button class="add-btn" title="Tambah ke keranjang">+</button>
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
                <button class="btn btn-sm btn-link text-secondary p-0" onclick="clearCart()" title="Bersihkan keranjang">Clear</button>
            </div>

            <!-- Cart Items -->
            <div class="cart-items-container" id="cart-items">
                <div class="cart-empty">Kosong</div>
            </div>

            <!-- Footer -->
            <div class="cart-footer">
                <!-- Customer Selection -->
                <div class="form-group-compact">
                    <label>Customer</label>
                    <select class="form-select form-select-sm" id="customer">
                        <option value="">Walk-in Customer</option>
                        @if(isset($members))
                            @foreach($members as $member)
                                <option value="{{ $member->id }}">{{ $member->nama }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div style="text-align: right; font-size: 12px; color: #0d6efd; cursor: pointer; margin-bottom: 12px;">
                    <a href="#" style="text-decoration: none;">+ Tambah customer baru.</a>
                </div>

                <!-- Payment Method -->
                <div class="form-group-compact">
                    <label>Metode pembayaran</label>
                    <select class="form-select form-select-sm" id="payment_method">
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        <option value="card">Kartu Kredit</option>
                    </select>
                </div>

                <hr class="my-3">

                <!-- Discount Options -->
                <label style="font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Diskon</label>
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
                    <input type="number" id="discount_value" value="0">
                    <span class="stepper-unit" id="discount-unit">%</span>
                </div>

                <!-- Payment Amount -->
                <div class="form-group-compact">
                    <label>Jumlah Pembayaran</label>
                    <div class="stepper-group">
                        <button type="button" onclick="stepValue('payment_amount', -1000)">−</button>
                        <input type="number" id="payment_amount" placeholder="0">
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
                <button class="btn btn-success w-100 fw-bold" id="saveBtn">
                    Simpan
                </button>
            </div>
        </aside>
    </div>

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

        // Tambah produk ke keranjang
        document.querySelectorAll('.product-list-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (!e.target.classList.contains('add-btn')) return;

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
                        <div class="cart-item-qty">
                            <button class="btn btn-sm btn-light" onclick="decreaseQty(${index})">-</button>
                            <input type="text" class="form-control form-control-sm text-center" value="${item.qty}" style="width: 35px; border: none; padding: 2px;" readonly>
                            <button class="btn btn-sm btn-light" onclick="increaseQty(${index})">+</button>
                        </div>
                        <div style="text-align: right; min-width: 80px;">
                            <div style="font-size: 12px; color: #999;">Rp${number_format(item.harga)}</div>
                            <div style="font-weight: 600;">Rp${number_format(item.harga * item.qty)}</div>
                        </div>
                        <button class="cart-item-remove" onclick="removeItem(${index})">×</button>
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

        // Update total
        function updateTotal() {
            let subtotal = cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);

            const discountType = document.querySelector('input[name="discount_type"]:checked').value;
            const discountValue = parseInt(document.getElementById('discount_value').value) || 0;

            let discount = 0;
            if (discountType === 'percent') {
                discount = Math.round(subtotal * discountValue / 100);
            } else {
                discount = discountValue;
            }

            const total = subtotal - discount;

            // Update display
            document.getElementById('subtotal-display').textContent = formatRupiah(subtotal);
            document.getElementById('discount-display').textContent = formatRupiah(discount);
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

        // Event untuk diskon
        document.querySelectorAll('input[name="discount_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const unit = document.getElementById('discount-unit');
                unit.textContent = this.value === 'percent' ? '%' : 'Rp';
                updateTotal();
            });
        });

        document.getElementById('discount_value').addEventListener('input', updateTotal);

        document.getElementById('payment_amount').addEventListener('input', function() {
            const subtotal = cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);
            const discountType = document.querySelector('input[name="discount_type"]:checked').value;
            const discountValue = parseInt(document.getElementById('discount_value').value) || 0;

            let discount = 0;
            if (discountType === 'percent') {
                discount = Math.round(subtotal * discountValue / 100);
            } else {
                discount = discountValue;
            }

            const total = subtotal - discount;
            updateChange(total);
        });

        // Bersihkan keranjang
        function clearCart() {
            if (confirm('Yakin ingin mengosongkan keranjang?')) {
                cart = [];
                renderCart();
            }
        }

        // Simpan transaksi
        document.getElementById('saveBtn').addEventListener('click', function() {
            if (cart.length === 0) {
                alert('Keranjang masih kosong');
                return;
            }

            const customer_id = document.getElementById('customer').value || null;
            const payment_method = document.getElementById('payment_method').value;
            const payment_amount = parseInt(document.getElementById('payment_amount').value) || 0;
            const discount_type = document.querySelector('input[name="discount_type"]:checked').value;
            const discount_value = parseInt(document.getElementById('discount_value').value) || 0;

            const subtotal = cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);
            let discount = 0;
            if (discount_type === 'percent') {
                discount = Math.round(subtotal * discount_value / 100);
            } else {
                discount = discount_value;
            }

            const total = subtotal - discount;

            // Validasi pembayaran
            if (payment_method === 'cash' && payment_amount < total) {
                alert('Jumlah pembayaran kurang');
                return;
            }

            // Siapkan data untuk dikirim ke server
            const data = {
                customer_id: customer_id,
                payment_method: payment_method,
                payment_amount: payment_amount,
                discount_type: discount_type,
                discount_value: discount_value,
                discount_amount: discount,
                subtotal: subtotal,
                total: total,
                items: cart.map(item => ({
                    barang_id: item.id,
                    qty: item.qty,
                    harga: item.harga
                }))
            };

            console.log('Data transaksi:', data);

            // TODO: Kirim ke server dengan AJAX/fetch
            // fetch('/transaksi', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            //     },
            //     body: JSON.stringify(data)
            // }).then(response => response.json())
            //   .then(data => {
            //       alert('Transaksi berhasil disimpan');
            //       cart = [];
            //       renderCart();
            //   });
        });
    </script>
@endsection