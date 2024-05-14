<div class="sidebar-container">
    <div class="sidebar-content-container">
      <!-- LOGO -->
      <div class="logo-container">
        <img
          src="{{asset('images/navigation/hris-logo.png')}}"
          class="nav-logo margin-auto"
        />
      </div>
      <!-- PROFILE -->
      <div id="profile-content">
        <img src="{{ asset('images/navigation/user.png') }}" class="profile-img" />
        <div class="profile-info-content">
            <h4 class="profile-name">{{ auth()->user()->name }}</h4>
            <h6 class="profile-role" style="color: #ddd">SUPER ADMIN</h6>
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
          {{-- <li>
            <a href="{{ route('employee_checklist') }}" wire:navigate>
              <img src="{{asset('images/navigation/checklist-icon.png')}}" class="nav-icon" />
              <span>Employee Checklist</span>
            </a>
          </li>
          <li>
            <a href="{{ route('approve_accounts') }}" wire:navigate>
              <img src="{{asset('images/navigation/registration-icon.png')}}" class="nav-icon" />
              <span>Employee Registration</span>
            </a>
          </li>
          <li>
            <a href="{{ route('employee_informations') }}" wire:navigate>
              <img src="{{asset('images/navigation/employee-info-icon.png')}}" class="nav-icon" />
              <span>Employee Information</span>
            </a>
          </li>
          <li>
            <a href="{{ route('log_user_access') }}" wire:navigate>
              <img src="{{asset('images/navigation/activity-logs-icon.png')}}" class="nav-icon" />
              <span>Employee Activity Logs</span>
            </a>
          </li>
          <li>
            <a href="{{ route('employee_request') }}" wire:navigate>
              <img src="{{asset('images/navigation/request-icon.png')}}" class="nav-icon" />
              <span>Employee Requests</span>
            </a>
          </li>
          <li>
            <a href="{{ route('employee_leaves') }}" wire:navigate>
              <img src="{{asset('images/navigation/leaves-icon.png')}}" class="nav-icon" />
              <span>Employee Leaves</span>
            </a>
          </li>
          <li>
            <a href="{{ route('schedule_profile') }}" wire:navigate>
              <img src="{{asset('images/navigation/schedule-profiles-icon.png')}}" class="nav-icon" />
              <span>Schedule Profiles</span>
            </a>
          </li> --}}
    
        </ul>
      </div>
    </div>
</div>