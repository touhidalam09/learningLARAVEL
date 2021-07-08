<div class="sidebar" data-color="purple" data-background-color="white">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            LCFAD
        </a>
        <a href="#" class="simple-text logo-normal">
            Touhid Alam
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a class="nav-link " href="{{url('/')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            
            <li class="nav-item {{ Request::is('catagory') ? 'active' : '' }}">
                <a class="nav-link" href="{{url('/catagory')}}">
                    <i class="material-icons">stars</i>
                    <p>Catagory</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('brand') ? 'active' : '' }}">
                <a class="nav-link" href="{{url('/brand')}}">
                    <i class="material-icons">work_outline</i>
                    <p>Brand</p>
                </a>
            </li>
            
            <li class="nav-item {{ Request::is('customers') ? 'active' : '' }}">
                <a class="nav-link" href="{{url('/customers')}}">
                    <i class="material-icons">content_paste</i>
                    <p>Customers</p>
                </a>
            </li>

        </ul>
    </div>
</div>