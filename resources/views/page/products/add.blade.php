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

            <form class="was-validated m-1 ">
                <div class="row d-flex justify-content-center m-3">
                    <div class="col-xl-6 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control is-invalid" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control is-invalid" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                    </div>
    
                    <div class="col-xl-3 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control is-invalid" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control is-invalid" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                    </div>
                    <div class="col-xl-3 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control is-invalid" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control is-invalid" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                    </div>

        
                    <textarea name="text" class="summernote" id="contents" title="Contents">...</textarea>
                   
                    
                    
                </div>
            </form>
        </div>
    </div>
@endsection
