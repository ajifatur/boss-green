@extends('admin.main')
@section('title')
  Boss Green Store - Semua Produk
@endsection
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-users"></i> Boss Green Store - Semua Produk</h1>
<!--           <p>Table to display analytical data effectively</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Boss Green Store</li>
          <li class="breadcrumb-item active"><a href="#">Semua Produk</a></li>
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
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                  <tr>
                    <td>{{ $product->id_produk }}</td>
                    <td>{{ $product->produk }}</td>
                    <td>Rp. {{ number_format($product->harga,0,'.','.') }}</td>
                    <td>{{ $product->stok }}</td>
                    <td>{{ $product->kategori }}</td>
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
@section('js')
<script type="text/javascript">
  $('.alert').fadeOut(3000);
</script>
@endsection