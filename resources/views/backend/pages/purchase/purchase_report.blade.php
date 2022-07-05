@extends('backend.layouts.master')

@section('title')
Purchase
@endsection

@section('styles')

{{-- <!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css"> --}}
@endsection


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
                    <li><span>All Purchases</span></li>
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

    <div class="card mt-4">
        <form action="{{ route('purchase.report') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                {{-- <h4 class="header-title float-left">Purchase</h4> --}}
{{-- <input name="search" value="1" type="hidden"> --}}
                <div class="row">
                    <div class="col-md-3 ">

                        <label for="">Warehouse </label>
                        <select name="warehouse_id" id="cus" class="form-control" >
                            <option value="" selected disabled>Choose Warehouse</option>
                            @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}">{{ $warehouse->wareh_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 ">
                        <label for="supplier_id">Suppliers </label>

                        <select name="supplier_id" id="cus1" class="form-control" >
                                <option value="" selected disabled>Choose Supplier</option>
                                @foreach ($supplier as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>

                    </div>
                    <div class="col-md-2 ">
                        <label for="">Start Date </label>
                        <input type="date"    id="inputId" style="height: 50%" name="start_date" class="form-control ">
                    </div>
                    <div class="col-md-2 ">
                        <label for="">End Date </label>
                        <input type="date" id="enddate" style="height: 50%" name="end_date" class="form-control ">
                    </div>
                    <div class="col-md-2 mt-4">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-search"> </i> Search </button>
                    </div>
                </div>
        </form>
        <br>
        {{-- <p class="float-right mb-2">
            @if (Auth::guard('admin')->user()->can('admin.edit'))
            <a href="{{ url('create-purchase') }}" type="button" class="btn btn-primary btn-flat btn-md"> +
                Add New
            </a>
            @endif
        </p> --}}

        <div class="clearfix"></div>
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

                            <a type="button" href="#" data-toggle="modal"
                                data-target="#paymentModal-{{ $purchase->id }}"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>








        </div>

    </div>

</div>


</div>

@foreach ($purchases as $key => $purchase)
<div class="modal fade" id="paymentModal-{{ $purchase->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supplier Name {{ $purchase->supplier->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table class="table text-center">
                    <thead>

                        <tr>
                            <th>Product</th>
                            {{-- <th>Code</th> --}}
                            <th>UnitCost</th>

                            <th>Quantity</th>
                            <th>Avaible Quantity</th>

                            <th>sale price</th>
                            <th>SubTotal</th>
                            {{-- <th> <button type="button" id="addRow" class="btn btn-success btn-sm float-right"><i
                                        class="fa fa-plus" aria-hidden="true"></i></button>

                            </th> --}}
                        </tr>
                    </thead>
                    <tbody id="purchaseTable" class="text-center">
                        @foreach($purchase->product_purchase as $value)
                        <tr>
                            <td> 
                                {{-- <select name="product_id[]" class="form-control select_product"> --}}
                                    @foreach ($products as $product)
                                    {{-- <option value="{{ $product->id}}" @if ($value->product_id == --}}
                                        {{-- $product->id) selected --}}
                                         @if ($value->product_id ==  $product->id)
                                        {{ $product->product_name }}
@endif
                                        @endforeach
                                        {{-- > --}}
                                        {{-- {{ $product->product_name }} --}}
                                    {{-- </option> --}}
                                    
                                {{-- </select> --}}
                            </td>
                            {{-- <td><input type="text" class="form-control name" value="{{ $value->name }}"
                                    name="name[]" placeholder="Name">
                            </td> --}}
                            {{-- <td><input type="text" class="form-control code" value="{{ $value->code }}"
                                    name="code[]" placeholder="code">
                            </td> --}}

                            <td>
                                {{-- <input type="number" class="form-control cost" value="{{ $value->net_unit_cost }}"
                                    name="net_unit_cost[]" placeholder="0.00"> --}}
                                    {{ $value->net_unit_cost }}
                            </td>
                            <td>
                                {{-- <input type="text" class="form-control qty" name="qty[]" value="{{ $value->qty }}"
                                    placeholder="0.00"> --}}
                                    {{ $value->qty }}
                            </td>
                            <td>
                                {{-- <input type="text" class="form-control avaiable_stock" name="avaiable_stock[]"
                                    value="{{ $value->avaiable_stock }}" placeholder="0.00"> --}}
                                    {{ $value->avaiable_stock }}
                            </td>
                            <td>
                                {{-- <input type="text" class="form-control sale" name="sale_price[]"
                                    value="{{ $value->sale_price }}" placeholder="0.00"> --}}
                                    {{ $value->sale_price }}
                            </td>
                            {{-- <td><input type="number" class="form-control discont" name="discont[]"
                                    placeholder="0.00"></td> --}}
                            <td>
                                {{-- <input type="number" class="form-control subtot" name="total[]" placeholder="0.00"
                                    readonly value="{{ $value->total }}"> --}}
                                    {{ $value->total }}
                                </td>
                            {{-- <td><button type="button" id="deleteRow" class="btn btn-danger btn-sm"><i
                                        class="fa fa-trash" aria-hidden="true"></i></button>
                            </td> --}}
                        </tr>

                        @endforeach

                    </tbody>
                </table>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

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

        const inputDate = document.getElementById("inputId");

inputDate.addEventListener("focus",function (evt) {
  if (this.getAttribute("type")==="date") {
    this.showPicker();
  }

  
});
const enddate = document.getElementById("enddate");

enddate.addEventListener("focus",function (evt) {
  if (this.getAttribute("type")==="date") {
    this.showPicker();
  }

  
});
</script>
@endsection