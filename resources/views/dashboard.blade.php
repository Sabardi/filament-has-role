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

 
        {{-- 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-semibold mb-4">Job Details</h2>
                    @forelse ( $jobs as $job )
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="font-bold">Company</h3>
                            <p>{{ $job->company }}</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="font-bold">Title</h3>
                            <p>{{ $job->title }}</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="font-bold">Email</h3>
                            <p>{{ $job->email }}</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="font-bold">Location</h3>
                            <p>{{ $job->location }}</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="font-bold">Description</h3>
                            <p>{{ $job->description }}</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="font-bold">Category</h3>
                            <p>{{ $job->kategoris->name }}</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="font-bold">Posted On</h3>
                            <p>{{ $job->created_at->format('Y-m-d') }}</p> <!-- Format the date as needed -->
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="font-bold">Thumbnail</h3>
                            @if ($job->thumbnail)
                                <img src="{{ asset('images/thumbnails/' . $job->thumbnail) }}" alt="Job Thumbnail"
                                    class="w-full h-auto rounded">
                            @else
                                <p>No thumbnail available.</p>
                            @endif
                        </div>
                    </div>
                    @empty
                        <p>date belom ada</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div> --}}
    </x-app-layout>
@endif
