<x-app-layout title="Bienvenue — ITF" :noindex="true">

    <style>
        @keyframes itf-apparition {
            from { opacity: 0; transform: translateY(20px) scale(.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        .itf-carte-bienvenue { animation: itf-apparition .5s ease both; }

        @keyframes itf-rebond {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-8px); }
        }
        .itf-rebond { animation: itf-rebond 1.8s ease-in-out infinite; }

        @media (prefers-reduced-motion: reduce) {
            .itf-carte-bienvenue, .itf-rebond { animation: none; }
        }
    </style>

    <section class="relative flex min-h-[70vh] items-center overflow-hidden bg-itf-cream px-4 py-16"
             x-data="{ secondes: 5, timer: null }"
             x-init="timer = setInterval(() => {
                 secondes--;
                 if (secondes <= 0) {
                     clearInterval(timer);
                     window.open('{{ $lienWhatsapp }}', '_blank');
                 }
             }, 1000)">

        {{-- Décor de fond : halos + points, cohérent avec les autres pages --}}
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute -left-32 top-10 h-80 w-80 rounded-full bg-itf-blue/10 blur-3xl"></div>
            <div class="absolute -right-24 bottom-10 h-96 w-96 rounded-full bg-green-500/10 blur-3xl"></div>
            <svg class="absolute left-[10%] top-16 hidden h-32 w-32 text-itf-blue/10 lg:block" fill="currentColor" viewBox="0 0 100 100">
                @for ($x = 0; $x < 8; $x++) @for ($y = 0; $y < 8; $y++)
                    <circle cx="{{ 6 + $x * 12 }}" cy="{{ 6 + $y * 12 }}" r="1.8" />
                @endfor @endfor
            </svg>
            {{-- Confettis discrets --}}
            <span class="absolute left-[18%] top-[22%] text-2xl opacity-40">🎊</span>
            <span class="absolute right-[16%] top-[30%] text-2xl opacity-40">✨</span>
            <span class="absolute left-[24%] bottom-[18%] text-2xl opacity-40">🎈</span>
            <span class="absolute right-[22%] bottom-[24%] text-2xl opacity-40">🎊</span>
        </div>

        <div class="itf-carte-bienvenue relative mx-auto w-full max-w-lg overflow-hidden rounded-3xl bg-itf-white shadow-xl">

            {{-- En-tête avec logo --}}
            <div class="relative overflow-hidden bg-itf-blue p-8 text-center text-itf-white">
                <div aria-hidden="true" class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-itf-cream/10 blur-2xl"></div>

                {{-- Logo ITF --}}
                <span class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-itf-white p-2 shadow-lg">
                    <img src="{{ asset('images/icon_ITF.png') }}" alt="Logo ITF" class="h-full w-full object-contain">
                </span>

                <span class="itf-rebond mt-4 inline-block text-4xl">🎉</span>
                <h1 class="mt-2 text-2xl font-extrabold">Bienvenue chez ITF !</h1>
                <p class="mt-1 text-sm text-itf-cream/90">
                    Votre compte est créé et votre <strong class="text-itf-white">mois gratuit est activé</strong>.
                </p>
            </div>

            <div class="p-8 text-center">

                {{-- Prochaines étapes --}}
                <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Vos prochaines étapes</p>
                <ol class="mx-auto mt-4 max-w-sm space-y-3 text-left">
                    @foreach ([
                        ['💬', 'Rejoignez le groupe WhatsApp', 'Annonces, programme des séances et entraide'],
                        ['📚', 'Explorez vos cours', 'Tous les PDF de votre niveau vous attendent'],
                        ['⚡', 'Lancez votre premier quiz', 'Testez votre niveau dès aujourd\'hui'],
                    ] as $i => [$icone, $titre, $sous])
                        <li class="flex items-start gap-3 rounded-xl bg-itf-cream/60 p-3">
                            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-itf-white text-lg shadow-sm">{{ $icone }}</span>
                            <span>
                                <span class="block text-sm font-bold text-itf-dark">{{ $i + 1 }}. {{ $titre }}</span>
                                <span class="block text-xs text-gray-600">{{ $sous }}</span>
                            </span>
                        </li>
                    @endforeach
                </ol>

                {{-- Compte à rebours avec barre de progression --}}
                <div class="mt-6">
                    <p class="text-sm text-gray-500">
                        Ouverture automatique de WhatsApp dans
                        <span x-text="Math.max(0, secondes)" class="font-bold text-itf-blue"></span>
                        <span x-text="secondes > 1 ? 'secondes' : 'seconde'"></span>...
                    </p>
                    <div class="mx-auto mt-2 h-1.5 max-w-xs overflow-hidden rounded-full bg-gray-100">
                        <div class="h-full rounded-full bg-green-500 transition-all duration-1000 ease-linear"
                             :style="`width: ${Math.max(0, secondes) / 5 * 100}%`"></div>
                    </div>
                </div>

                {{-- Bouton WhatsApp --}}
                <a href="{{ $lienWhatsapp }}" target="_blank" rel="noopener"
                   class="group mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-green-500 px-8 py-4 font-bold text-itf-white shadow-lg shadow-green-500/30 transition hover:-translate-y-0.5 hover:bg-green-600 hover:shadow-xl sm:w-auto">
                    <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current" aria-hidden="true"><path d="M12.04 2a9.9 9.9 0 0 0-8.5 15.05L2 22l5.1-1.5A9.9 9.9 0 1 0 12.04 2Zm0 18.1a8.2 8.2 0 0 1-4.2-1.15l-.3-.18-3.02.9.9-2.95-.2-.3a8.2 8.2 0 1 1 6.82 3.68Zm4.5-6.13c-.25-.13-1.46-.72-1.68-.8-.23-.09-.4-.13-.56.12-.17.25-.64.8-.78.97-.15.16-.29.18-.53.06-.25-.12-1.04-.38-1.98-1.22a7.4 7.4 0 0 1-1.37-1.7c-.14-.25-.02-.38.1-.5.12-.12.25-.3.37-.44.13-.15.17-.25.25-.42.08-.16.04-.31-.02-.44-.06-.12-.55-1.34-.76-1.83-.2-.48-.4-.42-.56-.43h-.48c-.16 0-.44.06-.67.31-.23.25-.87.85-.87 2.07 0 1.22.9 2.4 1.02 2.57.12.16 1.75 2.67 4.23 3.74.6.26 1.05.41 1.41.53.6.19 1.13.16 1.56.1.48-.07 1.46-.6 1.67-1.18.2-.57.2-1.06.14-1.17-.06-.1-.22-.16-.47-.28Z"/></svg>
                    Rejoindre le groupe WhatsApp
                </a>

                {{-- Lien espace étudiant --}}
                <div class="mt-5 border-t border-gray-100 pt-5">
                    <a href="{{ route('etudiant.dashboard') }}"
                       class="group inline-flex items-center gap-2 font-semibold text-itf-blue hover:underline">
                        Accéder à mon espace
                        <span class="transition group-hover:translate-x-1">→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>