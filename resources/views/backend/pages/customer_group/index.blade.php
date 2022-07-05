@extends('backend.layouts.master')

@section('title')
    customer-group
@endsection

@section('styles')
    <!-- Start datatable css -->
   
@endsection


@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Customer Group</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>All Customer Group</span></li>
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
                        <h4 class="header-title float-left">Customer Group List</h4>
                        <p class="float-right mb-2">
                            @if (Auth::guard('admin')->user()->can('customergroup.create'))
                                <button type="button" class="btn btn-primary btn-flat btn-md" data-toggle="modal"
                                    data-target="#add_customer_group_modal">+ Add new
                                </button>
                            @endif
                        </p>
                        <div class="clearfix " style="margin-top: 40px;"></div>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center supplier-table">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">Id</th>
                                        <th width="5%">Name</th>
                                        <th width="5%">Percentage</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="customergroupTable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>

    {{-- Add customer_group Modal Start --}}
    <div class="modal fade bd-example-modal-lg" id="add_customer_group_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Customer Group</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addCustomerGroupForm" method="POST" enctype="multipart/form-data">
                        {{-- @csrf --}}
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="wareh_name">Name</label>
                                <input type="text" class="form-control" placeholder="Name" name="group_name" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email"> Percentage(%)</label>
                                <input type="text" class="form-control" placeholder="Percentage" name="group_percentage" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    
                    <button type="submit" class="btn btn-primary save_customer_group">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add customer_group Modal End --}}


    {{-- Edit customer_group Modal Start --}}
    <div class="modal fade bd-example-modal-lg" id="edit_customer_group_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Customer Group</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editCustomerGroupForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="customer_group_id">
                        {{-- @csrf --}}
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="wareh_name">Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email"> Percentage(%)</label>
                                <input type="text" class="form-control" name="percentage" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    @if (Auth::guard('admin')->user()->can('customergroup.edit'))
                    <button type="submit" class="btn btn-primary update_customer_group">Update</button>
               @endif
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit customer_group Modal End --}}
@endsection



@section('scripts')
    <!-- Start datatable js -->
   

    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            getCustomerGroup();

            function getCustomerGroup() {

                $.ajax({

                    url: '{{ url('/get-customer-group') }}',
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
                                '<td>' + data[i].percentage + ' (%)</td>' +
                                '<td> ' +
                                '<ul class="d-flex justify-content-center"> ' +
                                '<li><a href="#" class="text-secondary edit-customer-group" data="' +
                                data[
                                    i].id + '"><i class="fa fa-edit"></i></a> ' +
                                '</li> ' +
                                @if (Auth::guard('admin')->user()->can('customergroup.delete'))

                                '<li><a href="#" class="text-danger delete-customer-group ml-2" data="' +
                                    data[
                                    i].id + '"><i class="ti-trash"></i></a> ' +
                                    @endif

                                '</li> ' +
                                '</ul> ' +
                                '</td> ' +
                                '</tr>';
                        }


                        $('#customergroupTable').html(html);
            $('#dataTable').DataTable();
        

                    },
                    error: function() {
                        toastr.error('something went wrong');
                    }

                });
            }

            //Add Customer Group
            $('#addCustomerGroupForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData($('#addCustomerGroupForm')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ url('customer-group-store') }}",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.save_customer_group').text('Saving...');
                        $(".save_customer_group").prop("disabled", true);
                    },
                    success: function(response) {

                        if (response.status == 200) {
                            $('.save_customer_group').text('Save');
                            $(".save_customer_group").prop("disabled", false);
                            $(".close").click();
                            $('#addCustomerGroupForm').find('input').val("");
                            toastr.success(response.message);
                            getCustomerGroup();
                            setTimeout(() => {
                                window.location.reload();
                            }, 500);
                        }

                        if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                    error: function() {
                        $('.save_customer_group').text('Save');
                        $(".save_customer_group").prop("disabled", false);
                        toastr.error('something went wrong');
                    },
                });

            });

            //Edit Supplier
            $('#customergroupTable').on('click', '.edit-customer-group', function(e) {
                e.preventDefault();

                var id = $(this).attr('data');

                $('#edit_customer_group_modal').modal('show');

                $.ajax({

                    type: 'ajax',
                    method: 'get',
                    url: '{{ url('customer-group-edit') }}',
                    data: {
                        id: id
                    },
                    async: false,
                    dataType: 'json',
                    success: function(data) {

                        $('input[name=customer_group_id]').val(data.customer_group.id);
                        $('input[name=name]').val(data.customer_group.name);
                        $('input[name=percentage]').val(data.customer_group.percentage);
                    },

                    error: function() {

                        toastr.error('something went wrong');

                    }

                });

            });

            //Update Customer Group
            $('.update_customer_group').on('click', function(e) {
                e.preventDefault();


                let EditFormData = new FormData($('#editCustomerGroupForm')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ url('customer-group-update') }}",
                    data: EditFormData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function() {
                        $('.update_customer_group').text('Updating...');
                        $(".update_customer_group").prop("disabled", true);
                    },
                    success: function(response) {

                        if (response.status == 200) {
                            $('#edit_customer_group_modal').modal('hide');
                            $('#editCustomerGroupForm').find('input').val("");
                            $('.update_customer_group').text('Update');
                            $(".update_customer_group").prop("disabled", false);
                            toastr.success(response.message);
                            getCustomerGroup();
                        }
                    },
                    error: function() {
                        toastr.error('something went wrong');
                        $('.update_customer_group').text('Update');
                        $(".update_customer_group").prop("disabled", false);
                    }
                });

            });

            // Delete Customer Group
            $('#customergroupTable').on('click', '.delete-customer-group', function(e) {
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
                            url: "{{ url('customer-group-delete') }}",
                            data: {
                                id: id
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: "json",
                            success: function(response) {

                                toastr.success(response.message);
                                getCustomerGroup();
                                setTimeout(() => {
                                window.location.reload();
                            }, 500);
                            }
                        });
                    }
                })

            });

        });
    </script>
@endsection
