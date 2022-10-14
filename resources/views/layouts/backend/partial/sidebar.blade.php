<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('app.dashboard')}}">
      <div class="sidebar-brand-icon">
        <img src="img/logo/logo2.png">
      </div>
      <div class="sidebar-brand-text mx-3"><span class="small">Hospital Management</span></div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="{{route('app.dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Features
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" active href="#" data-toggle="collapse" data-target="#Pharmacy-menu" aria-expanded="true"
        aria-controls="Pharmacy-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Pharmacy</span>
      </a>
      <div id="Pharmacy-menu" class="collapse {{Request::is('app/pharmacy*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{Request::is('app/pharmacy/category/create')?'activate':''}}" href="{{route('app.pharmacy.category.create')}}">Add Category</a>
          <a class="collapse-item {{Request::is('app/pharmacy/category/index')?'activate':''}}" href="{{route('app.pharmacy.category.index')}}">Category List</a>
          <a class="collapse-item" href="">Add Purchase</a>
          <a class="collapse-item" href="">Purchase List</a>
          <a class="collapse-item {{Request::is('app/pharmacy/supplier/create')?'activate':''}}" href="{{route('app.pharmacy.supplier.create')}}">Add Supplier</a>
          <a class="collapse-item {{Request::is('app/pharmacy/supplier/index')?'activate':''}}" href="{{route('app.pharmacy.supplier.index')}}">Supplier List</a>
          <a class="collapse-item" href="">Report</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pathology-menu" aria-expanded="true"
        aria-controls="pathology-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Pathology</span>
      </a>
      <div id="pathology-menu" class="collapse {{Request::is('app/pathology*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="">Generate Bill</a>
          <a class="collapse-item {{Request::is('app/pathology/patient/create')?'activate':''}}" href="{{route('app.pathology.patient.create')}}">New Patient</a>
          <a class="collapse-item {{Request::is('app/pathology/patient/index')?'activate':''}}" href="{{route('app.pathology.patient.index')}}">Patient List</a>
          <a class="collapse-item {{Request::is('app/pathology/category/create')?'activate':''}}" href="{{route('app.pathology.category.create')}}">Add Category</a>
          <a class="collapse-item {{Request::is('app/pathology/category/index')?'activate':''}}" href="{{route('app.pathology.category.index')}}">Category List</a>
          <a class="collapse-item" href="">Add Parameter</a>
          <a class="collapse-item" href="">Parameter List</a>
          <a class="collapse-item {{Request::is('app/pathology/unit/create')?'activate':''}}" href="{{route('app.pathology.unit.create')}}">Add Unit</a>
          <a class="collapse-item {{Request::is('app/pathology/unit/index')?'activate':''}}" href="{{route('app.pathology.unit.index')}}">Unit List</a>
          <a class="collapse-item" href="">Set Pathology</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#IPD-menu" aria-expanded="true"
        aria-controls="IPD-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>IPD</span>
      </a>
      <div id="IPD-menu" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="">Add Patient</a>
          <a class="collapse-item" href="">Discharge Patient</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#income-menu" aria-expanded="true"
        aria-controls="income-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Income</span>
      </a>
      <div id="income-menu" class="collapse {{Request::is('app/income*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{Request::is('app/income/index')?'activate':''}}" href="{{ route('app.income.index') }}">Income</a>
          <a class="collapse-item {{Request::is('app/income/account/index')?'activate':''}}" href="{{ route('app.account.index') }}">Account</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Expense-menu" aria-expanded="true"
        aria-controls="Expense-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Expense</span>
      </a>
      <div id="Expense-menu" class="collapse {{Request::is('app/expense*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{Request::is('app/expense/category/index')?'activate':''}}" href="{{ route('app.expense.category.index') }}">Expense Category</a>
          <a class="collapse-item {{Request::is('app/expense/index')?'activate':''}}" href="{{ route('app.expense.index') }}">Expense</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ICU-menu" aria-expanded="true"
        aria-controls="IPD-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>ICU</span>
      </a>
      <div id="ICU-menu" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="">Patient List</a>
          <a class="collapse-item" href="">Medicine Order</a>
          <a class="collapse-item" href="">Order List</a>
          <a class="collapse-item" href="">Patient Condition Note</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Finance-menu" aria-expanded="true"
        aria-controls="IPD-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Finance</span>
      </a>
      <div id="Finance-menu" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="">Add Account</a>
          <a class="collapse-item" href="">Account List</a>
          <a class="collapse-item" href="">Income</a>
          <a class="collapse-item" href="">Referral Payment</a>
        </div>
      </div>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#IPD-menu" aria-expanded="true"
        aria-controls="IPD-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Bank</span>
      </a>
      <div id="IPD-menu" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="">Add Bank</a>
          <a class="collapse-item" href="">Bank List</a>
          <a class="collapse-item" href="">Bank Transaction</a>
        </div>
      </div>
    </li> --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Referral-menu" aria-expanded="true"
        aria-controls="IPD-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Referral</span>
      </a>
      <div id="Referral-menu" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="">Add referral</a>
          <a class="collapse-item" href="">Referral List</a>
          <a class="collapse-item" href="">Referral Payment</a>
          <a class="collapse-item" href="">Report</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Bank-menu" aria-expanded="true"
        aria-controls="IPD-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Bank</span>
      </a>
      <div id="Bank-menu" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="">Add Bank</a>
          <a class="collapse-item" href="">Bank List</a>
          <a class="collapse-item" href="">Bank Transaction</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#HRM-menu" aria-expanded="true"
        aria-controls="IPD-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>HRM</span>
      </a>
      <div id="HRM-menu" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="">Add Department</a>
          <a class="collapse-item" href="">Department List</a>
          <a class="collapse-item" href="">Add Employee</a>
          <a class="collapse-item" href="">Employee List</a>
          <a class="collapse-item" href="">Salary Particular</a>
          <a class="collapse-item" href="">Attendance</a>
          <a class="collapse-item" href="">Payroll</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Inventory-menu" aria-expanded="true"
        aria-controls="IPD-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Inventory</span>
      </a>
      <div id="Inventory-menu" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="">Category</a>
      <a class="collapse-item" href="">Add Item</a>
      <a class="collapse-item" href="">Item List</a>
      <a class="collapse-item" href="">Purchase</a>
      <a class="collapse-item" href="">Supplier</a>
      <a class="collapse-item" href="">Stock Deduct/Used</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Report-menu" aria-expanded="true"
        aria-controls="IPD-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Report</span>
      </a>
      <div id="Report-menu" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="">Daily Transaction Report</a>
          <a class="collapse-item" href="">All Transaction Report</a>
          <a class="collapse-item" href="">IPD Report</a>
          <a class="collapse-item" href="">IPD Balance Report</a>
          <a class="collapse-item" href="">IPD Discharge Report</a>
          <a class="collapse-item" href="">Pharmacy Bill Report</a>
          <a class="collapse-item" href="">OT Report</a>
          <a class="collapse-item" href="">Income Report</a>
          <a class="collapse-item" href="">Expense Report</a>
          <a class="collapse-item" href="">Payroll Report</a>
          <a class="collapse-item" href="">Inventory Report</a>
          <a class="collapse-item" href="">Attendance Report</a>
          <a class="collapse-item" href="">Patient Bill Report</a>
          <a class="collapse-item" href="">Referral Report</a>
          <a class="collapse-item" href="">Pathology Report</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Setting-menu" aria-expanded="true"
        aria-controls="IPD-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Setting</span>
      </a>
      <div id="Setting-menu" class="collapse {{Request::is('app/setting*')?'show':''}}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="">General Setting</a>
          <a class="collapse-item" href="">Hospital Change</a>
          <a class="collapse-item {{Request::is('app/setting/test/create')?'activate':''}}" href="{{route('app.setting.test.create')}}">Add Test</a>
          <a class="collapse-item {{Request::is('app/setting/test/index')?'activate':''}}" href="{{route('app.setting.test.index')}}">Test List</a>
          <a class="collapse-item {{Request::is('app/setting/doctor/create')?'activate':''}}" href="{{route('app.setting.doctor.create')}}">Add Doctor</a>
          <a class="collapse-item {{Request::is('app/setting/doctor/index')?'activate':''}}" href="{{route('app.setting.doctor.index')}}">Doctor List</a>
          <a class="collapse-item {{Request::is('app/setting/referral/create')?'activate':''}}" href="{{route('app.setting.referral.create')}}">Add Referral</a>
          <a class="collapse-item {{Request::is('app/setting/referral/index')?'activate':''}}" href="{{route('app.setting.referral.index')}}">Referral List</a>
          <a class="collapse-item" href="{{route('app.floor.index')}}">Floor</a>
          <a class="collapse-item" href="">Cabin</a>
          <a class="collapse-item " href="">Bed</a>
          <a class="collapse-item" href="">Operation</a>
        </div>
      </div>
    </li>
  </ul>