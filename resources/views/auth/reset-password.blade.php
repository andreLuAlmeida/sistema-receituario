<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('template/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/x-icon" href="{{ asset('hospital.png') }}">
  <title>{{ config('app.name') }}</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('template/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('template/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('template/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('template/assets/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
  <style>
    /* Estilizando a div centralizada */
</style>
</head>
<body>

        
        <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
            <div class="p-5 rounded-3 border shadow-lg col-5 row justify-content-center align-items-center">
              <h4>Redefinir Senha</h4>
              <x-validation-errors class="mb-4" />
        
              @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('As instruções de redefinição de senha foram enviadas para o seu e-mail.') }}
                </div>
              @endif
        
              <form method="POST" action="{{ route('password.update') }}" class="w-100">
                @csrf
        
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
        
                <div class="mb-4">
                  <input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="Preencha com seu email" class="block mt-1 w-100 form-control">
                </div>
        
                <div class="mb-4">
                  <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Crie uma nova senha" class="block mt-1 w-100 form-control">
                </div>
        
                <div class="mb-4">
                  <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme a nova senha" class="block mt-1 w-100 form-control">
                </div>
        
                <div class="flex items-center justify-end">
                  <button type="submit" class="btn btn-primary">{{ __('Redefinir Senha') }}</button>
                </div>
              </form>
            </div>
          </div>
        
        
</body>
    <!--   Core JS Files   -->
    <script src="{{asset('template/assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('template/assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('template/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('template/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('template/assets/js/soft-ui-dashboard.min.js?v=1.0.7')}}"></script>
   </body>
   
   </html>


