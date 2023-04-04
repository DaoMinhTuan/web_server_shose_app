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
                                <label class="form-label" for="exampleFormControlInput1">size</label>
                                <input type="number" name="size[]" class="form-control "
                                    id="exampleFormControlInput1" value="{{$item->size}}" placeholder="Nhập size sản phẩm">
                            </div>
                            
                        

                            <div class="col-xl-5 m-3">
                                <label class="form-label" for="exampleFormControlInput1">Quantity</label>
                                <input type="text" name="quantity[]" class="form-control"
                                    id="exampleFormControlInput1" value="{{$item->quantity}}" placeholder="Nhập số lượng sản phẩm">
                            </div>

                    </div>
                    @endforeach

                    <div> <button type="submit" class="btn btn-primary"> Add </button> </div>

            </form>
        </div>
    </div>
@endsection
