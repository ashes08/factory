<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Factory</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('dashboard') }}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <!-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user me-2"></i>Customers</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('customer_list') }}" class="dropdown-item">Customers List</a>
                    <a href="{{ route('customer_add') }}" class="dropdown-item">Customer Add</a>
                </div>
            </div> -->
            <a href="{{ route('customer_list') }}" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Customers</a>
            <a href="{{ route('slab_list') }}" class="nav-item nav-link"><i class="fa fa-list me-2"></i>Slab</a>
            <a href="{{ route('add_materials') }}" class="nav-item nav-link"><i class="fa fa-book me-2"></i>Entry</a>
            
        </div>
    </nav>
</div>
<!-- Sidebar End -->