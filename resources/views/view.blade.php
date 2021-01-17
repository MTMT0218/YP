@extends('layouts.header')
@section('main')
<div class="container h-100">
    <div class="row h-75">
        <div class="col align-self-center h-50">
            <div class="card text-center h-100">
                <div class="card-body">
                    <iframe class="youtube h-100 w-100"
                    src="https://www.youtube.com/embed/{{$VideoId}}?playsinline=0
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
    <div class="row h-25">
        <div class="col align-self-auto">
        <a class="btn btn-primary" href="{{route('home')}}">戻る</a>
    </div>
</div>

</div>
@endsection
