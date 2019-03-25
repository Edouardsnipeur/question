<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="{{asset('backend/images/user.png')}}" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}}</div>
                <div class="email">{{\Illuminate\Support\Facades\Auth::user()->email}}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="material-icons">input</i>Sign Out</a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{csrf_field()}}
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li  class="{{Request::is('admin/question*')?'active':''}}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">dashboard</i>
                            <span>QUESTION</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{Request::is('admin/question/section*')?'active':''}}">
                                <a href="{{route('admin.section.index')}}"  >Sections</a>
                            </li>
                            <li class="{{Request::is('admin/question/question*')?'active':''}}">
                                <a href="{{route('admin.question.index')}}">Questions</a>
                            </li>
                            <li class="{{Request::is('admin/question/reponse*')?'active':''}}">
                                <a href="{{route('admin.reponse.index')}}">Reponses</a>
                            </li>
                        </ul>
                    </li>
                <li  class="{{Request::is('admin/suscriber*')?'active':''}}">
                    <a href="{{route('admin.suscriber.index')}}">
                        <i class="material-icons">group_add</i>
                        <span>Abonne</span>
                    </a>
                </li>
                <li  class="{{Request::is('admin/devi*')?'active':''}}">
                    <a href="{{route('admin.devi.index')}}">
                        <i class="material-icons">assignment</i>
                        <span>Devis</span>
                    </a>
                </li>
                <li  class="{{Request::is('admin/command*')?'active':''}}">
                    <a href="{{route('admin.command.index')}}">
                        <i class="material-icons">group_add</i>
                        <span>Commande</span>
                    </a>
                </li>
                <li  class="{{Request::is('admin/suscrib0')?'active':''}}">
                    <a href="{{route('admin.suscrib0.index')}}">
                        <i class="material-icons">group_add</i>
                        <span>Abonne sans rien</span>
                    </a>
                </li>
                <li  class="{{Request::is('admin/user*')?'active':''}}">
                    <a href="{{route('admin.user.index')}}">
                        <i class="material-icons">group_add</i>
                        <span>Utilisateurs</span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2016 - 2017 <a href="javascript:void(0);">Question</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>
