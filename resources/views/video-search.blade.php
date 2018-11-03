@extends('layouts.default')
@section('content')
    <form action="/video/save" method="post">
        <div class="row">
            <div class="col-md-4">
                <h1>Search for Videos</h1>
            </div>
            <div class="col-md-8">
                <button type="button" type="submit" id="submit" name="submit" class="btn btn-primary float-right">Save to My Vibrary</button>
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

        <div class="row">
            <div div class="col-md-3">
                <iframe width="240" src="https://www.youtube.com/embed/{{ $video['videoId'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-md-9">
                <h2>
                    <div class="custom-control form-control-lg custom-checkbox">
                        <input type="checkbox" id="saveVideo" name="saveVideo[]" class="custom-control-input" value="{{ json_encode($video) }}"/>
                        <label class="custom-control-label" for="saveVideo">{{ $video['title'] }}</label>
                    </div>
                </h2>
                <p>{{ $video['description'] }}</p>
                <p>Channel: <strong>{{ $video['channelTitle'] }}</strong></p>
            </div>
        </div>
        @endforeach
        <div class="row">
            <div class="col-md-12">
                <button type="button" type="submit" id="submit" name="submit" class="btn btn-primary float-right">Save to My Vibrary</button>
            </div>
        </div>
    </form>
@stop