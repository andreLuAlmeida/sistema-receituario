<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('hospital.png') }}">
        <title>{{ config('app.name') }}</title>

        <!-- Fonts and icons -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <link id="pagestyle" href="{{ asset('template//assets/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
        
    </head>
    <body class="">
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
           
            <!-- Page Heading -->
            @if (Auth()->user()->isMedico())

                <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <!--Mostra em qual pagina estou-->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('medico.home')}}">Páginas</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="{{route('medico-profile.show')}}">Perfil</a></li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Perfil</h6>
      </nav>
    </div>
  </nav>
                <!-- End Navbar -->

                @elseif (Auth()->user()->isFarmacia())

                 <!-- Navbar -->
                 <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
                    <div class="container-fluid py-1 px-3">
                        <!--Mostra em qual pagina estou-->
                      <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('farmacia.home')}}">Páginas</a></li>
                          <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="{{route('farmacia-profile.show')}}">Perfil</a></li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Perfil</h6>
                      </nav>
                    </div>
                  </nav>
                <!-- End Navbar -->

                @else

                 <!-- Navbar -->
                 <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
                    <div class="container-fluid py-1 px-3">
                        <!--Mostra em qual pagina estou-->
                      <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('admin.home')}}">Páginas</a></li>
                          <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="{{route('admin-profile.show')}}">Perfil</a></li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Perfil</h6>
                      </nav>
                    </div>
                </nav>
                <!-- End Navbar -->

            @endif
            
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
