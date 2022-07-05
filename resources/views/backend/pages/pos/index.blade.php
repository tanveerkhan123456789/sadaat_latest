@extends('backend.layouts.master')

@section('title')
POS
@endsection

@php

$catagories = \App\Models\Catagory::all();

@endphp
@section('styles')
<!-- Start datatable css -->


<style>
    #minus-btn {
        background-color: #d6deff;
        border: none;
        box-shadow: none;

    }

    #plus-btn {
        background-color: #d6deff;
        border: none;
        box-shadow: none;
    }

    #posCard {
        height: 85vh;
        margin-bottom: 20px;
    }

    #secondTable {
        position: absolute;
        bottom: 0px;
        left: 0px;
    }

    .user-profiles {
        color: #000 !important;
        background: #e3e3e394;
        padding: 9px 40px;
        color: #fff;
    }


    #qty_input {
        padding: 0px;
        width: 14%;
        text-align: center;
    }

    /*left right modal*/
    .modal.left_modal,
    .modal.right_modal {
        position: fixed;
        z-index: 99999;
    }

    .modal.left_modal .modal-dialog,
    .modal.right_modal .modal-dialog {
        position: fixed;
        margin: auto;
        width: 450px;
        max-width: 85%;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal-dialog {
        /* max-width: 100%; */
        margin: 1.75rem auto;
    }

    @media (min-width: 576px) {
        .left_modal .modal-dialog {
            max-width: 100%;
        }

        .right_modal .modal-dialog {
            max-width: 100%;
        }
    }

    .modal.left_modal .modal-content,
    .modal.right_modal .modal-content {
        /*overflow-y: auto;
                        overflow-x: hidden;*/
        height: 100vh !important;
    }

    .modal.left_modal .modal-body,
    .modal.right_modal .modal-body {
        padding: 15px 15px 30px;
    }

    /*.modal.left_modal  {
                        pointer-events: none;
                        background: transparent;
                    }*/

    .modal-backdrop {
        display: none;
    }

    /*Left*/
    .modal.left_modal.fade .modal-dialog {
        left: -50%;
        -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
        -o-transition: opacity 0.3s linear, left 0.3s ease-out;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left_modal.fade.show .modal-dialog {
        left: 0;
        box-shadow: 0px 0px 19px rgba(0, 0, 0, .5);
    }

    /*Right*/
    .modal.right_modal.fade .modal-dialog {
        right: -50%;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }



    .modal.right_modal.fade.show .modal-dialog {
        right: 0;
        box-shadow: 0px 0px 19px rgba(0, 0, 0, .5);
        width: 50%;
    }

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }



    .modal-header.left_modal,
    .modal-header.right_modal {

        padding: 10px 15px;
        border-bottom-color: #EEEEEE;
        background-color: #FAFAFA;
    }

    .modal_outer .modal-body {
        /*height:90%;*/
        overflow-y: auto;
        overflow-x: hidden;
        height: 91vh;
    }

    .catagory:hover {
        border: 1px solid grey;
    }
</style>
@endsection


@section('admin-content')
{{-- <div class="main-content">
</div> --}}


<div class="container-fluid ">
    <div class="row">

        <div class="col-md-6" style="margin-top: 8px">
            <div class="card" id="posCard">
                <div class="card-body">
                    {{-- <div class="row">
                        <div class="col-md-6">
                            <select name="" class="form-control">
                                <option value="" selected disabled>Select warehouse</option>
                                @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->wareh_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 d-flex">
                            <select name="" class="form-control">
                                <option value="" selected disabled>Select customer</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-flat btn-outline-secondary btn-sm" data-toggle="modal"
                                data-target="#customerModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                    </div> --}}

                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Pice</th>
                                <th>Quantity</th>
                                <th>SubTotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Computer</td>
                                <td>20.0</td>
                                <td class="col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn btn-default btn-sm" id="minus-btn"><i
                                                    class="fa fa-minus"></i></button>
                                        </div>
                                        <input type="number" id="qty_input" class="form-control form-control-sm"
                                            value="1" min="1">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-default btn-sm" id="plus-btn"><i
                                                    class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </td>
                                <td>100</td>
                                <td class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table" id="secondTable">
                        <tbody>
                            <tr>
                                <td>Items</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-md-6" style="margin-top: 8px">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-sm w-100" style="border: 0px; font-weight: bold;"
                                id="modal_view_right" data-toggle="modal"
                                data-target="#information_modal">Category</button>
                        </div>
                    </div>
                    {{-- <i class="fa fa-angle-down user-profiles float-right" data-toggle="dropdown"
                        aria-expanded="false"></i>

                    <div class="dropdown-menu" x-placement="bottom-start"
                        style="position: absolute; transform: translate3d(10px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="http://localhost/sadaat/public/admin/logout/submit"
                            onclick="event.preventDefault();
                                                              document.getElementById('admin-logout-form').submit();">Log
                            Out</a>
                    </div>

                    <form id="admin-logout-form" action="http://localhost/sadaat/public/admin/logout/submit"
                        method="POST" style="display: none;">
                        <input type="hidden" name="_token" value="iHu5qEIolQcrZU3vs73oCQoH1wJq9lYqImCg1tCO">
                    </form> --}}
                </div>
            </div>



        </div>
    </div>
</div>


<!-- Quick Add Customer Modal Start -->
{{-- <div class="modal fade bd-example-modal-lg" id="customerModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('quick-customer-store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="wareh_name">Customer Group</label>
                            <select name="customer_group_id" id="cus" class="form-control" required>
                                <option value="" selected disabled>Choose Customer Group</option>
                                @foreach ($customer_groups as $customer_group)
                                <option value="{{ $customer_group->id }}">{{ $customer_group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="wareh_name">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="email"> Company Name</label>
                            <input type="text" class="form-control" name="company_name" required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="email"> Email</label>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="email"> Tax Number</label>
                            <input type="number" class="form-control" name="tax_number" required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="email"> Phone Number</label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="email"> Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="email"> City</label>
                            <input type="text" class="form-control" name="city" required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="email"> State</label>
                            <input type="text" class="form-control" name="state" required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="email"> Postal Code</label>
                            <input type="text" class="form-control" name="p_code" required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="email"> Country</label>
                            <input type="text" class="form-control" name="country" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary save_customer">Save</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}
<!-- Quick Add Customer Modal End -->


<!-- left modal -->
<div class="modal modal_outer right_modal fade" style="width: 0%;" id="information_modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <form method="post" id="get_quote_frm">
            <div class="modal-content ">
                <!-- <input type="hidden" name="email_e" value="admin@filmscafe.in"> -->
                <div class="modal-header">
                    <p class="modal-title">Choose Category</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body get_quote_view_modal_body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($catagories as $catagory)
                                <div class="col-md-3 text-center catagory" catagory_id="{{ $catagory->id }}">
                                    <img src="{{ asset('storage/app/public/uploads/catagory/' . $catagory->catagory_img) }}"
                                        class="img-fluid" alt="" width="70px;" style="cursor: pointer;">
                                    <p>{{ $catagory->catagory_name }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>

    </div><!-- modal-content -->
    </form>
</div><!-- modal-dialog -->
</div><!-- modal -->
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


<script>
    $(document).ready(function() {
            $('#qty_input').prop('disabled', true);
            $('#plus-btn').click(function() {
                $('#qty_input').val(parseInt($('#qty_input').val()) + 1);
            });
            $('#minus-btn').click(function() {
                $('#qty_input').val(parseInt($('#qty_input').val()) - 1);
                if ($('#qty_input').val() == 0) {
                    $('#qty_input').val(1);
                }

            });


            $('.catagory').on('click', function () { 

                var id = $(this).attr('catagory_id');
                alert(id);
                $('#information_modal').modal('hide');
                
            });

        });
</script>
@endsection