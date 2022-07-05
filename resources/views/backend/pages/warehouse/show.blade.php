@extends('backend.layouts.master')

@section('title')
Admins - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css"> --}}
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Warehouse</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Warehouses</span></li>
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
                    <h4 class="header-title float-left">Warehouses List</h4>
                    <p class="float-right mb-2">
                        @if (Auth::guard('admin')->user()->can('warehouse.edit'))
                        <button type="button" class="btn btn-primary btn-flat btn-md" data-toggle="modal" data-target=".bd-example-modal-lg">+ Add new
                                </button>                        @endif
                    </p>
                    <div class="clearfix " style="margin-top: 40px;"></div>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Id</th>
                                    <th width="5%">Name</th>
                                    <th width="5%">Email</th>
                                    <th width="5%">phone</th>
                                    <th width="5%">Address</th>
                                    <th width="5%">Number of products</th>
                                    <th width="5%">Quantity</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ware_houses as $ware)
                               <tr>
                               <td>{{$ware->id}}</td>

                                    <td>{{$ware->wareh_name}}</td>
                                    <td> {{$ware->wareh_email}}</td>
                                    <td> {{$ware->wareh_phone}}</td>
                                    <td> {{$ware->wareh_address}}</td>
                                    <td> {{$ware->wareh_stock}}</td>
                                    <td> {{$ware->wareh_quantiy}}</td>
                                  
                                    <td>
                                        {{-- @if (Auth::guard('admin')->user()->can('warehouse.edit')) --}}
                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3"><a  type="button" class="" data-toggle="modal" data-target=".bd-example-modal-lg-{{$ware->id}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                           {{-- @endif --}}

                                                            <form method="get" action="{{ route('admin.warehouse.delete', $ware->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            @if (Auth::guard('admin')->user()->can('warehouse.delete'))

                            <a type="submit" class=" text-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'><i class="ti-trash"></i></a>
                            @endif

                        </form>                                                         </ul>
                                                    </td>

                              
                           
<div class="modal fade bd-example-modal-lg-{{$ware->id}}" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Warehouse  </h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="{{ route('admin.warehouse.update') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" id="id" name="id" placeholder="Enter Name" value="{{$ware->id}}">

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="wareh_name">Warehouse Name</label>
                                <input type="text" class="form-control" id="wareh_name" name="wareh_name" placeholder="Enter Name" value="{{$ware->wareh_name}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email"> Email</label>
                                <input type="text" class="form-control" id="wareh_email" name="wareh_email" placeholder="Enter Email" value="{{$ware->wareh_email}}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password">Phone number</label>
                                <input type="text" class="form-control" value="{{$ware->wareh_phone}}" id="wareh_phone" name="wareh_phone" placeholder="Enter Phone number">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="wareh_address">Address </label>
                                <input type="text" class="form-control" value="{{$ware->wareh_address}}" id="wareh_address" name="wareh_address" placeholder="Enter Address">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="wareh_stock">Number of Products</label>
                                <input type="text" class="form-control" value="{{$ware->wareh_stock}}" id="wareh_stock" name="wareh_stock" placeholder="Enter Number of Products">

                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="username">Product Quantity</label>
                                <input type="text" class="form-control" value="{{$ware->wareh_quantiy}}" id="username" name="wareh_quantiy" placeholder="Enter Product Quantity" required>
                            </div>
                        </div>
                        
                                                               </div>
       
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                @if (Auth::guard('admin')->user()->can('warehouse.edit'))

                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
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

<div class="modal fade bd-example-modal-lg" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add Warehouse</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="{{ route('admin.warehouse.create') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="wareh_name">Warehouse Name</label>
                                <input  required type="text" class="form-control" id="wareh_name" name="wareh_name" placeholder="Enter Name">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email"> Email</label>
                                <input required type="text" class="form-control" id="wareh_email" name="wareh_email" placeholder="Enter Email">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password">Phone number</label>
                                <input required type="text" class="form-control" id="wareh_phone" name="wareh_phone" placeholder="Enter Phone number">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="wareh_address">Address </label>
                                <input type="text" required class="form-control" id="wareh_address" name="wareh_address" placeholder="Enter Address">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="wareh_stock">Number of Products</label>
                                <input  required type="text" class="form-control" id="wareh_stock" name="wareh_stock" placeholder="Enter Number of Products">

                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="username">Product Quantity</label>
                                <input required type="text" class="form-control" id="username" name="wareh_quantiy" placeholder="Enter Product Quantity" required>
                            </div>
                        </div>
                        
                                                               </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form> 
@endsection



@section('scripts')
     {{-- <!-- Start datatable js -->
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
      --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

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