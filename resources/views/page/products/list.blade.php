@extends('layouts.app')
@section('content')
<div id="content" class="app-content">
    <div class="d-flex align-items-center mb-3">
        <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">PAGES</a></li>
                <li class="breadcrumb-item active">PRODUCTS</li>
            </ul>
            <h1 class="page-header mb-0">Products</h1>
        </div>
        <div class="ms-auto">
            <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Product</a>
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
        <ul class="nav nav-tabs nav-tabs-v2 px-4">
            <li class="nav-item me-3"><a href="#allTab" class="nav-link active px-2"
                    data-bs-toggle="tab">All</a></li>
            {{-- <li class="nav-item me-3"><a href="#publishedTab" class="nav-link px-2"
                    data-bs-toggle="tab">Published</a></li>
            <li class="nav-item me-3"><a href="#expiredTab" class="nav-link px-2"
                    data-bs-toggle="tab">Expired</a></li>
            <li class="nav-item me-3"><a href="#deletedTab" class="nav-link px-2"
                    data-bs-toggle="tab">Deleted</a></li> --}}
        </ul>
        <div class="tab-content p-4">
            <div class="tab-pane fade show active" id="allTab">

                <div class="input-group mb-4">
                    <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Filter products &nbsp;</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                    <div class="flex-fill position-relative">
                        <div class="input-group">
                            <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0"
                                style="z-index: 1020;">
                                <i class="fa fa-search opacity-5"></i>
                            </div>
                            <input type="text" class="form-control ps-35px" placeholder="Search products" />
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="pt-0 pb-2"></th>
                                <th class="pt-0 pb-2">Product</th>
                                <th class="pt-0 pb-2">Inventory</th>
                                <th class="pt-0 pb-2">Type</th>
                                <th class="pt-0 pb-2">Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td class="w-10px align-middle">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="product1">
                                        <label class="form-check-label" for="product1"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="w-60px h-60px bg-gray-100 d-flex align-items-center justify-content-center">
                                            <img class="mw-100 mh-100" src="{{$item->image[0]->image1->name}}" />
                                        </div>
                                        <div class="ms-3">
                                            <a href="#">{{$item->name}}</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">{{ $item->quantity }} in stock for {{ count(get_object_vars($item->size[0])) }} Sizes</td>
                                <td class="align-middle">Cotton</td>
                                <td class="align-middle">{{$item->color}}</td>
                            </tr>
                            @endforeach
                            
                        
                        </tbody>
                    </table>
                </div>

                <div class="d-md-flex align-items-center">
                    <div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
                        Showing 1 to 10 of 57 entries
                    </div>
                    <ul class="pagination mb-0 justify-content-center">
                        {{ $data->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection