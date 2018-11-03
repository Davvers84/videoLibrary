


@extends('layouts.default')
@section('content')
        <div class="row video-row">
            <div class="col-md-4">
                <h1>My Vibrary</h1>
            </div>
            @include('includes.alerts')
        </div>

        @if(count($videos) > 0)

            @foreach($videos as $video)

                @php
                    $maxStringLength = 87;
                    if(strlen($video['title']) > $maxStringLength) {
                        $newTitle = rtrim(substr($video['title'], 0, $maxStringLength)) . '...';
                        $video['title'] = $newTitle;
                    }
                @endphp

                <div class="row video-row">
                    <div div class="col-md-3">
                        <iframe width="240" src="https://www.youtube.com/embed/{{ $video['videoId'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-9">
                        <h2 class="video-title">{{ $video['title'] }}</h2>
                        <p>{{ $video['description'] }}</p>
                        <p>Channel: <strong>{{ $video['channelTitle'] }}</strong></p>
                        <p><strong>@php echo $video->created_at->diffForHumans(); @endphp</strong></p>
                        <a href="/video/destroy/{{ $video['id'] }}"><button type="button" class="btn btn-primary">Remove</button></a>
                    </div>
                </div>
            @endforeach

        @else

            <p>Sorry you have no Videos saved.</p>

        @endif




@stop