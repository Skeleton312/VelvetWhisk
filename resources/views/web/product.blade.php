<x-app-layout>
<div class="group-10">
        <li class="menu-item"><a href="{{ route('products.filter', 'Kue Tradisional') }}">Kue Tradisional</a></li>
        <li class="menu-item"><a href="{{ route('products.filter', 'Roti') }}">Roti</a></li>
        <li class="menu-item"><a href="{{ route('products.filter', 'Cookies') }}">Cookies</a></li>
        <li class="menu-item"><a href="{{ route('products.filter', 'Donut') }}">Donut</a></li>
        <li class="menu-item"><a href="{{ route('products.filter', 'Pastry') }}">Pastry</a></li>
        <li class="menu-item"><a href="{{ route('products.filter', 'Cake') }}">Cake</a></li>
        <li class="menu-item"><a href="{{ route('products.filter', 'Tart') }}">Tart</a></li>
        <li class="menu-item"><a href="{{ route('products.filter', 'Pudding') }}">Pudding</a></li>
</div>
<div class="parent-container">
    @if(session('success'))
        <script>
            // Show a JavaScript alert with the success message
            alert("{{ session('success') }}");
        </script>
    @endif
    <div class="card-container">
        @foreach ($product as $products)
        <div class="card" onclick="showPopup('{{ $products->nama }}', '{{ $products->deskripsi }}', '{{ $products->harga }}', '{{ URL::asset('data_gambar/' . $products->gambar) }}', '{{ $products->product_id}}')">
            <img src="{{ asset('data_gambar/' . $products->gambar) }}" alt="Card 1">
                <h2>{{ $products->nama }}</h2>
                <p><a>Rp </a>{{ number_format($products->harga, 0, ',', '.') }}</p>
        </div>
        @endforeach
    </div>
</div>
<div style= "background-color: white; padding-left:2rem;padding-right:2rem; border-radius:1rem;" id="popup-container" class="popup-container">
    <div  class="popup-content">
        <button id="close-btn" class="close-btn">&times;</button>
        <div class="popup-inner">
            <img id="popup-img" src="" alt="Product Image">
            <div class="kanan">
                <h2 id="popup-name"></h2>
                <p class='harga_popup' id="popup-price"></p>
                <p id="popup-description"></p>
                <div class="popup-buttons">
                    <form id="add-to-cart-form" action="/cart" method='post'>
                    @csrf
                        <input type=hidden value="" name="product_id" id='product-id-input'>
                        <input type="submit" class="add-to-cart-btn" value="Tambahkan ke Keranjang">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    </form>
                    <form id="buy-btn" action="{{ route('checkout.singleItem') }}" method="POST">
                    @csrf
                        <input type=hidden value="" name="product_id" id='product-id-beli'>
                        <input type="submit" name="selected_items"  class="button-beli" value="Beli">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    </form>
                </div>
                <p id="success-message" style="color: green; display: none;"></p>
            </div>
        </div>
    </div>
</div>

<script> 
const popupContainer = document.getElementById('popup-container');
const overlay = document.createElement('div');
overlay.classList.add('overlay');
document.body.appendChild(overlay);
const closeBtn = document.getElementById('close-btn');
const addToCartBtn = document.getElementById('add-to-cart-btn');
const buyBtn = document.getElementById('buy-btn');

// Fungsi untuk menampilkan popup
function showPopup(name, description, price, imageUrl, idproduk) {
    document.getElementById('popup-name').textContent = name;
    document.getElementById('popup-description').textContent = description;
    document.getElementById('popup-price').textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price);
    document.getElementById('popup-img').src = imageUrl;
    popupContainer.style.display = 'block';
    overlay.style.display = 'block';
    var newValue = idproduk; 
    document.getElementById('product-id-input').value = newValue;
    document.getElementById('product-id-beli').value = newValue;
}
// Fungsi untuk menyembunyikan popup
function hidePopup() {
    popupContainer.style.display = 'none';
    overlay.style.display = 'none';
}

// Event listener untuk tombol-tombol
closeBtn.addEventListener('click', hidePopup);
overlay.addEventListener('click', hidePopup);

// Contoh penggunaan: ketika card diklik, panggil fungsi showPopup
const card = document.getElementById('card');
card.addEventListener('click', function() {
    // Ambil data produk dari card
    const name = "Nama Produk";
    const description = "Deskripsi Produk";
    const price = "Rp 100.000";
    const imageUrl = "gambar_produk.jpg";
    showPopup(name, description, price, imageUrl);
});

</script>

</x-app-layout>