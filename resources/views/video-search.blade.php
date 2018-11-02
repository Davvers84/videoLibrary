<h1>Search for Videos</h1>
@foreach($videos as $video)
    <iframe width="240" src="https://www.youtube.com/embed/{{ $video['videoId'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
@endforeach