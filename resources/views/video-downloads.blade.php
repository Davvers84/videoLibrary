<h1>My Downloads</h1>
<hr/>
@if($successMessage)
<p>{{ $successMessage }}</p>
@endif
@if($errorMessage)
    <p>{{ $errorMessage }}</p>
@endif

@if(count($videos) > 0)

    @foreach($videos as $video)
        <div style="display: block; width: 100%; clear: both;">
            <div style="float: left; display: block; width: 20%;">
                <iframe width="240" src="https://www.youtube.com/embed/{{ $video['videoId'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div style="float: left; display: block; width: 80%;">
                <h2>{{ $video['title'] }}</h2>
                <p>{{ $video['description'] }}</p>
                <p>Channel: <strong>{{ $video['channelTitle'] }}</strong></p>
            </div>
        </div>
    @endforeach

@else

    <p>Sorry you have no Videos saved.</p>

@endif