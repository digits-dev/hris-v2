<div class="relative"
  x-data="{ 
    isSidenavOpen: true,
    screen: '',

    toggleSidenav: function() {
      if(this.isSidenavOpen == true && this.screen < 640){
        this.isSidenavOpen = false;
      }
    }
  }"
  x-init="() => {
    screen = window.innerWidth;
    window.addEventListener('resize', () => {
      
      screen = window.innerWidth;
      console.log(isSidenavOpen, screen) 
      if (window.innerWidth >= 640){
        isSidenavOpen = true;
      }else{
        isSidenavOpen = false;
      }
    })
  }"
>
  <div class="fixed bottom-2 left-2 cursor-pointer hover:opacity-50  block sm:hidden" style="display: none"
    @click="isSidenavOpen=true"
  >
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
    </svg>
  </div>
  <div class="sidebar-container z-10 fixed sm:relative"
    x-show="isSidenavOpen"
    @click.outside="toggleSidenav"
  >
    <div class="sidebar-content-container">
      <!-- LOGO -->
      <div class="logo-container">
        <img
          src="{{asset('images/navigation/hris-logo.png')}}"
          width="45"
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
  
          {{-- IS ADMIN --}}
          @if(App\Helpers\CommonHelpers::isSuperadmin())
          <li class="!pl-2 pr-0 hover:!bg-transparent"><span>Admin</span></li>
          <li class="{{ Request::segment(1) == 'ad-privilege' ? 'active' : '' }}">
            <a href="{{ route('ad-privilege') }}" wire:navigate>
              <img src="{{asset('images/navigation/key-icon.png')}}" class="nav-icon" />
              <span>Privileges</span>
            </a>
          </li>
          <li class="{{ Request::segment(1) == 'ad-privilege' ? 'active' : '' }}">
            <a href="{{ route('ad-privilege') }}" wire:navigate>
              <img src="{{asset('images/navigation/user-accounts-icon.png')}}" class="nav-icon" />
              <span>Users Management</span>
            </a>
          </li>
          <li class="{{ Request::segment(1) == 'log-user-access' ? 'active' : '' }}">
            <a href="{{ route('log-user-access') }}" wire:navigate>
              <img src="{{asset('images/navigation/user-logs-icon.png')}}" class="nav-icon" />
              <span>Log User Access</span>
            </a>
          </li>
          @endif
        </ul>
      </div>

    </div>


  </div>
</div>