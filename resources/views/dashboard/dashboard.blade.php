@extends('theme.app')
@section('content')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                @php
                $dashboard = DB::table('tb_menu_dashboard')->orderBy('urutan', 'ASC')->get();
                @endphp
                @foreach ($dashboard as $d)
                @php
                $id_user = Auth::user()->id;
                $perm = DB::select("SELECT * FROM dashboard_permission as a LEFT JOIN tb_menu_dashboard as b ON
                a.id_menu_dashboard = b.id WHERE a.id_user = '$id_user' AND b.id = '$d->id'");
                @endphp
                @foreach ($perm as $p)
 
                @if($p->teks == 'Export' || $p->teks == 'Import')
                @php
                    continue;
                @endphp
                @else
                <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{route($p->link)}}">
                        <div class="card">
                            <div class="card-body px-4 py-4-5" style="height: 170px">
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid {{$p->icon}} fa-3x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                            {{ ucwords($p->teks) }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @endforeach
                @endforeach
                <div class="col-6 col-lg-2 col-md-6">
                    <a href="{{ route('logout') }}">
                        <div class="card">
                            <div class="card-body px-4 py-4-5" style="height: 170px">
                                <div class="row ">
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-center">
                                        <i class="fa-solid fa-right-from-bracket fa-3x"></i>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4 justify-content-center">
                                        <h6 class="text-muted font-semibold text-center">
                                            Logout
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection