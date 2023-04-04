
<div id="sidebar" class="app-sidebar">

    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <div class="menu-header">Navigation</div>
            <div class="menu-item active">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('product.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="fa fa-chart-pie"></i></span>
                    <span class="menu-text">Products</span>
                </a>
            </div>
            
        </div>

    </div>


    <button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>

</div>
