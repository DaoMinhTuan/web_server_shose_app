@extends('layouts.app')
@section('content')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>

                <h1 class="page-header mb-0">Products</h1>
            </div>

        </div>
        <div class="mb-sm-4 mb-3 d-sm-flex">
            <div class="mt-sm-0 mt-2"><a href="#" class="text-dark text-decoration-none"><i
                        class="fa fa-download fa-fw me-1 text-muted"></i> Export</a></div>
            <div class="ms-sm-4 mt-sm-0 mt-2"><a href="#" class="text-dark text-decoration-none"><i
                        class="fa fa-upload fa-fw me-1 text-muted"></i> Import</a></div>
            <div class="ms-sm-4 mt-sm-0 mt-2 dropdown-toggle">
                <a href="#" data-bs-toggle="dropdown" class="text-dark text-decoration-none">More Actions</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>
        </div>
        <div class="card">

            <form class=" m-1 " action="{{ route('product.store') }}" method="POST"
                enctype="multipart/form-data">
                <div class="row d-flex justify-content-center m-3">
                    @csrf

                    <div class="col-xl-3 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="">Name</label>
                            <input type="text" name="name" class="form-control " id=""
                                placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Price</label>
                            <input type="text" name="price" class="form-control" id="exampleFormControlInput1"
                                placeholder="Nhập giá sản phẩm">
                        </div>


                    </div>

                    <div class="col-xl-3 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="">Sale</label>
                            <input type="text" name="sale" class="form-control " id=""
                                placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-group mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Chọn trạng thái sản phẩm</option>
                                    <option value="1">Còn Hàng</option>
                                    <option value="2">Hết Hàng</option>
                                </select>
                            </div>
                        </div>


                    </div>

                    <div class="col-xl-3 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Color</label>
                            <input type="text" name="color" class="form-control is-invalid"
                                id="exampleFormControlInput1" placeholder="Nhập màu sản phẩm">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Min size</label>
                            <input type="number" name="misize" class="form-control is-invalid"
                            id="exampleFormControlInput1" placeholder="Nhập kích thước nhỏ nhất">
                        </div>

                        


                    </div>

                    <div class="col-xl-3 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Max size</label>
                            <input type="number" name="msize" class="form-control is-invalid"
                            id="exampleFormControlInput1" placeholder="Nhập kích thước lớn nhất">
                        </div>


                    </div>


                {{-- image and branch --}}
                    <div class="col-xl-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="defaultFile">Image Products</label>
                            <input type="file" name="file_image[]" class="form-control" multiple id="multipleFile" />
                        </div>
                    </div>

                    <div class="col-xl-6 col-12">
                        
                        <div class="mb-3">
                            <label class="form-label" for="defaultFile">Product Brnach</label>
                            <select class="form-control" name="brandID">
                                <option value="">Chọn hãng cho sản phẩm</option>
                                @foreach ($branch as $item)
                                <option value="{{$item->id}}">{{$item->brandName}}</option>

                                @endforeach
                            </select>
                        </div>

                    </div>
                  
                  
                    {{-- text arena--}}
                    <div class="col-xl-6 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Conten</label>
                            <textarea name="content" class="summernote" id="contents" title="Contents"></textarea>
                        </div>
                    </div>        

                    <div class="col-xl-6 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">description</label>
                            <textarea name="desc" class="summernote" id="contents" title="Contents"></textarea>
                        </div>
                    </div>

                    <div> 
                        <button type="submit" class="btn btn-primary"> Add </button>
                        <a href="{{ route('product.index')}}"  class="btn btn-warning"> Back </a>
                   </div>
                </div>

            </form>
        </div>
    </div>
@endsection
