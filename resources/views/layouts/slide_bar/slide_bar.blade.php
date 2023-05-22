
<div id="sidebar" class="app-sidebar">

    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <div class="menu-header">Navigation</div>
            <div class="menu-item active">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                    <span class="menu-text">Bảng điều khiển</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('product.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="fa fa-chart-pie"></i></span>
                    <span class="menu-text">Các sản phẩm</span>
                </a>
            </div>

            {{-- <div class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <span class="menu-icon">
                        <i class="fa fa-desktop"></i>
                    </span>
                    <span class="menu-text">Admin</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="{{ route('list_oder') }}" class="menu-link">
                            <span class="menu-text">Oder</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="" class="menu-link">
                            <span class="menu-text">User</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="email_detail.html" class="menu-link">
                            <span class="menu-text">Detail</span>
                        </a>
                    </div>
                </div>
            </div> --}}
            
        </div>

    </div>


    <button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>

</div>
