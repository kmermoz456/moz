@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         class="fixed top-4 right-4 z-50 max-w-sm bg-green-50 border border-green-300 text-green-800 rounded-lg shadow-lg p-4">
        <div class="flex items-start justify-between gap-3">
            <p class="text-sm font-medium">{{ session('success') }}</p>
            <button @click="show = false" class="text-green-600 hover:text-green-800">&times;</button>
        </div>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         class="fixed top-4 right-4 z-50 max-w-sm bg-red-50 border border-red-300 text-red-800 rounded-lg shadow-lg p-4">
        <div class="flex items-start justify-between gap-3">
            <p class="text-sm font-medium">{{ session('error') }}</p>
            <button @click="show = false" class="text-red-600 hover:text-red-800">&times;</button>
        </div>
    </div>
@endif
