@extends('masterAP')
@section('contentAP')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            {{-- <h1>Hello, <span>Welcome Here</span></h1> --}}
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Đơn hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <section id="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h1>Danh sách đơn hàng</h1>
                                {{-- <a href="{{ url('/admin/order/create') }}"><button class="btn btn-success m-1"><i
                                            class="fa fa-plus"></i>&ensp;Thêm</button></a> --}}
                                <div id="deleteMsg">
                                </div>
                            </div>
                            <div class="bootstrap-data-table-panel">
                                <div class="table-responsive" id="order-table">
                                    <table id="row-select" class="display table table-borderd table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Địa chỉ</th>
                                                <th>Tổng tiền</th>
                                                <th>Trạng thái</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($orders as $order)
                                            <tr>
                                                <td class="text-center">{{ $order->id }}</td>
                                                <td>{{ $order->rUsers->email }}</td>
                                                <td>{{ $order->phone }}</td>
                                                <td>{{ $order->address }}</td>
                                                <td>{{ number_format($order->price_total) }}</td>
                                                <td>{{ $order->getStatus() }}</td>

                                                <th class="col-3" style="text-align:right;">
                                                    @if($order->status != 4)
                                                    <a href="{{ url('/admin/order/update', $order->id) }}"><button
                                                            class="btn btn-outline-primary m-1"
                                                            name="btn-update[{{ $order->id }}]"
                                                            id="{{ $order->id }}">Chỉnh
                                                            sửa</button></a>
                                                    <button class="btn btn-outline-danger m-1"
                                                        name="btn-delete[{{ $order->id }}]"
                                                        id="{{ $order->id }}">Xóa</button>
                                                    @endif
                                                </th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Địa chỉ</th>
                                                <th>Tổng tiền</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
            </section>
        </div>
    </div>
</div>
<script>
    $('[name^="btn-delete"]').each(function() {
            $(this).click(function() {
                var id = $(this).attr('id');
                isDelete = window.confirm('Bạn có muốn xóa ' + id);
                if (isDelete) {
                    $.ajax({
                        url: '{{ url('/admin/orders/delete/delete') }}/' + id,
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                        }
                    }).done(function(data) {
                        window.location = '{{ url('/admin/order') }}';
                    });
                }
            });
        });
</script>
@endsection
