<div class="w-full p-3 bg-gray-100 flex justify-between items-center shadow-md">
  <a href="/">
    <img src="{{asset("img/logo.png")}}" alt="imagen-logo" width="70">
  </a>
  <nav class="flex justify-center gap-5">
    <a href="/" class="hover:text-gray-500 font-outtfit">
      Boletos de autobus
    </a>
    <a href="{{route("about")}}" class="hover:text-gray-500 font-outtfit">
      Sobre Nosotros
    </a>
    <a href="{{route("terminals")}}" class="hover:text-gray-500 font-outtfit">
      Terminales
    </a>
  </nav>
  <div class="flex gap-5">
    <a 
        href="{{route("login", ['form' => 'login'])}}"
        class="p-2 border border-solid border-blue-500 text-blue-500 rounded shadow-sm hover:bg-blue-700 hover:cursor-pointer transition hover:scale-125 hover:text-white font-outtfit"
      >
        Iniciar Sesión
      </a>
      <a 
        href="{{route("register" ,['form' => 'register'])}}"
        class="p-2 bg-blue-500 text-white rounded shadow-sm hover:bg-blue-700 hover:cursor-pointer transition hover:scale-125 font-outtfit"
      >
        Registrarse
      </a>
  </div>
</div>