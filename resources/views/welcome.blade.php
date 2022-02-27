@extends('layout.template')

@section('title')
    <title>ZeroGRUPS | Bienvenido</title>
@endsection

@section('titulo')
    Panel de Bienvenida
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Bienvenido</li>
@endsection

@section('contenido')
    <div class="card-header">
        <h3 class="card-title">Bienvenido al sistema</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Ventas</p>
                    </div>
                    <a href="{{ route('users.index') }}">
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </a>
                    <a href="#" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>Bounce Rate</p>
                    </div>
                    <a href="{{ route('users.index') }}">
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </a>
                    <a href="#" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $usuario_count }}</h3>
                        <p>Registros de Usuarios</p>
                    </div>
                    <a href="{{ route('users.index') }}">
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </a>
                    <a href="{{ route('users.index') }}" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>
                        <p>Unique Visitors</p>
                    </div>
                    <a href="{{ route('users.index') }}">
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </a>
                    <a href="#" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ultimos Miembros</h3>

                        <div class="card-tools">
                            <span class="badge badge-danger">{{ $count_members }} Nuevos Miembros</span>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            @for ($i = 0; $i < $count_members; $i++)
                                <li>
                                    <img src="{{ $latest_members[$i]->perfil->upro_image }}"
                                        style="width:128px; height: 128px;" alt="User Image">
                                    <a class="users-list-name" href="#">{{ $latest_members[$i]->user_name }}</a>
                                    <span class="users-list-date">
                                        Activo(a)
                                        {{-- años --}}
                                        @if ($last_sessions[$i]->y == 0)
                                        @elseif($last_sessions[$i]->y > 0)
                                            hace {{ $last_sessions[$i]->y }} año
                                        @endif

                                        {{-- meses --}}
                                        @if ($last_sessions[$i]->m == 0)
                                        @elseif($last_sessions[$i]->y == 0 && $last_sessions[$i]->m == 1)
                                            hace 1 mes
                                        @elseif($last_sessions[$i]->y == 0 && $last_sessions[$i]->m <= 11)
                                            hace {{ $last_sessions[$i]->m }} Meses
                                        @endif

                                        {{-- días --}}
                                        @if ($last_sessions[$i]->d == 0)
                                        @elseif($last_sessions[$i]->m == 0 && $last_sessions[$i]->d >= 28)
                                            hace 4 semanas
                                        @elseif($last_sessions[$i]->m == 0 && $last_sessions[$i]->d >= 21)
                                            hace 3 semanas
                                        @elseif($last_sessions[$i]->m == 0 && $last_sessions[$i]->d >= 14)
                                            hace 2 semanas
                                        @elseif($last_sessions[$i]->m == 0 && $last_sessions[$i]->d >= 7)
                                            hace 1 semana
                                        @elseif($last_sessions[$i]->y == 0 && $last_sessions[$i]->m == 0 && $last_sessions[$i]->d == 1)
                                            Ayer
                                        @elseif($last_sessions[$i]->y == 0 && $last_sessions[$i]->m == 0 && $last_sessions[$i]->d <= 6)
                                            hace {{ $last_sessions[$i]->d }} d
                                        @endif

                                        {{-- horas --}}
                                        @if ($last_sessions[$i]->h == 0)
                                        @elseif($last_sessions[$i]->y == 0 && $last_sessions[$i]->m == 0 && $last_sessions[$i]->d == 0 && $last_sessions[$i]->h >= 17 && $last_sessions[$i]->h <= 23)
                                            Hoy
                                        @elseif($last_sessions[$i]->y == 0 && $last_sessions[$i]->m == 0 && $last_sessions[$i]->d == 0)
                                            hace {{ $last_sessions[$i]->h }} h
                                        @endif

                                        {{-- minutos --}}
                                        @if ($last_sessions[$i]->i == 0)
                                        @elseif($last_sessions[$i]->y == 0 && $last_sessions[$i]->m == 0 && $last_sessions[$i]->d == 0 && $last_sessions[$i]->h == 0)
                                            hace {{ $last_sessions[$i]->i }} m
                                        @endif

                                        {{-- segundos --}}
                                        @if ($last_sessions[$i]->i > 0)
                                        @elseif($last_sessions[$i]->y == 0 && $last_sessions[$i]->m == 0 && $last_sessions[$i]->d == 0 && $last_sessions[$i]->h == 0 && $last_sessions[$i]->i == 0 && $last_sessions[$i]->s == 0)
                                            Nunca
                                        @elseif($last_sessions[$i]->y == 0 && $last_sessions[$i]->m == 0 && $last_sessions[$i]->d == 0 && $last_sessions[$i]->h == 0 && $last_sessions[$i]->i == 0)
                                            hace {{ $last_sessions[$i]->s }} s
                                        @endif

                                    </span>
                                </li>
                            @endfor
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center card-dark">
                        <a href="{{ route('users.index') }}">Ver Lista de Usuarios</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <div class="card-footer">

    </div>
@endsection

@section('css')
@endsection

@section('js')
@endsection
