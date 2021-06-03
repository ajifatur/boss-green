@extends('admin.main')
@section('title')
  Boss Green Store - Kategori
@endsection
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-users"></i> Boss Green Store - Kategori</h1>
<!--           <p>Table to display analytical data effectively</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Boss Green Store</li>
          <li class="breadcrumb-item active"><a href="#">Kategori</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-title"><h3>List Kategori</h3></div>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th width="30px">ID</th>
                    <th>Kategori</th>
                    <th width="50px">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="idk" data-id="1">1</td>
                    <td class="nama" data-id="1">Pakaian</td>
                    <td align="center">
                      <a href="#" class="btn btn-sm btn-info edit" data-id="1" title="Edit"><i class="fa fa-edit" style="margin-right: 0px"></i></a>
                      <a href="#" class="btn btn-sm btn-danger delete" data-id="1" title="Hapus"><i class="fa fa-trash" style="margin-right: 0px"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <div class="tile-title"><h3>Tambah/Edit Kategori</h3></div>
            <form>
              <div class="tile-body">
                  <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control">
                    <input type="hidden" name="id" id="id" value="0">
                  </div>
              </div>
              <div class="tile-footer">
                <button type="button" id="store" class="btn btn-primary">Tambah</button>
                <button type="button" id="update" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
@section('js')
<script type="text/javascript">
$(document).on('click', '.edit', function(e){
  e.preventDefault();
  var id = $(this).data('id');
  var category = $('td.nama[data-id="'+id+'"]').text();
  $('#kategori').val(category);
  $('#id').val(id);
  $('#store').addClass('forbidden');
});

$(document).on('click', '.delete', function(e){
  e.preventDefault();
  var id = $(this).data('id');
  var ask = confirm('Kamu ingin menghapus kategori?');
  if(ask){
    $.ajax({
      type: 'get',
      url: '/admin/boss-green-store/hapus-kategori',
      data: {id: id},
      success: function(){
        window.location.href = '/admin/boss-green-store/kategori';
      }
    })
  }
});

$(document).on('click', '#store', function(e){
  e.preventDefault();
  var category = $('#kategori').val();
  var forbidden = $(this).hasClass('forbidden');
  if(!forbidden){
    $.ajax({
      type: 'post',
      url: 'process/manage-category.php',
      data: {category: category},
      success: function(){
        window.location.href = '/admin/boss-green-store/kategori';
      }
    })
  }
  else{
    alert('Refresh halaman dulu untuk menambahkan kategori');
    window.location.href = '/admin/boss-green-store/kategori';
  }
});

$(document).on('click', '#update', function(e){
  e.preventDefault();
  var category = $('#category').val();
  var id_category = $('#id_category').val();
  $.ajax({
    type: 'post',
    url: 'process/manage-category.php',
    data: {category: category, id_category: id_category},
    success: function(){
      window.location.href = 'category.php';
    }
  })
});

</script>
@endsection