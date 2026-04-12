<x-backend-layout title="Our Story Management">
    @push('css')
        <link rel="stylesheet" href="{{asset('backend/libs/summernote/summernote-lite.min.css')}}" />
    @endpush

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Our Story Management</h1>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('story.update', $story->id) }}" method="POST" enctype="multipart/form-data"
                        id="storyForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $story->title }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea class="form-control summernote" name="content"
                                        rows="8">{!! $story ? $story->content : '' !!}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Story Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    <small class="text-muted">Recommended Size: 400x650px</small>
                                    @if($story->image)
                                        <div class="mt-2">
                                            <img src="{{ asset($story->image) }}" alt="Current Story Image"
                                                class="img-thumbnail" width="150">
                                            <p class="text-muted mt-1">Current Image</p>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remove_image"
                                                    name="remove_image" value="1">
                                                <label class="form-check-label" for="remove_image">
                                                    Remove current image
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="1" {{ $story->status == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $story->status == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Story</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{asset('backend/libs/summernote/summernote-lite.min.js')}}"></script>

        <script>
            $('.summernote').summernote({
                height: 300,
            });

            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('select.searchable').forEach(select => {
                    new Choices(select, {
                        searchEnabled: true,
                        shouldSort: false,
                        removeItemButton: true, // allow removing selected tags
                        placeholder: true,
                        placeholderValue: select.dataset.placeholder || 'Select an option'
                    });
                });
            });
        </script>
    @endpush

</x-backend-layout>