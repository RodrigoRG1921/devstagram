@extends('layouts.app')

@section('titulo')
 Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
<div class="md:flex md:justify-center">
  <div class="md:w-1/2 bg-white shadow p-6">
    <form action="{{ route('perfil.store')}}" method='POST' class="mt-10 md:mt-0" enctype="multipart/form-data">
      @csrf
      <div class="mb-5">
          <label for="username" class="mb-2 block uppercase text-gray-500 font-bold" >
            Username
          </label>
          <input
          name="username"
            type="text"
            id="username"
            placeholder="Tu Nombre de Usuario"
            class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
            value="{{ auth()->user()->username }}"
            />

          @error('username')
          <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
            {{ $message }}
          </p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold" >
            Imagen Perfil
          </label>
          <input
          name="imagen"
            type="file"
            id="imagen"
            class="border p-3 w-full rounded-lg"
            value=""
            accept=".jpg, .jpeg, .png"
            />

            <div class="mb-5">
              
          <label for="oldPassword" class="mb-2 block uppercase text-gray-500 font-bold" >
            Constraseña anterior
          </label>
          <input
            name="oldPassword"
            type="password"
            id="oldPassword"
            placeholder="Contraseña anterior"
            class="border p-3 w-full rounded-lg"
            
          />
              @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                  {{ session('mensaje') }}
                </p>
              @endif
        </div>
            <div class="mb-5">
          <label for="password" class="mb-2 block uppercase text-gray-500 font-bold" >
            Nueva contraseña
          </label>
          <input
            name="password"
            type="password"
            id="password"
            placeholder="Nueva contraseña"
            class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
            
          />
          @error('password')
          <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
            {{ $message }}
          </p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold" >
            Repetir contraseña
          </label>
          <input
            name="password_confirmation"
            type="password"
            id="password_confirmation"
            placeholder="Repite tu nueva contraseña"
            class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror"
          />
        </div>

            <input type="submit" value="Guardar Cambios"
          class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" >

        </div>
    </form>
  </div>
</div>
@endsection