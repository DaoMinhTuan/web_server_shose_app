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


                    <div id="jQueryFileUpload" class="mb-5">
                       
                            <div class="card">
                                <div class="card-body pb-2">
                                    <div class="fileupload-buttonbar mb-2">
                                        <div class="d-block d-lg-flex align-items-center">
                                            <span class="btn btn-primary fileinput-button me-2 mb-1">
                                                <i class="fa fa-fw fa-plus"></i>
                                                <span>Add files...</span>
                                                <input type="file" name="files[]" multiple>
                                            </span>
                                            <button type="submit" class="btn btn-default me-2 mb-1 start">
                                                <i class="fa fa-fw fa-upload"></i>
                                                <span>Start upload</span>
                                            </button>
                                            <button type="reset" class="btn btn-default me-2 mb-1 cancel">
                                                <i class="fa fa-fw fa-ban"></i>
                                                <span>Cancel upload</span>
                                            </button>
                                            <button type="button" class="btn btn-default me-2 mb-1 delete">
                                                <i class="fa fa-fw fa-trash"></i>
                                                <span>Delete</span>
                                            </button>
                                            <div class="form-check ms-2 mb-1">
                                                <input type="checkbox" id="toggle-delete"
                                                    class="form-check-input toggle" />
                                                <label for="toggle-delete" class="form-check-label">Select Files</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="error-msg"></div>
                                </div>
                                <table class="table table-card mb-0 fs-13px">
                                    <thead>
                                        <tr class="fs-12px">
                                            <th class="pt-2 pb-2 w-25">PREVIEW</th>
                                            <th class="pt-2 pb-2 w-25">FILENAME</th>
                                            <th class="pt-2 pb-2 w-25">SIZE</th>
                                            <th class="pt-2 pb-2 w-25">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody class="files">
                                        <tr class="empty-row">
                                            <td colspan="4" class="text-center p-3">
                                                <div class="text-gray-300 mb-2"><i class="fa fa-file-archive fa-3x"></i>
                                                </div>
                                                No file uploaded
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                               



            </form>
        </div>
    </div>
@endsection
