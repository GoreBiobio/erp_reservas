<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}
                    </a>
                </div>
            </div>
    @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">SISTEMA</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>Inicio</span></a></li>
            <li class="header">RESERVAS</li>
            <li class="treeview">
                <a href="#"><i class='fa fa-calendar'></i> <span>Salones</span> <i
                        class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Salones/Disponibilidad">Ver Disponibilidad</a></li>
                    @if(Auth::user()->level == 'MENU1')
                        <li><a href="/Salones/Gestion">Gestionar Reserva</a></li>
                        @elseif(Auth::user()->level == 'M12')
                        <li><a href="/Salones/Gestion">Gestionar Reserva</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-truck'></i> <span>Vehículos</span> <i
                        class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Vehiculos/Disponibilidad">Ver Disponibilidad</a></li>
                    @if(Auth::user()->level == 'M12')
                    <li><a href="/Vehiculos/Gestion">Gestionar Reserva</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-bug'></i> <span>Hardware</span> <i
                        class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Hardwares/Disponibilidad">Ver Disponibilidad</a></li>
                    @if(Auth::user()->level == 'MENU3')
                        <li><a href="/Hardwares/Gestion">Gestionar Reserva</a></li>
                    @endif
                </ul>
            </li>
            <li class="header">INFORMATICA</li>
            <li><a href="/"><i class='fa fa-users'></i> <span>Funcionarios</span></a></li>
            <li><a href="/"><i class='fa fa-file'></i> <span>Documentos</span></a></li>
            <li class="header">SISTEMA</li>
            <li class="treeview">
                <a href="#"><i class='fa fa-gears'></i> <span>Configuraciones</span> <i
                        class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Mantenedores</a></li>
                    <li><a href="/Acercade">Acerca De</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
