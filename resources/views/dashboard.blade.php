
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor"
                     stroke-width="1.8">
                    <rect x="3" y="3" width="18" height="18" rx="4" />
                    <circle cx="8.5" cy="8.5" r="1.5" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m21 15-5-5L5 21" />
                </svg>
            </div>

            <div>
                <h2 class="text-xl font-bold tracking-tight text-gray-800">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500">
                    Compartilhe seus melhores momentos.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-10 sm:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Cabeçalho da página --}}
            <div class="mb-10">
                <span class="text-sm font-semibold uppercase tracking-widest text-blue-600">
                    Sua galeria
                </span>

                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Momentos em fotos
                </h1>

                <p class="mt-3 max-w-2xl text-gray-500">
                    Publique suas fotos favoritas e veja o que as pessoas estão curtindo.
                </p>
            </div>

            {{-- Formulário de upload --}}
            <div class="mb-14 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 16V4m0 0L7 9m5-5 5 5M4 16v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Adicionar nova foto
                            </h3>
                            <p class="text-sm text-gray-500">
                                Escolha uma imagem e dê um título para ela.
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('foto.save') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-6 p-6 sm:p-8">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Título da foto')"
                            class="mb-2 font-semibold text-gray-700" />

                        <x-text-input
                            id="title"
                            type="text"
                            name="title"
                            :value="old('title')"
                            placeholder="Ex.: Meu passeio favorito..."
                            class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                        />

                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="photo" :value="__('Escolha sua imagem')"
                            class="mb-2 font-semibold text-gray-700" />

                        <input
                            id="photo"
                            type="file"
                            name="photo"
                            accept="image/*"
                            required
                            class="block w-full cursor-pointer rounded-xl border border-dashed border-gray-300 bg-gray-50 text-sm text-gray-600 transition file:mr-4 file:cursor-pointer file:border-0 file:bg-blue-600 file:px-5 file:py-3 file:font-semibold file:text-white hover:border-blue-400 hover:bg-blue-50 hover:file:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100"
                        />

                        <p class="mt-2 text-xs text-gray-400">
                            Selecione uma imagem compatível com o seu projeto.
                        </p>

                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>

                    <div class="flex justify-end border-t border-gray-100 pt-5">
                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white shadow-lg shadow-blue-600/20 transition duration-200 hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-xl active:translate-y-0 sm:w-auto">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 4v16m8-8H4" />
                            </svg>
                            Publicar foto
                        </button>
                    </div>
                </form>
            </div>

            {{-- Galeria --}}
            <div class="mb-7 flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h3 class="text-2xl font-bold tracking-tight text-gray-900">
                        Suas fotos
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Confira sua coleção de momentos.
                    </p>
                </div>

                <div class="rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-600 shadow-sm">
                    {{ $fotos->count() }} {{ $fotos->count() === 1 ? 'foto' : 'fotos' }}
                </div>
            </div>

            @if($fotos->isEmpty())
                <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-8 w-8" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="3" />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m21 15-5-5L5 21" />
                        </svg>
                    </div>

                    <h4 class="mt-5 text-lg font-bold text-gray-900">
                        Sua galeria está vazia
                    </h4>
                    <p class="mx-auto mt-2 max-w-sm text-sm text-gray-500">
                        Que tal publicar sua primeira foto e começar sua coleção?
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($fotos as $foto)
                        @php
                            $curtida = $foto->like()
                                ->where('user_id', Auth::id())
                                ->exists();

                            $totalCurtidas = $foto->like->count();
                        @endphp

                        <article class="group flex min-w-0 flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                            {{-- Imagem --}}
                            <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">
                                <img
                                    src="{{ asset('storage/' . $foto->photo) }}"
                                    alt="{{ $foto->title }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                />

                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 transition duration-300 group-hover:opacity-100"></div>
                            </div>

                            {{-- Título --}}
                            <div class="flex flex-1 flex-col p-5">
                                <h4 class="min-h-12 break-words text-base font-bold leading-6 text-gray-800 [overflow-wrap:anywhere]">
                                    {{ $foto->title }}
                                </h4>

                                {{-- Curtidas --}}
                                <form action="{{ route('foto.like', $foto) }}"
                                      method="POST"
                                      class="mt-4 border-t border-gray-100 pt-4">
                                    @csrf

                                    <button
                                        type="submit"
                                        aria-label="{{ $curtida ? 'Descurtir foto' : 'Curtir foto' }}"
                                        class="flex w-full items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold transition duration-200 active:scale-95
                                        {{ $curtida
                                            ? 'bg-red-50 text-red-600 hover:bg-red-100'
                                            : 'bg-gray-50 text-gray-600 hover:bg-pink-50 hover:text-pink-600' }}">

                                        @if($curtida)
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-5 w-5" viewBox="0 0 24 24"
                                                 fill="currentColor">
                                                <path d="M11.645 20.91a.75.75 0 0 0 .71 0C17.14 18.12 21 13.97 21 9.75A5.25 5.25 0 0 0 11.99 6.4 5.25 5.25 0 0 0 3 9.75c0 4.22 3.86 8.37 8.645 11.16Z"/>
                                            </svg>
                                            Curtido
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor"
                                                 stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78Z"/>
                                            </svg>
                                            Curtir
                                        @endif

                                        <span class="rounded-full bg-white/80 px-2 py-0.5 text-xs">
                                            {{ $totalCurtidas }}
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>

