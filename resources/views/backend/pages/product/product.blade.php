@extends('backend.layouts.master')

@section('title')
    Admins - Admin Panel
@endsection

@section('styles')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
@endsection
<style>
    #catagory_catagory {
        padding: 6px 10px;
        margin: 0px -1px;
    }

    .note-editor.note-frame .note-editing-area .note-editable {
        padding: 10px;
        overflow: auto;
        height: 150px;
        word-wrap: break-word;
    }
</style>

@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Products</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>All products</span></li>
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
                        <h4 class="header-title float-left">Product List</h4>
                        <p class="float-right mb-2">
                            @if (Auth::guard('admin')->user()->can('product.create'))
                                <button type="button" class="btn btn-primary btn-flat btn-md" data-toggle="modal"
                                    data-target=".bd-example-modal-lg">+ Add new
                                </button>
                            @endif
                        </p>
                        <div class="clearfix " style="margin-top: 40px;"></div>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">Id</th>
                                        <th width="5%">Product Name</th>
                                        <th width="5%">Product Code</th>
                                        <th width="5%">Product Price</th>
                                        <th width="5%">Product Unit</th>
                                        <th width="5%">Product image</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Product as $ware)
                                        <tr>
                                            <td>{{ $ware->id }}</td>

                                            <td>{{ $ware->product_name }}</td>
                                            <td>{{ $ware->product_code }}</td>
                                            <td>{{ $ware->product_price }}</td>
                                            <td>{{ $ware->product_unit }}</td>

                                            <td> <img
                                                    src="{{ asset('storage/app/public/uploads/product/' . $ware->product_img) }}"
                                                    width="30%"></td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><a type="button" class=""
                                                            data-toggle="modal"
                                                            data-target=".bd-example-modal-lg-{{ $ware->id }}"
                                                            class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                    <form method="get"
                                                        action="{{ route('admin.product.delete', $ware->id) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        @if (Auth::guard('admin')->user()->can('product.delete'))

                                                        <a type="submit" class=" text-danger btn-flat show_confirm"
                                                            data-toggle="tooltip" title='Delete'><i
                                                                class="ti-trash"></i></a>
                                                                @endif
                                                    </form>
                                                </ul>
                                            </td>



                                            <div class="modal fade bd-example-modal-lg-{{ $ware->id }}"
                                                style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Product Detail </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal"><span>×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.product.update') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" class="form-control" id="id"
                                                                    name="id" placeholder="Enter Name"
                                                                    value="{{ $ware->id }}">

                                                                <div class="form-row">

                                                                    <div class="form-group col-md-4 col-sm-12">
                                                                        <label for="product_name">product Name</label>
                                                                        <input type="text"
                                                                            value="{{ $ware->product_name }}" required
                                                                            class="form-control" id="product_name"
                                                                            name="product_name">
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-12">
                                                                        <label for="catagory_catagory"> Product
                                                                            Catagory</label>
                                                                        <select type="text" required class="form-control"
                                                                            id="catagory_catagory" name="product_catagory">
                                                                            <option value="" disabled selected>select
                                                                                catagory</option>

                                                                            @foreach ($Catagory as $cata)
                                                                                <option value="{{ $cata->id }}"
                                                                                    @if ($ware->product_catagory == $cata->id) selected @endif>
                                                                                    {{ $cata->catagory_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-12">
                                                                        <label for="product_code"> Product Code</label>
                                                                        <input type="text" required
                                                                            value="{{ $ware->product_code }}"
                                                                            class="form-control" id="product_code"
                                                                            name="product_code">
                                                                    </div>

                                                                </div>


                                                                <div class="form-row">

                                                                    <div class="form-group col-md-4 col-sm-12">
                                                                        <label for="product_price">product Price</label>
                                                                        <input type="text" required
                                                                            value="{{ $ware->product_price }}"
                                                                            class="form-control" id="product_price"
                                                                            name="product_price">
                                                                    </div>
                                                                    <div class="form-group col-md-4 col-sm-12">
                                                                        <label for="catagory_catagory"> Product Cost</label>
                                                                        <input type="text" required
                                                                            value="{{ $ware->product_cost }}"
                                                                            class="form-control" id="product_cost"
                                                                            name="product_cost">

                                                                    </div>

                                                                    <div class="form-group col-md-4 col-sm-12">
                                                                        <label for="product_quantity"> Product Alert
                                                                            Quantity</label>
                                                                        <input type="text" required
                                                                            value="{{ $ware->product_quantity }}"
                                                                            class="form-control" id="product_quantity"
                                                                            name="product_quantity">
                                                                    </div>

                                                                </div>


                                                                <div class="form-row">

                                                                    <div class="form-group col-md-4 col-sm-12">
                                                                        <label for="product_unit">product Unit</label>
                                                                        <select type="text" required
                                                                            class="form-control product_unit"
                                                                            id="catagory_catagory" name="product_unit">
                                                                            <option value="" disabled selected>select Unit
                                                                            </option>

                                                                            @foreach ($Unit as $unit)
                                                                                <option value="{{ $unit->unit_name }}"
                                                                                    @if ($ware->product_unit == $unit->unit_name) selected @endif>
                                                                                    {{ $unit->unit_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group col-md-4 col-sm-12">
                                                                        <label for="product_sale_unit"> Product Sale
                                                                            Unit</label>
                                                                        <input type="text" required
                                                                            value="{{ $ware->product_sale_unit }}"
                                                                            class="form-control product_unit"
                                                                            id="product_sale_unit" name="product_sale_unit">
                                                                    </div>







                                                                    <div class="form-group col-md-4 col-sm-12">
                                                                        <label for="product_purchase_unit"> Product Purchase
                                                                            unit</label>
                                                                        <input type="text"
                                                                            value="{{ $ware->product_purchase_unit }}"
                                                                            required class="form-control product_unit"
                                                                            id="product_purchase_unit"
                                                                            name="product_purchase_unit">
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">

                                                                    <div class="form-group col-md-4 col-sm-12">
                                                                        <label for="product_unit">product Brand</label>
                                                                        <select type="text" required class="form-control"
                                                                            id="catagory_catagory" name="product_brand">

                                                                            @foreach ($Brand as $brand)
                                                                                <option value="{{ $brand->id }}"
                                                                                    @if ($ware->product_brand == $brand->id) selcted @endif>
                                                                                    {{ $brand->brand_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group col-md-4 col-sm-12">
                                                                        <label for="product_method"> Product Method</label>
                                                                        <input type="text" required class="form-control"
                                                                            value="{{ $ware->product_method }}"
                                                                            id="product_method" name="product_method">
                                                                    </div>
                                                                    <div class="form-group col-md-1 col-sm-12">
                                                                        <label for="product_ethod"
                                                                            style="width: max-content;"> Product
                                                                            Featured</label>
                                                                        <input type="checkbox"
                                                                            @if ($ware->product_feature == 'yes') checked @endif
                                                                            required class="form-control "
                                                                            style="width: max-content;"
                                                                            style="margin-left:42px;" id="product_feature"
                                                                            name="product_feature">
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">

                                                                    <div class="form-group col-md-8 col-sm-12">
                                                                        <label for="product_detail">Product Detail</label>
                                                                        <textarea class="summernote form-control" name="product_detail">{!! $ware->product_detail !!} </textarea>
                                                                    </div>

                                                                    <div class="form-group col-md-4 col-sm-12">
                                                                        <label for="product_image"> Product Image
                                                                            Upload</label>
                                                                        <input type="file" class="form-control dropify"
                                                                            data-default-file="{{ asset('storage/app/public/uploads/product/' . $ware->product_img) }}"
                                                                            data-height="188" id="product_img"
                                                                            name="product_img">
                                                                    </div>

                                                                </div>
                                                                <h4 class="header-title"> This product has different price
                                                                    for different warehouse </h4>

                                                                <div class="form-row">


                                                                    <div class="form-group col-md-1 col-sm-12">

                                                                        <input type="checkbox"
                                                                            value="{{ $ware->product_different_warehouse }}"
                                                                            @if ($ware->product_different_warehouse == 'yes') checked @endif
                                                                            class="form-control my_check_box_update"
                                                                            style="width: max-content;margin-top: -10px; width:40px;"
                                                                            id="my_check_box_update"
                                                                            name="product_different_warehouse">
                                                                    </div>
                                                                </div>

                                                                <div id="formdivupdate">
                                                                    <div class="form-row ">

                                                                        <div class="form-group col-md-4 col-sm-12">
                                                                            <label for="product_warehouse">product
                                                                                Warehouse</label>
                                                                            <select type="text" class="form-control"
                                                                                id="catagory_catagory"
                                                                                name="product_warehouse">
                                                                                @foreach ($Ware_houses as $s)
                                                                                    <option value="{{ $s->id }}"
                                                                                        @if ($ware->product_warehouse == $s->id) selected @endif>
                                                                                        {{ $s->wareh_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group col-md-4 col-sm-12">
                                                                            <label for="product_warehouse_price"> Warehouse
                                                                                Price</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $ware->product_warehouse_price }}"
                                                                                id="product_warehouse_price"
                                                                                name="product_warehouse_price">
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <h4 class="header-title"> Add Promotional Price </h4>

                                                                <div class="form-row">


                                                                    <div class="form-group col-md-1 col-sm-12">

                                                                        <input type="checkbox" name="product_add_warehouse"
                                                                            value="{{ $ware->product_add_warehouse }}"
                                                                            class="form-control"
                                                                            @if ($ware->product_different_warehouse == 'yes') checked @endif
                                                                            style="width: max-content;margin-top: -10px; width:40px;"
                                                                            id="my_check_box_update_new">
                                                                    </div>
                                                                </div>

                                                                <div id="formdivnew_update">
                                                                    <div class="form-row ">

                                                                        <div class="form-group col-md-4 col-sm-12">
                                                                            <label for="product_promotional_price">product
                                                                                promotional price</label>
                                                                            <input type="text"
                                                                                value="{{ $ware->product_promotional_price }}"
                                                                                class="form-control"
                                                                                id="product_promotional_price"
                                                                                name="product_promotional_price">
                                                                        </div>
                                                                        <div class="form-group col-md-4 col-sm-12">
                                                                            <label for="product_promotional_start">product
                                                                                promotional start</label>
                                                                            <input type="date" class="form-control"
                                                                                value="{{ $ware->product_promotional_start }}"
                                                                                name="product_promotional_start">
                                                                        </div>
                                                                        <div class="form-group col-md-4 col-sm-12">
                                                                            <label for="product_promotional_end">product
                                                                                promotional end</label>
                                                                            <input type="date" class="form-control"
                                                                                id="product_promotional_end"
                                                                                value="{{ $ware->product_promotional_end }}"
                                                                                name="product_promotional_end">
                                                                        </div>
                                                                    </div>



                                                                </div>





                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                        @if (Auth::guard('admin')->user()->can('product.edit'))

                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                        @endif
                                                                </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                        </div>
                    </div>
                    @endforeach
                    </tr>
                    </form>

                    </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- data table end -->

    </div>
    </div>

    <!-- Modal -->

    <div class="modal fade bd-example-modal-lg">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.product.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">

                            <div class="form-group col-md-4 col-sm-12">
                                <label for="product_name">product Name</label>
                                <input type="text" required class="form-control" id="product_name" name="product_name">
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="catagory_catagory"> Product Catagory</label>
                                <select type="text" required class="form-control" id="catagory_catagory"
                                    name="product_catagory">
                                    <option value="" disabled selected>select catagory</option>

                                    @foreach ($Catagory as $cata)
                                        <option value="{{ $cata->id }}">{{ $cata->catagory_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="product_code"> Product Code</label>
                                <input type="text" required class="form-control" id="product_code" name="product_code">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col-md-4 col-sm-12">
                                <label for="product_price">product Price</label>
                                <input type="text" required class="form-control" id="product_price" name="product_price">
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="catagory_catagory"> Product Cost</label>
                                <input type="text" required class="form-control" id="product_cost" name="product_cost">

                            </div>

                            <div class="form-group col-md-4 col-sm-12">
                                <label for="product_quantity"> Product Alert Quantity</label>
                                <input type="text" required class="form-control" id="product_quantity"
                                    name="product_quantity">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col-md-4 col-sm-12">
                                <label for="product_unit">product Unit</label>
                                <select type="text" required class="form-control product_unit " id="catagory_catagory"
                                    name="product_unit">
                                    <option value="" disabled selected>select Unit</option>

                                    @foreach ($Unit as $unit)
                                        <option value="{{ $unit->unit_name }}">{{ $unit->unit_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4 col-sm-12">
                                <label for="product_sale_unit"> Product Sale Unit</label>
                                <input type="text" required class="form-control product_unit" id="product_sale_unit"
                                    name="product_sale_unit">
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="product_purchase_unit"> Product Purchase unit</label>
                                <input type="text" required class="form-control product_unit" id="product_purchase_unit"
                                    name="product_purchase_unit">
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-4 col-sm-12">
                                <label for="product_unit">product Brand</label>
                                <select type="text" required class="form-control" id="catagory_catagory"
                                    name="product_brand">

                                    @foreach ($Brand as $brand)
                                        <option value="" disabled selected>select brand</option>

                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4 col-sm-12">
                                <label for="product_method"> Product Method</label>
                                <input type="text" required class="form-control" id="product_method"
                                    name="product_method">
                            </div>
                            <div class="form-group col-md-1 col-sm-12">
                                <label for="product_ethod" style="width: max-content;"> Product Featured</label>
                                <input type="checkbox" required class="form-control " style="width: max-content;"
                                    style="margin-left:42px;" id="product_feature" name="product_feature">
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-8 col-sm-12">
                                <label for="product_detail">Product Detail</label>
                                <textarea class="summernote form-control" name="product_detail"></textarea>
                            </div>

                            <div class="form-group col-md-4 col-sm-12">
                                <label for="product_image"> Product Image Upload</label>
                                <input type="file" required class="form-control dropify" data-height="188" id="product_img"
                                    name="product_img">
                            </div>

                        </div>
                        <h4 class="header-title"> This product has different price for different warehouse </h4>

                        <div class="form-row">


                            <div class="form-group col-md-1 col-sm-12">

                                <input type="checkbox" class="form-control my_check_box"
                                    style="width: max-content;margin-top: -10px; width:40px;" id="myCheck"
                                    name="product_different_warehouse">
                            </div>
                        </div>

                        <div id="formdiv">
                            <div class="form-row ">

                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="product_warehouse">product Warehouse</label>
                                    <select type="text" required class="form-control" id="catagory_catagory"
                                        name="product_warehouse">
                                        @foreach ($Ware_houses as $ware)
                                            <option value="" disabled selected>select ware house</option>

                                            <option value="{{ $ware->id }}">{{ $ware->wareh_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="product_sale_unit"> Warehouse Price</label>
                                    <input type="text" required class="form-control" id="product_warehouse_price"
                                        name="product_warehouse_price">
                                </div>

                            </div>

                        </div>



                        <h4 class="header-title"> Add Promotional Price </h4>

                        <div class="form-row">


                            <div class="form-group col-md-1 col-sm-12">

                                <input type="checkbox" name="product_add_warehouse" value="yes" class="form-control"
                                    style="width: max-content;margin-top: -10px; width:40px;" id="my_check_box_new">
                            </div>
                        </div>

                        <div id="formdivnew">
                            <div class="form-row ">

                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="product_unit">product promotional price</label>
                                    <input type="text"  class="form-control" id="product_promotional_price"
                                        name="product_promotional_price">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="product_unit">product promotional start</label>
                                    <input type="date"  class="form-control" id="product_promotional_start"
                                        name="product_promotional_start">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="product_unit">product promotional end</label>
                                    <input type="date"  class="form-control" id="product_promotional_end"
                                        name="product_promotional_end">
                                </div>
                            </div>



                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save </button>
                        </div>
                </div>
            </form>

            </div>
        </div>
    </div>

@endsection



@section('scripts')
    <!-- Start datatable js -->
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>
    <script>
        function myFunction() {

            var checkBox = document.getElementById("myCheck");
            var form = document.getElementById("formdiv");
            if (checkBox.checked == true) {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
    <script>
        /*================================
            datatable active
            
            ==================================*/
        $(document).ready(function() {
            $('.summernote').summernote();
            $("#formdivupdate").hide(200);
            var as = $('.my_check_box_update').val();

            if (as == 'yes') {
                $("#formdivupdate").show(300);
            } else {
                $("#formdivupdate").hide(200);
            }


        });

        $("#formdiv").hide(200);

        $(".my_check_box").click(function() {
            if ($(this).is(":checked")) {
                $("#formdiv").show(300);
            } else {
                $("#formdiv").hide(200);
            }
        });



        $("#formdivnew").hide(200);

        $("#my_check_box_new").click(function() {
            if ($(this).is(":checked")) {
                $("#formdivnew").show(300);
            } else {
                $("#formdivnew").hide(200);
            }
        });
        $('.product_unit').on('change', function() {
            var unit_name = this.value;

            $('.product_unit').val(unit_name);
        });

        if ($('#dataTable').length) {
            $('#dataTable').DataTable({});
        }

        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
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
