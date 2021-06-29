<div class="card mb-3 ">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Table Example
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Content</th>
                        <th>Price</th>
                        <th>Memory</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $row)
                    <tr>
                        <td>
                            {{$row->id}}
                        </td>
                        <td style="width:80px">
                            <img src="{{ asset($row->path) }}" style="width: 60px; height: 100px; object-fit: cover;">
                        </td>
                        <td style="width:220px">
                            {{$row->name}}
                        </td>
                        <td style="width:220px">
                            {{$row->content}}
                        </td>
                        <td>
                            {{$row->price}}
                        </td>
                        <td>
                            {{$row->memory}}
                        </td>
                        <td>
                            {{$row->stock}}
                        </td>
                        <td style="width:160px">
                            <a data-product="{{$row->id}}" class=" btn btn-primary" id="btn-edit-product">Edit</a>
                            &nbsp;
                            <a data-product="{{$row->id}}" class="btn-delete btn btn-secondary"
                                id="btn-delete-product">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>