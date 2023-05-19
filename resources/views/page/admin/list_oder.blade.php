@extends('layouts.app')
@section('content')
    <div id="content" class="app-content">
       
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">List oders</h1>
            </div>

            {{-- <div class="ms-auto">
                <a href="" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw me-1"></i>
                    Add Product</a>
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalLg"><i
                        class="fa fa-plus-circle fa-fw me-1"></i>
                    Add Branchs</button>
            </div> --}}
           

            


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
                                    <th class="pt-0 pb-2">Product</th>
                                    <th class="pt-0 pb-2">Inventory</th>
                                    <th class="pt-0 pb-2">Color</th>
                                    <th class="pt-0 pb-2">Status</th>
                                    <th class="pt-0 pb-2">Action</th>
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
                                                    <img class="mw-100 mh-100"
                                                        src="" />
                                                </div>
                                                <div class="ms-3">
                                                    <a href="#"></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle"> in stock for </td>
                                          
                                        <td class="align-middle">
                                         
                                        </td>
                                        <td class="align-middle">
                                            <a href="" class="btn btn-primary">cập nhật</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                   
                </div>
                
                <div class="d-md-flex align-items-center">
                    <div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
                        Showing 1 to 10 of 57 entries
                    </div>
                    <ul class="pagination mb-0 justify-content-center">
                        {{-- {{ $data->links() }} --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
