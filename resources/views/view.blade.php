@extends('layouts.header')
@section('main')
<div class="container h-100">
    <div class="row h-100">
        <div class="col align-self-center">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">
                        <div class="col-12">
                            <iframe class="youtube"
                            src="https://www.youtube.com/embed/{{$VideoId}}?playsinline=1"
                            frameborder="0" allow="accelerometer;
                            autoplay;
                            clipboard-write; encrypted-media; gyroscope;
                            picture-in-picture"
                            allowfullscreen></iframe>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
