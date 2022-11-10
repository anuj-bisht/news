<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('Admin') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
      <a href="https://creative-tim.com/" class="simple-text logo-normal">
        {{ __('News Panel') }}
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="nav-item" >
          <a class="nav-link" href="{{ route('home') }}">
            <i class="material-icons">dashboard</i>
              <p>{{ __('Dashboard') }}</p>
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link collapsed" data-toggle="collapse" href="#laravelExample" aria-expanded="false">
            <i class="fa-regular fa-folder-open"></i>
            <p>{{ __('News Management') }}
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse " id="laravelExample">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="{{asset('new')}}">
                    <i class="fa-solid fa-file-lines"></i>
                  <span class="sidebar-normal">{{ __('Global News') }} </span>
                </a>
              </li>
              {{-- <li class="nav-item"  >
                <a class="nav-link" href="" >
                  <span class="sidebar-mini"> UM </span>
                  <span class="sidebar-normal">{{ __('your News') }} </span>
                </a>
              </li> --}}
            </ul>
          </div>
        </li>
        <li class="nav-item" >
          <a class="nav-link" href="{{route('Users')}}"  >
            <i class="fa-solid fa-users"></i>
              <p>{{ __('User List') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('show.categories')}}">
            <i class="fa-regular fa-rectangle-list"></i>
              <p>{{ __('Category') }}</p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="">
            <i class="material-icons">bubble_chart</i>
            <p>{{ __('Icons') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="material-icons">location_ons</i>
              <p>{{ __('Maps') }}</p>
          </a>
        </li>
        {{-- {{ $activePage == 'notifications' ? ' active' : '' }} --}}
        {{-- <li class="nav-item">
          <a class="nav-link" href="">
            <i class="material-icons">notifications</i>
            <p>{{ __('Notifications') }}</p>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a class="nav-link" href="">
            <i class="material-icons">language</i>
            <p>{{ __('RTL Support') }}</p>
          </a>
        </li> --}}

      </ul>
    </div>
  </div>
