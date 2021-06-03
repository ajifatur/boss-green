@extends('admin.main')
@section('title')
  Boss Green Store - Tambah Produk
@endsection
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-trash"></i> Tambah Produk</h1>
<!--           <p>Table to display analytical data effectively</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Boss Green Store</li>
          <li class="breadcrumb-item active"><a href="#">Tambah Produk</a></li>
        </ul>
      </div>
      <form class="form-horizontal" method="post" action="/admin/boss-green-store/simpan-produk" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-12">
            <div class="tile">
              <h3 class="tile-title">Tambah Produk</h3>
              @csrf
              <div class="tile-body">
                <div class="form-group row">
                  <label class="control-label col-md-3">Nama Produk</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="produk" placeholder="Nama Produk" required autofocus>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Harga</label>
                  <div class="col-md-8">
                      <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Stok</label>
                  <div class="col-md-8">
                      <input type="number" class="form-control" name="stok" placeholder="Stok" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Deskripsi</label>
                  <div class="col-md-8">
                    <textarea class="form-control" name="deskripsi" placeholder="Deskripsi"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Kategori</label>
                  <div class="col-md-8">
                    <select class="custom-select" name="kategori">
                      <option value="" disabled selected>--Pilih Kategori--</option>
                      <option value="1">Pakaian</option>
                      <option value="2" disabled>Kamera</option>
                      <option value="3" disabled>Smartphone</option>
                      <option value="4" disabled>Tas</option>
                      <option value="5" disabled>Sepatu</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Tag</label>
                  <div class="col-md-8">
                      <input type="text" class="form-control" name="tag" placeholder="Tag" required>
                  </div>
                </div>
<!--                 <div class="form-group row">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Open modal
                  </button>
                </div> -->
                <div class="form-group row">
                  <label class="control-label col-md-3">Gambar</label>
                  <div class="col-md-8">
                    <input type="file" id="image" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3"></div>
                  <div class="col-md-8"><div class="row" id="images"></div></div>
                </div>
              </div>
              <div class="tile-footer">
                <div class="row">
                  <div class="col-md-8 col-md-offset-3">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </main>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-footer">
        <button type="button" id="crop" class="btn btn-success" data-dismiss="modal">Crop</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <div id="upload-image"></div>
      </div>

    </div>
  </div>
</div>
@endsection
@section('js')
  <script type="text/javascript">
    $(document).on('change', '#harga', function(){
      var money = $(this).val();
      $.ajax({
        type: 'get',
        url: '/admin/boss-sampah/ubah-format-uang/sampah',
        data: {money: money},
        success: function(response){
          $('#harga').val(response);
        }
      })
    })
  </script>

  <script type="text/javascript">
  $image_crop = $('#upload-image').croppie({
    enableExif: true,
    viewport: {
      width: 400,
      height: 400,
      type: 'square'
    },
    boundary: {
      width: 500,
      height: 500
    }
  });

  $('#image').on('change', function () { 
    var reader = new FileReader();
    reader.onload = function (e) {
      $image_crop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });     
    }
    reader.readAsDataURL(this.files[0]);
    $('#myModal').modal();
  });

  $('#crop').on('click', function (ev) {
    ev.preventDefault();
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function (response) {
        $('#images').append('<div class="col-auto" style="margin-bottom:15px"><img class="img" src="'+response+'" width="100" style="border:1px solid #999; margin-right:10px"><a href="#" class="btn btn-sm btn-danger delete-image" style="margin-right:10px; vertical-align:top"><i class="fa fa-times" style="margin-right:0px; vertical-align:baseline"></i></a><input type="hidden" name="image[]" value="'+response+'"></div>');
          //console.log(response);
    });
  });

  $(document).on('click', '.delete-image', function(e){
    e.preventDefault();
    $(this).parent().remove();
  })
</script>

@endsection