@extends('backend.layouts.master')

@section('title')
    Purchase
@endsection

@section('styles')
    <!-- Start datatable css -->
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection --}}


@section('admin-content')
    <style>
        #cus {
            padding: 6px 10px;
            margin: 0px -1px;
        }

        #cus1 {
            padding: 6px 10px;
            margin: 0px -1px;
        }
    </style>
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h5 class="page-title pull-left">Purchase</h5>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span> Purchase</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->

    <div class="main-content-inner">
        <!-- data table start -->
        <div class="card mt-5">
            <div class="card-body">
                <h4 class="header-title float-left">Purchase</h4>

                <p class="float-right mb-2">
                    @if (Auth::guard('admin')->user()->can('purchase.create'))
                        <a href="{{ url('create-purchase') }}" type="button" class="btn btn-primary btn-flat btn-md"> +
                            Add New
                        </a>
                    @endif
                </p>

                <div class="clearfix " style="margin-top: 40px;"></div>
                <div class="data-tables">
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th width="5%">#</th>
                                <th width="5%">Supplier</th>
                                <th width="5%">Purchase Status</th>
                                <th width="5%">Grand Total</th>
                                <th width="5%">Due</th>
                                <th width="5%">Payment Status</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $key => $purchase)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $purchase->supplier->name }}</td>
                                    <td>
                                        @if ($purchase->payment_status == '1')
                                            <span class="badge badge-pill badge-success">Received</span>
                                        @elseif ($purchase->payment_status == '2')
                                            <span class="badge badge-pill badge-success">Partial</span>
                                        @elseif ($purchase->payment_status == '3')
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-pill badge-info">Ordered</span>
                                        @endif
                                    </td>
                                    <td>{{ $purchase->grand_total }}</td>
                                    <td>{{ $purchase->due_ammount }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-success">Due</span>
                                    </td>
                                    <td>
                                        <div class="btn-group dropleft text-secondary">
                                            <i class="fa fa-ellipsis-v" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" aria-hidden="true" style="cursor: pointer;"></i>
                                            <div class="dropdown-menu" x-placement="left-start"
                                                style="position: absolute; transform: translate3d(-123px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                @if (Auth::guard('admin')->user()->can('purchase.edit'))

                                                <a class="dropdown-item" href="{{ route('admin.purchase.update',$purchase->id) }}" >Edit</a>
                                                
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#paymentModal">Payment</a>
                                                    @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!-- data table end -->
    </div>


    <!-- Add Payment Modal Start -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" name="" />
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Received Amount *</label>
                                <input type="text" class="form-control" value="0">
                            </div>
                            <div class="col-md-6">
                                <label for="">Paying Amount *</label>
                                <input type="text" class="form-control" value="0">
                            </div>
                            <div class="col-md-6">
                                <label for="">Change </label>
                                <input type="text" class="form-control" name="" value="0.00" readonly>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="">Paying Amount *</label>
                                <select name="" class="form-control" required>
                                    <option value="" selected disabled>Choose Pay Method</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Payment Modal End -->
@endsection



@section('scripts')
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script>
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({});
        }
    </script>
@endsection
