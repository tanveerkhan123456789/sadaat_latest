<!-- sidebar menu area start -->
@php
$usr = Auth::guard('admin')->user();
@endphp
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <p class="text-white" style="font-weight: 900;">
                    {{ $usr->name }}</p>
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr->can('dashboard.view'))
                    <li class=" {{  Route::is('admin.dashboard')  ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse  {{  Route::is('admin.dashboard')  ? 'in' : '' }}">
                            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a
                                    href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ul>
                    </li>
                    @endif


                    @if ($usr->can('role.create') || $usr->can('role.view') || $usr->can('role.edit') ||
                    $usr->can('role.delete')
                    || $usr->can('user.create') || $usr->can('user.view') || $usr->can('user.edit') ||
                    $usr->can('user.delete')
                    || $usr->can('warehouse.create') || $usr->can('warehouse.view') || $usr->can('warehouse.edit') ||
                    $usr->can('warehouse.delete')
                    || $usr->can('brand.create') || $usr->can('brand.view') || $usr->can('brand.edit') ||
                    $usr->can('brand.delete')
                    || $usr->can('customergroup.create') || $usr->can('customergroup.view') ||
                    $usr->can('customergroup.edit') || $usr->can('customergroup.delete')
                    || $usr->can('unit.create') || $usr->can('unit.view') || $usr->can('unit.edit') ||
                    $usr->can('unit.delete')

                    )
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                                Settings
                            </span></a>
                        <ul
                            class="collapse {{  Route::is('admin.roles.create') ||   Route::is('admin.admins.index') ||   Route::is('admin.admins.index') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                            <li
                                class="{{ Route::is('admin.roles.index') || Route::is('admin.roles.edit') ? 'active' : '' }}">
                                <a href="{{ route('admin.roles.index') }}">All Roles</a>
                            </li>
                            @endif
                            @if ($usr->can('role.create'))
                            <li class="{{ Route::is('admin.roles.create') ? 'active' : '' }}"><a
                                    href="{{ route('admin.roles.create') }}">Add Role</a></li>
                            @endif


                            @if ($usr->can('user.view'))
                            <li
                                class="{{ Route::is('admin.admins.index') || Route::is('admin.admins.edit') ? 'active' : '' }}">
                                <a href="{{ route('admin.admins.index') }}">All Users</a>
                            </li>
                            @endif

                            @if ($usr->can('user.create'))
                            <li class="{{ Route::is('admin.admins.create') ? 'active' : '' }}"><a
                                    href="{{ route('admin.admins.create') }}">Add User</a></li>
                            @endif
                            @if ($usr->can('warehouse.create') || $usr->can('warehouse.view') ||
                            $usr->can('warehouse.edit') || $usr->can('warehouse.delete'))
                            <li class="{{ Route::is('admin.warehouse') ? 'active' : '' }}"><a
                                    href="{{ route('admin.warehouse') }}">Warehouses</a></li>
                            @endif

                            @if ($usr->can('brand.create') || $usr->can('brand.view') || $usr->can('brand.edit') ||
                            $usr->can('brand.delete'))
                            <li class="{{ Route::is('admin.brand') ? 'active' : '' }}"><a
                                    href="{{ route('admin.brand') }}">Brands</a></li>
                            @endif

                            @if ($usr->can('customergroup.create') || $usr->can('customergroup.view') ||
                            $usr->can('customergroup.edit') || $usr->can('customergroup.delete'))
                            <li class="{{ Route::is('create.customer.group') ? 'active' : '' }}"><a
                                    href="{{ route('create.customer.group') }}">Customer Group</a></li>
                            @endif

                            @if ($usr->can('unit.create') || $usr->can('unit.view') || $usr->can('unit.edit') ||
                            $usr->can('unit.delete'))
                            <li class="{{ Route::is('admin.unit') ? 'active' : '' }}"><a
                                    href="{{ route('admin.unit') }}">Unit</a></li>
                            @endif
                        </ul>

                    </li>
                    @endif


                    @if ($usr->can('supplier.create') || $usr->can('supplier.view') || $usr->can('supplier.edit') ||
                    $usr->can('supplier.delete') || $usr->can('customer.create') || $usr->can('customer.view') ||
                    $usr->can('customer.edit') || $usr->can('customer.delete') )
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                                People
                            </span></a>
                        <ul
                            class="collapse {{ Route::is('create.supplier') || Route::is('create.customer')  ? 'in' : '' }}">
                            @if($usr->can('supplier.create') || $usr->can('supplier.view') || $usr->can('supplier.edit')
                            || $usr->can('supplier.delete'))
                            <li class="{{ Route::is('create.supplier') ? 'active' : '' }}"><a
                                    href="{{ route('create.supplier') }}">Supplier</a></li>
                            @endif
                            @if( $usr->can('customer.create') || $usr->can('customer.view') ||
                            $usr->can('customer.edit') || $usr->can('customer.delete'))
                            <li class="{{ Route::is('create.customer') ? 'active' : '' }}"><a
                                    href="{{ route('create.customer') }}">Customer</a></li>
                            @endif
                        </ul>

                    </li>
                    @endif

                    @if ($usr->can('product.create') || $usr->can('product.view') || $usr->can('product.edit') ||
                    $usr->can('product.delete') || $usr->can('catagory.create') || $usr->can('catagory.view') ||
                    $usr->can('catagory.edit') || $usr->can('catagory.delete'))
                    <li
                        class="  {{ Route::is('admin.product') || Route::is('admin.sale') || Route::is('admin.catagory') ? 'in' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span> Product
                            </span></a>
                        <ul
                            class="collapse {{ Route::is('admin.product') || Route::is('admin.sale') ||  Route::is('admin.sale.report') || Route::is('admin.catagory') ? 'in' : '' }}">

                            @if ($usr->can('product.create') || $usr->can('product.view') || $usr->can('product.edit')
                            || $usr->can('product.delete') )
                            <li class="{{ Route::is('admin.product') ? 'active' : '' }}"><a
                                    href="{{ route('admin.product') }}">Products</a></li>
                            @endif
                            @if ( $usr->can('catagory.create') || $usr->can('catagory.view') ||
                            $usr->can('catagory.edit') || $usr->can('catagory.delete') )

                            <li class="{{ Route::is('admin.catagory') ? 'active' : '' }}"><a
                                    href="{{ route('admin.catagory') }}">Catagory</a></li>
                            @endif

                            {{--
                            <li class="{{ Route::is('admin.sale') ? 'active' : '' }}"><a
                                    href="{{ route('admin.sale') }}">Sale</a></li>
                            <li class="{{ Route::is('admin.sale.report') ? 'active' : '' }}"><a
                                    href="{{ route('admin.sale.report') }}">Sale Report</a></li>

                            <li class="{{ Route::is('pos') ? 'active' : '' }}"><a href="{{ route('pos') }}">POS</a></li>
                            --}}
                            {{-- @endif --}}
                        </ul>

                    </li>
                    @endif





                    @if ($usr->can('sale.create') || $usr->can('sale.view') || $usr->can('sale.edit') ||
                    $usr->can('sale.delete') )
                    <li class="  {{ Route::is('admin.sale')   || Route::is('admin.add.sales') ? 'in' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span> Sale
                            </span></a>
                        <ul
                            class="collapse {{  Route::is('admin.sale') || Route::is('admin.add.sales')  ? 'in' : '' }}">



                            <li class="{{ Route::is('admin.sale') ? 'active' : '' }}"><a
                                    href="{{ route('admin.sale') }}"> Sales</a></li>
                            @if (Auth::guard('admin')->user()->can('sale.create'))

                            <li class="{{ Route::is('admin.add.sales') ? 'active' : '' }}"><a
                                    href="{{ route('admin.add.sales') }}"> Add Sale </a></li>
                            @endif
                            {{-- <li class="{{ Route::is('admin.sale.report') ? 'active' : '' }}"><a
                                    href="{{ route('admin.sale.report') }}">Sale Report</a></li>

                            <li class="{{ Route::is('pos') ? 'active' : '' }}"><a href="{{ route('pos') }}">POS</a></li>
                            --}}
                        </ul>

                    </li>
                    @endif


                    @if ($usr->can('purchase.create') || $usr->can('purchase.view') || $usr->can('purchase.edit') ||
                    $usr->can('purchase.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                                Purchase </span></a>
                        <ul
                            class="collapse {{ Route::is('create.purchase') || Route::is('purchase') ? 'in' : '' }}">

                            <li class="{{ Route::is('purchase') ? 'active' : '' }}"><a href="{{ route('purchase') }}">
                                    Purchase</a></li>
                                    @if ($usr->can('user.create'))

                            <li class="{{ Route::is('create.purchase') ? 'active' : '' }}"><a
                                    href="{{ route('create.purchase') }}"> Add Purchase</a></li>
                            @endif
                        </ul>

                    </li>
                    @endif





                    @if ($usr->can('salereport.view') || $usr->can('purchasereport.view') )
                    <li
                        class="  {{ Route::is('admin.sale.report')   || Route::is('admin.purchase.report') ? 'in' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span> Reports
                            </span></a>
                        <ul
                            class="collapse {{  Route::is('admin.sale.report') || Route::is('purchase.report')  ? 'in' : '' }}">

                            @if ($usr->can('salereport.view') )

                            <li class="{{ Route::is('admin.sale.report') ? 'active' : '' }}"><a
                                    href="{{ route('admin.sale.report') }}">Sale Report</a></li>

                            @endif

                            @if ( $usr->can('purchasereport.view')  )

                            <li class="{{ Route::is('purchase.report') ? 'active' : '' }}"><a
                                    href="{{ route('purchase.report') }}"> Purchase Report</a></li>
                            @endif

                            {{--
                            <li class="{{ Route::is('pos') ? 'active' : '' }}"><a href="{{ route('pos') }}">POS</a></li>
                            --}}
                        </ul>

                    </li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->