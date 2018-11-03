@if($successMessage || $errorMessage)
    <div class="row space-above-and-below">
        <div class="col-md-12">

        @if($successMessage)
            <div class="alert alert-success" role="alert">
                {{ $successMessage }}
            </div>
        @endif
        @if($errorMessage)
            <div class="alert alert-danger" role="alert">
                {{ $errorMessage }}
            </div>
        @endif

        </div>
    </div>
@endif