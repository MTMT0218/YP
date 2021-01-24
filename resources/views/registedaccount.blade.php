

@extends('layouts.header')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card ">
                <div class="card-header ">{{ __('YOUTUBE検索') }}</div>
                <div class="card-body">
                    <form action="{{route('registedAccount/search')}}" method="get">
                        @csrf
                        <input type="text" name="url"
                        placeholder="アカウントURL"
                        name="keyword"required>
                        <input type="submit" value="検索">
                    </form>
                </div>
            </div>
            @isset($title)
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">{{$title}}</h5>
                        <img src={{$thumbnailsURL}} class="img-fluid">
                    </div>
                </div>
            <div class="align-self-auto m-4">
                <form method="post" action="{{route('registedAccount/regist')}}">
                @csrf
                <input type="hidden" name="title" value="{{$title}}">
                <input type="hidden" name="thumbnailsURL" value="{{$thumbnailsURL}}">
                <input type="hidden" name="accountID" value="{{$accountID}}">
                <input type="hidden" name="playList" value="{{$playList}}">
                <input type="submit" class="btn btn-primary"onclick="history.back()" value="戻る"></input>
                <input type="submit" class="btn btn-primary float-right" value="登録"></input>
            </form>
            </div>
            @endisset

        </div>
    </div>
</div>

@endsection
