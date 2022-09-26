@extends('layouts.admin')
@section('title', 'Order Lists')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="">My Orders</h3>
            </div>
            <div class="card-body">

                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Filter By Date</label>
                            <input type="date" name="date" value="{{ request()->get('date') ?? date('d-m-Y') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Filter By Status</label>
                            <select name="status" class="form-select" aria-label="Default select example">
                                <option value="">Select Status</option>
                                <option value="In Progress" {{ request()->get('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ request()->get('status') == "Completed" ? 'selected' : '' }}>Completed</option>
                                <option value="Pending" {{ request()->get('status') == "Pending" ? 'selected' : '' }}>Pending</option>
                                <option value="Cancelled" {{ request()->get('status') == "Cancelled" ? 'selected' : '' }}>Cancelled</option>
                                <option value="Out-For-Delivery" {{ request()->get('status') == "Out-For-Delivery" ? 'selected' : '' }}>Out For Delivery</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-2">
                    <table class="table table-striped table-bordered text-center">
                        <thead>
                            <th>Order ID</th>
                            <th>Tracking No</th>
                            <th>Username</th>
                            <th>Payment Mode</th>
                            <th>Order Date</th>
                            <th>Status Message</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $no = ($orders->currentPage() - 1) * $orders->perPage() + 1
                            @endphp
                            @forelse ($orders as $orderItem)
                                <tr class="">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $orderItem->tracking_no }}</td>
                                    <td>{{ $orderItem->fullname }}</td>
                                    <td>{{ $orderItem->payment_mode }}</td>
                                    <td>{{ $orderItem->created_at->format('d F Y h:i A') }}</td>
                                    <td>
                                        @if ($orderItem->status_message == 'In Progress')
                                            <span class="badge bg-secondary">
                                                {{ $orderItem->status_message }}
                                            </span>
                                        @elseif ($orderItem->status_message == 'Pending')
                                            <span class="badge bg-info">
                                                {{ $orderItem->status_message }}
                                            </span>
                                        @elseif ($orderItem->status_message == 'Cancelled')
                                            <span class="badge bg-danger">
                                                {{ $orderItem->status_message }}
                                            </span>
                                        @elseif ($orderItem->status_message == 'Out-For-Delivery')
                                            <span class="badge bg-warning">
                                                {{ $orderItem->status_message }}
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                {{ $orderItem->status_message }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.showorders', $orderItem->id) }}" class="btn btn-primary btn-sm">View</a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="7">No Orders Available</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection