<h1>Search for Videos</h1>
<hr/>
@include('includes.alerts')

<form action="/video/save" method="post">

    <input type="submit" id="submit" name="submit" value="Save to myVibrary"/>

@foreach($videos as $video)
    <div style="display: block; width: 100%; clear: both;">
        <div style="float: left; display: block; width: 20%;">
            <iframe width="240" src="https://www.youtube.com/embed/{{ $video['videoId'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div style="float: left; display: block; width: 80%;">
            <h2><input type="checkbox" id="saveVideo" name="saveVideo[]" value="{{ json_encode($video) }}"/> {{ $video['title'] }}</h2>
            <p>{{ $video['description'] }}</p>
            <p>Channel: <strong>{{ $video['channelTitle'] }}</strong></p>
        </div>
    </div>
@endforeach

    <input type="submit" id="submit" name="submit" value="Save to myVibrary"/>

</form>