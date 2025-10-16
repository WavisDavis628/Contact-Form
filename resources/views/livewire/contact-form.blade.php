<section class="space-y-6">
    @if (session('status'))
        <div class="rounded-lg border border-emerald-700/50 bg-emerald-900/30 p-4 text-emerald-200 shadow-sm">
            {{ session('status') }}
        </div>
    @endif

    <header class="space-y-2">
        <h1 class="text-3xl font-semibold tracking-tight text-slate-100">Contact Us</h1>
        <p class="text-sm text-slate-400">Fields marked * are required.</p>
    </header>

    <div class="rounded-2xl border border-white/10 bg-slate-800/50 shadow-xl backdrop-blur-sm">
        <form wire:submit.prevent="submit" class="p-6 md:p-8 space-y-5">
            {{-- Honeypot (hidden) --}}
            <div class="hidden" aria-hidden="true">
                <label for="website">Website</label>
                <input id="website" type="text" wire:model.lazy="website" autocomplete="off" tabindex="-1" />
            </div>

            {{-- Full name --}}
            <div>
                <label for="name" class="mb-1 block font-medium text-slate-300">Full name *</label>
                <input
                    id="name"
                    type="text"
                    wire:model.defer="name"
                    class="w-full rounded-lg border border-slate-700 bg-slate-900/60 text-slate-100 placeholder-slate-400
                           p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    maxlength="120"
                    required
                />
                @error('name') <p class="mt-1 text-sm text-rose-300">{{ $message }}</p> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="mb-1 block font-medium text-slate-300">Email *</label>
                <input
                    id="email"
                    type="email"
                    wire:model.defer="email"
                    class="w-full rounded-lg border border-slate-700 bg-slate-900/60 text-slate-100 placeholder-slate-400
                           p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    maxlength="190"
                    required
                />
                @error('email') <p class="mt-1 text-sm text-rose-300">{{ $message }}</p> @enderror
            </div>

            {{-- Subject --}}
            <div>
                <label for="subject" class="mb-1 block font-medium text-slate-300">Subject *</label>
                <input
                    id="subject"
                    type="text"
                    wire:model.defer="subject"
                    class="w-full rounded-lg border border-slate-700 bg-slate-900/60 text-slate-100 placeholder-slate-400
                           p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    maxlength="150"
                    required
                />
                @error('subject') <p class="mt-1 text-sm text-rose-300">{{ $message }}</p> @enderror
            </div>

            {{-- Message --}}
            <div>
                <label for="message" class="mb-1 block font-medium text-slate-300">Message *</label>
                <textarea
                    id="message"
                    rows="6"
                    wire:model.defer="message"
                    class="w-full rounded-lg border border-slate-700 bg-slate-900/60 text-slate-100 placeholder-slate-400
                           p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    maxlength="2000"
                    required
                ></textarea>
                @error('message') <p class="mt-1 text-sm text-rose-300">{{ $message }}</p> @enderror
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button
                    type="submit"
                    class="inline-flex items-center rounded-lg bg-indigo-500 px-5 py-2.5 font-medium text-white
                           hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 shadow-md"
                >
                    Send message
                </button>
            </div>
        </form>
    </div>
</section>
