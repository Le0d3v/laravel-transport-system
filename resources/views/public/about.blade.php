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
          <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus rerum alias ratione neque facere quo nostrum, placeat ipsam veritatis distinctio iusto, voluptatem nisi earum laboriosam perspiciatis exercitationem. Adipisci, pariatur iure!
          </p>
          <br>
          <p>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium, nam. Voluptatem reiciendis minima molestias, eos veritatis consequuntur officia blanditiis eum? Quia veniam magni enim adipisci velit deleniti possimus! Maiores, commodi!
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, eligendi iste! Eos dignissimos blanditiis aliquam molestiae eius ducimus consectetur repudiandae perspiciatis delectus. At velit accusantium quidem nemo commodi. Perspiciatis, sint!
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
      <div class="mt-5 md:mt-0 md:w-1/3">
        <h2 class="text-center text-blue-500 font-bold text-xl font-outtfit">
          Misión
        </h2>
        <p class="text-center">
          Proporcionar experiencias de viaje excepcionales en autobús, combinando comodidad, seguridad y un servicio al cliente inigualable, para que nuestros pasajeros descubran el mundo con estilo y confianza
        </p>
      </div>
      <div class="mt-5 md:mt-0 md:w-1/3">
        <h2 class="text-center text-blue-500 font-bold text-xl font-outtfit">
          Visión 
        </h2>
        <p class="text-center">
          Ser la empresa líder en viajes en autobús, reconocida por nuestra elegancia en el servicio, nuestra dedicación a la sostenibilidad y nuestra pasión por conectar a las personas a través de experiencias inolvidables.
        </p>
      </div>
      <div class="mt-5 md:mt-0 md:w-1/3">
        <h2 class="text-center text-blue-500 font-bold text-xl font-outtfit">
          Valores
        </h2>
        <div class="flex justify-center">
          <ul class="list-disc list-inside space-y-2">
            <li class="font-semibold text-lg">
              Profesionalidad
            </li>
            <li class="font-semibold text-lg">
              Pasión
            </li>
            <li class="font-semibold text-lg">
              Elegancia
            </li>
            <li class="font-semibold text-lg">
              Compromiso
            </li>
            <li class="font-semibold text-lg">
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