@extends('admin.main')
@section('title')
  Boss Sampah - Harga Sampah
@endsection
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-trash"></i> Boss Sampah - Harga Sampah</h1>
<!--           <p>Table to display analytical data effectively</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Boss Sampah</li>
          <li class="breadcrumb-item active"><a href="#">Harga Sampah</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <div class="tile">
            <h3 class="tile-title">Harga Sampah</h3>
            <form class="form-horizontal" method="post" action="{{ route('admin.updatesampah') }}">
              @csrf
              <div class="tile-body">
                @if(Session::get('message'))
                <div class="alert alert-dismissible alert-success">
                  <button class="close" type="button" data-dismiss="alert">×</button>{{ Session::get('message') }}
                </div>
                @endif
                <div class="form-group row">
                  <label class="control-label col-md-3">Harga per Kg</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="harga" id="harga-text" value="Rp. {{ number_format($harga->harga) }}">
                    <small style="color: #999">Ribuan dipisahkan dengan koma</small>
                  </div>
                </div>
              </div>
              <div class="tile-footer">
                <div class="row">
                  <div class="col-md-8 col-md-offset-3">
                    <button class="btn btn-primary" type="submit" id="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
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
    $(document).on('change', '#harga-text', function(){
      var money = $(this).val();
      $.ajax({
        type: 'get',
        url: '/admin/boss-sampah/ubah-format-uang/sampah',
        data: {money: money},
        success: function(response){
          $('#harga-text').val(response);
        }
      })
    })
  </script>
@endsection