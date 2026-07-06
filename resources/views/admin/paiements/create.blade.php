<x-admin-layout title="Nouveau paiement — Back-office ITF">
    <a href="{{ route('admin.paiements.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-itf-dark/60 hover:text-itf-blue transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Retour aux paiements
    </a>
    <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-6">Enregistrer un paiement</h1>

    <div class="bg-itf-white rounded-2xl p-6 sm:p-8 shadow-sm border border-itf-dark/10 max-w-xl">
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
                {{-- Étudiant (combobox recherchable) --}}
                <div class="relative">
                    <label class="block text-sm font-semibold text-itf-dark mb-1.5">Étudiant</label>

                    <button type="button" @click="open = !open"
                            class="w-full flex items-center justify-between gap-2 rounded-xl border border-itf-dark/15 bg-itf-white
                                   px-4 py-2.5 text-left shadow-sm transition-colors duration-200
                                   hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                        <span :class="selectedId ? 'text-itf-dark' : 'text-itf-dark/35'"
                              x-text="selectedLabel || '— Sélectionner —'" class="truncate"></span>
                        <svg class="w-4 h-4 text-itf-dark/35 shrink-0 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <input type="hidden" name="user_id" :value="selectedId">

                    <div x-show="open" x-cloak x-transition
                         class="absolute z-10 mt-2 w-full bg-itf-white rounded-xl border border-itf-dark/10 shadow-lg overflow-hidden">
                        <div class="p-2 border-b border-itf-dark/10">
                            <input type="text" x-model="search" x-ref="search" placeholder="Rechercher un étudiant…"
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
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="montant" class="block text-sm font-semibold text-itf-dark mb-1.5">Montant (FCFA)</label>
                        <div class="relative">
                            <input id="montant" type="number" name="montant" x-model="montant" min="0" required
                                   class="w-full rounded-xl border border-itf-dark/15 bg-itf-white pl-4 pr-16 py-2.5 text-itf-dark
                                          shadow-sm transition-colors duration-200
                                          hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                            <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-semibold text-itf-dark/35">FCFA</span>
                        </div>
                        <p class="text-xs text-itf-dark/40 mt-1.5" x-show="montant > 0" x-cloak x-text="new Intl.NumberFormat('fr-FR').format(montant) + ' FCFA'"></p>
                    </div>
                    <div>
                        <label for="mois" class="block text-sm font-semibold text-itf-dark mb-1.5">Mois</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-itf-dark/35"
                                 fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                            </svg>
                            <input id="mois" type="text" name="mois" value="{{ old('mois', now()->translatedFormat('F Y')) }}" required
                                   placeholder="Ex : Juillet 2026"
                                   class="w-full rounded-xl border border-itf-dark/15 bg-itf-white pl-10 pr-4 py-2.5 text-itf-dark
                                          placeholder-itf-dark/30 shadow-sm transition-colors duration-200
                                          hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                        </div>
                    </div>
                </div>

                {{-- Statut --}}
                <div>
                    <label class="block text-sm font-semibold text-itf-dark mb-1.5">Statut</label>
                    <input type="hidden" name="statut" :value="statut">
                    <div class="inline-flex rounded-xl border border-itf-dark/15 p-1 bg-itf-cream/50">
                        <button type="button" @click="statut = 'valide'"
                                :class="statut === 'valide' ? 'bg-green-500 text-itf-white shadow-sm' : 'text-itf-dark/50 hover:text-itf-dark'"
                                class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-lg text-sm font-semibold transition-all duration-200">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            Validé
                        </button>
                        <button type="button" @click="statut = 'en_attente'"
                                :class="statut === 'en_attente' ? 'bg-amber-400 text-itf-white shadow-sm' : 'text-itf-dark/50 hover:text-itf-dark'"
                                class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-lg text-sm font-semibold transition-all duration-200">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/>
                            </svg>
                            En attente
                        </button>
                    </div>
                </div>

                <button type="submit"
                        class="inline-flex items-center gap-2 bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-xl
                               shadow-md shadow-itf-blue/25 transition-all duration-300
                               hover:shadow-lg hover:shadow-itf-blue/35 hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Enregistrer le paiement
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>