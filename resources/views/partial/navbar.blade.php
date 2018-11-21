 @if (Route::has('login'))
        @auth
<?php $st = Auth::user()->rules_id ; ?>
      <?php if ( $st == 1 ) {
         $status = "super admin";
            }elseif ( $st == 2 ) {
         $status = "admin daerah";
            }elseif ( $st == 3 ) {
         $status = "admin desa";
            }elseif ( $st == 4) {
         $status = "admin kelompok";
            }else {
         $status = "new anggota";
            }
      ?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{ Auth::user()->name }}</p>
                  <div>
                    <small class="designation text-muted"><?php echo $status;?></small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              <button class="btn btn-success btn-block"><?php echo $status;?>
                <i class="mdi mdi-plus"></i>
              </button>
            </div>
          </li>
          <?php $i = Auth::user()->rules_id ; ?>
              <?php if ( $i == 1 ) { ?>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('users')}}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('daerah')}}">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">DAERAH</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('desa')}}">
              <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title">DESA</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('kelompok')}}">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">KELOMPOK</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('peopple')}}">
              <i class="menu-icon mdi mdi-sticker"></i>
              <span class="menu-title">PEOPLE</span>
            </a>
          </li>
        <?php } elseif ( $i == 2 ) { ?>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('desa')}}">
              <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title">DESA</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('kelompok')}}">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">KELOMPOK</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('peopple')}}">
              <i class="menu-icon mdi mdi-sticker"></i>
              <span class="menu-title">PEOPLE</span>
            </a>
          </li>
        <?php } elseif ( $i == 3 ) { ?>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('kelompok')}}">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">KELOMPOK</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('peopple')}}">
              <i class="menu-icon mdi mdi-sticker"></i>
              <span class="menu-title">PEOPLE</span>
            </a>
          </li>
        <?php } elseif ( $i == 4 ) { ?>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('peopple')}}">
              <i class="menu-icon mdi mdi-sticker"></i>
              <span class="menu-title">PEOPLE</span>
            </a>
          </li>
        <?php } else { ?> 
        <?php } ?>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-restart"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
              </ul>
            </div>
          </li>
        </ul>
      </nav>
       @else

       <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">Your Name</p>
                  <div>
                    <small class="designation text-muted">Manager</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">DAERAH</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title">DESA</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">KELOMPOK</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="menu-icon mdi mdi-sticker"></i>
              <span class="menu-title">PEOPLE</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-restart"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
              </ul>
            </div>
          </li>
        </ul>
      </nav>
       @endauth
            @endif