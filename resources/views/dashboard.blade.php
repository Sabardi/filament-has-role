@if (Auth::user()->hasRole('admin'))
    <script>
        window.location.href = "{{ route('filament.admin.pages.dashboard') }}";
    </script>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Portal Job') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="container px-5 py-24 mx-auto">
                    <div class="flex flex-wrap -mx-4 -mb-10 -mt-4">
                        @forelse ($jobs as $job)
                            <div class="p-4 md:w-1/3 sm:w-1/2 w-full mb-6">
                                <div class="rounded-lg h-64 overflow-hidden">
                                    <img alt="content" class="object-cover object-center h-full w-full"
                                        src="{{ asset('images/thumbnails') }}/{{ $job->thumbnail }}">
                                </div>
                                <h2 class="text-xl font-medium title-font text-gray-900 mt-5">{{ $job->company }}</h2>
                                <p class="text-base leading-relaxed mt-2">{{ $job->title }}</p>
                                <a class="text-indigo-500 inline-flex items-center mt-3">Learn More
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2"
                                        viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        @empty
                            <p>no data</p>
                        @endforelse

                    </div>
                </div>
            </section>
        </div>   
    </x-app-layout>
@endif
