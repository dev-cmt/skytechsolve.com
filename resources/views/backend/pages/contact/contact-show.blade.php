<x-backend-layout title="Contact Details">
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Contact Details</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Contact List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Details</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-9">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Message from {{ $contact->name }}
                    </div>
                    <div>
                        <span class="badge bg-{{ $contact->is_seen ? 'info' : 'warning' }}">
                            {{ $contact->is_seen ? 'Read' : 'Unread' }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <p class="fw-semibold mb-2">Subject:</p>
                        <p class="text-muted">{{ $contact->subject }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="fw-semibold mb-2">Message:</p>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($contact->message)) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="fw-semibold mb-2">Email:</p>
                            <p class="text-muted"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="fw-semibold mb-2">Date Received:</p>
                            <p class="text-muted">{{ $contact->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('contact.index') }}" class="btn btn-secondary-light">Back to List</a>
                        @if(($contact->type ?? '') === 'sale')
                            <form action="{{ route('contact.create-sale', $contact->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success-light" onclick="return confirm('Create sale from this contact?')">Create Sale</button>
                            </form>
                        @endif
                        <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger-light" onclick="return confirm('Are you sure you want to delete this message?')">Delete Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Sender info</div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-2">
                            <span class="avatar avatar-md avatar-rounded bg-primary-transparent text-primary">
                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <p class="fw-semibold mb-0">{{ $contact->name }}</p>
                            <p class="fs-12 text-muted mb-0">{{ $contact->email }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-0">
                        <p class="fs-14 fw-semibold mb-1">Status</p>
                        <p class="fs-12 text-muted mb-0">This message has been marked as <strong>{{ $contact->is_seen ? 'read' : 'unread' }}</strong>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-backend-layout>
