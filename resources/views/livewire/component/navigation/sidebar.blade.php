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
      <div id="navigation-content" x-data="{ selected: null }">
        <ul class="navigation">
          <?php $dashboard = App\Helpers\CommonHelpers::sidebarDashboard();?>
          @if($dashboard)
            <li class="{{ Request::segment(1) == $dashboard->path ? 'active' : '' }}">
              <a href="{{ $dashboard->url }}" wire:navigate>
                <img src="{{asset($dashboard->icon)}}" class="nav-icon" />
                <span class="menu-name">Dashboard</span>
              </a>
            </li>
          @endif

          @foreach(App\Helpers\CommonHelpers::sidebarMenu() as $menu)
          <div  x-data="{
              isChildActive: false,
              ulHeight: 0,
              maxHeight: 0,
              isOpen: false,

              toggle(){
                if(this.isOpen == false){
                  this.maxHeight = 0
                }else{
                  this.maxHeight = this.ulHeight
                }
              }
            }">
            {{-- PARENT --}}
            <li class="{{ Request::segment(1) == $menu->path ? 'active' : '' }}" @click="selected !== {{$menu->id}} ? selected = {{$menu->id}} : selected = null, isOpen=!isOpen, toggle()">
              <a href="{{ $menu->url }}" {{ $menu->type == 'URL' ? '' : 'wire:navigate' }} style="justify-content: space-between">
                <div class="nav-icon-name-container">
                  <img src="{{ asset($menu->icon) }}" class="nav-icon" />
                  <span class="menu-name">{{$menu->name}}</span>
                </div>
                @if(!empty($menu->children))
                <span class="menu-arrow-icon" x-html="selected === {{$menu->id}} ? `<img src='{{ asset('images/navigation/nav-up.png') }}' class='menu-child-arrow-icon'>` : `<img src='{{ asset('images/navigation/nav-down.png') }}' class='menu-child-arrow-icon'>`"></span>
                @endif
              </a>
            </li>
            {{-- CHILDREN --}}
            <div class="relative overflow-hidden transition-all duration-700" x-ref="container{{$menu->id}}">
              @if(!empty($menu->children))
              <ul x-ref="ul{{$menu->id}}" x-init="maxHeight = $refs.ul{{$menu->id}}.scrollHeight"
                  x-bind:style="selected === {{$menu->id}} || isChildActive ? 'max-height: ' + maxHeight + 'px' : 'max-height: 0'">
                @foreach($menu->children as $child)
                <li data-id="{{$child->id}}" class="{{ Request::is($child->url_path .= !Str::endsWith(Request::decodedPath(), $child->url_path) ? '/*' : '') ? 'active' : '' }} child-menu-container"
                    x-init="
                      isActive = $el.classList.contains('active');
                      ulHeight = $refs.container{{$menu->id}}.scrollHeight;
                      if (isActive) {
                        maxHeight = ulHeight;
                        isChildActive = true;
                        isOpen = true;
                      }
                    ">
                  <a href="{{ $child->is_broken ? 'javascript:alert(\''.cbLang('controller_route_404').'\')' : $child->url }}"
                    class="{{ $child->color ? 'text-' . $child->color : '' }}">
                    <img src="{{ asset($child->icon) }}" class="child-nav-icon" />
                    <span class="menu-child-name">{{$child->name}}</span>
                  </a>
                </li>
                @endforeach
              </ul>
              @endif
            </div>
          </div>

          @endforeach
         
  
        {{-- IS ADMIN --}}
        @if(App\Helpers\CommonHelpers::isSuperadmin())
        <li class="!pl-2 pr-0 hover:!bg-transparent"><span class="font-bold pt-2">Admin</span></li>
          <li class="{{ Request::segment(2) == 'privilege' ? 'active' : '' }}">
            <a href="{{ route('PrivilegesControllerGetIndex') }}">
              <img src="{{asset('images/navigation/key-icon.png')}}" class="nav-icon" />
              <span class="menu-name">{{trans('ad_default.Privileges')}}</span>
            </a>
          </li>
          <li class="{{ Request::segment(1) == 'users' ? 'active' : '' }}">
            <a href="{{ route('AdminUsersControllerGetIndex') }}" wire:navigate>
              <img src="{{asset('images/navigation/user-accounts-icon.png')}}" class="nav-icon" />
              <span class="menu-name">{{trans('ad_default.Users_Management')}}</span>
            </a>
          </li>
          <li class="{{ Request::segment(1) == 'users' ? 'active' : '' }}">
            <a href="{{ route('ModulsControllerGetIndex') }}" wire:navigate>
              <img src="{{asset('images/navigation/settings-icon.png')}}" class="nav-icon" />
              <span class="menu-name">{{trans('ad_default.Module_Generator')}}</span>
            </a>
          </li>
          <li class="{{ Request::segment(1) == 'users' ? 'active' : '' }}">
            <a href="{{ route('MenusControllerGetIndex') }}" wire:navigate>
              <img src="{{asset('images/navigation/settings-icon.png')}}" class="nav-icon" />
              <span class="menu-name">{{trans('ad_default.Menu_Management')}}</span>
            </a>
          </li>
          <li class="{{ Request::segment(1) == 'log-user-access' ? 'active' : '' }}">
            <a href="{{ route('log-user-access') }}" wire:navigate>
              <img src="{{asset('images/navigation/user-logs-icon.png')}}" class="nav-icon" />
              <span class="menu-name">Log User Access</span>
            </a>
          </li>
          @endif
        </ul>
      </div>

    </div>

  </div>
</div>