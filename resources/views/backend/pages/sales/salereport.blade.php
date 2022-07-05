@extends('backend.layouts.master')

@section('title')
Admins - Admin Panel
@endsection
@php $all=App\Models\Purchase_product::get(); @endphp
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
@section('styles')

@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Sale Report</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Sales Report</span></li>
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
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-4">
            
            <div class="card">
                    <form action="{{ route('admin.sale.report') }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="customer_id">Customers </label>
            
                                    <select name="customer_id" id="cus1" class="form-control" >
                                            <option value="" selected disabled>Choose Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
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
                    {{-- <p class="float-right mb-2">
                        @if (Auth::guard('admin')->user()->can('admin.edit'))
                        <a type="button" href="{{ url('add-sales') }}"  class="btn btn-primary btn-flat btn-md" 
                            data-target=".bd-example-modal-lg">+ Add new
                    </a> @endif
                    </p> --}}
                    <div class="clearfix " style="margin-top: 40px;"></div>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">

                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="5%">warehouse name</th>
                                    <th width="5%">Customer name</th>
                                    <th width="5%">Payment Status</th>
                                    <th width="5%">Payment Status</th>
                                    <th width="5%">Grand Total</th>

                                    <th width="5%">created Date</th>

                                    <th width="5%">image</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sale as $ware)
                                <tr>
                                    <td>{{$ware->id}}</td>

                                    <td>{{$ware->ware->wareh_name}}</td>
                                    <td>{{$ware->customer->name}}</td>
                                    <td>
                                        @if ($ware->payment_status == '1')
                                        <span class="badge badge-pill badge-success">Received</span>
                                        @elseif ($ware->payment_status == '2')
                                        <span class="badge badge-pill badge-success">Partial</span>
                                        @elseif ($ware->payment_status == '3')
                                        <span class="badge badge-pill badge-warning">Pending</span>
                                        @else
                                        <span class="badge badge-pill badge-info">Ordered</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($ware->sale_status == '1')
                                        <span class="badge badge-pill badge-warning"> Pending</span>
                                        @else ($ware->sale_status == '2')
                                        <span class="badge badge-pill badge-success">Completed</span>

                                        @endif
                                    </td>
                                    <td>{{ $ware->grand_total}}</td>

                                    <td>{{ date('d-m-Y', strtotime($ware->created_at))}}</td>
                                    <td> <img src="{{ asset('storage/app/public/uploads/sale/'.$ware->document) }}"
                                            width="30%"></td>

                                       
                                    <td>
                                        <a type="button" href="#" data-toggle="modal"
                                            data-target="#paymentModal-{{ $ware->id }}"><i class="fa fa-eye"></i></a>
                                    </td>



                    </div>
                    </form>

                    @endforeach
                    </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- data table end -->

</div>

</div>


@foreach($sale as $ware)
<div class="modal fade" id="paymentModal-{{ $ware->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer Name {{ $ware->customer->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table class="table">
                    <thead>
                        
                        <tr>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Quantity</th>

                            <th>Sale Price</th>

                            {{-- <th>Avaible Quantity</th> --}}

                            {{-- <th>sale price</th> --}}
                            <th>SubTotal</th>
                            {{-- <th> <button type="button" id="addRow"
                                    class="btn btn-success btn-sm float-right"><i class="fa fa-plus"
                                        aria-hidden="true"></i></button>

                            </th> --}}
                        </tr>
                    </thead>
                    <tbody id="purchaseTable">
                        @foreach ($ware->product_sale as $value)
                        @php
                        $product_table=App\Models\Product::where('id',$value->product_id)->first();


                        $newe=App\Models\Product::where('id',$value->product_id)->first();
                        @endphp
                        <tr>
                            <td> <select name="product_id[]" class="form-control select_product product_id">


                                    @foreach ($products as $product)
                                    <option value="{{ $product->product_id }}" @if ($product->
                                        product_id == $newe->id) selected @endif>
                                        @php
                                        $product_table=App\Models\Product::where('id',$product->product_id)->first();
                                        @endphp
                                        {{ $product_table->product_name }}</option>
                                    @endforeach
                                </select></td>
                            <td><input type="text" class="form-control name" name="name[]" readonly
                                    value="{{ $value->product_name }}" placeholder="Name">
                            </td>
                            {{-- <td><input type="text" class="form-control code" name="code[]"
                                    value="{{ $product_table->product_code }}" placeholder="code">
                            </td> --}}
                            <td><input type="text" class="form-control qty latestqty" name="qty[]"
                                    value="{{ $value->product_qty }}" placeholder="0.00">
                                    <span class="qty-error" style="color: red; font-weight:bold;"></span>

                                </td>
                            <td><input type="number" class="form-control cost" name="price[]"
                                    value="{{ $value->product_unit_price }}" placeholder="0.00">
                            </td>
                            <!-- <td style="    display: inline-flex; "> <button style="width:50px; ;
border-radius: 0px;" type="button" id="as" class="btn btn-success btn-sm"><i
                                    class="fa fa-fan" aria-hidden="true"></i></button><input style="width: 84px; border-radius: 0px;" type="text"  class="form-control discont" name="discont[]"
                                placeholder="0.00"></td> -->
                            <td><input type="number" class="form-control subtot"
                                    name="product_subtot[]"
                                    value="{{ $value->product_total_price }}" placeholder="0.00">
                            </td>
                            {{-- <td><button type="button" id="deleteRow" class="btn btn-danger  btn-sm"
                                    items="{{ $ware->item }}"><i class="fa fa-trash"
                                        aria-hidden="true"></i></button></td> --}}

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
{{-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script> --}}
<script>
 
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
<script>
    
    /*================================
                                                                                                                                                datatable active
                                                                                                                                                ==================================*/
        if ($('#dataTables').length) {
            $('#dataTables').DataTable({});
        }
        
$(document).on('keyup', '.invoice_item_price, .invoice_item_quantity, .invoice_item_discount', function() {

  var sum = 0;
  var disc = 0;
  
  $('.invoice-table > tbody > tr').each(function() {
    var price = $(this).find('.invoice_item_price').val();
    var quantity = $(this).find('.invoice_item_quantity').val();
    var discount = $(this).find('.invoice_item_discount').val();
    var total = quantity * price;

    if (discount) {
      var dec = (discount / 100).toFixed(2);
      var mult = total * dec;
      disc += mult;
      total = total - mult;
    }

    $(this).find('.invoice_item_total_amount').val(total);
    sum += total;
  });

  $('#invoice_total_amount').text(sum);
  $("#invoice_total_discount").text(disc);

});

        $(document).ready(function() {
      
            $('#purchaseTable').on('keyup', '.latestqty', function() {
            var qty = $(this).val();
            var $currentRow = $(this).closest('tr');
            var product_id = $currentRow.find('.product_id').val();

            $.ajax({

                type: 'ajax',

                method: 'get',

                url: '{{ url('/all/purchses/ajaxdata') }}',

                data: {
                    product_id: product_id
                },

                async: false,

                dataType: 'json',

                success: function(data) {
                   
                    if (parseFloat(qty) > parseFloat(data.qty)) {
                        var p = '<span style="color:red">stock not exist</span>';
                        $currentRow.find('.qty-error').html(p);


                    } else {
                        var p = '';
                        $currentRow.find('.qty-error').html(p);
                    }

                },

                error: function() {

                    toastr.error('Could not get Data from Database');

                }

            });



        });

        $('#purchaseTable').on('change', '.select_product', function() {

                var product_id = $(this).val();
                var $currentRow = $(this).closest('tr');

                $.ajax({

                    type: 'ajax',
                    method: 'get',
                    url: '{{ url('get-product-detail') }}',
                    data: {
                        product_id: product_id,
                    },
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        $currentRow.find('.name').val(data[0]['product_name']);
                        $currentRow.find('.code').val(data[0]['product_code']);
                        $currentRow.find('.cost').val(data[1]['sale_price']);
                        // var qty_database=data[1]['qty'];
// alert(qty);
                     

                
                    },

                    error: function() {
                        toastr.error('Database error');
                    }

                });
            });

            $('#purchaseTable').on('change', '.select_product', function() {

                var product_id = $(this).val();
                var $currentRow = $(this).closest('tr');

                $.ajax({

                    type: 'ajax',
                    method: 'get',
                    url: '{{ url('get-product-detail') }}',
                    data: {
                        product_id: product_id,
                    },
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        $currentRow.find('.name').val(data[0]['product_name']);
                        $currentRow.find('.code').val(data[0]['product_code']);
                        $currentRow.find('.cost').val(data[1]['sale_price']);
                        // var qty_database=data[1]['qty'];
// alert(qty);
                  

                
                    },

                    error: function() {
                        toastr.error('Database error');
                    }

                });
            });


            $('#purchaseTable').on('keyup', '.qty', function() {

                var qty = $(this).val();

                var $currentRow = $(this).closest('tr');
                var cost = $currentRow.find('.cost').val();
                var subtotal = parseFloat(cost) * parseFloat(qty);
                $currentRow.find('.subtot').val(subtotal);
                grandTotal();
                totalDiscont();
                totalQty();


            });
            $('#purchaseTable').on('keyup','.cost', function() {

var qty = $(this).val();

var $currentRow = $(this).closest('tr');
var cost = $currentRow.find('.qty').val();
var subtotal = parseFloat(cost) * parseFloat(qty);
$currentRow.find('.subtot').val(subtotal);
grandTotal();
totalDiscont();
totalQty();


});

            $('#purchaseTable').on('change', '.discont', function() {


var $currentRow = $(this).closest('tr');
var disc = $currentRow.find('.discont').val();
var subtotal = $currentRow.find('.subtot').val();

var main1 = (disc / 100).toFixed(2);

var mult1 = subtotal * main1;


var totaldisc = Math.ceil(parseFloat(subtotal) - parseFloat(mult1));


$currentRow.find('.subtot').val(totaldisc);
grandTotal();

});
$('.order_discount').on('keyup', function() {

var order_disc = $(this).val();
var a = $('.grand_total').text();
var a = $('.grand_total').val();

var main = (order_disc / 100).toFixed(2);

var mult = a * main;

var totaldisc = a - mult;

if (order_disc == "") {
    $('.all_total').text(a);
    $('.all_total').val(a);

} else {
    var a = $('.granddsocount').text(totaldisc);
    var a = $('.granddsocount').val(totaldisc);

}

$('.all_disc').text(order_disc);
$('.all_disc').val(order_disc);

});

            $('.shipping_cost').on('keyup', function() {

                var ship_cost = $(this).val();
                $('.all_shipping').text(ship_cost);

            });

            function grandTotal() {
                var grandTotal = 0;
                $(".subtot").each(function() {
                    var subTotals = $(this).val();
                    // alert(subTotals);
                    (subTotals) ? grandTotal = parseFloat(grandTotal) + parseFloat(subTotals): '';

                });

                $('.grand_total').text(grandTotal);
                $('.all_total').text(grandTotal);
                $('.all_total').val(grandTotal);
                $('.grand_total').val(grandTotal);

            }

            function grandTotalDecrement() {
                var grandTotal1 = 0;
                $(".subtot").each(function() {
                    var subTotals1 = $(this).val();
                    // alert(subTotals);
                    (subTotals1) ? grandTotal1 = parseFloat(grandTotal1) - parseFloat(subTotals1): '';
                });

                $('.grand_total').text(grandTotal1);
            }

            function totalDiscont() {
                var totalDisc = 0;
                $(".discont").each(function() {
                    var dis = $(this).val();
                    // alert(subTotals);
                    (dis) ? totalDisc = parseFloat(totalDisc) + parseFloat(dis): '';

                });

                $('.totDis').text(totalDisc);

            
            }

            function totalQty() {
                var totalQty = 0;
                $(".qty").each(function() {
                    var qty = $(this).val();
                    // alert(subTotals);
                    (qty) ? totalQty = parseFloat(totalQty) + parseFloat(qty): '';

                });

                $('.totQty').text(totalQty);
                $('.Total_quantity').val(totalQty);

                
            }


            function MinustotalQty() {
                var totalQty = 0;
                $(".qty").each(function() {
                    var qty = $(this).val();
                    // alert(subTotals);
                    (qty) ? totalQty = parseFloat(totalQty) - parseFloat(qty): '';

                });

                $('.totQty').text(totalQty);
                $('.Total_quantity').val(totalQty);

                
            }

            var x = 1; //Initial field counter is 1

//Once add button is clicked


$('#addRow').on('click', function() {
    var tr = $("#purchaseTable1").find("Table").find("TR:has(td)").clone();
    $("#purchaseTable").append(tr);

    $('.number_item').text(++x);
});



$("#purchaseTable").on('click', '#deleteRow', function() {
    
    $('.number_item').text(--x);

    $(this).closest('tr').remove();
    $('.order_discount').val('0');
    grandTotalDecrement();
    grandTotal();
    MinustotalQty();
    totalDiscont();
    totalQty();
});

        });
</script>
<script>
    /*================================
        datatable active
        ==================================*/
    if ($('#dataTable').length) {
        $('#dataTable').DataTable({});
    }

    $('.show_confirm').click(function(event) {
              var form =  $(this).closest("form");
              var name = $(this).data("name");
              event.preventDefault();
              swal({
                  title: `Are you sure you want to delete this record?`,
                  text: "If you delete this, it will be gone forever.",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                  form.submit();
                }
              });
          });
      
</script>



@endsection