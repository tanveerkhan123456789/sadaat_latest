@extends('backend.layouts.master')

@section('title')
  units
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
                <h4 class="page-title pull-left">Units</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Units</span></li>
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
                    <h4 class="header-title float-left">Unit List</h4>
                    <p class="float-right mb-2">
                        @if (Auth::guard('admin')->user()->can('unit.create'))
                        <button type="button" class="btn btn-primary btn-flat btn-md" data-toggle="modal" data-target=".bd-example-modal-lg">+ Add new
                        </button> @endif
                    </p>
                    <div class="clearfix " style="margin-top: 40px;"></div>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Id</th>
                                    <th width="5%">Unit code</th>
                                    <th width="5%">Unit name</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($Unit as $key=> $ware)

                                <tr>
                                    <td>{{$key+1 }}</td>
                                    <td>{{$ware->unit_code}}</td>

                                    <td>{{$ware->unit_name}}</td>


                                    <td>
                                        <ul class="d-flex justify-content-center">
                                            <li class="mr-3"><a type="button" class="" data-toggle="modal" data-target=".bd-example-modal-lg-{{$ware->id}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                            <form method="get" action="{{ route('admin.unit.delete', $ware->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            @if (Auth::guard('admin')->user()->can('unit.delete'))

                            <a type="submit" class=" text-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'><i class="ti-trash"></i></a>
                        @endif
                        </form>                                       
                     </ul>
                                    </td>



                                    <div class="modal fade bd-example-modal-lg-{{$ware->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Brand Detail </h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.unit.update') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" class="form-control" id="id" name="id" placeholder="Enter Name" value="{{$ware->id}}">

                                                        <div class="form-row">
                                                            <div class="form-group col-md-6 col-sm-12">
                                                                <label for="wareh_name">Warehouse Name</label>
                                                                <input type="text" class="form-control" id="unit_code" name="unit_code"  value="{{$ware->unit_code}}" placeholder="Enter Brand Name">
                                                            </div>
                                                            <div class="form-group col-md-6 col-sm-12">
                                                                <label for="image"> Brnad Image</label>
                                                                <input required type="text" class="form-control" id="unit_name" name="unit_name" value="{{$ware->unit_name}}"  placeholder="Enter Brand Image">
                                                            </div>
                                                        </div>

                                                       

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            @if (Auth::guard('admin')->user()->can('unit.edit'))

                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        @endif
                                                        </div>
                                                </div>

                                            </div>

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
                <h5 class="modal-title">Add Unit</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.unit.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="unit_code">Unit Code</label>
                            <input required type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Enter Unit Code">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="unit_name"> Unit Name</label>
                            <input required type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Enter Unit Name">
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