@extends('backend.layouts.master')

@section('title')
Catagories
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
                <h4 class="page-title pull-left">Catagory</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Catagories</span></li>
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
                    <h4 class="header-title float-left">Catagory List</h4>
                    <p class="float-right mb-2">
                        @if (Auth::guard('admin')->user()->can('catagory.create'))
                        <button type="button" class="btn btn-primary btn-flat btn-md" data-toggle="modal" data-target=".bd-example-modal-lg">+ Add new
                        </button> @endif
                    </p>
                    <div class="clearfix " style="margin-top: 40px;"></div>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Id</th>
                                    <th width="5%">Name</th>
                                    <th width="5%">image</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ware_houses as $ware)
                                <tr>
                                    <td>{{$ware->id}}</td>

                                    <td>{{$ware->catagory_name}}</td>
                                    <td> <img src="{{ asset('storage/app/public/uploads/catagory/'.$ware->catagory_img) }}" width="30%"></td>


                                    <td>
                                        <ul class="d-flex justify-content-center">
                                            <li class="mr-3"><a type="button" class="" data-toggle="modal" data-target=".bd-example-modal-lg-{{$ware->id}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                            <form method="get" action="{{ route('admin.catagory.delete', $ware->id) }}">
                            @csrf
                            @if (Auth::guard('admin')->user()->can('catagory.delete'))

                            <input name="_method" type="hidden" value="DELETE">
                            <a type="submit" class=" text-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'><i class="ti-trash"></i></a>
                       @endif
                        </form>                                        </ul>
                                    </td>



                                    <div class="modal fade bd-example-modal-lg-{{$ware->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Catagory Detail </h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.catagory.update') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" class="form-control" id="id" name="id" placeholder="Enter Name" value="{{$ware->id}}">

                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 col-sm-12">
                                                                <label for="wareh_name">Catagory Name</label>
                                                                <input type="text" required class="form-control" id="catagory_name" required name="catagory_name"  value="{{$ware->catagory_name}}" placeholder="Enter Brand Name">
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="row text-center">
                                                        <div class="w-100"><h6 class="text-center #badge badge-primary"> Catagory Image</h6></div>
                                                            <div class="col-md-12">
                                                                <input type="file" id="MemberImage" name="catagory_img" class="dropify" data-default-file="{{ asset('storage/app/public/uploads/catagory/'.$ware->catagory_img) }}" data-height="230" />

                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            @if (Auth::guard('admin')->user()->can('catagory.edit'))

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
                <h5 class="modal-title">Add Catagory </h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.catagory.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="catagory_name">Catagory Name</label>
                            <input type="text" required class="form-control" id="catagory_name" name="catagory_name" placeholder="Enter Brand Name">
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="catagory_img"> Upload Catagory Image</label>
                            <input type="file" id="MemberImage" name="catagory_img" class="dropify" data-default-file="Add Catagory Image" data-height="230" />
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