<section class="space-y-6">
    <header class="flex items-center justify-between gap-4">
        <h1 class="text-2xl font-semibold text-slate-100">Submissions</h1>
        <a href="{{ route('contact') }}"
           class="rounded-lg border border-white/10 bg-slate-800/50 px-3 py-1.5 text-slate-200 hover:bg-slate-700">
            New message
        </a>
    </header>

    <div class="rounded-2xl border border-white/10 bg-slate-800/50 p-4 backdrop-blur-sm">
        <div class="mb-4 flex items-center gap-3">
            <input
                type="search"
                wire:model.live.debounce.300ms="q"
                placeholder="Search by email or subject…"
                class="w-full rounded-lg border border-slate-700 bg-slate-900/60 p-2.5 text-slate-100 placeholder-slate-400
                    focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            />

            <select wire:model="perPage"
                    class="rounded-lg border border-slate-700 bg-slate-900/60 p-2.5 text-slate-100 focus:outline-none">
                <option value="10">10</option>
                <option value="25">25</option>
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm text-slate-300">
                <thead class="border-b border-white/10 text-slate-400">
                    <tr>
                        <th class="px-3 py-2">Name</th>
                        <th class="px-3 py-2">Email</th>
                        <th class="px-3 py-2">Subject</th>
                        <th class="px-3 py-2">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($submissions as $s)
                        <tr wire:key="sub-{{ $s->id }}" class="border-b border-white/5">
                            <td class="px-3 py-2">{{ $s->name }}</td>
                            <td class="px-3 py-2">{{ $s->email }}</td>
                            <td class="px-3 py-2 truncate max-w-[24ch]">{{ $s->subject }}</td>
                            <td class="px-3 py-2">{{ $s->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-6 text-center text-slate-400">
                                No submissions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $submissions->onEachSide(1)->links() }}
        </div>
    </div>
</section>
