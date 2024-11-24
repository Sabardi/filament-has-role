@extends('User.layouts.app')

@section('content')
    @push('style')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @endpush
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Portal Loker</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                {{-- <a href="{{ route('job.create') }}" class="btn btn-primary">Buat Loker</a> --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Buat Loker
                </button>

                <!-- Modal -->
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Buat Loker</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('job.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="company" class="form-label">Company</label>
                                        <input type="text" class="form-control" id="company" name="company" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Job Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="thumbnail" class="form-label">Thumbnail</label>
                                        <input type="file" class="form-control" id="thumbnail" name="thumbnail"
                                            accept="image/*" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <select class="form-select" id="kategori" name="kategori_id" required>
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            @forelse ($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                            @empty
                                                <p>Kategori belom tersedia</p>
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Kategori</th>
                                <th>thumbnail</th>
                                <th>description</th>
                                <th>location</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Company</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Kategori</th>
                                <th>thumbnail</th>
                                <th>description</th>
                                <th>location</th>
                                <th>aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($jobs as $job)
                                <tr>
                                    <td>{{ $job->company }}</td>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->email }}</td>
                                    <td>{{ $job->kategoris->name }}</td>
                                    <td>
                                        <img src="{{ asset('images/thumbnails') }}/{{ $job->thumbnail }}" alt=""
                                            style="width: 50%;">
                                    </td>

                                    <td>
                                        {{ $job->description }}</td>
                                    <td>{{ $job->location }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop{{ $job->id }}">
                                            Edit
                                        </button>

                                        <form action="{{ route('job.destroy', $job->id) }}" method="post"
                                            style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>

                                </tr>

                                <div class="modal fade" id="staticBackdrop{{ $job->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Buat Loker</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('job.update', $job->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="mb-3">
                                                        <label for="company" class="form-label">Company</label>
                                                        <input type="text" class="form-control" id="company"
                                                            name="company" value="{{ $job->company }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Job Title</label>
                                                        <input type="text" class="form-control" id="title"
                                                            name="title" value="{{ $job->title }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" value="{{ $job->email }}" required>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="thumbnail" class="form-label">Thumbnail</label>
                                                        <input type="file" class="form-control" id="thumbnail"
                                                            name="thumbnail" accept="image/*">
                                                        <br>
                                                        <!-- Hidden input to retain the old thumbnail name -->
                                                        <input type="hidden" name="old_thumbnail"
                                                            value="{{ $job->thumbnail }}">

                                                        <!-- Display the current thumbnail if it exists -->
                                                        @if ($job->thumbnail)
                                                            <img src="{{ asset('images/thumbnails/' . $job->thumbnail) }}"
                                                                alt="Current Thumbnail" style="width: 50%;">
                                                        @else
                                                            <p>No thumbnail available.</p>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Description</label>
                                                        <textarea class="form-control" id="description" name="description" rows="3" required>
                                                            {{ $job->title }}
                                                        </textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="location" class="form-label">Location</label>
                                                        <input type="text" class="form-control" id="location"
                                                            name="location" value="{{ $job->title }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="kategori" class="form-label">Kategori</label>
                                                        <select class="form-select" id="kategori" name="kategori_id"
                                                            required>
                                                            <option value="{{ $job->kategori_id }}">
                                                                {{ $job->kategoris->name }}
                                                            </option>
                                                            @forelse ($kategoris as $kategori)
                                                                <option value="{{ $kategori->id }}">{{ $kategori->name }}
                                                                </option>
                                                            @empty
                                                                <p>Kategori belom tersedia</p>
                                                            @endforelse
                                                        </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No data available</td>
                                    <!-- Centered message when no data -->
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    @endpush
@endsection
