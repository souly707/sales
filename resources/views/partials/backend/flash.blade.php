<div class="container">
    @if (session()->has('message'))
    <div class="alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert"
        id="alert-message">
        <strong>{{ session()->get('message') }}</strong>
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
    @endif
</div>
