<div class="header">
    <div class="header-left">
        <a href="/" class="logo">
            <img src="{{asset('logo.png')}}" width="35" height="35" alt="Main Logo"> <span>MP3 Music World</span>
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
    <a id="mobile_btn" class="mobile_btn float-start" href="#sidebar"><i class="fa fa-bars"></i></a>

    <ul class="nav user-menu float-end">
        <a class="nav-link user-link" id="tagLine">
            @if(auth()->check())
                <span>{{Auth::user()->name}}</span>
            @else
                <div>
                    Want to download music? Register
                </div>
            @endif
        </a>
    </ul>
</div>
