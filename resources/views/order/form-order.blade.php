<div class="modal-content">
    <span id="close-detail-order" class="close">&times;</span>    
    <section class="mt-3">
        <div class="order-info" id="detail-order"></div>
    </section>
    <section class="order-edit-form my-1 mx-4">
        <div class="container">
        <ul id="update_noti_err" style="position: absolute; right: 10px; top: 20px; z-index: 2;"></ul>

            <form enctype="multipart/form-data" method="post" action="" id="order-show">
                @csrf                        
                <div class="row">
                    <div class="col-12">
                        <h1>Detail Order</h1>
                    </div>
                    <div class="col-6">
                        <div class="col-12">
                            <span>Customer infomation</span>
                            <hr class="mt-1">
                        </div>
                        <div class="col-12">
                            <div class="row mx-4">
                                <input type="hidden" name="id" value={{ $orderItem->id}}>
                                <div class="col-12 mb-2">
                                    <label class="order-form-label">Full Name </label>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <input id="edit-order-name" class="order-form-input" type="text" name="name" value="{{$orderItem->name}}">
                                </div>
                                <div class="col-6 col-sm-6 mt-2 mt-sm-0">
                                    <input class="order-form-input" id="edit-upload-order-avt" type="file" name="avatar">
                                    <img id="edit-order-avt" alt="img" src="{{ asset('/storage/') }}" style="width: 100px; height: 100px; object-fit: cover;"/>
                                </div>
                            </div>
                            <div class="row mt-3 mx-4">
                                <div class="col-12">
                                    <label class="order-form-label">Phone Number</label>
                                </div>
                                <div class="col-12">
                                    <input class="order-form-input" placeholder="Phone Number" type="tel" pattern="[0]{1}[0-9]{9}" name="phone" id="edit-order-phone" value="{{ $orderItem->phone}}">
                                    <br><small>Format: 0123456789</small><br>
                                </div>
                            </div>
                            <div class="row mt-3 mx-4">
                                <div class="col-12">
                                    <label class="order-form-label">Address</label>
                                </div>
                                <div class="col-12">
                                    <input class="order-form-input" placeholder="Address" name="address" id="edit-order-address" value="{{ $orderItem->address}}">
                                </div>
                            </div>
                            <div class="row mt-3 mx-4">
                                <div class="col-12">
                                    <label class="order-form-label">Email </label>
                                </div>
                                <div class="col-12">
                                    <input class="order-form-input" placeholder="Email" type="email"  name="email" id="edit-order-email" value="{{ $orderItem->email}}">
                                </div>
                            </div>
                            <div class="row mt-3 mx-4">
                                <div class="col-12">
                                    <label class="order-form-label" for="date-picker-example">Date Order</label>
                                </div>
                                <div class="col-12">
                                    <input class="order-form-input datepicker" placeholder="Selected date" type="text" name="date" id="edit-order-date" value={{ $orderItem->date}}>
                                </div>
                            </div>
                            <div class="row mt-3 mx-4">
                                <div class="col-12">
                                    <label class="order-form-label">Note</label>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control"  rows="2" name="note" id="order-note" value={{$orderItem->note}}></textarea>
                                </div>
                            </div>
                            <div class="row mt-3 mx-4">
                                <div class="col-12">
                                    <input class="order-form-input" id="edit-order-qty" name="quantity" value="{{ $orderItem->quantity}}">
                                    <input class="order-form-input" id="edit-order-total" name="total" value="{{ $orderItem->total}}">
                                </div>
                            </div>
                            <div class="row mt-3 mx-4">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="validation" value="1">
                                        <label for="validation" class="form-check-label">I know what I need to know</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-12">
                            <span>Product infomation</span>
                            <hr class="mt-1">
                        </div> 
                        <div class="col-12" id="wrap_item" style="height:500px; overflow:auto">
                            <div id="products-list">
                                @foreach($dataProduct as $row)
                                    <div class="d-flex justify-content-between align-items-center mt-3 p-2 rounded item_order_edit">
                                        @foreach($productOfOrder as $po)
                                            @if ($row->id == $po->product_id)
                                                <div class="col-6 d-flex flex-row">
                                                    <input type="checkbox" class="my-3 mx-2 item-check-selected" value="{{$row->price}}" checked>
                                                    <img alt="img" class="rounded" src="{{ asset($row->path) }}" width="40">
                                                    <div class="ml-2"><span class="font-weight-bold d-block" id="product_content">{{$row->name}}</span><span class="spec">{{$row->memory}} GB</span></div>
                                                </div>
                                                <div class="col-6 d-flex flex-row align-items-center">
                                                    <!-- <span class="d-block">2</span> -->
                                                    <div class="pl-md-0 pl-2"> 
                                                        <!-- <span class="fa fa-minus-square text-secondary"></span> -->
                                                        <div class="form-outline">
                                                            <label class="form-label" for="quantity-product-edit" >Quantity </label>
                                                            <input
                                                                name="item[{{$row->id}}]"
                                                                style="width: 70px;"
                                                                type="number"
                                                                class="form-control quantity-product-edit"
                                                                value="{{$po->quantity}}"
                                                                min="1"
                                                            />
                                                        </div>
                                                    </div>
                                                    <span class="d-block ml-5 font-weight-bold item-price">$ {{$row->price}}</span>
                                                </div>
                                            @elseif($loop->last)
                                                <div class="col-6 d-flex flex-row">
                                                    <input type="checkbox" class="my-3 mx-2 item-check-selected" value="{{$row->price}}">
                                                    <img alt="img" class="rounded" src="{{ asset($row->path) }}" width="40">
                                                    <div class="ml-2"><span class="font-weight-bold d-block" id="product_content">{{$row->name}}</span><span class="spec">{{$row->memory}} GB</span></div>
                                                </div>
                                                <div class="col-6 d-flex flex-row align-items-center">
                                                    <!-- <span class="d-block">2</span> -->
                                                    <div class="pl-md-0 pl-2"> 
                                                        <!-- <span class="fa fa-minus-square text-secondary"></span> -->
                                                        <div class="form-outline">
                                                            <label class="form-label" for="quantity-product-edit" >Quantity </label>
                                                            <input
                                                                name="item[{{$row->id}}]"
                                                                disabled
                                                                style="width: 70px;"
                                                                type="number"
                                                                class="form-control quantity-product-edit"
                                                                value="0"
                                                                min="1"
                                                            />
                                                        </div>
                                                    </div>
                                                    <span class="d-block ml-5 font-weight-bold item-price">$ {{$row->price}}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <center>
                            <button type="submit" class="btn btn-dark  btn-submit">Save</button>
                            <button class="btn btn-secondary btn-cancel-form" type="reset">Cancel</button>
                        </center>
                    </div>
                </div>                        
            </form>
        </div>
    </section>
</div>
