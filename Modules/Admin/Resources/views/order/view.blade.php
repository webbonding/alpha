@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-order-index') }}">orders</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of orders</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-9">Order Number:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($data->order_number)) ?$data->order_number: "#" }} </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-9">Customer Name:</label>
                            <div class="col-md-9">
                                <?php
                                $user = App\Model\UserMaster::where('id', '=', $data->user_id)->first();
                                ?>
                                <p class="form-control-static">{{$user->full_name}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-9">Customer Email:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{$data->email}} </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-9">Customer Phone:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{$data->phone}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-9">Customer Address:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{$data->address}} </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-9">Customer City:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{$data->city}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-9">Customer State:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{$data->state}} </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-9">Customer Zipcode:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{$data->zipcode}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-9">Product Name:</label>
                            <div class="col-md-9">
                                <?php
                                $product = App\Model\Product::where('id', '=', $data->product_id)->first();
                                ?>
                                <p class="form-control-static">{{$product->name}} </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-9">Product Quantity:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{$data->quantity}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-9">Product Price:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{$data->item_price}} </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-9">Order placed on:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><span class="time">{{\Carbon\Carbon::parse($data->created_at)->format('d F Y')}}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">



            </div>

        </form>
        <!-- END FORM-->
    </div>
</div>
@stop