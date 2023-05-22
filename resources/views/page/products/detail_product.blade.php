@extends('layouts.app')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="">
                    @if ($data != null)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="images p-3">
                                    <div class="text-center p-4"> <img id="main-image"
                                            src="{{ $data->image[0]->image1->name }}" width="250" /> </div>
                                    <div class="thumbnail text-center">
                                        @for ($i = 0; $i < 3; $i++)
                                            <img src="{{ $data->image[0]->{'image' . $i + 1}->name }}" width="70">
                                        @endfor
                                    </div>

                                </div>
                                <div class="sizes mt-3 p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="pt-0 pb-2">Kích cỡ</th>
                                                <th class="pt-0 pb-2">Số lượng</th>
                                                <th class="pt-0 pb-2">Cập nhật gần đây</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->size as $item)
                                                <tr>
                                                    <td class="align-middle">
                                                        {{ $item->size }}
                                                    </td>
                                                    <td class="align-items-center">{{ $item->quantity }}</td>
                                                    <td class="align-items-center">{{date('d-m-Y', strtotime($item->updated_at))}}</td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product p-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('product.index') }}"class="btn btn-warning text-white"><i
                                                class="fas fa-lg fa-fw me-2 fa-sign-out-alt"></i>Trở Lại</a>
                                    </div>
                                    <div class="mt-4 mb-2">
                                        <p class="text-uppercase text-muted brand mb-1">{{ $data->branch }}</p>
                                        <h5 class="text-uppercase mt-3">{{ $data->name }}</h5>
                                        <div class=" d-flex mb-1">
                                            <p class="m-1">{{ number_format($data->sale, 0, '', ',') }} VND</p>
                                            <del class="m-1">{{ number_format($data->price, 0, '', ',') }}VND</del>
                                        </div>
                                        <div class="sale">
                                            <div class="col-xl-3 col-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label" for="exampleFormControlInput1">Giảm Giá</label>
                                                    <input type="text" readonly class="form-control "
                                                        id="exampleFormControlInput1" value="{{ $sale_off }}% OFF">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="quantity">
                                            <div class="col-xl-3 col-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label" for="exampleFormControlInput1">Tổng Số Lượng</label>
                                                    <input type="text" readonly class="form-control "
                                                        id="exampleFormControlInput1" value="{{ $data->quantity}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-uppercase mt-3">Mô Tả</h5>
                                    <p  class="text-break">{!! $data->desc !!}</p>

                                    <div class="cart mt-4 align-items-center"> 
                                        <a href="" class="btn btn-success text-uppercase mr-2 px-4">cập nhật san phẩm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger mt-3">
                            <strong>Thông báo lỗi ! </strong> Không có thông tin sản phẩm
                            <i class="btn-close m-3 ml-3" data-bs-dismiss="alert"></i>
                        </div>
                        <a href="{{ route('product.index') }}"class="btn btn-warning text-white"><i
                                class="fas fa-lg fa-fw me-2 fa-sign-out-alt"></i>Back</a>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection
