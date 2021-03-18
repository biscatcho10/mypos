<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('dashboard/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dashboard/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->first_name . " " . auth()->user()->last_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                {{-- Categories --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        {{-- <i class="nav-icon fas fa-copy"></i> --}}
                        <span><i class="fab fa-bandcamp"></i></span>
                        <p>
                            Categories
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">{{App\Models\Category::count()}}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->isAbleTo('categories_read'))
                        <li class="nav-item">
                            <a href="{{route('categories.index')}}" class="nav-link">
                                <i class="fa fa-minus ml-1" aria-hidden="true"></i>
                                <p>All Categories</p>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->hasPermission('categories_create'))
                        <li class="nav-item">
                            <a href="{{route('categories.create')}}" class="nav-link">
                                <i class="fa fa-minus ml-1" aria-hidden="true"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>



                {{-- Products --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">{{App\Models\Product::count()}}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->isAbleTo('products_read'))
                        <li class="nav-item">
                            <a href="{{route('products.index')}}" class="nav-link">
                                <i class="fa fa-minus ml-1" aria-hidden="true"></i>
                                <p>All Products</p>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->hasPermission('products_create'))
                        <li class="nav-item">
                            <a href="{{route('products.create')}}" class="nav-link">
                                <i class="fa fa-minus ml-1" aria-hidden="true"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>

                {{-- Users --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        {{-- <i class="nav-icon fas fa-copy"></i> --}}
                        <span><i class="fa fa-users" aria-hidden="true"></i></span>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">{{App\Models\User::count()}}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->isAbleTo('users_read'))
                        <li class="nav-item">
                            <a href="{{route('users.index')}}" class="nav-link">
                                <i class="fa fa-minus ml-1" aria-hidden="true"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->hasPermission('users_create'))
                        <li class="nav-item">
                            <a href="{{route('users.create')}}" class="nav-link">
                                <i class="fa fa-minus ml-1" aria-hidden="true"></i>
                                <p>Add Users</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>

                {{-- Clients --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        {{-- <i class="nav-icon fas fa-copy"></i> --}}
                        <span><i class="fa fa-users-cog" aria-hidden="true"></i></span>
                        <p>
                            Clients
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">{{App\Models\Client::count()}}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->isAbleTo('clients_read'))
                        <li class="nav-item">
                            <a href="{{route('clients.index')}}" class="nav-link">
                                <i class="fa fa-minus ml-1" aria-hidden="true"></i>
                                <p>All Clients</p>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->hasPermission('clients_create'))
                        <li class="nav-item">
                            <a href="{{route('clients.create')}}" class="nav-link">
                                <i class="fa fa-minus ml-1" aria-hidden="true"></i>
                                <p>Add Clients</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>

                {{-- Orders --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <p>
                            Orders
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">{{App\Models\Order::count()}}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->isAbleTo('orders_read'))
                        <li class="nav-item">
                            <a href="{{route('orders.index')}}" class="nav-link">
                                <i class="fa fa-minus ml-1" aria-hidden="true"></i>
                                <p>All Orders</p>
                            </a>
                        </li>
                        @endif

                        @if (Auth::user()->hasPermission('orders_create'))
                        <li class="nav-item">
                            <a href="{{route('clients.index')}}" class="nav-link">
                                <i class="fa fa-minus ml-1" aria-hidden="true"></i>
                                <p>Add Orders</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
