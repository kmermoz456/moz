@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const map = L.map('map').setView([5.3721, -3.9866], 16); // Abidjan, campus UNA (approximatif)

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19,
            }).addTo(map);

            const lieux = [
                { nom: 'Amphithéâtres', lat: 5.3721, lng: -3.9866 },
                { nom: 'Bibliothèque universitaire', lat: 5.3726, lng: -3.9860 },
                { nom: 'Restaurant universitaire', lat: 5.3715, lng: -3.9872 },
                { nom: 'Résidences universitaires', lat: 5.3730, lng: -3.9878 },
                { nom: 'Services administratifs / Scolarité', lat: 5.3718, lng: -3.9855 },
            ];

            lieux.forEach(l => L.marker([l.lat, l.lng]).addTo(map).bindPopup(l.nom));
        });
    </script>
@endpush

<x-app-layout>
    {{-- Bannière --}}
    <section class="bg-itf-blue text-itf-white py-16">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-3xl sm:text-4xl font-extrabold">Découvrir l'Université Nangui Abrogoua</h1>
            <p class="mt-4 text-itf-cream max-w-2xl mx-auto">
                Tout ce qu'il faut savoir sur l'UFR Sciences de la Nature avant votre rentrée.
            </p>
        </div>
    </section>

    {{-- Présentation & LMD --}}
    <section class="max-w-6xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-10">
        <div>
            <h2 class="text-2xl font-bold text-itf-dark mb-4">L'UFR Sciences de la Nature</h2>
            <p class="text-gray-700 leading-relaxed">
                L'Université Nangui Abrogoua (Abidjan) forme des étudiants dans les sciences de la nature à travers
                plusieurs filières scientifiques exigeantes. L'UFR SN accueille chaque année de nombreux nouveaux
                bacheliers scientifiques venus de toute la Côte d'Ivoire.
            </p>
        </div>
        <div class="bg-itf-cream rounded-2xl p-8">
            <h2 class="text-xl font-bold text-itf-dark mb-3">Le système LMD</h2>
            <p class="text-gray-700 leading-relaxed">
                <strong>L</strong>icence (3 ans) — <strong>M</strong>aster (2 ans) — <strong>D</strong>octorat (3 ans).
                Chaque année universitaire est divisée en deux semestres, validés par l'obtention de crédits (UE :
                Unités d'Enseignement).
            </p>
        </div>
    </section>

    {{-- Filières --}}
    <section class="bg-itf-cream py-16">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-itf-dark mb-8 text-center">Les filières</h2>
            <div class="grid sm:grid-cols-3 gap-6">
                @foreach ($filieres as $filiere)
                    <div class="bg-itf-white rounded-xl p-6 shadow">
                        <h3 class="font-bold text-itf-blue mb-2">{{ $filiere['nom'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $filiere['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Cartographie du campus --}}
    <section class="max-w-6xl mx-auto px-4 py-16">
        <h2 class="text-2xl font-bold text-itf-dark mb-8 text-center">Cartographie du campus</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @foreach ($lieux as $lieu)
                <div class="border border-gray-200 rounded-xl p-6 flex gap-4 items-start">
                    <span class="text-3xl">{{ $lieu['icone'] }}</span>
                    <div>
                        <h3 class="font-bold text-itf-dark">{{ $lieu['nom'] }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $lieu['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="map" class="w-full h-96 rounded-2xl overflow-hidden border border-gray-200"></div>
    </section>

    {{-- FAQ --}}
    <section class="bg-itf-cream py-16">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-itf-dark mb-8 text-center">Questions fréquentes</h2>
            <div class="space-y-3">
                @foreach ($faq as $i => $item)
                    <div x-data="{ open: false }" class="bg-itf-white rounded-xl overflow-hidden">
                        <button @click="open = !open"
                                class="w-full flex items-center justify-between p-5 text-left font-semibold text-itf-dark">
                            {{ $item['question'] }}
                            <span x-text="open ? '−' : '+'" class="text-itf-blue text-xl"></span>
                        </button>
                        <div x-show="open" x-cloak class="px-5 pb-5 text-sm text-gray-600">
                            {{ $item['reponse'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
