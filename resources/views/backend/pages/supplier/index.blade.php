@extends('backend.layouts.master')
@php
     $usr = Auth::guard('admin')->user();
 @endphp
@section('title')
    All Suplier
@endsection

@section('styles')
    <!-- Start datatable css -->
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css"> --}}
@endsection


@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Supplier</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>All Suppliers</span></li>
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
                        <h4 class="header-title float-left">Supplier List</h4>
                        <p class="float-right mb-2">
                            @if (Auth::guard('admin')->user()->can('supplier.create'))
                                <button type="button" class="btn btn-primary btn-flat btn-md" data-toggle="modal"
                                    data-target="#add_supplier_modal">+ Add new
                                </button>
                            @endif
                        </p>
                        <div class="clearfix " style="margin-top: 40px;"></div>
                        <div class="data-tables">
                            <table id="dataTable2" class="text-center supplier-table">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">Id</th>
                                        <th width="5%">Name</th>
                                        <th width="5%">Company Name</th>
                                        <th width="5%">Address</th>
                                        <th width="5%">City</th>
                                        <th width="5%">Country</th>
                                        <th width="5%">Postal Code</th>
                                        <th width="5%">Phone</th>
                                        <th width="5%">Image</th>

                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="supplierTable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>

    {{-- Add Suplier Modal Start --}}
    <div class="modal fade bd-example-modal-lg" id="add_supplier_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addSupplierForm" method="POST" enctype="multipart/form-data">
                        {{-- @csrf --}}
                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
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
                                <label for="email"> VAT Number</label>
                                <input type="number" class="form-control" name="vat_number" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="email"> Phone</label>
                                <input type="number" class="form-control" name="phone" required>
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
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email"> Country</label>
                                <input type="text" class="form-control" name="country" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email"> Image</label>
                                <input type="file" class="form-control" name="image" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    
                    @if ($usr->can('supplier.create'))
                    <button type="submit" class="btn btn-primary save_suplier">Save</button>
                    @endif
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add Suplier Modal End --}}


    {{-- Edit Suplier Modal Start --}}
    <div class="modal fade bd-example-modal-lg" id="edit_supplier_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editSupplierForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="supplier_id">
                        {{-- @csrf --}}
                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
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
                                <label for="email"> VAT Number</label>
                                <input type="number" class="form-control" name="vat_number" required>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="email"> Phone</label>
                                <input type="number" class="form-control" name="phone" required>
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
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email"> Country</label>
                                <input type="text" class="form-control" name="country" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email"> Image</label>
                                <input type="file" class="form-control" name="image" required>
                                
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="w-100">
                                <h6 class="text-center #badge badge-primary"> Image</h6>
                            </div>
                            <div class="col-md-12">
                                <span id="store_image"></span>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    @if ($usr->can('supplier.edit'))

                    <button type="submit" class="btn btn-primary update_suplier">Update</button>
                    @endif
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit Suplier Modal End --}}
@endsection



@section('scripts')
    <!-- Start datatable js -->
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> --}}


    <script>
        $(document).ready(function() {

            getSupplier();

            function getSupplier() {

                $.ajax({

                    url: '{{ url('/get-supplier') }}',
                    type: 'get',
                    async: false,
                    dataType: 'json',

                    success: function(data) {

                        var html = '';
                        var i;
                        var c = 0;

                        for (i = 0; i < data.length; i++) {

                            c++;
                            html += '<tr>' +
                                '<td>' + c + '</td>' +
                                '<td>' + data[i].name + '</td>' +
                                '<td>' + data[i].company_name + '</td>' +
                                '<td>' + data[i].address + '</td>' +
                                '<td>' + data[i].city + '</td>' +
                                '<td>' + data[i].country + '</td>' +
                                '<td>' + data[i].p_code + '</td>' +
                                '<td>' + data[i].phone + '</td>' +
                                '<td> <img src="{{ asset('storage/app/public/uploads/supplier/') }}/' +
                                data[i].image + '" width="50px"></td>' +
                                '<td> ' +
                                '<ul class="d-flex justify-content-center"> ' +
                                '<li><a href="#" class="text-secondary btn-edit-supplier" data="' +
                                data[
                                    i].id + '"><i class="fa fa-edit"></i></a> ' +
                                '</li> ' +                    
                                 @if ($usr->can('supplier.delete'))

                                '<li><a href="#" class="text-danger btn-delete-supplier ml-2" data="' +
                                
                                    data[
                                    i].id + '"><i class="ti-trash"></i></a> ' 
                                    +@endif
                                '</li> ' +
                                '</ul> ' +
                                '</td> ' +
                                '</tr>';
                        }


                        $('#supplierTable').html(html);
                        $('#dataTable2').DataTable();

                    },
                    error: function() {
                        toastr.error('something went wrong');
                    }

                });
            }

            //Add Supplier
            $('#addSupplierForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData($('#addSupplierForm')[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ url('supplier-store') }}",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.save_suplier').text('Saving...');
                        $(".save_suplier").prop("disabled", true);
                    },
                    success: function(response) {

                        if (response.status == 200) {
                            $('.save_suplier').text('Save');
                            $(".save_suplier").prop("disabled", false);
                            $(".close").click();
                            $('#addSupplierForm').find('input').val("");
                            getSupplier();
                            // $('#dataTable2').DataTable();
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                            toastr.success(response.message);
                        }

                        if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                    error: function() {
                        $('.save_suplier').text('Save');
                        $(".save_suplier").prop("disabled", false);
                        toastr.error('something went wrong');
                    },
                });

            });

            //Edit Supplier
            $('#supplierTable').on('click', '.btn-edit-supplier', function(e) {
                e.preventDefault();

                var id = $(this).attr('data');

                $('#edit_supplier_modal').modal('show');

                $.ajax({

                    type: 'ajax',
                    method: 'get',
                    url: '{{ url('supplier-edit') }}',
                    data: {
                        id: id
                    },
                    async: false,
                    dataType: 'json',
                    success: function(data) {

                        $('input[name=supplier_id]').val(data.suplier.id);
                        $('input[name=name]').val(data.suplier.name);
                        $('input[name=email]').val(data.suplier.email);
                        $('input[name=company_name]').val(data.suplier.company_name);
                        $('input[name=address]').val(data.suplier.address);
                        $('input[name=city]').val(data.suplier.city);
                        $('input[name=vat_number]').val(data.suplier.vat_number);
                        $('input[name=country]').val(data.suplier.country);
                        $('input[name=state]').val(data.suplier.state);
                        $('input[name=p_code]').val(data.suplier.p_code);
                        $('input[name=phone]').val(data.suplier.phone);
                        $('#store_image').html(
                            '<img src="{{ asset('storage/app/public/uploads/supplier/') }}/' +
                            data.suplier.image +
                            '" class="mt-3" width="15%" />'
                        );
                        $('#store_image').append(
                            '<input type="hidden" name="hidden_image" value="' + data
                            .suplier.image + '" />');
                    },

                    error: function() {

                        toastr.error('something went wrong');

                    }

                });

            });

             //Update Events
             $('.update_suplier').on('click', function(e) {
                e.preventDefault();


                let EditFormData = new FormData($('#editSupplierForm')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ url('supplier-update') }}",
                    data: EditFormData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function() {
                        $('.update_suplier').text('Updating...');
                        $(".update_suplier").prop("disabled", true);
                    },
                    success: function(response) {

                        if (response.status == 200) {
                            $('#edit_supplier_modal').modal('hide');
                            $('#editSupplierForm').find('input').val("");
                            $('.update_suplier').text('Update');
                            $(".update_suplier").prop("disabled", false);
                            toastr.success(response.message);
                            getSupplier();
                        }
                    },
                    error: function() {
                        toastr.error('something went wrong');
                        $('.update_suplier').text('Update');
                        $(".update_suplier").prop("disabled", false);
                    }
                });

            });

            // Delete Supplier
            $('#supplierTable').on('click', '.btn-delete-supplier', function(e) {
                e.preventDefault();

                var id = $(this).attr('data');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to Delete this Data!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('supplier-delete') }}",
                            data: {
                                id: id
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: "json",
                            success: function(response) {
                                setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                                toastr.success(response.message);
                                getSupplier();
                                $('#dataTable2').DataTable();
                                
                            }
                        });
                    }
                })

            });

        });
    </script>
@endsection
