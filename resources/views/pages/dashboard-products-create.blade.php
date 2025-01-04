@extends('layouts.dashboard')

@section('title')
  Store Dashboard Product Create
@endsection

@section('content')

<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Create New Product</h2>
            <p class="dashboard-subtitle">Create your own product</p>
        </div>
        <div class="dashborad-content">
            <div class="row">
                <div class="col-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                               @foreach ($errors->all() as $error)
                                    <li>{{ $error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="users_id" value="#">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" class="form-control" name="name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" class="form-control" name="price" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" v-if="is_store_open">
                                            <label>Kategori</label>
                                            <select name="categories_id" class="form-control">
                                               <option value="" disabled>
                                                    Select Category
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Deskription</label>
                                            <textarea name="description" id="editor"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Thumbnails</label>
                                            <input type="file" name="photo" class="form-control" />
                                            <p class="text-muted">      
                                            Kamu Dapat Memilih Lebih Dari Satu File
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">
                                            Save now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace("editor");
</script>
@endpush
