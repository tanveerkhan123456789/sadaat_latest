<div class="header-area">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-6 col-sm-8 clearfix">

        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
            <div class="user-profile pull-right">

                <h4 class="user-name dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Super Admin
                    <i class="fa fa-angle-down"></i>
                </h4>
                <div class="dropdown-menu" x-placement="bottom-start"
                    style="position: absolute; transform: translate3d(10px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" href="http://localhost/sadaat/public/admin/logout/submit"
                        onclick="event.preventDefault();
                                              document.getElementById('admin-logout-form').submit();">Log
                        Out</a>
                </div>

                <form id="admin-logout-form" action="http://localhost/sadaat/public/admin/logout/submit" method="POST"
                    style="display: none;">
                    <input type="hidden" name="_token" value="iHu5qEIolQcrZU3vs73oCQoH1wJq9lYqImCg1tCO">
                </form>
            </div>
        </div>
    </div>
</div>
