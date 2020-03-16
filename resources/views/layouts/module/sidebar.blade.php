 <!-- partial:partials/_sidebar.html -->
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item nav-profile">
             <a href="#" class="nav-link">
                 <div class="profile-image">
                     <img class="img-xs rounded-circle" src="{{asset('admin/assets/images/faces/face8.jpg')}}"
                         alt="profile image">
                     <div class="dot-indicator bg-success"></div>
                 </div>
                 <div class="text-wrapper">
                     <p class="profile-name">Allen Moreno</p>
                     <p class="designation">Premium user</p>
                 </div>
             </a>
         </li>
         <li class="nav-item nav-category">Main Menu</li>
         <li class="nav-item">
             <a class="nav-link" href="/home">
                 <i class="menu-icon typcn typcn-document-text"></i>
                 <span class="menu-title">Dashboard</span>
             </a>
         </li>
         @if (Auth::user()->id_roles=='3' )
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                 <i class="menu-icon typcn typcn-coffee"></i>
                 <span class="menu-title">Pasien</span>
                 <i class="menu-arrow"></i>
             </a>
             <div class="collapse" id="ui-basic">
                 <ul class="nav flex-column sub-menu">
                     <li class="nav-item">
                         <a class="nav-link" href="{{route('pasien.index')}}">Data Pasien</a>
                     </li>
                 </ul>
             </div>
         </li>
         @endif

         @if (Auth::user()->id_roles=='1')
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                 <i class="menu-icon typcn typcn-coffee"></i>
                 <span class="menu-title">Dokter</span>
                 <i class="menu-arrow"></i>
             </a>
             <div class="collapse" id="ui-basic">
                 <ul class="nav flex-column sub-menu">
                     <li class="nav-item">
                         <a class="nav-link" href="{{route('tipe_dokter.index')}}">Tipe Dokter</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="{{route('dokter.index')}}">Data Dokter</a>
                     </li>
                 </ul>
             </div>
         </li>
         @endif

         @if (Auth::user()->id_roles=='1'|| Auth::user()->id_roles=='2')
         <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                 <i class="menu-icon typcn typcn-coffee"></i>
                 <span class="menu-title">Perawat</span>
                 <i class="menu-arrow"></i>
             </a>
             <div class="collapse" id="ui-basic">
                 <ul class="nav flex-column sub-menu">
                     <li class="nav-item">
                         <a class="nav-link" href="{{route('data-perawat.index')}}">Data Perawat</a>
                     </li>
                 </ul>
             </div>
         </li>
         @endif

         @if (Auth::user()->id_roles=='2'|| Auth::user()->id_roles=='3')
         <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Riwayat Pasien</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('riwayat-pasien.index')}}">Data Riwayat Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('status-pengobatan.index')}}">Data Status Pengobatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('rawat-inap.index')}}">Data Rawat Inap</a>
                    </li>
                </ul>
            </div>
        </li>
        @endif


            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon typcn typcn-document-add"></i>
                    <span class="menu-title">Logout</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item has-treeview">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="nav-icon fa fa-sign-out"></i>
                                <p>
                                    {{ __('Logout') }}
                                </p>
                            </a>
                        ​
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
         </li>
     </ul>
 </nav>
