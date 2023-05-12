@extends('layouts.app')
@section('content')
    <div id="content" class="app-content">
        @error('brandName')
            <div class="alert alert-danger mt-3">
                <strong>Thông báo lỗi ! </strong> {{ $message }}.
                <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
            </div>
        @enderror

        @error('desc')
            <div class="alert alert-danger mt-3">
                <strong>Thông báo lỗi ! </strong> {{ $message }}.
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
                <a href="{{ route('product.index') }}"class="btn btn-warning text-white"><i
                        class="fas fa-lg fa-fw me-2 fa-sign-out-alt"></i>Back</a>
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


            <div class="modal fade" id="product_update1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update product 1</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">

                            <form class="m-1" action="{{ route('product.update', $id) }}" method="POST"
                                enctype="multipart/form-data">
                                <div class="row d-flex justify-content-center m-3">
                                    @csrf
                                    @method('put')
                                    <div class="col-xl-4 col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="">Name</label>
                                            <input type="text" name="name" class="form-control " id=""
                                                placeholder="Nhập tên sản phẩm" value="{{$product->name}}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="exampleFormControlInput1">Price</label>
                                            <input type="text" name="price" class="form-control"
                                                id="exampleFormControlInput1" placeholder="Nhập giá sản phẩm" value="{{$product->price}}">
                                        </div>


                                    </div>

                                    <div class="col-xl-4 col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="">Sale</label>
                                            <input type="text" name="sale" class="form-control" value="{{$product->sale}}" id=""
                                                placeholder="Nhập tên sản phẩm">
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="exampleFormControlInput1">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="">Chọn trạng thái sản phẩm</option>
                                                    <option {{ $product->status == 1 ? 'selected' : ''; }} value="1">Còn Hàng</option>
                                                    <option {{ $product->status == 2 ? 'selected' : ''; }} value="2">Hết Hàng</option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-xl-4 col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="exampleFormControlInput1">Color</label>
                                            <input type="text" name="color" class="form-control"
                                                id="exampleFormControlInput1" value="{{$product->color}}" placeholder="Nhập màu sản phẩm">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="defaultFile">Product Brnach</label>
                                            <select class="form-control" name="brandID">
                                                <option value="">Chọn hãng cho sản phẩm</option>
                                                @foreach ($branch as $item)
                                                    <option {{ $product->brandID == $item->id ? 'selected' : ''; }} value="{{ $item->id }}">{{ $item->brandName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    {{-- text arena --}}
                                    <div class="col-xl-6 col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="exampleFormControlInput1">Conten</label>
                                            <textarea name="content" class="summernote" id="contents" title="Contents">{!! $product->content !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="exampleFormControlInput1">description</label>
                                            <textarea name="desc" class="summernote" id="contents" title="Contents">{!! $product->desc !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group  mb-3 m-1" hidden>
                                        <label class="form-label" for="">role</label>
                                        <input type="text" readonly name="role" class="form-control "
                                            id="" placeholder="" value="product">
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


            <div class="modal fade" id="product_update_image">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form class="" action="{{ route('product.update', $id) }}" method="POST"
                                enctype="multipart/form-data">
                                <div class="row d-flex justify-content-center m-3">
                                    @csrf
                                    @method('put')
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="defaultFile">Image Products</label>
                                            <input type="file" name="file_image[]" class="form-control" multiple
                                                id="multipleFile" />
                                        </div>

                                        <div class="form-group  mb-3 m-1" hidden>
                                            <label class="form-label" for="">role</label>
                                            <input type="text" readonly name="role" class="form-control "
                                                id="" placeholder="" value="image">
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


            <div class="modal fade" id="product_update_size">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update size</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form class="" action="{{ route('product.update', $id) }}" method="POST"
                                enctype="multipart/form-data">
                                <div class="row d-flex justify-content-center m-3">
                                    @csrf
                                    @method('put')
                                    @foreach ($size as $item)
                                        <div class="col-12 d-flex">
                                            <div class="form-group col-6 mb-3 m-1">
                                                <label class="form-label" for="">Size</label>
                                                <input type="text" name="size[]" class="form-control "
                                                    id="" placeholder="Nhập size" value="{{ $item->size }}">
                                            </div>

                                            <div class="form-group col-6 mb-3 m-1">
                                                <label class="form-label" for="">Quantiy</label>
                                                <input type="text" name="quantity[]" class="form-control "
                                                    id="" placeholder="Nhập số lượng"
                                                    value="{{ $item->quantity }}">
                                            </div>
                                            <div class="form-group  mb-3 m-1" hidden>
                                                <label class="form-label" for="">Quantiy</label>
                                                <input type="text" readonly name="PSID[]" class="form-control "
                                                    id="" placeholder="" value="{{ $item->id }}">
                                            </div>
                                            <div class="form-group  mb-3 m-1" hidden>
                                                <label class="form-label" for="">role</label>
                                                <input type="text" readonly name="role" class="form-control "
                                                    id="" placeholder="" value="size">
                                            </div>
                                        </div>
                                    @endforeach

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
                                                <h4 href="#"> Cập nhật sản phẩm </h4>
                                            </div>
                                        </div>
                                    </td>


                                    <td class="align-middle">
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#product_update1"><i class="far fa-lg fa-fw me-2 fa-edit"></i>
                                            Update</button>
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
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#product_update_image"><i
                                                class="far fa-lg fa-fw me-2 fa-edit"></i>
                                            Update</button>
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
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#product_update_size"><i
                                            class="far fa-lg fa-fw me-2 fa-edit"></i>
                                            Update</button>
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
