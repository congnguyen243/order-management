@extends('layouts.main')
@section('title')
Order Management
@endsection
@section('stylesheet')
<link rel="stylesheet" href="/css/order.css?<?php echo time();?>">
@endsection
@section('page_javascript')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script src="//cdn.ckeditor.com/4.16.1/basic/ckeditor.js"></script>
<script src="//cdn.ckeditor.com/4.16.1/basic/adapters/jquery.js"></script>
<script type="text/javascript" src="/js/order.js"></script>
@endsection
@section('content')
<div id="content-wrapper">
    <div class="">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Order</li>
        </ol>

        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span id="close-form-order" class="close">&times;</span>
                <section class="order-form my-1 mx-4">
                    <div class="container">

                        <ul id="noti_err" style="position: absolute; right: 10px; top: 20px; z-index: 2;"></ul>

                        <form id="form-order" enctype="multipart/form-data" method="post" action="">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h1>Create Your Order Form</h1>
                                </div>
                                <div class="col-6" id="block-cus">
                                    <div class="col-12">
                                        <span>Customer infomation</span>
                                        <hr class="mt-1">
                                    </div>
                                    <div class="col-12">
                                        <div class="row mx-4">
                                            <div class="col-12 mb-2">
                                                <label class="order-form-label">Full Name *</label>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <input class="order-form-input" type="text" id="name-customer"
                                                    placeholder="Full Name" name="name" value="{{ old('name') }}">
                                                <!-- <p class="help is-danger alert alert-danger" role="alert" id="error-name">{{ $errors->first('name') }}</p> -->
                                            </div>
                                            <div class="col-12 col-sm-6 mt-2 mt-sm-0">
                                                <input class="order-form-input" type="file" name="avatar"
                                                    id="file-avatar">
                                            </div>
                                        </div>
                                        <div class="row mt-3 mx-4">
                                            <div class="col-12">
                                                <label class="order-form-label">Phone Number *</label>
                                            </div>
                                            <div class="col-12">
                                                <input class="order-form-input" id="phone-customer"
                                                    placeholder="Phone Number" type="tel" pattern="[0]{1}[0-9]{9}"
                                                    name="phone" value="{{ old('phone') }}">
                                                <br><small>Format: 0123456789</small><br>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mx-4">
                                            <div class="col-12">
                                                <label class="order-form-label">Address *</label>
                                            </div>
                                            <div class="col-12">
                                                <input class="order-form-input" id="address-customer"
                                                    placeholder="Address" name="address" value="{{ old('address') }}">
                                            </div>
                                        </div>
                                        <div class="row mt-3 mx-4">
                                            <div class="col-12">
                                                <label class="order-form-label">Email *</label>
                                            </div>
                                            <div class="col-12">
                                                <input class="order-form-input" id="mail-customer" placeholder="Email"
                                                    type="email" name="email" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="row mt-3 mx-4">
                                            <div class="col-12">
                                                <label class="order-form-label" for="date-picker-example">Date Order
                                                    *</label>
                                            </div>
                                            <div class="col-12">
                                                <input class="order-form-input datepicker" placeholder="Selected date"
                                                    type="text" id="date-picker-example" name="date"
                                                    value="{{ old('date') }}">
                                            </div>
                                        </div>
                                        <div class="row mt-3 mx-4">
                                            <div class="col-12">
                                                <label class="order-form-label">Note</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea class="form-control" id="note-order" rows="2"
                                                    name="note"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mx-4">
                                            <div class="col-12">
                                                <input class="order-form-input" id="update-quantity-order"
                                                    name="quantity">
                                                <input class="order-form-input" id="update-total-order" name="total">
                                            </div>
                                        </div>
                                        <div class="row mt-3 mx-4">
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="validation"
                                                        id="validation" value="1">
                                                    <label for="validation" class="form-check-label">I know what I need
                                                        to know</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6" id="block-product">
                                    <div class="col-12">
                                        <span>Product infomation</span>
                                        <hr class="mt-1">
                                    </div>
                                    <div class="col-12">
                                        <input type="checkbox" class="mx-2" id="selectAllProduct"><span>Select
                                            all</span>
                                    </div>
                                    <div class="col-12" id="wrap_item" style="height:500px; overflow:auto">
                                        @foreach($dataProduct as $row)
                                        <div
                                            class="d-flex justify-content-between align-items-center mt-3 p-2 rounded item_order">
                                            <div class="col-6 d-flex flex-row">
                                                <input type="checkbox" class="my-3 mx-2 item-check"
                                                    value="{{$row->price}}">
                                                <img alt="img" class="rounded" src="{{ asset($row->path) }}" width="40">
                                                <div class="ml-2"><span class="font-weight-bold d-block"
                                                        id="product_content">{{$row->name}}</span><span
                                                        class="spec">{{$row->memory}} GB</span></div>
                                            </div>
                                            <div class="col-6 d-flex flex-row align-items-center">
                                                <!-- <span class="d-block">2</span> -->
                                                <div class="pl-md-0 pl-2">
                                                    <!-- <span class="fa fa-minus-square text-secondary"></span> -->
                                                    <div class="form-outline">
                                                        <label class="form-label" for="quantity-product">Quantity
                                                        </label>
                                                        <input name="item[{{$row->id}}]" disabled style="width: 70px;"
                                                            type="number" class="form-control quantity-product"
                                                            value="0" min="1" />
                                                    </div>
                                                </div>
                                                <span class="d-block ml-5 font-weight-bold item-price">$
                                                    {{$row->price}}</span>
                                                <a href="##">
                                                    <!-- <i class="far fa-trash-alt mx-4" ></i> -->
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="col-12">
                                        <hr />
                                        <div class="order_total">
                                            <div class="order_total_content text-md-right">
                                                <span>Quantity</span>
                                                <span id="total-quantity">0</span>
                                                <div class="order_total_title">Order Total:</div>
                                                <span>$ </span>
                                                <div id="order_total_amount">0</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" id="btn-submit-order"
                                        class="btn btn-dark d-block mx-auto btn-submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>

        <div class="btns my-3">
            <button type="button" class="btn btn-success " id="new-order-btn">New Order</button>
        </div>

        <!-- DataTables Example -->
        <div id="orders">
            @include('order.data-content')
        </div>
        <!-- /dataTables example -->
    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
            </div>
        </div>
    </footer>
</div>
@endsection