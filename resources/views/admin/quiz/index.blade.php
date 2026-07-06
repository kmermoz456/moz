<x-admin-layout title="Quiz — Back-office ITF">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-itf-dark">Quiz</h1>
            <p class="text-sm text-itf-dark/50 mt-0.5">
                {{ $quiz->total() }} {{ Str::plural('quiz', $quiz->total() > 1 ? 2 : 1) }} au catalogue
            </p>
        </div>
        <a href="{{ route('admin.quiz.create') }}"
           class="inline-flex items-center gap-2 bg-itf-blue text-itf-white font-semibold px-5 py-2.5 rounded-xl
                  shadow-sm transition-all duration-200 hover:opacity-90 hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Nouveau quiz
        </a>
    </div>

    <div class="bg-itf-white rounded-2xl shadow-sm border border-itf-dark/10 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark/70 text-xs uppercase tracking-wider">
                <tr>
                    <th class="p-4 font-semibold">Titre</th>
                    <th class="p-4 font-semibold">Matière</th>
                    <th class="p-4 font-semibold">Niveau</th>
                    <th class="p-4 font-semibold">Questions</th>
                    @if (auth()->user()->estSuperAdmin())
                        <th class="p-4 font-semibold">Créé par</th>
                    @endif
                    <th class="p-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-itf-dark/5">
                @forelse ($quiz as $item)
                    <tr class="transition-colors duration-150 hover:bg-itf-blue/5">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="shrink-0 w-9 h-9 rounded-lg bg-itf-blue/10 text-itf-blue
                                            flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/>
                                    </svg>
                                </div>
                                <span class="font-semibold text-itf-dark">{{ $item->titre }}</span>
                            </div>
                        </td>
                        <td class="p-4 text-itf-dark/70">{{ $item->matiere }}</td>
                        <td class="p-4">
                            <span @class([
                                'inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold',
                                'bg-itf-blue/10 text-itf-blue' => $item->niveau === 'L1',
                                'bg-amber-100 text-amber-700' => $item->niveau === 'L2',
                            ])>
                                {{ $item->niveau }}
                            </span>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center gap-1 text-itf-dark/70">
                                <svg class="w-3.5 h-3.5 text-itf-dark/35" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
                                </svg>
                                {{ $item->questions_count }}
                            </span>
                        </td>
                        @if (auth()->user()->estSuperAdmin())
                            <td class="p-4 text-itf-dark/50">{{ $item->creePar->name ?? '—' }}</td>
                        @endif
                        <td class="p-4">
                            <div class="flex items-center justify-end gap-4">
                                <a href="{{ route('admin.quiz.edit', $item) }}"
                                   class="inline-flex items-center gap-1 text-itf-blue font-semibold hover:underline">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                                    </svg>
                                    Modifier
                                </a>
                                <form method="POST" action="{{ route('admin.quiz.destroy', $item) }}"
                                      onsubmit="return confirm('Supprimer ce quiz ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 text-red-500/80 font-semibold hover:text-red-600 hover:underline transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->estSuperAdmin() ? 6 : 5 }}" class="p-12 text-center">
                            <div class="flex flex-col items-center gap-2 text-itf-dark/40">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/>
                                </svg>
                                <p class="font-medium">Aucun quiz pour le moment</p>
                                <p class="text-xs">Cliquez sur « Nouveau quiz » pour en créer un.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $quiz->links() }}</div>
</x-admin-layout>