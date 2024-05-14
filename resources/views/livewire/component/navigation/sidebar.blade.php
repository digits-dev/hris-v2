<div class="sidebar-container">
  <div class="sidebar-content-container">
    <!-- LOGO -->
    <div class="logo-container">
      <img
        src="{{asset('images/navigation/hris-logo.png')}}"
        class="nav-logo margin-auto"
      />
    </div>
    </div>
    <!-- SCREENS -->
    <div id="navigation-content">
      <ul class="navigation">
        <li class="{{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}" wire:navigate>
            <img src="{{asset('images/navigation/dashboard-icon.png')}}" class="nav-icon" />
            <span>Dashboard</span>
          </a>
        </li>
        <li class="{{ Request::segment(1) == 'employee-accounts' ? 'active' : '' }}">
          <a href="{{ route('employee-accounts') }}" wire:navigate>
            <img src="{{asset('images/navigation/user-accounts-icon.png')}}" class="nav-icon" />
            <span>Employee Accounts</span>
          </a>
        </li>
        <li class="{{ Request::segment(1) == 'employee-attendance' ? 'active' : '' }}">
          <a href="{{ route('employee-attendance') }}" wire:navigate>
            <img src="{{asset('images/navigation/employee-attendance-icon.png')}}" class="nav-icon" />
            <span>Employee Attendance</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>