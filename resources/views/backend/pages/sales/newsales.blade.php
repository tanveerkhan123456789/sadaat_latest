@extends('backend.layouts.master')

@section('title')
Admins - Admin Panel
@endsection
@php $all=App\Models\Purchase_product::get(); @endphp

@section('styles')
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">sales</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Sales</span></li>
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
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
   <h4 class="header-title float-left">Add Sales </h4>
                                       
                    <div class="clearfix " style="margin-top: 40px;">
                        <form action="{{route('admin.sale.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card ">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <label for="">Warehouse </label>
                                        <select name="warehouse_id" id="cus" class="form-control" required>
                                            <option value="" selected disabled>Choose Warehouse</option>
                                            @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->wareh_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Customer </label>
                                        <select name="customer_id" id="cus1" class="form-control" required>
                                            <option value="" selected disabled>Choose Customer</option>
                                            @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <label for="">Order Status </label>
                                        <select name="order_status" id="cus1" class="form-control">
                                            <option value="" selected disabled>Choose Status</option>
                                            <option value="1">Pending</option>
                                            <option value="2">Completed</option>
                        
                                        </select>
                                    </div>
                        
                                    <div class="col-md-3 mt-3">
                                        <label for="">payment Status </label>
                                        <select name="payment_status" id="cus1" class="form-control">
                                            <option value="" selected disabled>Choose Status</option>
                                            <option value="1">Received</option>
                                            <option value="2">Partial</option>
                                            <option value="3">Pending</option>
                                            <option value="4">Ordered</option>
                                        </select>
                                    </div>
                        
                                    <div class="col-md-6 mt-3">
                                        <label for="">Attach Document </label>
                                        <input type="file" name="document" class="form-control" required>
                                    </div>
                        
                                    <div class="col-md-12 mt-3">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Name</th>
                                                    {{-- <th>Code</th> --}}
                                                    <th>Quantity</th>
                                                    <th>Sale Price</th>
                                                    <!-- <th>Discount</th> -->
                                                    <th>SubTotal</th>
                                                    <th>ADD</th>
                                                </tr>
                                            </thead>
                        
                                            <tbody id="purchaseTable">
                                                <tr>
                                                    <td> <select name="product_id[]" class="form-control product_id select_product">
                                                            <option value="" selected disabled>Choose Product</option>
                                                            @foreach ($products as $product)
                        
                                                            <option value="{{ $product->product_id }}">
                                                                @php
                                                                $product_table=App\Models\Product::where('id',$product->product_id)->first();
                                                                @endphp
                        
                                                                {{ $product_table->product_name }}</option>
                                                            @endforeach
                        
                                                        </select></td>
                                                    <td><input type="text" class="form-control name" name="name[]"
                                                            placeholder="Name">
                                                    </td>
                                                    {{-- <td><input type="text" class="form-control code" name="code[]"
                                                            placeholder="code">
                                                    </td> --}}
                                                    <td><input type="text" class="form-control latestqty qty" name="qty[]"
                                                            placeholder="0.00">
                                                            <span class="qty-error" style="color: red; font-weight:bold;"></span>
                                                        </td>
                                                    <td><input type="number" class="form-control cost" name="price[]"
                                                            placeholder="0.00">
                                                    </td>
                                                    <!-- <td style="    display: inline-flex; "> <button style="width:50px; ;
                        border-radius: 0px;" type="button" id="as" class="btn btn-success btn-sm"><i
                                                            class="fa fa-fan" aria-hidden="true"></i></button><input style="width: 84px; border-radius: 0px;" type="text"  class="form-control discont" name="discont[]"
                                                        placeholder="0.00"></td> -->
                                                    <td><input type="number" class="form-control subtot" name="product_subtot[]"
                                                            placeholder="0.00"></td>
                                                    <td><button type="button" id="addRow" class="btn btn-success btn-sm"><i
                                                                class="fa fa-plus" aria-hidden="true"></i></button>
                        
                                                    </td>
                                                </tr>
                                            </tbody>
                        
                                            <tr>
                                                <th>Total</th>
                                                <td></td>
                                                <td class="totQty font-weight-bold">0</td>
                                                <td></td>
                                                <td class="totDis font-weight-bold">0.00</td>
                                                <td class="font-weight-bold grand_total">0.00</td>
                                            </tr>
                                        </table>
                                    </div>
                        
                                    <div class="col-md-6 mt-3">
                                        <label for="">Order Discount </label>
                                        <input type="text" name="order_discount" class="form-control order_discount" required>
                                    </div>
                        
                                    <div class="col-md-6 mt-3">
                                        <label for="">Shipping Cost </label>
                                        <input type="text" name="shipping_cost" class="form-control shipping_cost" required>
                                    </div>
                        
                        
                        
                        
                                    <div class="col-md-6 mt-3">
                                        <label for="">Sale Note </label>
                                        <textarea name="sale_note" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                        
                                    <div class="col-md-6 mt-3">
                                        <label for="">Staff Note </label>
                                        <textarea name="staf_note" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                        
                                </div>
                        
                                <table class="table mt-4 table-bordered">
                                    <thead>
                                        <tr>
                                            <input type="hidden" class="Total_quantity" name="total_quantity">
                                            <input type="hidden" class="all_total" name="sub_total">
                        
                                            <th>Items <span class="float-right text-secondary number_item">1</span></th>
                                            <th>Shipping Cost <span class="float-right text-secondary all_shipping">0.00</span>
                                            </th>
                                            <th>Order Discount <span class="float-right text-secondary all_disc">0.00</span>
                                            </th>
                                            <th>Sub Total <span class="float-right text-secondary all_total">0.00</span></th>
                                            <th>Grand Total <span class="float-right text-secondary all_total granddsocount"
                                                    i>0.00</span></th>
                                            <input type="hidden" name="grand_total" class="all_total granddsocount">
                                        </tr>
                                    </thead>
                                </table>
                        
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        </form>
                        
    <!-- data table end -->

</div>

<div id="purchaseTable1" style="display: none;">
    <table>
        <tr>
            <td> <select name="product_id[]" id="cus1" class="form-control select_product product_id">
                    <option value="" selected disabled>Choose Product</option>
                    @foreach ($products as $product)

                    <option value="{{ $product->product_id }}">
                        @php
                        $product_table=App\Models\Product::where('id',$product->product_id)->first();
                        @endphp

                        {{ $product_table->product_name }}</option>
                    @endforeach

                </select></td>
            <td><input type="text" class="form-control name" name="name[]" placeholder="Name"></td>
            {{-- <td><input type="text" class="form-control code" name="code[]" placeholder="0.00"></td> --}}
            <td><input type="number" class="form-control  latestqty qty" name="qty[]" placeholder="0.00">
                <span class="qty-error" style="color: red; font-weight:bold;"></span>

            </td>

            <td><input type="text" class="form-control cost" name="price[]" placeholder="0.00"></td>
            <!-- <td><input type="number" class="form-control discont" name="product_discont" placeholder="0.00"></td> -->
            <td><input type="number" class="form-control subtot" name="product_subtot[]" placeholder="0.00"></td>
            <td><button type="button" id="deleteRow" class="btn btn-danger btn-sm"><i class="fa fa-trash"
                        aria-hidden="true"></i></button>
            </td>
        </tr>
    </table>
</div>

@endsection



@section('scripts')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

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