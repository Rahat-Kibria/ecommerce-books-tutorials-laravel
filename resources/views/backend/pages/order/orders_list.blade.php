@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 30%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > List of Orders</h3>
    </div>
    <div style="padding: 10px;">
        <table class="table table-hover table-bordered table-success">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="color: red;">User ID</th>
                    <th scope="col">Auth?</th>
                    <th scope="col">Need Auth?</th>
                    <th scope="col">Paid?</th>
                    <th scope="col">Seen by Admin?</th>
                    <th scope="col">Out for Delivery?</th>
                    <th scope="col">Completed?</th>
                    <th scope="col">Cancelled?</th>
                    <th scope="col">Completion Date</th>
                    <th scope="col" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr>
                        <td>{{ $key + $orders->firstItem() }}</td>
                        <td>{{ $order->user_id }}</td>
                        @php
                            $user = \App\Models\User::where('id', $order->user_id)->first();
                            $product_ids = \App\Models\OrderDetails::where('order_id', $order->id)
                                ->pluck('product_id')
                                ->all();
                            $audios = \App\Models\Audio::whereIn('product_id', $product_ids)->get();
                            $ebooks = \App\Models\Ebook::whereIn('product_id', $product_ids)->get();
                        @endphp
                        <td>
                            @if ($user->role == 'auth_user')
                                <span class="btn-sm btn-success">YES</span>
                            @else
                                <span class="btn-sm btn-danger">NO</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->role == 'auth_user')
                                <span>---</span>
                            @elseif((isset($audios) && !empty($audios)) || (isset($ebooks) && !empty($ebooks)))
                                <form action="{{ route('admin.create.auth.plus.mail') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                    <button class="btn-sm btn-success" type="submit"
                                        onclick="return confirm('Are you sure?')">YES</button>
                                </form>
                            @else
                                <span>---</span>
                            @endif
                        </td>
                        <td>
                            @if ($order->is_paid == 'complete')
                                <span class="btn-sm btn-success">YES</span>
                            @else
                                <span class="btn-sm btn-danger">NO</span>
                            @endif
                        </td>
                        <td>
                            @if ($order->is_seen_by_admin == 'no')
                                <form action="{{ route('admin.order.seen_by_admin.to.yes') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                    <button class="btn-sm btn-danger" type="submit"
                                        onclick="return confirm('Are you sure?')">NO</button>
                                </form>
                            @else
                                <form action="{{ route('admin.order.seen_by_admin.to.no') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                    <button class="btn-sm btn-success" type="submit"
                                        onclick="return confirm('Are you sure?')">YES</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            @if ($order->is_out_for_delivery == 'no')
                                <form action="{{ route('admin.order.out_for_delivery.to.yes') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                    <button class="btn-sm btn-danger" type="submit"
                                        onclick="return confirm('Are you sure?')">NO</button>
                                </form>
                            @else
                                <form action="{{ route('admin.order.out_for_delivery.to.no') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                    <button class="btn-sm btn-success" type="submit"
                                        onclick="return confirm('Are you sure?')">YES</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            @if ($order->is_completed == 'no')
                                <form action="{{ route('admin.order.completed.to.yes') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                    <button class="btn-sm btn-danger" type="submit"
                                        onclick="return confirm('Are you sure?')">NO</button>
                                </form>
                            @else
                                <form action="{{ route('admin.order.completed.to.no') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                    <button class="btn-sm btn-success" type="submit"
                                        onclick="return confirm('Are you sure?')">YES</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            @if ($order->is_cancelled == 'no')
                                <span class="btn-sm btn-danger">NO</span>
                            @else
                                <span class="btn-sm btn-success">YES</span>
                            @endif
                        </td>
                        <td>{{ $order->completion_date }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.order.details.view', $order->id) }}">
                                <button type="button" class="btn btn-info"><i class="fa-solid fa-eye"></i></button>
                            </a>
                            <a href="{{ route('admin.order.delete', $order->id) }}" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">
                                <i class="fa-solid fa-trash-can text-dark"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
@endsection
