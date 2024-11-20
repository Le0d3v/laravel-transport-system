@extends("app")
@section("title")
  
@endsection
@section("layout")
  <div class="flex justify-end p-5">
    <div class="flex gap-5">
      <a href="{{route("login")}}">Iniciar Sesión</a>
      <a href="{{route("register")}}">Registrarse</a>
    </div>
  </div>
@endsection