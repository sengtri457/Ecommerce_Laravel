@if (session('success'))
    <div class="container mt-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="icon-check"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="container mt-2">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="icon-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if (session('info'))
    <div class="container mt-2">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="icon-info-circle"></i> {{ session('info') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="container mt-2">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
