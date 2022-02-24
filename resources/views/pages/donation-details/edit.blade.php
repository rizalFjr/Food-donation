@extends('layouts.default')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Food</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/donation">Donation</a></li>
            <li class="breadcrumb-item active">Food</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content-header -->
  
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Form Edit Food</h3>
                  </div>
                  <form action="{{ route('update-food', $food->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                      <input type="hidden" class="form-control" id="donations_id" name="donations_id" placeholder="Enter name"  value="{{ $food->donations_id }}" required>
                      <div class="form-group">
                        <label for="donation_categories_id">Kategori</label>
                        <select class="form-control" id="donation_categories_id" name="donation_categories_id" value="{{ old('donation_categories_id') }}">
                          @foreach ($categories as $category)
                            @if ($food->donation_categories_id == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="nama_barang">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Enter name"  value="{{ old('nama_barang') ?? $food->nama_barang }}" required>
                      </div>
                      <div class="form-group">
                        <label for="jumlah">Jumlah <span class="text-danger">*</span></label>
                        <div class="row">
                          <div class="col-9">
                            <input type="number" class="form-control" min="1" id="jumlah" name="jumlah" placeholder="Enter jumlah"  value="{{ old('jumlah') ?? $food->jumlah }}" required>
                          </div>
                          <div class="col-3">
                            <select class="form-control" id="quantities_id" name="quantities_id" value="{{ old('quantities_id') }}">
                              @foreach ($quantities as $quantity)
                                @if ($food->quantities_id == $quantity->id)
                                    <option value="{{ $quantity->id }}" selected>{{ $quantity->name }}</option>
                                @else
                                <option value="{{ $quantity->id }}">{{ $quantity->name }}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="row">
                          <div class="col-3">
                            <a id="image-click">
                              <img class="rounded" id="image-resource" src="{{ $food->foto ? asset('/uploads/images/food/'.$food->foto) : asset('/uploads/images/food/no-image.jpg') }}" alt="foto {{ $food->nama_barang }}" width="250" />
                            </a>
                          </div>
                          <div class="col-9">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="foto" name="foto" accept="image/*">
                              <label class="custom-file-label" for="foto">Change picture</label>
                            </div>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <p><span class="text-danger">*</span> Wajib diisi</p>
                      </div>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                      <a class="btn btn-warning" href="{{ route('donation-details', $food->donations_id) }}">
                          <i class="fas fa-arrow-left"></i> Kembali
                      </a>
                    </div>
                  </form>
              </div>
          </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection