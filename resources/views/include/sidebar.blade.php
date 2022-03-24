  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        <img src="{{asset('assets/img/logo-ct.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Project Tracking Tool</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item hide-item" id="Dashboard">
          <a class="nav-link text-white active {{ Request::is('dashboard') ? 'bg-gradient-primary' : '' }}" href="{{route('home')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link text-white " href="{{route('table')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li> -->
        <li class="nav-item hide-item" id="Master">
          <a class="nav-link text-white {{ Request::is('master/*') ? 'bg-gradient-primary' : '' }}" data-bs-toggle="collapse" href="#master" role="button" aria-expanded="false" aria-controls="master">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Masters</span>
          </a>
          <div class="collapse" id="master">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{url('/master/project-stages')}}"> Project Stage </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/master/business-group')}}"> Business Group </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/master/ministry')}}"> Ministry</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/master/department')}}"> Department </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/master/project-type')}}"> Project Type</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/master/instrument-type')}}"> Intrument Type </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/master/instrument-purpose')}}"> Instrument Purpose </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/master/work-order-type')}}"> Work Order Type </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/master/billing-type')}}"> Billing Type </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('/master/employee-list')}}"> Employees List </a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item hide-item" id="Project">
          <a class="nav-link text-white {{ Request::is('project') || Request::is('project/*') ? 'bg-gradient-primary' : '' }}" data-bs-toggle="collapse" href="#project" role="button" aria-expanded="false" aria-controls="master">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Project Management</span>
          </a>
          <div class="collapse" id="project">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link hide-item Project_add" href="{{route('add-project')}}"> Add Project</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{route('projects')}}"> Manage Project </a></li>
              
            </ul>
          </div>
        </li>

        <li class="nav-item hide-item" id="Instrument">
          <a class="nav-link text-white {{ Request::is('instrument') || Request::is('instrument/*') ? 'bg-gradient-primary' : '' }}" data-bs-toggle="collapse" href="#instrument" role="button" aria-expanded="false" aria-controls="master">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">Instrument Details</span>
          </a>
          <div class="collapse" id="instrument">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link hide-item Instrument_add" href="{{route('add-instrument')}}"> Add Instrument</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{route('instruments')}}"> Manage Instrument </a></li>
              
            </ul>
          </div>
        </li>

        <li class="nav-item hide-item" id="Employee">
          <a class="nav-link text-white {{ Request::is('upload/employee') ? 'bg-gradient-primary' : '' }}" data-bs-toggle="collapse" href="#employee" role="button" aria-expanded="false" aria-controls="master">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">Employee Details</span>
          </a>
          <div class="collapse" id="employee">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{route('upload-employee')}}"> Upload Employee</a></li>
              
            </ul>
          </div>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link text-white " href="#">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">Instrument Details</span>
          </a>
        </li> -->
        <li class="nav-item hide-item" id="Work">
          <a class="nav-link text-white {{ Request::is('work/*') ? 'bg-gradient-primary' : '' }}" data-bs-toggle="collapse" href="#work" role="button" aria-expanded="false" aria-controls="master">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Work Order Details</span>
          </a>
          <div class="collapse" id="work">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link hide-item Instrument_add" href="{{route('add-work-order')}}"> Add Work Order</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{route('work-orders')}}"> Manage Work Order </a></li>
              
            </ul>
          </div>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link text-white " href="#">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Work Order Details</span>
          </a>
        </li> -->

        <li class="nav-item hide-item" id="Invoice">
          <a class="nav-link text-white {{ Request::is('invoice*') ? 'bg-gradient-primary' : '' }}" data-bs-toggle="collapse" href="#invoice" role="button" aria-expanded="false" aria-controls="master">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt</i>
            </div>
            <span class="nav-link-text ms-1">Invoice Details</span>
          </a>
          <div class="collapse" id="invoice">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link hide-item Instrument_add" href="{{route('add-invoice')}}"> Add Invoice Details</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{route('invoices')}}"> Manage Invoice Details </a></li>
              
            </ul>
          </div>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link text-white " href="#">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt</i>
            </div>
            <span class="nav-link-text ms-1">Invoice Details</span>
          </a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link text-white " href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">people_outline</i>
            </div>
            <span class="nav-link-text ms-1">Project Team Management</span>
          </a>
        </li>
        <li class="nav-item hide-item" id="User">
          <a class="nav-link text-white {{ Request::is('user') || Request::is('*/user') || Request::is('*/permission/*') ? 'bg-gradient-primary' : '' }}" data-bs-toggle="collapse" href="#user" role="button" aria-expanded="false" aria-controls="master">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">people</i>
            </div>
            <span class="nav-link-text ms-1">User Management</span>
          </a>
          <div class="collapse" id="user">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link hide-item User_add" href="{{route('add-user')}}"> Add User</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{route('users')}}"> Manage User </a></li>
              
            </ul>
          </div>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item hide-item {{ Request::is('profile') ? 'bg-gradient-primary' : '' }}" id="Profile">
          <a class="nav-link text-white" href="{{route('profile')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
      
      </ul>
    </div>

  </aside>