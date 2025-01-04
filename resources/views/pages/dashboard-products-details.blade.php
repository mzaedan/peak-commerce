@extends('layouts.dashboard')

@section('title')
  Store Dashboard Product
@endsection

@section('content')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" />
    

<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Gelas</h2>
            <p class="dashboard-subtitle">Product Details</p>
        </div>
        <div class="dashborad-content">
            <div class="row">
                <div class="col-12">
                <form action="">
                    <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" value="gelas" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" value="100.00" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" v-if="is_store_open">
                            <label>Kategori</label>
                            <select name="category" class="form-control">
                                <option value="" disabled>Select Category</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Deskription</label>
                            <textarea name="editor" id="editor"></textarea>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col text-right">
                            <button type="submit" class="btn btn-success px-5 btn-block">Save now</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img src="{{ url('images/product-card-1.png') }}" alt="" class="w-100" />
                                        <a href="" class="delete-gallery">
                                        <img src="images/icon-delete.svg" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img src="{{ url('images/product-card-2.png') }}" alt="" class="w-100" />
                                        <a href="" class="delete-gallery">
                                        <img src="images/icon-delete.svg" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="gallery-container">
                                    <img src="images/product-card-3.png" alt="" class="w -100" />
                                    <a href="" class="delete-gallery">
                                    <img src="images/icon-delete.svg" alt="" />
                                    </a>
                                </div>
                                </div>
                                <div class="col-12">
                                <input type="file" name="" id="file" style="display: none" multiple />
                                <button class="btn btn-secondary btn-block mt-4" onclick="thisFileUpload()">Add Photo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    function thisFileUpload() {
    document.getElementById("file").click();
    }
</script>
<script>
    CKEDITOR.replace("editor");
</script>
@endpush
