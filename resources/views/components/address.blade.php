<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @include('include.style')
</head>
<body>
<div class="container-checkout">
    <div class="py-2 text-center">
      <h2>Daftar Alamat</h2>
    </div>
    @if($shippingAddress)
    <p class="lead" id="lead">Edit Alamat Anda</p>
    @else
    <p class="lead" id="lead">Anda belum memiliki alamat pengiriman, lengkapi data Anda terlebih dahulu</p>
        @endif

        <form action="{{ route('editAddress') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">Nama Penerima</label>
                    <input type="text" class="form-control" id="firstName" name="penerima" placeholder="" value="{{ $shippingAddress->penerima ?? '' }}" required>
                    <div class="invalid-feedback">
                        Nama Penerima diperlukan.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Patokan</label>
                    <input type="text" class="form-control" id="lastName" name="patokan" placeholder="" value="{{ $shippingAddress->patokan ?? '' }}" required>
                    <div class="invalid-feedback">
                        Patokan diperlukan.
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="status">Tandai</label>
                <input type="text" class="form-control" id="status" name="status" placeholder="Rumah/Kantor..." value="{{ $shippingAddress->status ?? '' }}" required>
                <div class="invalid-feedback">
                    Tolong masukkan tanda alamat anda.
                </div>
            </div>
            <div class="mb-3">
                <label for="kode_pos">Kode Pos</label>
                <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Masukkan Kode Pos" value="{{ $shippingAddress->kode_pos ?? '' }}" required>
                <div class="invalid-feedback">
                    Tolong masukkan kode pos anda.
                </div>
            </div>
            <div class="mb-3">
                <label for="jalan">Jalan <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" id="jalan" name="jalan" placeholder="Jalan, No Rumah, dll ..." value="{{ $shippingAddress->jalan ?? '' }}">
            </div>
            <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="provinsi">Provinsi</label>
                    <select class="custom-select d-block w-100" id="provinsi" name="provinsi" required>
                        <option value="">{{ $shippingAddress->provinsi ?? 'Pilih Provinsi' }}</option>
                        <option value="United States" {{ ($shippingAddress->provinsi ?? '') == 'United States' ? 'selected' : '' }}>United States</option>
                        <option value="Indonesia" {{ ($shippingAddress->provinsi ?? '') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                        <option value="Malaysia" {{ ($shippingAddress->provinsi ?? '') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                        <option value="Papua Nugini" {{ ($shippingAddress->provinsi ?? '') == 'Papua Nugini' ? 'selected' : '' }}>Papua Nugini</option>
                        <option value="Konoha" {{ ($shippingAddress->provinsi ?? '') == 'Konoha' ? 'selected' : '' }}>Konoha</option>
                        <option value="Kwangya" {{ ($shippingAddress->provinsi ?? '') == 'Kwangya' ? 'selected' : '' }}>Kwangya</option>
                        <option value="Namex" {{ ($shippingAddress->provinsi ?? '') == 'Namex' ? 'selected' : '' }}>Namex</option>
                    </select>
                    <div class="invalid-feedback">
                        Silakan pilih provinsi yang valid.
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kabupaten">Kabupaten</label>
                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Masukkan kabupaten" value="{{ $shippingAddress->kabupaten ?? '' }}" required>
                    <div class="invalid-feedback">
                        Mohon masukkan nama kabupaten.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="kecamatan">Kecamatan</label>
                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Nama Kecamatan" value="{{ $shippingAddress->kecamatan ?? '' }}" required>
                    <div class="invalid-feedback">
                        Masukkan nama kecamatan anda.
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-secondary" id="submit-button" value="Selesai">
        </form>
    </div>
</body>
</html>