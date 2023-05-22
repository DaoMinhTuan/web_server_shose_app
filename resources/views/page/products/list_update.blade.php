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
                <h1 class="page-header mb-0">Cập nhật sản phẩm</h1>
            </div>

            <div class="ms-auto">
                <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw me-1"></i>
                    Thêm sản phẩm</a>
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalLg"><i
                        class="fa fa-plus-circle fa-fw me-1"></i>
                   Thêm Hãng</button>
                <a href="{{ route('product.index') }}"class="btn btn-warning text-white"><i
                        class="fas fa-lg fa-fw me-2 fa-sign-out-alt"></i>Quay lại</a>
            </div>

            <div class="modal fade" id="modalLg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hãng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <form class="" action="{{ route('brands.store') }}" method="POST"
                                enctype="multipart/form-data">
                                <div class="row d-flex justify-content-center m-3">
                                    @csrf

                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="">Tên</label>
                                            <input type="text" name="brandName" class="form-control " id=""
                                                placeholder="Nhập tên hãng">
                                        </div>
                                    </div>

                                    {{-- image and branch --}}
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="defaultFile">hình ảnh Sản phẩm </label>
                                            <input type="file" name="image" class="form-control" multiple
                                                id="multipleFile" />
                                        </div>
                                    </div>

                                    {{-- text arena --}}
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="exampleFormControlInput1">nội dung</label>
                                            <textarea name="desc" class="summernote" id="contents" title="Contents"></textarea>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary"> Thêm vào </button>
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
                            <h5 class="modal-title">Cập nhật thông số sản phẩm</h5>
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
                                            <label class="form-label" for="">Tên sản phẩm</label>
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
                                            <label class="form-label" for="">Giảm Giá</label>
                                            <input type="text" name="sale" class="form-control" value="{{$product->sale}}" id=""
                                                placeholder="Nhập tên sản phẩm">
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="exampleFormControlInput1">Trạng thái</label>
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
                                            <label class="form-label" for="exampleFormControlInput1">Màu sắc</label>
                                            <input type="text" name="color" class="form-control"
                                                id="exampleFormControlInput1" value="{{$product->color}}" placeholder="Nhập màu sản phẩm">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="defaultFile">Hãng sản Phẩm</label>
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
                                            <label class="form-label" for="exampleFormControlInput1">Nội dung</label>
                                            <textarea name="content" class="summernote" id="contents" title="Contents">{!! $product->content !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="exampleFormControlInput1">Mô tả</label>
                                            <textarea name="desc" class="summernote" id="contents" title="Contents">{!! $product->desc !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group  mb-3 m-1" hidden>
                                        <label class="form-label" for="">role</label>
                                        <input type="text" readonly name="role" class="form-control "
                                            id="" placeholder="" value="product">
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary"> cập nhật </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="product_update_image">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cập nhật hình ảnh</h5>
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
                                            <label class="form-label" for="defaultFile">Sản phẩm hình ảnh</label>
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
                                        <button type="submit" class="btn btn-primary"> Thêm vào </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="product_update_size">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Kích thước cập nhật</h5>
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
                                                <label class="form-label" for="">Kích cỡ</label>
                                                <input type="text" name="size[]" class="form-control "
                                                    id="" placeholder="Nhập size" value="{{ $item->size }}">
                                            </div>

                                            <div class="form-group col-6 mb-3 m-1">
                                                <label class="form-label" for="">Số lượng</label>
                                                <input type="text" name="quantity[]" class="form-control "
                                                    id="" placeholder="Nhập số lượng"
                                                    value="{{ $item->quantity }}">
                                            </div>
                                            <div class="form-group  mb-3 m-1" hidden>
                                                <label class="form-label" for=""></label>
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
                                        <button type="submit" class="btn btn-primary"> Thêm vào </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Đóng</button>
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
                                    <th class="pt-0 pb-2">Tên</th>
                                    <th class="pt-0 pb-2">Chức Năng</th>
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
                                            Cập nhật</button>
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
                                            Cập nhật</button>
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
                                            Cập nhật</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>


                </div>

                
            </div>
        </div>
    </div>
    </div>
@endsection
