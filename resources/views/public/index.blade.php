@extends("app")
@section("title")
  
@endsection
@section("layout")
<div class="navbar flex justify-between items-center bg-blue-600 text-white p-4 shadow-md">
  <div class="flex items-center">
      <img src="{{asset('img/logo.png')}}" alt="Logo de la Empresa" class="h-16 mr-20 transition-transform duration-300 ease-in-out transform hover:scale-110 shadow-lg rounded-lg"> 
  </div>
  <div class="flex space-x-4">
      <a id="btn-viaje-sencillo" href="javascript:void(0)" onclick="mostrarFormulario('sencillo')" class="hover:underline">Boletos de Autobús</a>
      <a id="btn-viaje-redondo" href="javascript:void(0)" onclick="mostrarFormulario('redondo')" class="hover:underline">Paquetes de Diversión</a>
      <a href="#" class="hover:underline">Terminales</a>
      <a href="{{route("login")}}" class="hover:underline">Iniciar Sesión</a>
      <a href="{{route("register")}}" class="hover:underline">Registrarse</a>
  </div>
</div>



<div class="container mx-auto p-4">
  <div class="table-container max-w-xl mx-auto">
      <h2 class="text-3xl font-semibold mb-4 text-center">Boletos de Autobús</h2>
      <div>
          <ul class="flex border-b mb-4">
              <li class="mr-4">
                  <a id="tab-sencillo" href="javascript:void(0);" class="inline-block py-2 px-4 text-blue-600 font-semibold border-b-2 border-blue-600 hover:text-blue-700 transition duration-300" onclick="mostrarFormulario('sencillo')">Viaje Sencillo</a>
              </li>
              <li>
                  <a id="tab-redondo" href="javascript:void(0);" class="inline-block py-2 px-4 text-gray-500 hover:text-blue-600 transition duration-300" onclick="mostrarFormulario('redondo')">Viaje Redondo</a>
              </li>
          </ul>
      </div>

      <div id="form-sencillo" class="w-full">
          <form action="/buscar-viaje-sencillo" method="POST" class="formulario">
              @csrf
              <div class="mb-4">
                  <label for="origen" class="block text-sm font-medium text-gray-700">Origen</label>
                  <input type="text" class="mt-1 block w-full p-2" id="origen" name="origen" placeholder="Ciudad de Origen">
              </div>
              <div class="mb-4">
                  <label for="destino" class="block text-sm font-medium text-gray-700">Destino</label>
                  <input type="text" class="mt-1 block w-full p-2" id="destino" name="destino" placeholder="Ciudad de Destino">
              </div>
              <div class="mb-4">
                  <label for="salida" class="block text-sm font-medium text-gray-700">Fecha de Salida</label>
                  <input type="date" class="mt-1 block w-full p-2" id="salida" name="salida">
              </div>
              <div class="mb-4">
                  <label for="pasajeros" class="block text-sm font-medium text-gray-700">Agregar Pasajeros</label>
                  <div class="button-add-remove">
                      <button type="button" onclick="updatePassengerCount('subtract')">-</button>
                      <input type="number" class="mt-1 block w-1/2 p-2" id="pasajeros" name="pasajeros" value="1" readonly>
                      <button type="button" onclick="updatePassengerCount('add')">+</button>
                  </div>
              </div>
              <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Buscar Viaje</button>
          </form>
      </div>

      <div id="form-redondo" class="w-full hidden">
          <form action="/buscar-viaje-redondo" method="POST" class="formulario">
              @csrf
              <div class="mb-4">
                  <label for="origen" class="block text-sm font-medium text-gray-700">Origen</label>
                  <input type="text" class="mt-1 block w-full p-2" id="origen" name="origen" placeholder="Ciudad de Origen">
              </div>
              <div class="mb-4">
                  <label for="destino" class="block text-sm font-medium text-gray-700">Destino</label>
                  <input type="text" class="mt-1 block w-full p-2" id="destino" name="destino" placeholder="Ciudad de Destino">
              </div>
              <div class="mb-4">
                  <label for="salida" class="block text-sm font-medium text-gray-700">Fecha de Salida</label>
                  <input type="date" class="mt-1 block w-full p-2" id="salida" name="salida">
              </div>
              <div class="mb-4">
                  <label for="regreso" class="block text-sm font-medium text-gray-700">Fecha de Regreso</label>
                  <input type="date" class="mt-1 block w-full p-2" id="regreso" name="regreso">
              </div>
              <div class="mb-4">
                  <label for="pasajeros" class="block text-sm font-medium text-gray-700">Agregar Pasajeros</label>
                  <div class="button-add-remove">
                      <button type="button" onclick="updatePassengerCount('subtract')">-</button>
                      <input type="number" class="mt-1 block w-1/2 p-2" id="pasajeros" name="pasajeros" value="1" readonly>
                      <button type="button" onclick="updatePassengerCount('add')">+</button>
                  </div>
              </div>
              <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Buscar Viaje</button>
          </form>
      </div>
  </div>
  
  <div class="relative overflow-hidden w-full max-w-4xl mx-auto mt-8 rounded-lg shadow-lg">
  <div id="carousel" class="flex transition-transform duration-500">
      <div class="flex-shrink-0 w-full text-center">
          <p class="mt-4 text-lg font-semibold text-gray-700">Súper descuento en tus viajes a San Martín</p>
          <div class="w-3/4 mx-auto mt-4 rounded-lg overflow-hidden shadow-md">
              <img src="https://static.wixstatic.com/media/7e1ded_19e8a428de524550b16a08a98dfcf0c8~mv2.jpg/v1/fill/w_720,h_480,al_c,lg_1,q_80/7e1ded_19e8a428de524550b16a08a98dfcf0c8~mv2.jpg" alt="Promoción 1" class="w-full transition-transform duration-300 ease-in-out transform hover:scale-105"> 
          </div>
      </div>
      <div class="flex-shrink-0 w-full text-center">
          <p class="mt-4 text-lg font-semibold text-gray-700">¡Viaja cómodo y seguro!</p>
          <div class="w-3/4 mx-auto mt-4 rounded-lg overflow-hidden shadow-md">
              <img src="imagen2.jpg" alt="Promoción 2" class="w-full transition-transform duration-300 ease-in-out transform hover:scale-105">
          </div>
      </div>
      <div class="flex-shrink-0 w-full text-center">
          <p class="mt-4 text-lg font-semibold text-gray-700">Disfruta de promociones especiales</p>
          <div class="w-3/4 mx-auto mt-4 rounded-lg overflow-hidden shadow-md">
              <img src="imagen3.jpg" alt="Promoción 3" class="w-full transition-transform duration-300 ease-in-out transform hover:scale-105">
          </div>
      </div>
  </div>


  <div class="flex justify-center mt-4">
      <span class="dot cursor-pointer bg-gray-400 w-3 h-3 rounded-full mx-1 transition duration-300 ease-in-out hover:bg-blue-600" onclick="changeSlide(0)"></span>
      <span class="dot cursor-pointer bg-gray-400 w-3 h-3 rounded-full mx-1 transition duration-300 ease-in-out hover:bg-blue-600" onclick="changeSlide(1)"></span>
      <span class="dot cursor-pointer bg-gray-400 w-3 h-3 rounded-full mx-1 transition duration-300 ease-in-out hover:bg-blue-600" onclick="changeSlide(2)"></span>
  </div>
</div>
</div>
</div>




<div class="p-4">
  <h2 class="text-3xl font-bold text-blue-600 mb-6 text-center">Viajes Recomendados</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-white p-6 rounded-lg shadow-lg">
          <img src="{{asset("img/cancun.jpg")}}" alt="Destino 1" class="w-full h-48 object-cover rounded-lg mb-4">
          <p class="text-xl font-semibold text-gray-800 mb-2">Cancún</p>
          <p class="text-gray-600">Disfruta de las hermosas playas de Cancún, donde el mar caribeño y la arena blanca te esperan para unas vacaciones inolvidables. Un destino ideal para relajarte y disfrutar de actividades acuáticas.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg">
          <img src="https://encrypted-tbn1.gstatic.com/licensed-image?q=tbn:ANd9GcRkqHlAgGAAIXOIO02KVBc0Q9tGSUACQlUmvIrcqN9Ukg8RFxXubFKx0IAmyBsHdQ24rlbC4zIvIVh0o6f1-AKDjlnLmvp6rficC1BZRw" alt="Destino 2" class="w-full h-48 object-cover rounded-lg mb-4">
          <p class="text-xl font-semibold text-gray-800 mb-2">Ciudad de México</p>
          <p class="text-gray-600">Explora la historia y cultura de la Ciudad de México, donde podrás visitar monumentos históricos, museos, y disfrutar de la deliciosa gastronomía local. Un lugar lleno de tradición y modernidad.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg">
          <img src="{{asset('img/guanajuato.jpeg')}}" alt="Destino 3" class="w-full h-48 object-cover rounded-lg mb-4">
          <p class="text-xl font-semibold text-gray-800 mb-2">Guanajuato</p>
          <p class="text-gray-600">Conoce la bella ciudad de Guanajuato, famosa por sus callejones, su arquitectura colonial y su ambiente pintoresco. Un lugar lleno de historia, cultura y belleza, ideal para disfrutar de un viaje relajante y lleno de color.</p>
      </div>
  </div>
</div>

<div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white py-10 px-5 mt-10">
  <div class="max-w-6xl mx-auto flex flex-col lg:flex-row items-start">
      <div class="w-full lg:w-1/2 flex flex-col items-start">
          <h2 class="text-4xl font-bold mb-6 text-center lg:text-left">Tus viajes <br> suman puntos</h2>
          <ul class="space-y-4">
              <li class="flex items-center">
                  🎉 <strong>Bono de bienvenida:</strong> <span class="text-sm ml-2">Recibe un incentivo al unirte a nuestra comunidad.</span>
              </li>
              <li class="flex items-center">
                  🎟️ <strong>Boletos gratis:</strong> <span class="text-sm ml-2">Obtén boletos gratis para tus viajes.</span>
              </li>
              <li class="flex items-center">
                  🛍️ <strong>Preventas en bonobus:</strong> <span class="text-sm ml-2">Accede a ofertas exclusivas antes que nadie.</span>
              </li>
              <li class="flex items-center">
                  🎁 <strong>Canje de puntos:</strong> <span class="text-sm ml-2">Usa tus puntos acumulados para disfrutar de experiencias únicas.</span>
              </li>
              <li class="flex items-center">
                  🎂 <strong>Bono de cumpleaños:</strong> <span class="text-sm ml-2">Celebra tu día especial con un regalo de nuestra parte.</span>
              </li>
          </ul>
          <div class="mt-6">
              <h3 class="text-xl font-semibold">Lo que dicen nuestros usuarios:</h3>
              <p class="mt-2 italic">"Gracias a los bonos de bienvenida, he podido disfrutar de mis viajes sin preocupaciones!" - Ana M.</p>
              <p class="mt-2 italic">"Las preventas son una maravilla. Siempre encuentro los mejores precios." - Luis R.</p>
          </div>
      </div>

      <div class="w-full lg:w-1/2 flex flex-col items-center justify-center mt-8 lg:mt-0">
          <div class="relative mb-6">
              <img src="https://framerusercontent.com/images/jt4kjxTKGxlnB1dV2DIJiEGStfs.svg" alt="Persona" class="w-72 h-auto transition-transform duration-300 hover:scale-105">
          </div>
          <div class="text-center">
              <h3 class="text-2xl font-semibold">¡Únete a nosotros!</h3>
              <p class="mt-2">Disfruta de beneficios exclusivos y promociones especiales.</p>
              <a href="{{route("register")}}" class="bg-red-500 text-white py-2 px-4 rounded mt-4 inline-block hover:bg-red-600 transition">¡Regístrate ahora!</a>
          </div>
      </div>
  </div>
</div>



<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
 
  <div class="bg-gradient-to-r from-blue-500 to-blue-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
      <p class="text-2xl font-bold text-white mb-4">Más de 20 años de experiencia</p>
      <p class="text-lg text-gray-200 mb-4 font-medium">En la transportación de pasajeros en México, cuenta con una flotilla de 100 autobuses y 20 sprinters con diversas opciones especializados para el turismo.</p>
  </div>
 
  <div class="bg-gradient-to-r from-pink-400 to-pink-600 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
      <p class="text-2xl font-bold text-white mb-4">No busques más autobuses a Puebla desde la Ciudad de México</p>
      <p class="text-lg text-gray-200 mb-4 font-medium">Hemos recorrido aproximadamente 10 millones de kilómetros, ofreciendo confort, comodidad y seguridad en cada uno de nuestros viajes.</p>
  </div>

  <div class="bg-gradient-to-r from-purple-500 to-purple-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
      <p class="text-2xl font-bold text-white mb-4">¡Somos tu alternativa perfecta si hablamos de Autobuses México Puebla!</p>
      <p class="text-lg text-gray-200 mb-4 font-medium">Especialistas en renta de autobuses, paquetes de diversión, y traslados a los mejores espectáculos.</p>
  </div>
</div>
<script>
  function mostrarFormulario(formulario) {
      document.getElementById('form-sencillo').classList.add('hidden');
      document.getElementById('form-redondo').classList.add('hidden');
      document.getElementById('form-' + formulario).classList.remove('hidden');

      document.getElementById('tab-sencillo').classList.remove('text-blue-600', 'border-blue-600');
      document.getElementById('tab-sencillo').classList.add('text-gray-500');

      document.getElementById('tab-redondo').classList.remove('text-blue-600', 'border-blue-600');
      document.getElementById('tab-redondo').classList.add('text-gray-500');

      document.getElementById('tab-' + formulario).classList.remove('text-gray-500');
      document.getElementById('tab-' + formulario).classList.add('text-blue-600', 'border-blue-600');
  }

  function updatePassengerCount(action) {
      const input = document.getElementById('pasajeros');
      let count = parseInt(input.value) || 1; 
      if (action === 'add') {
          count++;
      } else if (action === 'subtract' && count > 1) {
          count--;
      }
      input.value = count;
  }

  window.onload = function() {
      mostrarFormulario('sencillo');
      document.getElementById('pasajeros').value = 1;
      startCarousel();
  };

  let currentSlide = 0;
  const slides = document.querySelectorAll('.carousel img');

  function startCarousel() {
      slides[currentSlide].classList.add('active');

      setInterval(() => {
          slides[currentSlide].classList.remove('active');
          slides[currentSlide].classList.add('prev');

          currentSlide = (currentSlide + 1) % slides.length;

          slides[currentSlide].classList.remove('prev');
          slides[currentSlide].classList.add('active');
      }, 3000); 
  }
</script>
@endsection