@extends('layouts.admin')
@section('title', 'Order Details')
@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert-alert-success mb-3">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="">Order Details</h3>
            </div>
            <div class="card-body">
                <div class="shadow bg-white p-3">
                    <h3>
                        <i class="fa fa-shopping-cart text-dark"></i> Order Details
                        <a href="{{ route('orders') }}" class="btn btn-primary btn-sm float-end mx-1">Back</a>
                        <a href="{{ route('admin.invoicegenerate', $order->id) }}" target="_blank" class="btn btn-success btn-sm float-end mx-1">Download Invoice</a>
                        <a href="{{ route('admin.invoice', $order->id) }}" target="_blank" class="btn btn-warning btn-sm float-end mx-1">View Invoice</a>
                    </h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order Details</h5>
                            <hr>
                            <h6>Order ID: {{ $order->id }}</h6>
                            <h6>Tracking NO: {{ $order->tracking_no }}</h6>
                            <h6>Ordered Date: {{ $order->created_at->format('d F Y h:i A') }}</h6>
                            <h6>Payment Mode: {{ $order->payment_mode }}</h6>
                            <h6 class="border p-2 text-secondary">
                                Order Status Message: <span class="text-uppercase">
                                    @if ($order->status_message == 'In Progress')
                                    <span class="badge bg-secondary">
                                        {{ $order->status_message }}
                                    </span>
                                    @elseif ($order->status_message == 'Pending')
                                        <span class="badge bg-info">
                                            {{ $order->status_message }}
                                        </span>
                                    @elseif ($order->status_message == 'Cancelled')
                                        <span class="badge bg-danger">
                                            {{ $order->status_message }}
                                        </span>
                                    @elseif ($order->status_message == 'Out-For-Delivery')
                                        <span class="badge bg-warning">
                                            Our For Delivery
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            {{ $order->status_message }}
                                        </span>
                                    @endif
                                </span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>User Details</h5>
                            <hr>
                            <h6>Full Name: {{ $order->fullname }}</h6>
                            <h6>E-Mail: {{ $order->email }}</h6>
                            <h6>Phone Number: {{ $order->phone }}</h6>
                            <h6>Pincode: {{ $order->pincode }}</h6>
                            <h6>Address: {{ $order->address }}</h6>
                        </div>
                    </div>

                    <br>
                    <h5>Order Items</h5>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <th>Item ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                @php
                                    // $no = ($order->currentPage() - 1) * $order->perPage() + 1
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($order->OrderItems as $orderItem)
                                    <tr>
                                        <td width="10%">{{ $orderItem->id }}</td>
                                        <td width="10%">
                                            @if ($orderItem->product->productImages)
                                                <img src="{{ asset($orderItem->product->ProductImages[0]->image) }}" style="width: 50px; height: 50px" alt="{{ $orderItem->name }}">
                                            @else
                                                <img src="" style="width: 50px; height: 50px" alt="">
                                            @endif
                                            
                                        </td>
                                        <td>
                                            {{ $orderItem->product->name }}
                                            @if ($orderItem->productColor)
                                                @if ($orderItem->productColor->color)
                                                <span> - Color: {{ $orderItem->ProductColor->color->name }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td width="10%">${{ $orderItem->price }}</td>
                                        <td width="10%">{{ $orderItem->quantity }}</td>
                                        <td width="10%" class="fw-bold">${{ $orderItem->quantity * $orderItem->price }}</td>
                                        @php
                                            $totalPrice += $orderItem->quantity * $orderItem->price
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="fw-bold">Total Amount: </td>
                                    <td class="fw-bold">${{ $totalPrice }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="">
                            {{-- {{ $orders->links('pagination::bootstrap-5') }} --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card border mt-3">
            <div class="card-body">
                <h4>Order Proses (Order Status Updates)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <form action="{{ route('admin.updateorders', $order->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label>Update your order status</label>
                            <div class="input-group">
                                <select name="order_status"  class="form-select">
                                    <option value="">Select Order Status</option>
                                    <option value="In Progress" {{ request()->get('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Completed" {{ request()->get('status') == "Completed" ? 'selected' : '' }}>Completed</option>
                                    <option value="Pending" {{ request()->get('status') == "Pending" ? 'selected' : '' }}>Pending</option>
                                    <option value="Cancelled" {{ request()->get('status') == "Cancelled" ? 'selected' : '' }}>Cancelled</option>
                                    <option value="Out-For-Delivery" {{ request()->get('status') == "Out-For-Delivery" ? 'selected' : '' }}>Out For Delivery</option>
                                </select>
                                <button type="submit" class="btn btn-primary text-white">Update</button>
                            </div>
                            
                        </form>
                    </div>
                    <div class="col-md-7">
                        <br>
                        <h4 class="mt-3">Current order status: <span class="text-uppercase">{{ $order->status_message }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection