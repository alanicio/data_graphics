@extends('layouts.general')
@section('content')
<div class="container sombra">
  <div class="row">
    <div class="col-md-4 login-sec">
        <h2 class="text-center text-danger">Inicio Sesion</h2>
        <form class="login-form">
        <div class="form-group">
          <label for="exampleInputEmail1" class="text-uppercase">Usuario</label>
          <input type="text" class="form-control" placeholder="">
          
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1" class="text-uppercase">Password</label>
          <input type="password" class="form-control" placeholder="">
        </div>
        
        
          <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input">
            <small>Recuerdame</small>
          </label>
          <button type="submit" class="btn btn-danger float-right">aceptar</button>
        </div>
        </form>
    </div>
  <div class="col-md-8 banner-sec">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
               <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="{{ asset('images/soyUnCarrito.jpg') }}" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
                <div class="banner-text">
                    <h2>This is Heaven</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                </div>  
          </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="{{ asset('images/soyOtroCarrito.jpg') }}" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
                <div class="banner-text">
                    <h2>This is Heaven</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                </div>  
            </div>
            </div>
                <div class="carousel-item">
                    <img class="d-block img-fluid" src="{{ asset('images/soyUnCarrito.jpg') }}" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                    <div class="banner-text">
                      <h2>This is Heaven</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                    </div>  
                  </div>
                </div>
          </div>     
      
    </div>
  </div>
  </div>
</div>
@endsection