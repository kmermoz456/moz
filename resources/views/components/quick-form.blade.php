@props(['compact' => false])

<form method="POST" action="{{ route('prospects.store') }}"
      x-data="{ envoi: false }" @submit="envoi = true"
      class="{{ $compact ? 'space-y-6' : 'flex flex-col sm:flex-row gap-6 items-end' }}">
    @csrf
    <input type="hidden" name="page_source" value="{{ request()->route()?->getName() ?? url()->current() }}">

    {{-- Nom --}}
    <div class="{{ $compact ? 'w-full' : 'flex-1 w-full' }} relative">
        <label for="nom-{{ $compact ? 'c' : 'f' }}"
               class="block text-[11px] font-semibold uppercase tracking-widest text-itf-dark/50 mb-1.5">
            Votre nom
        </label>
        <input id="nom-{{ $compact ? 'c' : 'f' }}" type="text" name="nom" value="{{ old('nom') }}"
               placeholder="Ex : Kouadio Aya" required
               class="peer w-full bg-transparent border-0 border-b-2
                      {{ $errors->prospect->has('nom') ? 'border-red-400' : 'border-itf-dark/20' }}
                      px-0 py-2 text-itf-dark placeholder-itf-dark/30
                      transition-colors duration-200
                      focus:outline-none focus:ring-0 focus:border-itf-blue">
        <span class="pointer-events-none absolute left-0 bottom-0 h-0.5 w-0 bg-itf-blue transition-all duration-300 peer-focus:w-full"></span>
        @error('nom', 'prospect')
            <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    {{-- Téléphone WhatsApp --}}
    <div class="{{ $compact ? 'w-full' : 'flex-1 w-full' }} relative">
        <label for="tel-{{ $compact ? 'c' : 'f' }}"
               class="flex items-center gap-1.5 text-[11px] font-semibold uppercase tracking-widest text-itf-dark/50 mb-1.5">
            <svg class="w-3 h-3 text-itf-blue" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.83 14.12c-.25.7-1.44 1.33-2 1.41-.51.08-1.16.11-1.87-.12-.43-.14-.98-.32-1.69-.62-2.97-1.28-4.91-4.27-5.06-4.47-.15-.2-1.21-1.61-1.21-3.07 0-1.46.77-2.18 1.04-2.48.27-.3.6-.37.8-.37.2 0 .4 0 .57.01.18.01.43-.07.67.51.25.6.85 2.07.92 2.22.08.15.13.33.03.53-.1.2-.15.32-.3.5-.15.17-.31.39-.44.52-.15.15-.3.31-.13.61.17.3.77 1.26 1.65 2.05 1.13 1.01 2.08 1.32 2.38 1.47.3.15.47.13.65-.08.17-.2.75-.87.95-1.17.2-.3.4-.25.67-.15.28.1 1.74.82 2.04.97.3.15.5.22.57.35.08.13.08.72-.17 1.42z"/>
            </svg>
            Numéro WhatsApp
        </label>
        <input id="tel-{{ $compact ? 'c' : 'f' }}" type="tel" name="telephone" value="{{ old('telephone') }}"
               placeholder="Ex : 07 00 00 00 00" required
               class="peer w-full bg-transparent border-0 border-b-2
                      {{ $errors->prospect->has('telephone') ? 'border-red-400' : 'border-itf-dark/20' }}
                      px-0 py-2 text-itf-dark placeholder-itf-dark/30
                      transition-colors duration-200
                      focus:outline-none focus:ring-0 focus:border-itf-blue">
        <span class="pointer-events-none absolute left-0 bottom-0 h-0.5 w-0 bg-itf-blue transition-all duration-300 peer-focus:w-full"></span>
        @error('telephone', 'prospect')
            <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p>
        @enderror
    </div>

    {{-- Bouton --}}
    <button type="submit" :disabled="envoi"
            class="{{ $compact ? 'w-full' : 'shrink-0' }} group/btn relative inline-flex items-center justify-center gap-2
                   bg-itf-dark text-itf-white font-bold px-8 py-3 rounded-full whitespace-nowrap
                   transition-all duration-300
                   hover:bg-itf-blue hover:px-9
                   active:scale-95 disabled:opacity-60 disabled:cursor-wait">
        <span x-show="!envoi">Être rappelé</span>
        <svg x-show="!envoi" class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1"
             fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5M21 12H3"/>
        </svg>
        <span x-show="envoi" x-cloak class="inline-flex items-center gap-2">
            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
            </svg>
            Envoi…
        </span>
    </button>
</form>