<x-admin-layout title="Nouvel administrateur — Back-office ITF">
    <a href="{{ route('admin.administrateurs.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-itf-dark/60 hover:text-itf-blue transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Retour aux administrateurs
    </a>
    <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-6">Créer un administrateur</h1>

    <div class="bg-itf-white rounded-2xl p-6 sm:p-8 shadow-sm border border-itf-dark/10 max-w-xl">
        <form method="POST" action="{{ route('admin.administrateurs.store') }}"
              x-data="{
                  pwd: '',
                  showPwd: false,
                  showConfirm: false,
                  get score() {
                      let s = 0;
                      if (this.pwd.length >= 8) s++;
                      if (/[A-Z]/.test(this.pwd)) s++;
                      if (/[0-9]/.test(this.pwd)) s++;
                      if (/[^A-Za-z0-9]/.test(this.pwd)) s++;
                      return s;
                  }
              }">
            @csrf

            @if ($errors->any())
                <div class="flex gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm mb-6">
                    <svg class="w-5 h-5 shrink-0 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-5">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-itf-dark mb-1.5">Nom</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                               class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                                      shadow-sm transition-colors duration-200
                                      hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                    </div>
                    <div>
                        <label for="prenoms" class="block text-sm font-semibold text-itf-dark mb-1.5">Prénoms</label>
                        <input id="prenoms" type="text" name="prenoms" value="{{ old('prenoms') }}" required
                               class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                                      shadow-sm transition-colors duration-200
                                      hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-itf-dark mb-1.5">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                                  shadow-sm transition-colors duration-200
                                  hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                </div>

                <div>
                    <label for="telephone" class="block text-sm font-semibold text-itf-dark mb-1.5">Téléphone</label>
                    <input id="telephone" type="tel" name="telephone" value="{{ old('telephone') }}" required
                           class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                                  shadow-sm transition-colors duration-200
                                  hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-itf-dark mb-1.5">Mot de passe</label>
                        <div class="relative">
                            <input id="password" :type="showPwd ? 'text' : 'password'" name="password" required
                                   x-model="pwd"
                                   class="w-full rounded-xl border border-itf-dark/15 bg-itf-white pl-4 pr-10 py-2.5 text-itf-dark
                                          shadow-sm transition-colors duration-200
                                          hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                            <button type="button" @click="showPwd = !showPwd"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-itf-dark/35 hover:text-itf-blue transition-colors">
                                <svg x-show="!showPwd" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <svg x-show="showPwd" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12c1.292 4.338 5.31 7.5 10.066 7.5.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.243L9.88 9.88"/>
                                </svg>
                            </button>
                        </div>
                        {{-- Indicateur de force --}}
                        <div class="flex gap-1 mt-2" x-show="pwd.length > 0" x-cloak>
                            <template x-for="i in 4" :key="i">
                                <span class="h-1 flex-1 rounded-full transition-colors duration-200"
                                      :class="i <= score
                                          ? (score <= 1 ? 'bg-red-400' : score === 2 ? 'bg-amber-400' : score === 3 ? 'bg-itf-blue' : 'bg-green-500')
                                          : 'bg-itf-dark/10'"></span>
                            </template>
                        </div>
                        <p class="text-xs text-itf-dark/45 mt-1.5">8 caractères minimum.</p>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-itf-dark mb-1.5">Confirmer le mot de passe</label>
                        <div class="relative">
                            <input id="password_confirmation" :type="showConfirm ? 'text' : 'password'"
                                   name="password_confirmation" required
                                   class="w-full rounded-xl border border-itf-dark/15 bg-itf-white pl-4 pr-10 py-2.5 text-itf-dark
                                          shadow-sm transition-colors duration-200
                                          hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                            <button type="button" @click="showConfirm = !showConfirm"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-itf-dark/35 hover:text-itf-blue transition-colors">
                                <svg x-show="!showConfirm" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <svg x-show="showConfirm" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12c1.292 4.338 5.31 7.5 10.066 7.5.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.243L9.88 9.88"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                @if (auth()->user()->estSuperAdmin())
                    <label class="flex items-start gap-3 rounded-xl border border-amber-200 bg-amber-50 p-4 cursor-pointer
                                  transition-colors duration-200 hover:border-amber-300">
                        <input type="checkbox" name="est_super_admin" value="1" @checked(old('est_super_admin'))
                               class="mt-0.5 rounded border-itf-dark/25 text-itf-blue focus:ring-itf-blue">
                        <span>
                            <span class="flex items-center gap-1.5 font-semibold text-itf-dark">
                                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001z"/>
                                </svg>
                                Administrateur principal (super admin)
                            </span>
                            <span class="block text-sm text-itf-dark/55 mt-0.5">
                                Voit et modifie le contenu créé par tous les administrateurs, pas seulement le sien.
                            </span>
                        </span>
                    </label>
                @endif

                <button type="submit"
                        class="inline-flex items-center gap-2 bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-xl
                               shadow-md shadow-itf-blue/25 transition-all duration-300
                               hover:shadow-lg hover:shadow-itf-blue/35 hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766z"/>
                    </svg>
                    Créer l'administrateur
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>