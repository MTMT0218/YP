

@extends('layouts.header')
@section('js')
@endsection
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">{{ __('動画表示') }}</div>
                <div class="card-body">
                <div class="card embed-responsive embed-responsive-16by9" >
                    <iframe class="embed-responsive-item "
                    src="https://www.youtube.com/embed/{{$video_id}}?playsinline=0
                    frameborder="0" allow="accelerometer" ;
                    autoplay;
                    clipboard-write; encrypted-media; gyroscope;
                    picture-in-picture"
                    allowfullscreen>
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
