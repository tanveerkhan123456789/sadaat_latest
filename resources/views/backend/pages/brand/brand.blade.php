@extends('backend.layouts.master')

@section('title')
Admins - Admin Panel
@endsection

@section('styles')
<!-- Start datatable css -->
<style>
    #cus {
        padding: 6px 10px;
        margin: 0px -1px;
    }
</style>
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Brands</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Brands</span></li>
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
                    <h4 class="header-title float-left">Brand List</h4>
                    <p class="float-right mb-2">
                        @if (Auth::guard('admin')->user()->can('brand.create'))
                        <button type="button" class="btn btn-primary btn-flat btn-md" data-toggle="modal" data-target=".bd-example-modal-lg">+ Add new
                        </button> @endif
                    </p>
                    <div class="clearfix " style="margin-top: 40px;"></div>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Id</th>
                                    <th width="5%">Brand Name</th>
                                    <th width="5%">Catagory Name</th>
                                    <th width="5%">image</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ware_houses as $ware)
                                <tr>
                                    <td>{{$ware->id}}</td>

                                    <td>{{$ware->brand_name}}</td>
                                    <td>{{$ware->catagory->catagory_name}}</td>

                                    <td> <img src="{{ asset('storage/app/public/uploads/brands/'.$ware->brand_img) }}" width="30%"></td>


                                    <td>
                                        <ul class="d-flex justify-content-center">
                                            <li class="mr-3"><a type="button" class="" data-toggle="modal" data-target=".bd-example-modal-lg-{{$ware->id}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                            <form method="get" action="{{ route('admin.brand.delete', $ware->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            @if (Auth::guard('admin')->user()->can('brand.delete'))

                            <a type="submit" class=" text-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'><i class="ti-trash"></i></a>
                       @endif
                        </form>                                        </ul>
                                    </td>



                                    <div class="modal fade bd-example-modal-lg-{{$ware->id}}" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Brand Detail </h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.brand.update') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" class="form-control" id="id" name="id" placeholder="Enter Name" value="{{$ware->id}}">

                                                        <div class="form-row">
                                                            <div class="form-group col-md-6 col-sm-12">
                                                                <label for="wareh_name">Brand Name</label>
                                                                <input type="text" class="form-control" id="wareh_name" name="brand_name"  value="{{$ware->brand_name}}" placeholder="Enter Brand Name">
                                                            </div>
                                                         
                                                            <div class="form-group col-md-6 col-sm-12">
                                                                <label for="wareh_name">Brand Catagory</label>
                                                            <select type="text" required class="form-control" id="cus"
                                                            id="catagory_catagory" name="catagory_id">
                                                            <option value="" disabled selected>select
                                                                catagory</option>

                                                            @foreach ($catagory as $cata)
                                                                <option value="{{ $cata->id }}"
                                                                    @if ($ware->catagory_id == $cata->id) selected @endif>
                                                                    {{ $cata->catagory_name }}</option>
                                                            @endforeach
                                                        </select>
                                                            </div>
                                                         
                                                        </div>

                                                        <div class="row text-center">
                                                        <div class="w-100"><h6 class="text-center #badge badge-primary"> Brand Image Upload</h6></div>
                                                               <div class="form-group col-md-12 col-sm-12">
                                                                        {{-- <label for="product_image"> Product Image
                                                                            Upload</label> --}}
                                                                        <input type="file" class="form-control dropify"
                                                                            data-default-file="{{ asset('storage/app/public/uploads/brands/' . $ware->brand_img) }}"
                                                                            data-height="188" id="brand_img"
                                                                            name="brand_img">
                                                                    </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            @if (Auth::guard('admin')->user()->can('brand.edit'))

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
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.brand.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="wareh_name">Brand Name</label>
                            <input type="text" required class="form-control" id="brand_name" name="brand_name" placeholder="Enter Brand Name">
                        </div>
                    

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="wareh_name">catagory</label>
                        <select type="text" required class="form-control" 
                        id="cus" name="catagory_id" >
                        <option value="" disabled selected>select
                            catagory</option>

                        @foreach ($catagory as $cata)
                            <option value="{{ $cata->id }}">
                                {{ $cata->catagory_name }}</option>
                        @endforeach
                    </select>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="w-100"><h6 class="text-center #badge badge-primary"> Brand Image Upload</h6></div>
                               <div class="form-group col-md-12 col-sm-12">
                                        {{-- <label for="product_image"> Product Image
                                            Upload</label> --}}
                                        <input type="file" class="form-control dropify"
                                            
                                            data-height="188" id="brand_img"
                                            name="brand_img">
                                    </div>
                        </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection



@section('scripts')
<!-- Start datatable js -->

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