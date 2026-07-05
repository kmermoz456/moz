<x-admin-layout title="Cours — Back-office ITF">

    {{-- En-tête de page --}}
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="flex items-center gap-3 text-2xl font-extrabold text-itf-dark">
                Cours
                <span class="rounded-full bg-itf-blue/10 px-3 py-1 text-sm font-bold text-itf-blue">
                    {{ $cours->total() }}
                </span>
            </h1>
            <p class="mt-1 text-sm text-gray-500">Les supports PDF accessibles aux étudiants dans leur espace.</p>
        </div>
        <a href="{{ route('admin.cours.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-itf-blue px-5 py-2.5 font-bold text-itf-white shadow-lg shadow-itf-blue/25 transition hover:-translate-y-0.5 hover:shadow-xl">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
            </svg>
            Nouveau cours
        </a>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-gray-100 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/70 text-[11px] font-semibold uppercase tracking-wider text-gray-500">
                    <th class="px-4 py-3.5">Titre</th>
                    <th class="px-4 py-3.5">Matière</th>
                    <th class="px-4 py-3.5">Niveau</th>
                    <th class="px-4 py-3.5">Accès</th>
                    <th class="px-4 py-3.5 text-right">Téléch.</th>
                    @if (auth()->user()->estSuperAdmin())
                        <th class="px-4 py-3.5">Créé par</th>
                    @endif
                    <th class="px-4 py-3.5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($cours as $item)
                    <tr class="group transition-colors hover:bg-itf-cream/40">

                        {{-- Titre --}}
                        <td class="max-w-xs px-4 py-3">
                            <div class="flex items-center gap-3">
                                <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-itf-blue/10 text-base">📄</span>
                                <span class="truncate font-semibold text-itf-dark" title="{{ $item->titre }}">{{ $item->titre }}</span>
                            </div>
                        </td>

                        {{-- Matière --}}
                        <td class="px-4 py-3 text-gray-600">{{ $item->matiere }}</td>

                        {{-- Niveau --}}
                        <td class="px-4 py-3">
                            <span class="rounded-md px-2 py-0.5 text-xs font-bold
                                {{ $item->niveau === 'L1' ? 'bg-itf-blue/10 text-itf-blue' : 'bg-itf-dark/10 text-itf-dark' }}">
                                {{ $item->niveau }}
                            </span>
                        </td>

                        {{-- Accès --}}
                        <td class="px-4 py-3">
                            @if ($item->gratuit)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-bold text-green-700">
                                    <span aria-hidden="true" class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                    Gratuit
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-bold text-amber-700">
                                    <span aria-hidden="true" class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    Payant
                                </span>
                            @endif
                        </td>

                        {{-- Téléchargements --}}
                        <td class="px-4 py-3 text-right">
                            <span class="inline-flex items-center gap-1.5 font-mono font-semibold text-itf-dark">
                                {{ number_format($item->telechargements, 0, ',', ' ') }}
                                <svg class="h-3.5 w-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0l-4-4m4 4l4-4M4 20h16"/>
                                </svg>
                            </span>
                        </td>

                        {{-- Créé par (super admin) --}}
                        @if (auth()->user()->estSuperAdmin())
                            <td class="px-4 py-3 text-gray-500">{{ $item->creePar->name ?? '—' }}</td>
                        @endif

                        {{-- Actions --}}
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('admin.cours.edit', $item) }}"
                                   aria-label="Modifier « {{ $item->titre }} »" title="Modifier"
                                   class="grid h-8 w-8 place-items-center rounded-lg text-gray-400 transition hover:bg-itf-blue/10 hover:text-itf-blue">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.86 4.49 2.65 2.65m-1.13-4.19a1.875 1.875 0 1 1 2.65 2.65L7.13 18.4a4.5 4.5 0 0 1-1.9 1.13l-2.85.84.84-2.85a4.5 4.5 0 0 1 1.13-1.9L16.86 3.06Z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.cours.destroy', $item) }}" class="inline"
                                      onsubmit="return confirm('Supprimer ce cours ? Les étudiants n\'y auront plus accès.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            aria-label="Supprimer « {{ $item->titre }} »" title="Supprimer"
                                            class="grid h-8 w-8 place-items-center rounded-lg text-gray-400 transition hover:bg-red-50 hover:text-red-600">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25v6m4-6v6M3.375 7.5h17.25M9.75 7.5V5.25c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V7.5"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->estSuperAdmin() ? 7 : 6 }}">
                            <div class="px-6 py-14 text-center">
                                <span class="text-5xl">📚</span>
                                <p class="mt-4 font-bold text-itf-dark">Aucun cours pour le moment</p>
                                <p class="mx-auto mt-1 max-w-sm text-sm text-gray-500">
                                    Ajoutez vos premiers supports PDF : ils apparaîtront
                                    immédiatement dans l'espace des étudiants.
                                </p>
                                <a href="{{ route('admin.cours.create') }}"
                                   class="mt-5 inline-flex items-center gap-2 rounded-xl bg-itf-blue px-5 py-2.5 text-sm font-bold text-itf-white transition hover:opacity-90">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                                    </svg>
                                    Créer le premier cours
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8">{{ $cours->links() }}</div>

</x-admin-layout>