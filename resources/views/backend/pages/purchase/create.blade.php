@extends('backend.layouts.master')

@section('title')
Add Purchase
@endsection

@section('styles')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
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
                <h5 class="page-title pull-left"> Purchases</h5>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Add Purchase</span></li>
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
    <form action="{{ url('store-purchase') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mt-5">
            <div class="card-body">
                <h4 class="">Add PUrchase</h4>
                <div class="row mt-4">
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
                        <label for="">Supplier </label>
                        <select name="supplier_id" id="cus1" class="form-control" required>
                            <option value="" selected disabled>Choose Supplier</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="">Payment Status </label>
                        <select name="payment_status" id="cus1" class="form-control payment_status_new">
                            <option value="" selected disabled>Choose Status</option>
                            <option value="1">Paid</option>
                            <option value="2">Pending</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-3 credit" style="display: none;">
                        <label for="">Pay Ammount </label>
                        <input type="text" name="pay_amount" class="form-control payamount" >
                        <span id="showerrornew"></span>
                    </div>

                    <div class="col-md-6 mt-3 credit" style="display: none;">
                        <label for="">Due Ammount </label>
                        <input type="text" readonly name="due_amount"  class="form-control due_amount all_total " >
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
                                    <th>Unit Cost</th>
                                    <th>Quantity</th>

                                    <th>Sale Price</th>


                                    <th>SubTotal</th>
                                    <th>ADD</th>
                                </tr>
                            </thead>
                            <tbody id="purchaseTable">
                                <tr>
                                    <td> <select name="product_id[]" class="form-control select_product">
                                            <option value="" selected disabled>Choose Product</option>
                                            @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}
                                            </option>
                                            @endforeach
                                        </select></td>
                                    <td><input type="text" class="form-control name" name="name[]" placeholder="Name">
                                    </td>
                                    {{-- <td><input type="text" class="form-control code" name="code[]"
                                            placeholder="code">
                                    </td> --}}

                                    <td><input type="number" class="form-control cost" name="net_unit_cost[]"
                                            placeholder="0.00">
                                    </td>
                                    <td><input type="text" class="form-control qty" name="qty[]" placeholder="0.00">
                                    </td>
                                    <td><input type="text" class="form-control sale_price" name="sale_price[]"
                                            placeholder="0.00"></td>



                                    {{-- <td><input type="number" class="form-control discont" name="discont[]"
                                            placeholder="0.00"></td> --}}
                                    <td><input type="number" class="form-control subtot" name="total[]"
                                            placeholder="0.00" readonly></td>
                                    <td><button type="button" id="addRow" class="btn btn-success btn-sm"><i
                                                class="fa fa-plus" aria-hidden="true"></i></button>
                                    </td>
                                </tr>

                            </tbody>

                            <tr>
                                <th>Total</th>
                                <td></td>
                                <td></td>
                                <td class="totQty font-weight-bold">0</td>
                                <td></td>
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

                    <div class="col-md-12 mt-3">
                        <label for="">Note </label>
                        <textarea name="note" cols="30" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

                <table class="table mt-4 table-bordered">
                    <thead>
                        <tr>
                            <input type="hidden" name="total_qty" class="Total_quantity">
                            <th>Items <span class="float-right text-secondary number_item">1</span>
                                <input type="hidden" name="item" class="number_item" value="1">
                            </th>
                            <th>Total <span class="float-right text-secondary all_total">0.00</span>
                                <input type="test" name="total_cost" class="all_total">
                            </th>
                            <th>Order Discount <span class="float-right text-secondary all_disc">0.00</span>
                                <input type="hidden" name="order_discount" class="all_disc">
                            </th>
                            <th>Shipping Cost <span class="float-right text-secondary all_shipping">0.00</span>
                                <input type="hidden" name="shipping_cost" class="all_shipping">
                            </th>
                            <th>Grand Total <span class="float-right text-secondary all_total granddsocount"
                                    i>0.00</span>
                                <input type="hidden" name="grand_total" class="all_total granddsocount">
                            </th>
                            {{-- <input type="text" name="grand_total" class="all_total granddsocount"> --}}
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </form>

    <!-- data table end -->


</div>
@endsection



@section('scripts')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>




<div id="purchaseTable1" style="display: none;">
    <table>
        <tr>
            <td> <select name="product_id[]" id="cus1" class="form-control select_product">
                    <option value="" selected disabled>Choose Product</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                    @endforeach
                </select></td>
            <td><input type="text" class="form-control name" name="name[]" placeholder="Name"></td>
            <td><input type="text" class="form-control cost" name="net_unit_cost[]" placeholder="0.00"></td>
            <td><input type="number" class="form-control qty" name="qty[]" placeholder="0.00"></td>

            <td><input type="text" class="form-control code" name="sale_price[]" placeholder="0.00"></td>

            {{-- <td><input type="number" class="form-control discont" name="product_discont" placeholder="0.00"></td>
            --}}
            <td><input type="number" class="form-control subtot" name="total[]" placeholder="0.00" readonly></td>
            <td><button type="button" id="deleteRow" class="btn btn-danger btn-sm"><i class="fa fa-trash"
                        aria-hidden="true"></i></button>
            </td>
        </tr>
    </table>
</div>
<!-- Button trigger modal -->



<script type="text/javascript"></script>
<script>
    $(document).ready(function() {
            $('.payment_status_new').on('change', function() {
              
                //    alert(data); 
                if($(this).val()=='2')
                     {
                        $('.credit').show();
                     }
                     else
                     {
                        $('.credit').hide();

                     }

            });
            $('.payamount').on('keyup', function() {
                  payamount=$('.payamount').val();
                //   alert($payamount);
                  $a=$('.due_amount').val();
                  

                    var a = $('.grand_total').text();
                var a = $('.grand_total').val();


                var mult = a - payamount;


                if (payamount == "") {
                    $('.all_total').text(a);
                    $('.all_total').val(a);
                    

                } 
                else if(parseFloat(a) < parseFloat(payamount))
                  {
                    toastr.error('Pay Amount '+payamount+'  is Greater then Due Amount '+a);

                    var mult = a - payamount;
                    
                    var a = $('.due_amount').val(a);

                  }
                else {

                    var a = $('.due_amount').text(mult);
                    var a = $('.due_amount').val(mult);

                }

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
                    },

                    error: function() {
                        toastr.error('Database error');
                    }

                });
            });


            $('#purchaseTable').on('keyup', '.qty','.cost', function() {

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

            // $('#purchaseTable').on('change', '.discont', function() {


            //     var $currentRow = $(this).closest('tr');
            //     var disc = $currentRow.find('.discont').val();
            //     var subtotal = $currentRow.find('.subtot').val();

            //     var main1 = (disc / 100).toFixed(2);

            //     var mult1 = subtotal * main1;

            //     var totaldisc1 = parseFloat(subtotal) - parseFloat(mult1);


            //     $currentRow.find('.subtot').val(totaldisc1);
            //     grandTotal();

            // });

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
                $('.all_shipping').val(ship_cost);

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
            var y = 1; //Initial field counter is 1

            //Once add button is clicked


            $('#addRow').on('click', function() {
                var tr = $("#purchaseTable1").find("Table").find("TR:has(td)").clone();
                $("#purchaseTable").append(tr);

                $('.number_item').text(++x);
                $('.number_item').val(++y);
                $('.order_discount').val('0');
            });



            $("#purchaseTable").on('click', '#deleteRow', function() {

                $('.number_item').text(--x);
                $('.number_item').val(--y);

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
@endsection