@extends("app")
@section("title")
  | Terminales
@endsection 
@section("layout")
  @include("public.nav")
  <main class="p-5 mt-10">  
    <div>
      <h1 class="text-center font-bold text-6xl text-blue-500 font-outtfit">
        ¡Visita nuestras Terminales!
      </h1>
      <h2 class="text-lg text-center font-outtfit mt-2">
        Contamos con terminales en distintos puntos por todo el país. Encuentra la más cercana a tu ubicación
      </h2>
    </div>
    <div class="mt-10 flex gap-10">
        <div class="w-full p-5 shadow-lg rounde-lg overflow-y-scroll max-h-96">
            @foreach ($terminals as $terminal)
                <div class="w-full p-5 rounded-lg border-2 border-blue-500 flex gap-10 my-3">
                    <div class="w-full">
                        <h1 class="text-center text-blue-500 font-bold text-2xl font-outtfit">
                            {{$terminal->name}}
                        </h1>
                        <p>
                            <span class="font-bold text-blue-500 font-outfitt">
                                Dirección:
                            </span>
                            {{$terminal->address}}
                        </p>
                        <p>
                            <span class="font-bold text-blue-500 font-outfitt">
                                Estado:
                            </span>
                            {{$terminal->state}}
                        </p>
                        <p>
                            <span class="font-bold text-blue-500 font-outfitt">
                                Código Postal:
                            </span>
                            {{$terminal->cp}}
                        </p>
                        <p>
                            <span class="font-bold text-blue-500 font-outfitt">
                                Contácto:
                            </span>
                            {{$terminal->telephone}}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="w-1/2" id="map">
        </div>
    </div>
  </main>
  @include("public.footer")
@endsection