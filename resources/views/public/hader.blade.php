<div class="bg-busify">
  <div class="w-full flex justify-between px-5 py-7 items-center">
    <a href="/">
      <img src="{{asset("img/logo.png")}}" alt="imagen-logo" class="w-20">
    </a>
    <nav class="flex gap-10 justify-center">  
      <a href="/" class="text-white hover:text-gray-200 transition font-outtfit">
        Boletos de Autobus
      </a>
      <a href="{{route("about")}}" class="text-white hover:text-gray-200 transition font-outtfit">
        Sobre Nosotros
      </a>
      <a href="/" class="text-white hover:text-gray-200 transition font-outtfit">
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
        href="{{route("login", ['form' => 'register'])}}"
        class="p-2 bg-blue-500 text-white rounded shadow-sm hover:bg-blue-700 hover:cursor-pointer transition hover:scale-125 font-outtfits"
      >
        Registrarse
      </a>
    </div>
  </div>
  <div class="mt-26 text-center">
    <h1 class=" text-gray-100 text-9xl font-bold font-outtfit">
      Busify
    </h1>
    <h2 class="text-3xl text-gray-200 mt-2">
      Tu viaje, tu aventura
    </h2>
  </div>
</div>