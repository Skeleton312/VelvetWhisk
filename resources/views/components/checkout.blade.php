<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laman Checkout</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
</head>
<body>
  <div class="container-checkout">
    <div class="py-2 text-center">
      <h2>Laman Pembayaran</h2>
    </div>
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Ringkasan Belanja</span>
          <span class="badge badge-secondary badge-pill">{{$total}}</span>
        </h4>
        <form method="POST" action="/checkout/process">
        @csrf
        <ul class="list-group mb-3">
          @foreach($selectedItems as $item)
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">{{ $item['name'] }}</h6>
              <small class="text-muted">Rp {{ number_format($item['price'], 0, ',', '.') }} x {{ $item['quantity'] }}</small>
            </div>
            <span class="text-muted">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
          </li>
            <input type="hidden" name="items[{{ $loop->index }}][id]" value="{{ $item['id'] }}">
            <input type="hidden" name="items[{{ $loop->index }}][price]" value="{{ $item['price'] }}">
            <input type="hidden" name="items[{{ $loop->index }}][quantity]" value="{{ $item['quantity'] }}">
            <input type="hidden" name="items[{{ $loop->index }}][subtotal]" value="{{ $item['subtotal'] }}">
          </li>
          @endforeach
          <li class="list-group-item d-flex justify-content-between">
            <span>Total :</span>
            <strong>Rp {{ number_format($totalPrice, 0, ',', '.') }}</strong>
            <input type="hidden" name="payment_amount" value="{{$totalPrice}}">
          </li>
        </ul>
      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Alamat Pengiriman</h4>
        <div id="address-display">
          <p><strong>Nama Penerima:</strong> {{ $shippingAddress->penerima  }}</p>
          <p> {{ ucwords($shippingAddress->jalan)  }}, {{ ucwords($shippingAddress->kecamatan) }}, {{ ucwords($shippingAddress->kabupaten)  }}, {{ ucwords($shippingAddress->provinsi)  }}, {{ ucwords($shippingAddress->kode_pos)  }}, {{ ucwords($shippingAddress->patokan)  }}</p>
          <p><strong>Tandai Sebagai:</strong> {{ $shippingAddress->status }}</p>
        </div>
      </div>
    </div>
    <hr class="mb-4">
  
          <h4 class="mb-3">Pembayaran</h4>
  
          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" value="BRI" checked required>
              <label class="custom-control-label" for="credit">BRI</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" value="BCA" checked required>
              <label class="custom-control-label" for="debit">BCA</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" value="Mandiri" checked required>
              <label class="custom-control-label" for="paypal">MANDIRI</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" value="BNI" checked required>
              <label class="custom-control-label" for="paypal">BNI</label>
            </div>
          </div>
          <div>
            <h4>Rekening Velvet Whisk</h4>
            <h6>BRI : 1234-5678-9012-3456</h6>
            <h6>BCA : 0987-6543-2109-8765</h6>
            <h6>MANDIRI : 4567-8901-2345-6789</h6>
            <h6>DANA : 089-134-678-012</h6> 
        </div>
        <input class="btn btn-primary btn-lg btn-block my-3" type="submit" value="Checkout">
        </form>
        <a style="margin-left:48%;color:black;" href="javascript:history.back()">Kembali</a>
    <footer id="footer-checkout" class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2024 Velvet Whisk</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privasi</a></li>
        <li class="list-inline-item"><a href="#">Syarat dan Ketentuan</a></li>
        <li class="list-inline-item"><a href="#">Dukungan</a></li>
      </ul>
    </footer>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    (function () {
      'use strict';
      window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function (form) {
          form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });

        document.getElementById('edit-address').addEventListener('click', function() {
          document.getElementById('address-display').style.display = 'none';
          document.getElementById('address-form').style.display = 'block';
        });
      }, false);
    })();
    document.addEventListener("DOMContentLoaded", function() {
      var editAddressButton = document.getElementById("edit-address");
      var addressDisplay = document.getElementById("address-display");
      var addressForm = document.getElementById("address-form");
      var lead = document.getElementById("lead")

      editAddressButton.addEventListener("click", function() {
        addressDisplay.classList.add("hidden");
        addressForm.classList.remove("hidden");
        lead.innerHTML="Edit Alamat Anda";
      });
    });
  </script>
</body>
</html>
