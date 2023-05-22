@extends('layouts.app')
@section('content')

    <div id="content" class="app-content">
        @error('desc')
            <div class="alert alert-danger mt-3">
                <strong>Thông báo lỗi ! </strong> {{ $message }}.
                <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
            </div>
        @enderror
        @error('content')
            <div class="alert alert-danger mt-3">
                <strong>Thông báo lỗi ! </strong> {{ $message }}.
                <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
            </div>
        @enderror

        @error('name')
            <div class="alert alert-danger mt-3">
                <strong>Thông báo lỗi ! </strong> {{ $message }}.
                <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
            </div>
        @enderror
        @error('price')
            <div class="alert alert-danger mt-3">
                <strong>Thông báo lỗi ! </strong> {{ $message }}.
                <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
            </div>
        @enderror
        @error('brandID')
            <div class="alert alert-danger mt-3">
                <strong>Thông báo lỗi ! </strong> {{ $message }}.
                <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
            </div>
        @enderror
        @error('file_image')
            <div class="alert alert-danger mt-3">
                <strong>Thông báo lỗi ! </strong> {{ $message }}.
                <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
            </div>
        @enderror
        @error('file_image.*')
            <div class="alert alert-danger mt-3">
                <strong>Thông báo lỗi ! </strong> {{ $message }}.
                <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
            </div>
        @enderror
        @error('msize')
            <div class="alert alert-danger mt-3">
                <strong>Thông báo lỗi ! </strong> {{ $message }}.
                <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
            </div>
        @enderror
        @error('misize')
            <div class="alert alert-danger mt-3">
                <strong>Thông báo lỗi ! </strong> {{ $message }}.
                <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
            </div>
        @enderror



        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Thêm các sản phẩm</h1>
            </div>
        </div>
       
        <div class="card">

            <form class=" m-1 " action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                <div class="row d-flex justify-content-center m-3">
                    @csrf

                    <div class="col-xl-3 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror "
                                id="" placeholder="Nhập tên sản phẩm" value="{{old('name')}}">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Giá</label>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                id="exampleFormControlInput1" placeholder="Nhập giá sản phẩm" value="{{old('price')}}">
                        </div>


                    </div>

                    <div class="col-xl-3 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="">Doanh thu</label>
                            <input type="text" name="sale" class="form-control @error('sale') is-invalid @enderror"
                                id="" placeholder="Nhập tên sản phẩm" value="{{old('sale')}}">
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-group mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Trạng thái</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="">Chọn trạng thái sản phẩm</option>
                                    <option value="1">Còn Hàng</option>
                                    <option value="2">Hết Hàng</option>
                                </select>
                            </div>
                        </div>


                    </div>

                    <div class="col-xl-3 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Màu sắc </label>

                            <input type="text" name="color"
                                class="form-control  @error('color') is-invalid @enderror" id="exampleFormControlInput1"
                                placeholder="Nhập màu sản phẩm" value="{{old('color')}}">

                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Kích thước tối thiểu</label>
                            <input type="number" name="misize"
                                class="form-control  @error('misize') is-invalid @enderror" id="exampleFormControlInput1"
                                placeholder="Nhập kích thước nhỏ nhất" value="{{old('misize')}}">

                        </div>




                    </div>

                    <div class="col-xl-3 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Kích thước tối đa</label>
                            <input type="number" name="msize"
                                class="form-control  @error('msize') is-invalid @enderror" id="exampleFormControlInput1"
                                placeholder="Nhập kích thước lớn nhất" value="{{old('msize')}}">
                        </div>


                    </div>


                    {{-- image and branch --}}
                    <div class="col-xl-6 col-12">
                        <div class="mb-3">
                            <label class="form-label" for="defaultFile">Sản phẩm hình ảnh</label>
                            <input type="file" name="file_image[]"
                                class="form-control  @error('file_image') is-invalid @enderror" multiple
                                id="multipleFile" value="{{old('file_image[]')}}" />
                        </div>
                    </div>

                    <div class="col-xl-6 col-12">

                        <div class="mb-3">
                            <label class="form-label" for="defaultFile">Một sản xuất vú</label>
                            <select class="form-control  @error('brandID') is-invalid @enderror" name="brandID">
                                <option value="">Chọn hãng cho sản phẩm</option>
                                @foreach ($branch as $item)
                                    <option value="{{ $item->id }}">{{ $item->brandName }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>


                    {{-- text arena --}}
                    <div class="col-xl-6 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Nội dung</label>
                            <textarea name="content" class="summernote  " id="contents" title="Contents">{!!old('content')!!}</textarea>
                        </div>
                    </div>

                    <div class="col-xl-6 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Mô Tả</label>
                            <textarea name="desc" class="summernote" id="contents" title="Contents">{!!old('desc')!!}</textarea>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary"> Thêm vào </button>
                        <a href="{{ route('product.index') }}" class="btn btn-warning">Trở Lại</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
