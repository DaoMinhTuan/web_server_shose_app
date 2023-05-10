@extends('layouts.app')
@section('content')
    <div id="content" class="app-content">
        @error('brandName')
        <div class="alert alert-danger mt-3">
            <strong>Thông báo lỗi ! </strong> {{$message}}.
            <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
        </div>
        @enderror

        @error('desc')
        <div class="alert alert-danger mt-3">
            <strong>Thông báo lỗi ! </strong> {{$message}}.
            <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
        </div>
        @enderror


        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Products</h1>
            </div>

            <div class="ms-auto">
                <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw me-1"></i>
                    Add Product</a>
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalLg"><i
                        class="fa fa-plus-circle fa-fw me-1"></i>
                    Add Branchs</button>
            </div>
            <div class="modal fade" id="modalLg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Branchs</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form class="" action="{{ route('brands.store') }}" method="POST"
                                enctype="multipart/form-data">
                                <div class="row d-flex justify-content-center m-3">
                                    @csrf

                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="">Name</label>
                                            <input type="text" name="brandName" class="form-control " id=""
                                                placeholder="Nhập tên hãng">
                                        </div>
                                    </div>

                                    {{-- image and branch --}}
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="defaultFile">Image Products</label>
                                            <input type="file" name="image" class="form-control" multiple
                                                id="multipleFile" />
                                        </div>
                                    </div>

                                    {{-- text arena --}}
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="exampleFormControlInput1">Conten</label>
                                            <textarea name="desc" class="summernote" id="contents" title="Contents"></textarea>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary"> Add </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            


        </div>

        <div class="card">
            
            <ul class="nav nav-tabs nav-tabs-v2 px-4">
                <li class="nav-item me-3"><a href="#allTab" class="nav-link active px-2" data-bs-toggle="tab">All</a>
                </li>
            </ul>

            <div class="tab-content p-4">
                <div class="tab-pane fade show active" id="allTab">
                    
                <div class="table-responsive">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th class="pt-0 pb-2"></th>
                                    <th class="pt-0 pb-2">Name</th>
                                    <th class="pt-0 pb-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="w-10px align-middle">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="product1">
                                            <label class="form-check-label" for="product1"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <h4 href="#"> Cập nhật thông số sản phẩm </h4>
                                            </div> 
                                        </div>
                                    </td>
                                   
                                
                                    <td class="align-middle">
                                        <a href="{{ route('product.edit',$id) }}" class="btn btn-primary">cập nhật</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="w-10px align-middle">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="product1">
                                            <label class="form-check-label" for="product1"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <h4 href="#"> Cập nhật ảnh sản phẩm </h4>
                                            </div>
                                        </div>
                                    </td>
                                   
                                
                                    <td class="align-middle">
                                        <a href="{{ route('product.edit',$id) }}" class="btn btn-primary">cập nhật</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="w-10px align-middle">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="product1">
                                            <label class="form-check-label" for="product1"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <h4 href="#"> Cập nhật kích cỡ sản phẩm </h4>
                                            </div>
                                        </div>
                                    </td>
                                   
                                
                                    <td class="align-middle">
                                        <a href="{{ route('product.edit',$id) }}" class="btn btn-primary">cập nhật</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                   
                </div>
                
                <div class="d-md-flex align-items-center">
                    <div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
                        Showing 1 to 10 of 57 entries
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
