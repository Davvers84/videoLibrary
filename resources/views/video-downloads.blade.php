My Downloads
<hr/>
@if($successMessage)
<p>{{ $successMessage }}</p>
@endif
@if($errorMessage)
    <p>{{ $errorMessage }}</p>
@endif

@foreach($videos as $video)
    <p>Video Id: {{$video->id}}</p>
    <p>Video Name: {{$video->name}}</p>
    <p>Video Url: {{$video->url}}</p>
    <hr/>
@endforeach