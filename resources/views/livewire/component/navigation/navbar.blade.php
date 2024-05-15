<div class="navbar-section"
 x-data="{ isProfileOpen: false }"   
>
    <link rel="stylesheet" href="{{ asset('css/navigation/navbar.css') }}">

    <div class="title-content">
        <span class="system-title-text">Human Resource Information System</span>
        <span class="view-line"></span>
    </div>
    <div class="settings-button" 
        @click="isProfileOpen=!isProfileOpen"
        @click.outside="isProfileOpen=false"
    >
        <img src="{{asset('images/navigation/user.png')}}" class="settings-image" width="40">
    </div>
    <div class="setting-popup z-50" 
         x-show="isProfileOpen"
         x-transition
         x-cloak
    >
        <div class="header-info">
            <img src="{{asset('images/navigation/user.png')}}" class="profile-info-image">
            <p>{{auth()->user()->full_name}}</p>
        </div>
        <a href="" class="logout-content">
            <i class="fa-regular fa-user mx-2"></i>
            <p>Profile</p>
        </a>

        <div class="footer-info">
            <a href="{{ route('logout') }}" class="logout-content">
                <i class="fa-solid fa-right-from-bracket mx-2"></i>
                <p>Logout</p>
            </a>
        </div>
    </div>
    
</div>

@section('script')
<script>
     $(document).ready(function(){
   
    });
</script>
@endsection