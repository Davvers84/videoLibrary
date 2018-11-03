@extends('layouts.default')
@section('content')
    <form action="/video/save" method="post">
        <div class="row video-row">
            <div class="col-md-4">
                <h1>Search for Videos</h1>
            </div>
            <div class="col-md-8">
                <input type="submit" id="submit" name="submit" class="btn btn-primary float-right" value="Save to My Vibrary"/>
            </div>
            <hr/>
            @include('includes.alerts')
        </div>
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
                <div class="form-check">
                    <input type="checkbox" id="saveVideo" name="saveVideo[]" class="form-check-input" value="{{ json_encode($video) }}"/>
                    <label class="form-check-label text-primary" for="saveVideo">Select this Video</label>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row">
            <div class="col-md-12">
                <input type="submit" id="submit" name="submit" class="btn btn-primary float-right" value="Save to My Vibrary"/>
            </div>
        </div>
    </form>
@stop