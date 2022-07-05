@extends('backend.layouts.master')
@php
     $usr = Auth::guard('admin')->user();
 @endphp
@section('title')
Customer
@endsection

@section('styles')

@endsection


@section('admin-content')
<style>
    #cus {
        padding: 6px 10px;
        margin: 0px -1px;
    }
</style>
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Customer</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Customer</span></li>
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
                    <h4 class="header-title float-left">Customer List</h4>
                    @if( $usr->can('customer.create'))

                    <p class="float-right mb-2">
                        <button type="button" class="btn btn-primary btn-flat btn-md" data-toggle="modal"
                            data-target="#add_customer_modal">+ Add new
                        </button>

                    </p>
@endif

                    <table id="dataTables1" class="table">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th width="5%">#</th>
                                <th width="5%">Customer Group</th>
                                <th width="5%">Name</th>
                                <th width="5%">Company Name</th>
                                <th width="5%">Address</th>
                                <th width="5%">City</th>
                                <th width="5%">Country</th>
                                <th width="5%">Postal Code</th>
                                <th width="5%">Phone</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="customerTable">

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
        <!-- data table end -->

    </div>
</div>

{{-- Add Customer Modal Start --}}
<div class="modal fade bd-example-modal-lg" id="add_customer_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <form action="" id="addCustomerForm" method="POST">
                    {{-- @csrf --}}
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="wareh_name">Customer Group</label>
                            <select name="customer_group_id" id="cus" class="form-control" required>
                                <option value="" selected disabled>Choose Customer</option>
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
</div>
{{-- Add Customer Modal End --}}


{{-- Edit Customer Modal Start --}}
<div class="modal fade bd-example-modal-lg" id="edit_customer_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <form action="" id="EditCustomerForm" method="POST">
                    <input type="hidden" name="customer_id">
                    {{-- @csrf --}}
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="wareh_name">Customer Group</label>
                            <select name="customer_group_id" id="cus" class="form-control" required>
                                <option value="" selected disabled>Choose Customer</option>
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
                            <input type="text" class="form-control" name="phone" id="phone1" required>
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
            @if( $usr->can('customer.edit'))

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary update_customer">Update</button>
            </div>
            @endif
            </form>
        </div>
    </div>
</div>
{{-- Edit Customer Modal End --}}
@endsection



@section('scripts')

<script>
    document.getElementById('phone').addEventListener('input', function(e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        });

        document.getElementById('phone1').addEventListener('input', function(e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        });

        $(document).ready(function() {

            getCustomer();

            function getCustomer() {

                $.ajax({

                    url: '{{ url('/get-customer') }}',
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
                                '<td>' + data[i].customergroup.name + '</td>' +
                                '<td>' + data[i].name + '</td>' +
                                '<td>' + data[i].company_name + '</td>' +
                                '<td>' + data[i].address + '</td>' +
                                '<td>' + data[i].city + '</td>' +
                                '<td>' + data[i].country + '</td>' +
                                '<td>' + data[i].p_code + '</td>' +
                                '<td>' + data[i].phone + '</td>' +
                                '<td> ' +
                                '<ul class="d-flex justify-content-center"> ' +
                                '<li><a href="#" class="text-secondary btn-edit-customer" data="' +
                                data[
                                    i].id + '"><i class="fa fa-edit"></i></a> ' +
                                '</li> ' +
                                @if( $usr->can('customer.delete'))

                                '<li><a href="#" class="text-danger btn-delete-customer ml-2" data="' +
                                    data[
                                    i].id + '"><i class="ti-trash"></i></a> ' +
                                    @endif

                                '</li> ' +
                                '</ul> ' +
                                '</td> ' +
                                '</tr>';
                        }

                        $('#customerTable').html(html);
                        $('#dataTables1').DataTable();

                    },
                    error: function() {
                        toastr.error('something went wrong');
                    }

                });
            }

            //Add Customer
            $('#addCustomerForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData($('#addCustomerForm')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ url('customer-store') }}",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.save_customer').text('Saving...');
                        $(".save_customer").prop("disabled", true);
                    },
                    success: function(response) {

                        if (response.status == 200) {
                            $('.save_customer').text('Save');
                            $(".save_customer").prop("disabled", false);
                            $(".close").click();
                            $('#addCustomerForm').find('input').val("");
                            toastr.success(response.message);
                            getCustomer();
                            setTimeout(() => {
                                window.location.reload();
                            }, 500);
                        }

                        if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                    error: function() {
                        $('.save_customer').text('Save');
                        $(".save_customer").prop("disabled", false);
                        toastr.error('something went wrong');
                    },
                });

            });

            //Edit Customer
            $('#customerTable').on('click', '.btn-edit-customer', function(e) {
                e.preventDefault();

                var id = $(this).attr('data');

                $('#edit_customer_modal').modal('show');

                $.ajax({

                    type: 'ajax',
                    method: 'get',
                    url: '{{ url('customer-edit') }}',
                    data: {
                        id: id
                    },
                    async: false,
                    dataType: 'json',
                    success: function(data) {

                        $('input[name=customer_id]').val(data.customer.id);
                        $('input[name=name]').val(data.customer.name);
                        $('input[name=email]').val(data.customer.email);
                        $('input[name=company_name]').val(data.customer.company_name);
                        $('input[name=address]').val(data.customer.address);
                        $('input[name=tax_number]').val(data.customer.tax_number);
                        $('input[name=city]').val(data.customer.city);
                        $('input[name=vat_number]').val(data.customer.vat_number);
                        $('input[name=country]').val(data.customer.country);
                        $('input[name=state]').val(data.customer.state);
                        $('input[name=p_code]').val(data.customer.p_code);
                        $('input[name=phone]').val(data.customer.phone);

                        $.each(data.customer_groups, function(key, customer_groups) {

                            $('select[name="customer_group_id"]')
                                .append(
                                    `<option value="${customer_groups.id}" ${customer_groups.id == data.customer.customer_group_id ? 'selected' : ''}>${customer_groups.name}</option>`
                                )
                        });
                    },

                    error: function() {

                        toastr.error('something went wrong');

                    }

                });

            });


            //Update Customer
            $('.update_customer').on('click', function(e) {
                e.preventDefault();

                let EditFormData = new FormData($('#EditCustomerForm')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ url('customer-update') }}",
                    data: EditFormData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function() {
                        $('.update_customer').text('Updating...');
                        $(".update_customer").prop("disabled", true);
                    },
                    success: function(response) {

                        if (response.status == 200) {
                            $('#edit_customer_modal').modal('hide');
                            $('#EditCustomerForm').find('input').val("");
                            $('.update_customer').text('Update');
                            $(".update_customer").prop("disabled", false);
                            toastr.success(response.message);
                            getCustomer();
                        }
                    },
                    error: function() {
                        toastr.error('something went wrong');
                        $('.update_customer').text('Update');
                        $(".update_customer").prop("disabled", false);
                    }
                });

            });

            // Delete Customer
            $('#customerTable').on('click', '.btn-delete-customer', function(e) {
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
                            url: "{{ url('customer-delete') }}",
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
                            }, 500);
                                toastr.success(response.message);
                                getCustomer();
                            }
                        });
                    }
                })

            });


        });
</script>
@endsection