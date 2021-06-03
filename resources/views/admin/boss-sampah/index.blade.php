@extends('admin.main')
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
          <li class="breadcrumb-item active"><a href="#">@if($taken == 'belum-diambil') Belum Diambil @elseif($taken == 'akan-diambil') Akan Diambil @elseif($taken == 'sudah-diambil') Sudah Diambil @endif </a></li>
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
                    @elseif($taken == 'akan-diambil')
                    <th>Kurir</th>
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
                    @elseif($taken == 'akan-diambil')
                    <td>{{ $order->kurir->name }}</td>
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
@endsection