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
                <div class="table-responsive">
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
                                        @elseif ($orderItem->status_message == 'Delivery')
                                        <span class="badge bg-primary">
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