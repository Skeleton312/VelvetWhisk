<x-app-layout>
    <div class="cart-parent">
    @if($cartItems->isEmpty())
        <p>Keranjang belanja Anda kosong.</p>
    @else
    <div class="select-all">
        <input type="checkbox" id="select-all">
        <label for="select-all">Select All</label>
    </div>
        <ul>
            @foreach($cartItems as $item)
                <div class="cart">
                        <div class="kiri">
                            <input type="checkbox" class="select-item" data-cart="{{$item->id_cart}}" data-id="{{ $item->product->product_id}}" data-item="{{ $item->product->nama}}" data-price="{{ $item->product->harga }}" data-quantity="{{ $item->jumlah }}">
                            <img src="{{ asset('data_gambar/' . $item->product->gambar) }}" alt="Gambar Produk">
                            <div class="product-info">
                                <p class="nama-cart">{{ $item->product->nama }}</p>
                                <p class="harga-cart"><a>Rp </a>{{ number_format($item->product->harga, 0, ',', '.') }}</p>
                            </div>
                            <div class="number">
                                <span class="minus" data-id="{{ $item->product->product_id }}">-</span>
                                <input type="text" class="jumlah" value="{{ $item->jumlah }}" readonly />
                                <span class="plus" data-id="{{ $item->product->product_id }}">+</span>
                            </div>
                        </div>
                </div>
            @endforeach
        </ul>
    @endif
    </div>
    <!-- Popup for subtotal and total price -->
    <div class="popup-cart" id="popup">
        <div class="produk">
            <h3>Selected Items</h3>
            <div id="selected-items"></div>
            <div class="total">
                <p>Total Price: <span id="total-price">Rp 0</span></p>
            </div>
            @if($shippingAddress)
            <button style='margin-top:1rem;' id="checkout">Checkout</button>
            @else
            <a href="{{route('address') }}"><button style='margin-top:1rem;' class="btn btn-secondary" id="edit-address" >Checkout</button><a>
            @endif
            <a><button style='margin-top:1rem; background-color:white; color:black; border:2px solid #964940' id='hapus'>Hapus</button></a>
        </div>
        <div id="address-display">
        @if($shippingAddress)
            <h4 class="mb-3">Alamat Pengiriman</h4>
          <p><strong>Nama Penerima:</strong> {{ $shippingAddress->penerima  }}</p>
          <p> {{ ucwords($shippingAddress->jalan)  }}, {{ ucwords($shippingAddress->kecamatan) }}, {{ ucwords($shippingAddress->kabupaten)  }}, {{ ucwords($shippingAddress->provinsi)  }}, {{ ucwords($shippingAddress->kode_pos)  }}, {{ ucwords($shippingAddress->patokan)  }}</p>
          <p><strong>Tandai Sebagai:</strong> {{ $shippingAddress->status }}</p>
          <a href="{{route('address') }}"><button class="btn btn-secondary" id="edit-address" >Edit Alamat</button><a>
        </div>
        @else
            <p><strong style="color: #A02222;">Checkout sekarang? </strong>Isi alamat Pengiriman terlebih dahulu</p>
            <a href="{{route('address') }}"><button>Tambah Alamat</button></a>
            </div>
        @endif
        </div>
    </div>
        <!-- Hidden form for checkout -->
    <form id="checkout-form" action="{{ url('/checkout') }}" method="POST" style="display:none;">
    @csrf
        <input type="hidden" name="selected_items" id="selected-items-input">
        <input type="hidden" name="total_price" id="total-price-input">
    </form>
    <form id="delete-form" action="{{ url('/delete-cart') }}" method="POST" style="display:none;">
    @csrf
        <input type="hidden" name="cart_id" id="selected-items-delete">
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.minus').forEach(function (button) {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            updateCart(productId, 'decrease');
        });
    });

    document.querySelectorAll('.plus').forEach(function (button) {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                updateCart(productId, 'increase');
            });
        });
    });
    document.getElementById('select-all').addEventListener('change', function(e) {
        const isChecked = e.target.checked;
        document.querySelectorAll('.select-item').forEach(checkbox => {
            checkbox.checked = isChecked;
        });
    });

    function updateCart(productId, action) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                product_id: productId,
                action: action
            })
        })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const input = document.querySelector(`.plus[data-id="${productId}"]`).previousElementSibling;
            input.value = data.new_quantity;
        } else {
            alert('Something went wrong!');
        }
    })
    .catch(error => console.error('Error:', error));
    }
    document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const itemCheckboxes = document.querySelectorAll('.select-item');
    const popup = document.getElementById('popup');
    const selectedItemsContainer = document.getElementById('selected-items');
    const totalPriceElement = document.getElementById('total-price');
    const checkoutButton = document.getElementById('checkout');
    const checkoutForm = document.getElementById('checkout-form');
    const deleteForm = document.getElementById('delete-form');
    const selectedItemsInput = document.getElementById('selected-items-input');
    const selectedItemsDelete = document.getElementById('selected-items-delete');
    const totalPriceInput = document.getElementById('total-price-input');
    const hapus = document.getElementById('hapus');

    selectAllCheckbox.addEventListener('change', function(e) {
        const isChecked = e.target.checked;
        itemCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        updatePopup();
    });

    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updatePopup();
        });
    });

    checkoutButton.addEventListener('click', function() {
        const selectedItems = [];
        itemCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const name = checkbox.dataset.item;
                const price = parseFloat(checkbox.dataset.price);
                const quantity = parseInt(checkbox.dataset.quantity);
                const id = checkbox.dataset.id
                const subtotal = price * quantity;
                selectedItems.push({ name, price, quantity, subtotal, id });
            }
        });

        selectedItemsInput.value = JSON.stringify(selectedItems);
        totalPriceInput.value = totalPriceElement.textContent.replace('Rp ', '').replace(/\./g, '');
        checkoutForm.submit();
    });
    hapus.addEventListener('click', function(){
        const selectedItems = [];
        itemCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const id = parseInt(checkbox.dataset.cart);
                selectedItems.push({id});
            }
        });

        selectedItemsDelete.value = JSON.stringify(selectedItems);
        deleteForm.submit();
    });
    function updatePopup() {
        let total = 0;
        selectedItemsContainer.innerHTML = '';

        itemCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const name = checkbox.dataset.item;
                const price = parseFloat(checkbox.dataset.price);
                const quantity = parseInt(checkbox.dataset.quantity);
                const subtotal = price * quantity;
                total += subtotal;

                const itemInfo = document.createElement('div');
                itemInfo.textContent = `${name}: Rp ${price.toLocaleString('id-ID')} x ${quantity} = Rp ${subtotal.toLocaleString('id-ID')}`;
                selectedItemsContainer.appendChild(itemInfo);
            }
        });

        totalPriceElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        popup.style.display = total > 0 ? 'block' : 'none';
    }
    });
    </script>
</x-app-layout>