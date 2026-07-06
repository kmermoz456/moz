<x-admin-layout title="Nouveau paiement — Back-office ITF">
    <a href="{{ route('admin.paiements.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-itf-dark/60 hover:text-itf-blue transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Retour aux paiements
    </a>
    <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-6">Enregistrer un paiement</h1>

    <div class="bg-itf-white rounded-2xl p-6 sm:p-10 shadow-sm border border-itf-dark/10 max-w-xl">
        <form method="POST" action="{{ route('admin.paiements.store') }}"
              x-data="{
                  etudiants: {{ Illuminate\Support\Js::from($etudiants->map(fn ($e) => [
                      'id' => $e->id,
                      'label' => trim($e->name.' '.$e->prenoms).' ('.$e->email.')',
                  ])) }},
                  selectedId: '{{ old('user_id') }}',
                  search: '',
                  open: false,
                  statut: '{{ old('statut', 'valide') }}',
                  montant: '{{ old('montant') }}',
                  get filtered() {
                      if (!this.search) return this.etudiants;
                      return this.etudiants.filter(e => e.label.toLowerCase().includes(this.search.toLowerCase()));
                  },
                  get selectedLabel() {
                      const e = this.etudiants.find(e => e.id == this.selectedId);
                      return e ? e.label : '';
                  },
                  select(e) {
                      this.selectedId = e.id;
                      this.search = '';
                      this.open = false;
                  }
              }"
              @click.outside="open = false">
            @csrf

            @if ($errors->any())
                <div class="flex gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm mb-8">
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

            <div class="space-y-8">
                {{-- Étudiant --}}
                <div class="relative">
                    <label class="block text-[11px] font-semibold uppercase tracking-widest text-itf-dark/50 mb-1.5">
                        Étudiant
                    </label>

                    <button type="button" @click="open = !open"
                            class="peer w-full flex items-center justify-between gap-2 bg-transparent border-0 border-b-2
                                   {{ $errors->has('user_id') ? 'border-red-400' : 'border-itf-dark/20' }}
                                   px-0 py-2 text-left transition-colors duration-200 focus:outline-none"
                            :class="open ? 'border-itf-blue' : ''">
                        <span :class="selectedId ? 'text-itf-dark' : 'text-itf-dark/30'"
                              x-text="selectedLabel || 'Sélectionner un étudiant'" class="truncate"></span>
                        <svg class="w-4 h-4 text-itf-dark/35 shrink-0 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <span class="pointer-events-none absolute left-0 bottom-0 h-0.5 w-0 bg-itf-blue transition-all duration-300"
                          :class="open ? 'w-full' : ''"></span>

                    <input type="hidden" name="user_id" :value="selectedId">

                    <div x-show="open" x-cloak x-transition
                         class="absolute z-10 mt-2 w-full bg-itf-white rounded-xl border border-itf-dark/10 shadow-lg overflow-hidden">
                        <div class="p-2 border-b border-itf-dark/10">
                            <input type="text" x-model="search" x-ref="search" placeholder="Rechercher…"
                                   class="w-full rounded-lg border border-itf-dark/15 px-3 py-1.5 text-sm text-itf-dark
                                          placeholder-itf-dark/35 focus:border-itf-blue focus:ring-1 focus:ring-itf-blue/30 focus:outline-none">
                        </div>
                        <ul class="max-h-56 overflow-y-auto py-1">
                            <template x-for="e in filtered" :key="e.id">
                                <li @click="select(e)"
                                    class="px-4 py-2 text-sm text-itf-dark cursor-pointer transition-colors duration-100 hover:bg-itf-blue/10"
                                    :class="e.id == selectedId ? 'bg-itf-blue/5 font-semibold' : ''"
                                    x-text="e.label"></li>
                            </template>
                            <li x-show="filtered.length === 0" class="px-4 py-3 text-sm text-itf-dark/40">Aucun résultat.</li>
                        </ul>
                    </div>
                </div>

                {{-- Montant / Mois --}}
                <div class="grid sm:grid-cols-2 gap-8">
                    <div class="relative">
                        <label for="montant" class="block text-[11px] font-semibold uppercase tracking-widest text-itf-dark/50 mb-1.5">
                            Montant
                        </label>
                        <div class="flex items-baseline gap-2">
                            <input id="montant" type="number" name="montant" x-model="montant" min="0" required
                                   placeholder="0"
                                   class="peer w-full bg-transparent border-0 border-b-2 border-itf-dark/20 px-0 py-2
                                          text-itf-dark placeholder-itf-dark/25 text-lg font-semibold
                                          transition-colors duration-200 focus:outline-none focus:ring-0 focus:border-itf-blue">
                            <span class="text-xs font-semibold text-itf-dark/35 shrink-0">FCFA</span>
                        </div>
                        <span class="pointer-events-none absolute left-0 bottom-0 h-0.5 w-0 bg-itf-blue transition-all duration-300 peer-focus:w-full"></span>
                        <p class="text-xs text-itf-dark/40 mt-1.5" x-show="montant > 0" x-cloak
                           x-text="new Intl.NumberFormat('fr-FR').format(montant) + ' FCFA'"></p>
                    </div>

                    <div class="relative">
                        <label for="mois" class="block text-[11px] font-semibold uppercase tracking-widest text-itf-dark/50 mb-1.5">
                            Mois
                        </label>
                        <input id="mois" type="text" name="mois" value="{{ old('mois', now()->translatedFormat('F Y')) }}" required
                               placeholder="Ex : Juillet 2026"
                               class="peer w-full bg-transparent border-0 border-b-2 border-itf-dark/20 px-0 py-2
                                      text-itf-dark placeholder-itf-dark/30
                                      transition-colors duration-200 focus:outline-none focus:ring-0 focus:border-itf-blue">
                        <span class="pointer-events-none absolute left-0 bottom-0 h-0.5 w-0 bg-itf-blue transition-all duration-300 peer-focus:w-full"></span>
                    </div>
                </div>

                {{-- Statut en cartes --}}
                <div>
                    <label class="block text-[11px] font-semibold uppercase tracking-widest text-itf-dark/50 mb-2.5">
                        Statut
                    </label>
                    <input type="hidden" name="statut" :value="statut">
                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" @click="statut = 'valide'"
                                class="flex items-center gap-3 rounded-xl border-2 p-3.5 text-left transition-all duration-200"
                                :class="statut === 'valide' ? 'border-green-400 bg-green-50' : 'border-itf-dark/10 hover:border-itf-dark/25'">
                            <span class="shrink-0 w-8 h-8 rounded-full flex items-center justify-center transition-colors duration-200"
                                  :class="statut === 'valide' ? 'bg-green-500 text-white' : 'bg-itf-dark/5 text-itf-dark/30'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                </svg>
                            </span>
                            <span>
                                <span class="block text-sm font-semibold text-itf-dark">Validé</span>
                                <span class="block text-xs text-itf-dark/45">Paiement confirmé</span>
                            </span>
                        </button>

                        <button type="button" @click="statut = 'en_attente'"
                                class="flex items-center gap-3 rounded-xl border-2 p-3.5 text-left transition-all duration-200"
                                :class="statut === 'en_attente' ? 'border-amber-300 bg-amber-50' : 'border-itf-dark/10 hover:border-itf-dark/25'">
                            <span class="shrink-0 w-8 h-8 rounded-full flex items-center justify-center transition-colors duration-200"
                                  :class="statut === 'en_attente' ? 'bg-amber-400 text-white' : 'bg-itf-dark/5 text-itf-dark/30'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/>
                                </svg>
                            </span>
                            <span>
                                <span class="block text-sm font-semibold text-itf-dark">En attente</span>
                                <span class="block text-xs text-itf-dark/45">À confirmer plus tard</span>
                            </span>
                        </button>
                    </div>
                </div>

                <button type="submit"
                        class="group/btn inline-flex items-center mt-3 gap-2 bg-itf-dark text-itf-white font-bold px-8 py-3 rounded-full
                               transition-all duration-300 hover:bg-itf-blue hover:px-9 active:scale-95">
                    Enregistrer le paiement
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1"
                         fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5M21 12H3"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>