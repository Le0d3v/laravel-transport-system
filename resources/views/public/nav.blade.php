<div class="w-full p-5 bg-gray-300 flex justify-between">
  <a href="/">
    <img src="{{asset("img/logo.png")}}" alt="imagen-logo">
  </a>
  <nav class="flex justify-center">
    <a href="#">Inicio</a>
    <a href="#">Boletos de autobus</a>
    <a href="#">Sobre Nosotros</a>
    <a href="#">Terminales</a>
  </nav>
  <div class="flex gap-5">
    <a 
        href="{{route("login")}}"
        class="p-2 border border-solid border-blue-500 text-blue-500 rounded shadow-sm hover:bg-blue-700 hover:cursor-pointer transition hover:scale-125 hover:text-white"
      >
        Iniciar Sesión
      </a>
      <a 
        href="{{route("register")}}"
        class="p-2 bg-blue-500 text-white rounded shadow-sm hover:bg-blue-700 hover:cursor-pointer transition hover:scale-125"
      >
        Registrarse
      </a>
  </div>
</div>