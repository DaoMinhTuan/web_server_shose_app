@extends('layouts.app')
@section('content')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Kích Thước và Số Lượng</h1>
            </div>

        </div>
       
        <div class="card">

            <form class=" m-1 " action="{{ route('update_size') }}" method="POST" enctype="multipart/form-data">
                <div class="row d-flex justify-content-center m-3">
                    @csrf

                    @foreach ($size as $item)
                    <div class="d-flex">
                        
                            <div class="col-xl-1 m-3 " hidden>
                                <label class="form-label" for="exampleFormControlInput1">Id</label>
                                <input type="number" readonly name="id[]" class="form-control"
                                    id="exampleFormControlInput1" value="{{$item->id}}" placeholder="Nhập màu sản phẩm">
                            </div>
                            
                            <div class="col-xl-5 m-3">
                                <label class="form-label" for="exampleFormControlInput1">kích cỡ</label>
                                <input type="number" name="size[]" class="form-control "
                                    id="exampleFormControlInput1" value="{{$item->size}}" placeholder="Nhập size sản phẩm">
                            </div>
                            
                        

                            <div class="col-xl-5 m-3">
                                <label class="form-label" for="exampleFormControlInput1">Số lượng</label>
                                <input type="text" name="quantity[]" class="form-control"
                                    id="exampleFormControlInput1" value="{{$item->quantity}}" placeholder="Nhập số lượng sản phẩm">
                            </div>

                    </div>
                    @endforeach

                    <div> <button type="submit" class="btn btn-primary"> Thêm vào </button> </div>
                    <a href="{{ route('product.index') }}" class="btn btn-warning">Trở Lại</a>


            </form>
        </div>
    </div>
@endsection
