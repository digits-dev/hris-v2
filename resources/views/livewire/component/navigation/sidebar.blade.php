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
      if (window.innerWidth >= 640){
        isSidenavOpen = true;
      }else{
        isSidenavOpen = false;
      }
    })
  }"
>
  <div class="fixed bottom-2 left-2 cursor-pointer hover:opacity-50  block sm:hidden"
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
            <li class="{{ Request::segment(1) == $dashboard->slug ? 'active' : '' }}">
              <a href="{{ $dashboard->url }}">
                <img src="{{asset($dashboard->icon)}}" class="nav-icon" />
                <span class="menu-name">Dashboard</span>
              </a>
            </li>
          @endif

          <div 
            x-data="{ menus: $wire.menus.map(menu => ({ ...menu, myDropdown: false, maxHeight: 0})), 
            closeOtherDropdowns(index) { 
                this.menus.forEach((menu, i) => { 
                    if (i !== index) { 
                        menu.myDropdown = false; 
                    } 
                }); 
            }}"
            x-init="console.log(menus)">

          <template x-for="(menu, index) in menus">
     
            {{-- PARENT --}}
         
              <div class="navigation-div">
                <a id="dropdown-title" :href="menu.children ? '#' : menu.url" @click="closeOtherDropdowns(index); menu.myDropdown = !menu.myDropdown;" >
                  <div class="nav-parent mb-1 mt-1" :class="menu.slug == '{{ Request::segment(1) }}' ? 'active' : ''" >
                    <i :class="menu.icon" class="child-nav-icon text-white"></i>
                    {{-- <img :src="'{{ Request::segment(1) }}' === 'admin' ? getIconPath(menu.icon) : `${menu.icon}`" class="nav-icon" console.log(menu.slug);> --}}
                    <p class="nav-name" x-text="menu.name"></p>
                    <img x-show="menu.children" :src="menu.myDropdown ? '{{ asset('images/navigation/nav-up.png') }}' : '{{ asset('images/navigation/nav-down.png') }}'" 
                    class='menu-child-arrow-icon'>
                  </div>
                </a>
                <template x-if="menu.children">
                    <div class=" overflow-hidden transition-all duration-700"
                    :style="menu.myDropdown ? `max-height: ${menu.maxHeight}px` : 'max-height: 0;'"
                    >
                      <template x-for="children in menu.children" >
                        <a :class="children.url_path == '{{ Request::segment(1) }}' ? 'active' : ''" class="nav-child block mb-1 mt-1" :href="children.url" 
                           x-ref="childEl" 
                           x-init="
                              style = window.getComputedStyle($refs.childEl);
                              marginBottom = parseFloat(style.marginBottom);
                              marginTop = parseFloat(style.marginTop);
                              totalMarginHeight = marginBottom + marginTop;
                              totalHeight = totalMarginHeight + $refs.childEl.scrollHeight;
                              menu.maxHeight += totalHeight
                              if(children.url_path == '{{ Request::segment(1) }}'){
                                  menu.myDropdown = true;
                              }"
                    
                        >
                        <i :class="children.icon" class="child-nav-icon text-white"></i>
                        {{-- <img :src="'{{ Request::segment(1) }}' === 'admin' ? getIconPath(children.icon) : `${children.icon}`" class="child-nav-icon" x-init="console.log(children.icon)" > --}}
                        <p x-text="children.name" class="child-nav-name">children names</p>
                        </a>
                      </template>
                  </div>
                </template>
              </div>
          </template>
     
          {{-- IS ADMIN --}}
          @if(App\Helpers\CommonHelpers::isSuperadmin())
          <li class="!pl-2 pr-0 hover:!bg-transparent"><span class="font-bold pt-2">Admin</span></li>
            <li class="{{ Request::segment(2) == 'privileges' ? 'active' : '' }}">
              <a href="{{ route('PrivilegesControllerGetIndex') }}">
                <img src="{{asset('images/navigation/key-icon.png')}}" class="nav-icon" />
                <span class="menu-name">{{trans('ad_default.Privileges')}}</span>
              </a>
            </li>
            <li class="{{ Request::segment(2) == 'users' ? 'active' : '' }}">
              <a href="{{ route('AdminUsersControllerGetIndex') }}">
                <img src="{{asset('images/navigation/user-accounts-icon.png')}}" class="nav-icon" />
                <span class="menu-name">{{trans('ad_default.Users_Management')}}</span>
              </a>
            </li>
            <li class="{{ Request::segment(2) == 'module_generator' ? 'active' : '' }}">
              <a href="{{ route('ModulsControllerGetIndex') }}">
                <img src="{{asset('images/navigation/module-icon.png')}}" class="nav-icon" />
                <span class="menu-name">{{trans('ad_default.Module_Generator')}}</span>
              </a>
            </li>
            <li class="{{ Request::segment(2) == 'menu_management' ? 'active' : '' }}">
              <a href="{{ route('MenusControllerGetIndex') }}">
                <img src="{{asset('images/navigation/settings-icon.png')}}" class="nav-icon" />
                <span class="menu-name">{{trans('ad_default.Menu_Management')}}</span>
              </a>
            </li>
            <li class="{{ Request::segment(1) == 'log-user-access' ? 'active' : '' }}">
    
              <a href="{{ route('log-user-access') }}">
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

<script>
  function sidebarDropdown() {
    return {
      selected: '',
      parentDropdown: [],
    }
  }
  function getIconPath(icon) {
    // Adjust the path based on your needs
    const baseUrl = '{{ asset('') }}';
    return `${baseUrl}${icon}`;
  }
</script>