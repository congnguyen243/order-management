@extends('layouts.main')
@section('title')
    Product List
@endsection
@section('page_javascript')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/product.js"></script>
    <script type="text/javascript" charset="utf-8">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection
@section('content')

    <div id="content-wrapper">

        <div class="">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Product</li>
            </ol>

            <div class="btns my-3">
                <button id="btn-new-product" type="button" class="btn btn-success" data-toggle="modal"
                    data-target="#exampleModal" data-whatever="@mdo">New product</button>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="product-name" class="col-form-label">Title:</label>
                                    <input type="text" class="form-control" id="product-name">
                                </div>
                                <div class="form-group">
                                    <label for="product-img" class="col-form-label">Images:</label>
                                    <input type="file" class="form-control" id="product-img">
                                </div>
                                <div class="form-group">
                                    <label for="product-price" class="col-form-label">Price:</label>
                                    <input type="number" min="0" step="any" class="form-control" id="product-price">
                                </div>
                                <div class="form-group">
                                    <label for="product-stock" class="col-form-label">Stock:</label>
                                    <input type="number" class="form-control" min="1" id="product-stock" value="0">
                                </div>
                                <div class="form-group">
                                    <label for="product-memory" class="col-form-label">Memory:</label>
                                    <select id="product_memory" class="form-control">
                                        <option value="16GB">16GB</option>
                                        <option value="32GB">32GB</option>
                                        <option value="64GB">64GB</option>
                                        <option value="128GB">128GB</option>
                                        <option value="512GB">512Gb</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product-content" class="col-form-label">Content:</label>
                                    <textarea type="text" class="form-control" id="product-content"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="btn-product-save">Save</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- DataTables Example -->
            <div id="products">
                @include('product.data-content')
            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <!-- <span>Copyright © Your Website 2019</span> -->
                </div>
            </div>
        </footer>

    </div>

@endsection
