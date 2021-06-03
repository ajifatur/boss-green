@extends('kurir.main')
@section('title')
  Boss Sampah - 
  @if($taken == 'belum-diambil')
    Belum Diambil
  @elseif($taken == 'akan-diambil')
    Akan Diambil
  @elseif($taken == 'sudah-diambil')
    Sudah Diambil
  @endif
@endsection
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-trash"></i> Boss Sampah - @if($taken == 'belum-diambil') Belum Diambil @elseif($taken == 'akan-diambil') Akan Diambil @elseif($taken == 'sudah-diambil') Sudah Diambil @endif </h1>
<!--           <p>Table to display analytical data effectively</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Boss Sampah</li>
          <li class="breadcrumb-item active"><a href="#">@if($taken == 'belum-diambil') Belum Diambil @elseif($taken == 'akan-diambil') Akan Diambil @elseif($taken == 'sudah-diambil') Sudah Diambil @endif</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th width="40px">ID</th>
                    <th>Alamat</th>
                    <th>Waktu Ambil Sampah</th>
                    <th>Member</th>
                    @if($taken == 'sudah-diambil')
                    <th>Kurir</th>
                    <th>Berat (Kg)</th>
                    <th>Harga (Rp.)</th>
                    @endif
                    @if($taken != 'sudah-diambil')
                    <th width="60px">Opsi</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @foreach($boss_sampah as $order)
                  <tr>
                    <td>{{ $order->id_boss_sampah }}</td>
                    <td>
                      <strong>Jenis Tempat:</strong> {{ $alamat[$order->id_boss_sampah][0]['jenis'] }}<br>
                      <strong>Alamat Penjemputan:</strong> {{ $alamat[$order->id_boss_sampah][0]['alamat'] }}<br>
                      <strong>Kelurahan:</strong> {{ $alamat[$order->id_boss_sampah][0]['kelurahan'] }}<br>
                      <strong>Kecamatan:</strong> {{ $alamat[$order->id_boss_sampah][0]['kecamatan'] }}<br>
                      <strong>Kota:</strong> {{ $alamat[$order->id_boss_sampah][0]['kota'] }}<br>
                      <strong>Provinsi:</strong> {{ $alamat[$order->id_boss_sampah][0]['provinsi'] }}<br>
                    </td>
                    <td>{{ $order->waktu_ambil_sampah }}</td>
                    <td>{{ $order->member->name }}</td>
                    @if($taken == 'sudah-diambil')
                    <td>{{ $order->kurir->name }}</td>
                    <td>{{ $order->berat }}</td>
                    <td>{{ number_format($order->total_harga) }}</td>
                    @endif
                    @if($taken == 'belum-diambil')
                    <td align="center">
                      <a class="btn btn-sm btn-info jemput" href="#" title="Jemput" data-id="{{ $order->id_boss_sampah }}"><i class="fa fa-motorcycle"></i></a>
                    </td>
                    @elseif($taken == 'akan-diambil')
                    <td align="center">
                      <a class="btn btn-sm btn-info" href="/kurir/boss-sampah/verifikasi/{{ $order->id_boss_sampah }}" title="Verifikasi"><i class="fa fa-check"></i></a>&nbsp;
                      <a class="btn btn-sm btn-danger batal-jemput" href="#" title="Batal Jemput" data-id="{{ $order->id_boss_sampah }}"><i class="fa fa-times"></i></a>
                    </td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
    <style type="text/css">
      .btn .fa {margin-right: 0}
    </style>
@endsection
@section('js')
  <script type="text/javascript">
    $(document).on('click', '.jemput', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      $.ajax({
        type: 'get',
        url: '/kurir/boss-sampah/jemput/'+id,
        data: {id: id},
        success: function(){
          window.location.href = '/kurir/boss-sampah/akan-diambil';
        }
      })
    })

    $(document).on('click', '.batal-jemput', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      $.ajax({
        type: 'get',
        url: '/kurir/boss-sampah/batal-jemput/'+id,
        data: {id: id},
        success: function(){
          window.location.href = '/kurir/boss-sampah/belum-diambil';
        }
      })
    })
  </script>
@endsection