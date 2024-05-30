<div class="navbar-section {{App\Helpers\CommonHelpers::myThemeColor()}}"

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

        @if (auth()->user()->image)
            @php
                $profileImagePath = public_path('storage/' . auth()->user()->image);
                list($width, $height) = getimagesize($profileImagePath);
                $isLandscape = $width > $height;
            @endphp
            
            <img src="{{ asset('storage/' . auth()->user()->image) }}" class="settings-image" @style(['height:40px' => $isLandscape, 'max-width: unset' => $isLandscape]) alt="profile-picture">
        @else
            <img src="{{asset('images/navigation/user.png')}}" class="settings-image" width="40">
        @endif

    </div>
    <div class="setting-popup z-50" 
         x-show="isProfileOpen"
         x-transition
         x-cloak
    >
        <div class="header-info">
            @if (auth()->user()->image)
                @php
                    $profileImagePath = public_path('storage/' . auth()->user()->image);
                    list($width, $height) = getimagesize($profileImagePath);
                    $isLandscape = $width > $height;
                @endphp
            
                <img src="{{ asset('storage/' . auth()->user()->image) }}" class="settings-image" @style(['height:40px' => $isLandscape, 'max-width: unset' => $isLandscape]) alt="profile-picture">
            @else
                <img src="{{asset('images/navigation/user.png')}}" class="settings-image" width="40">
            @endif
            <p>{{auth()->user()->full_name}}</p>
        </div>

        <a href="{{route('profile')}}" class="logout-content">
            <i class="fa-regular fa-user mx-2"></i>
            <p>Profile</p>
        </a>

        <a href="{{route('change-password')}}" class="logout-content">
            <i class="fa-solid fa-lock mx-2"></i>
            <p>Change Password</p>
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