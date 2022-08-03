@extends('layouts.app')

@section('titulo')
  Perfil: {{$user->username}}
@endsection

@section('contenido')
  <div class="flex justify-center"> 
    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
      <div class="w-4/12 md:w-6/12 lg:w-6/12 px-5">
        <img
          src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg')}}"
          alt="Sooo"
          class='rounded-full'>
      </div>
      <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center py-10">
      <div class="flex items-center gap-2">  
        <p class="text-gray-700 text-2xl">{{$user->username}}</p>

          @auth
            @if($user->id === auth()->user()->id)
              <a href="{{ route('perfil.index')}}" class="text-gray-500 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
              </a>
            @endif
          @endauth    
      </div>
        <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
          {{ $user->followers->count()}}
          <span class="font-normal"> @choice('Seguidor|Seguidores',$user->followers->count() )</span>
        </p>
        <p class="text-gray-800 text-sm mb-3 font-bold">
          {{ $user->followings->count()}}
          <span class="font-normal"> Siguiendo</span>
        </p>
        <p class="text-gray-800 text-sm mb-3 font-bold">
          {{ $user->posts->count()}}
          <span class="font-normal">Posts</span>
        </p>
        @auth
          @if($user->id !== auth()->user()->id)
            @if( !$user->siguiendo( auth()->user() ) )
              <form action="{{ route('users.follow', $user) }}" method="POST">
                @csrf
                <input
                  type="submit"
                  class="bg-blue-600 text-white uppercase rounded-lg py-1 px-3 text-xs font-bold cursor-pointer"
                  value='Seguir'>
              </form>
              @else
              <form action="{{ route('users.unfollow', $user)}}" method="POST">
                @method('DELETE')
                @csrf
                <input
                  type="submit"
                  class="bg-red-600 text-white uppercase rounded-lg py-1 px-3 text-xs font-bold cursor-pointer"
                  value='Dejar de Seguir'>
              </form>
            @endif
          @endif
        @endauth
      </div>
    </div>
  </div>

  <section class="container mx-auto mt-10">
    <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

    <x-listar-post :posts="$posts" />
  </section>
@endsection