@extends('layouts.main')
@section('css')
<style>
.paginate_button a {
    width: 100%;
    background: #F2D672 !important;
    color: #000 !important;
}
select.form-control-sm:not([size]):not([multiple]){
    height: 40px;
}
.paginate_button.page-item.active {
    margin-top: 5px;
}
</style>
@endsection
@section('content')
<!--Start Breadcrumb-->
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">Orders</h1>
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="#">
            <span>Orders</span>
            </a>
        </li>
        </ul>
    </nav>
</div>
<!--End Breadcrumb-->


<!--start dashboard-->
<div class="dashboard mb-5 hg_section">
    <div class="container">
        <div class="row">
            @include('partials.left')
            <div class="col-md-8 col-sm-8 tab_dsh_2">
                <div class="dash-right-sec">
                    <div class="successfull">
                    <div class="container">
                            <div class="row">
                                <div class="col-sm-12 mobile-remove-gap">
                                    <div class="user-profile-details">
                                        <div class="account-info">
                                            <div class="header-area">
                                                <h4 class="title">ORDERS</h4>
                                            </div>
                                            <div class="edit-info-area">
                                                <div class="body">
                                                <table class="table table-striped table-hover table-bordered border-white my-table mb-4" id="user-order-management">
                                                    <thead class="thead-dark custom-head">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Order Id</th>
                                                            <th>Product Name</th>
                                                            <th>Order Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>


@stop
@section('js')
<script src="{{ URL::asset('public/backend/js/jquery-confirm.js') }}" type="text/javascript"></script>
<script>

//    $(docuemnt).ready(function () {
//
//    });
$(function () {
    $('#user-order-management').DataTable({
        serverSide: true,
        responsive: true,
        ajax: '{{ route("user-order-datatable") }}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'order_number', name: 'order_number'},
            {data: 'product_id', name: 'product_id'},
            {data: 'created_at', name: 'created_at'},
        ]
    });
});
</script>
@endsection



