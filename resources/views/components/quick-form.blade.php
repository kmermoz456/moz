@props(['compact' => false])

<form method="POST" action="{{ route('prospects.store') }}"
      class="{{ $compact ? 'space-y-3' : 'flex flex-col sm:flex-row gap-3 items-start' }}">
    @csrf
    <input type="hidden" name="page_source" value="{{ request()->route()?->getName() ?? url()->current() }}">

    <div class="{{ $compact ? 'w-full' : 'flex-1 w-full' }}">
        <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Votre nom" required
               class="w-full p-2 rounded-lg border-gray-900 focus:border-itf-blue focus:ring-itf-blue">
        @error('nom', 'prospect')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="{{ $compact ? 'w-full' : 'flex-1 w-full' }}">
        <input type="tel" name="telephone" value="{{ old('telephone') }}" placeholder="Votre numéro WhatsApp" required
               class="w-full P-2 rounded-lg border-gray-900 focus:border-itf-blue focus:ring-itf-blue">
        @error('telephone', 'prospect')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
            class="{{ $compact ? 'w-full' : '' }} bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-lg hover:opacity-90 transition whitespace-nowrap">
        Être rappelé
    </button>
</form>
