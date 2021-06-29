<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Table Example
    </div>
    <div class="card-body">
        <div class="">
            <div class="container d-flex justify-content-end mt-100">
                <div class="input-group-overlay d-none d-lg-flex mx-4">
                    <input class="form-control appended-form-control" type="text" placeholder="Search for order">
                    <div class="input-group-append-overlay">
                        <span class="input-group-text mx-1" style="height:100%"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
            <br />
            <div class="row">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- OrderList -->
                        @foreach($orders as $row)
                        <tr>
                            <td>
                                {{$loop->index + 1}}
                            </td>
                            <td style="width:80px">
                                <img src="{{ asset('/storage/'.$row->avatar) }}"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            </td>
                            <td>
                                {{$row->name}}
                            </td>
                            <td style="width:220px">
                                {{$row->phone}}
                            </td>
                            <td>
                                {{$row->date}}
                            </td>
                            <td>
                                {{$row->quantity}}
                            </td>
                            <td>
                                {{$row->total}}
                            </td>
                            <td>
                                <a data-order="{{$row->id}}" class="btn btn-primary btn-detail-order">View</a>
                                &nbsp;
                                <a data-order="{{$row->id}}" class="btn-delete btn btn-secondary order-delete-btn"
                                    data-confirm="Are you sure to delete this item?">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                        <!-- modal-detail-block -->
                        <div id="order-detail-modal" class="modal">
                            <!-- Modal content -->
                        </div>
                        <!-- modal-detail-block -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>