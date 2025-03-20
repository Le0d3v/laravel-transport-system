@extends("app")
@section("title")
  | Sobre Nosotros
@endsection
@section("layout")
  @include("public.nav")
  <main class="p-5">
    <div class="">
      <h1 class="text-center font-bold text-6xl text-blue-500 font-outtfit">
        ¿Quienes Somos?
      </h1>
      <div class="md:flex md:px-10 md:gap-10 mt-10">
        <div class="md:w-1/2">
          <p class="text-justify">
            En Busify Viajes, nuestra misión es transformar la forma en que las personas exploran el mundo. Fundada en 2020, hemos crecido rápidamente gracias a nuestro compromiso con la seguridad, la calidad y la atención al cliente. Nuestro equipo está formado por apasionados viajeros y expertos en la industria, dedicados a ofrecerte las mejores opciones para que disfrutes de cada aventura sin preocupaciones.

            Nos enorgullece ofrecer una plataforma intuitiva donde puedes encontrar destinos únicos, paquetes personalizados y precios competitivos. Creemos que cada viaje debe ser accesible y enriquecedor, por lo que trabajamos incansablemente para brindarte información actualizada y soporte constante.
          <br> <br>
          <p/>
          <p class="text-justify">
             Tu satisfacción es nuestra prioridad, y estamos comprometidos a hacer de tus experiencias de viaje momentos inolvidables. ¡Explora con nosotros y descubre el placer de viajar con confianza!
          </p>
        </div>
        <div class="md:w-1/2 md:mt-0 mt-5">
          <img src="{{asset("img/bg.jpg")}}" alt="imagen-nosotros">
        </div>
      </div>
    </div>
    <div class="mt-10">
      <h1 class="text-center font-bold text-6xl text-blue-500 font-outtfit">
        Nuestra Filosofía
      </h1>
    </div>
    <div class="p-5 md:flex mt-5 md:gap-10">
      <div class="mt-5 md:mt-0 md:w-1/3 p-3 border-2 border-solid border-blue-500 rounded-lg shadow">
        <h2 class="text-center text-blue-500 font-bold text-xl font-outtfit">
          Misión
        </h2>
        <p class="text-center">
          Proporcionar experiencias de viaje excepcionales en autobús, combinando comodidad, seguridad y un servicio al cliente inigualable, para que nuestros pasajeros descubran el mundo con estilo y confianza
        </p>
      </div>
      <div class="mt-5 md:mt-0 md:w-1/3 p-3 border-2 border-solid border-blue-500 rounded-lg shadow">
        <h2 class="text-center text-blue-500 font-bold text-xl font-outtfit">
          Visión 
        </h2>
        <p class="text-center">
          Ser la empresa líder en viajes en autobús, reconocida por nuestra elegancia en el servicio, nuestra dedicación a la sostenibilidad y nuestra pasión por conectar a las personas a través de experiencias inolvidables.
        </p>
      </div>
      <div class="mt-5 md:mt-0 md:w-1/3 p-3 border-2 border-solid border-blue-500 rounded-lg shadow">
        <h2 class="text-center text-blue-500 font-bold text-xl font-outtfit">
          Valores
        </h2>
        <div class="flex justify-center">
          <ul class="list-disc list-inside space-y-2">
            <li class="text-lg">
              Profesionalidad
            </li>
            <li class="text-lg">
              Pasión
            </li>
            <li class="text-lg">
              Elegancia
            </li>
            <li class="text-lg">
              Compromiso
            </li>
            <li class="text-lg">
              Innovación
            </li>
          </ul>
        </div>
      </div>
    </div>
    @include("public.iconos")
  </main>
  @include("public.footer")
@endsection