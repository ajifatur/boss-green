@extends('kurir.main')
@section('title')
  Boss Sampah - Verifikasi
@endsection
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-trash"></i> Boss Sampah - Verifikasi</h1>
<!--           <p>Table to display analytical data effectively</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Boss Sampah</li>
          <li class="breadcrumb-item active"><a href="#">Verifikasi</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <div class="tile">
            <h3 class="tile-title">Verifikasi Sampah</h3>
            <form class="form-horizontal" method="post" action="{{ route('kurir.verifikasi') }}">
              @csrf
              <div class="tile-body">
                  <div class="form-group row">
                    <label class="control-label col-md-3">Berat (Kg)</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" id="berat" name="berat" placeholder="Masukkan berat (kg)" required>
                      <small style="color: #999">Jika hasil bukan bilangan bulat maka ditulis dengan titik. Contoh: 12.5</small>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3">Harga</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" value="Rp. {{ number_format($harga) }}" readonly>
                      <input class="form-control" type="hidden" name="harga" id="harga" value="{{ $harga }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3">Total Harga</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" id="total_harga" value="Rp. 0" readonly>
                      <input class="form-control" type="hidden" id="total_harga_hidden" name="total_harga">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3">Tambahkan Uang ke Saldo?</label>
                    <div class="col-md-8">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="tambah" value="1" checked>Ya
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="tambah" value="0">Tidak
                        </label>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="id" value="{{ $id }}">
              </div>
              <div class="tile-footer">
                <div class="row">
                  <div class="col-md-8 col-md-offset-3">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
@section('js')
  <script type="text/javascript">
    $(document).on('change', '#berat', function(){
      var berat = $(this).val();
      var harga = $('#harga').val();
      $.ajax({
        type: 'get',
        url: '/kurir/hitung-harga-sampah',
        data: {berat: berat, harga: harga},
        success: function(response){
          var hasil = JSON.parse(response);
          $('#total_harga').val(hasil.rupiah);
          $('#total_harga_hidden').val(hasil.angka);
          console.log(response);
        }
      })
    })
  </script>
@endsection