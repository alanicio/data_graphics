<nav class="navbar navbar-expand-lg navbar-light bg-light border border-bottom ">
  <a class="navbar-brand" href="#">
    <img src="{{ asset('images/logo_maha.png') }}" style="max-width: 50px" class="d-inline-block align-top" alt="">
  </a>
  <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
            &#9776;
  </button>
  <div class="collapse navbar-collapse" id="exCollapsingNavbar">
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link" href="{{url('graficas')}}" id="Presentación_de_datos">Presentación de datos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Privilegios</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="Usuarios_modulo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuarios</a>
        <div class="dropdown-menu" aria-labelledby="Usuarios_modulo">
          <a class="dropdown-item" href="{{route('usuarios.index')}}">Ver</a>
          <a class="dropdown-item" href="{{route('usuarios.create')}}">Agregar</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">deshabilitado</a>
      </li>
    </ul>
    <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
        <li class="nav-item order-2 order-md-1"><a href="#" class="nav-link" title="settings"><i class="fa fa-cog fa-fw fa-lg"></i></a></li>
        <li class="dropdown order-1">
            <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-primary dropdown-toggle">Login <span class="caret"></span></button>
            <ul class="dropdown-menu dropdown-menu-right mt-2">
               <li class="px-3 py-2">
                   <form class="form" role="form">
                        <div class="form-group">
                            <input id="emailInput" placeholder="Email" class="form-control form-control-sm" type="text" required="">
                        </div>
                        <div class="form-group">
                            <input id="passwordInput" placeholder="password" class="form-control form-control-sm" type="text" required="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block bg-danger">Login</button>
                        </div>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
  </div>
</nav>