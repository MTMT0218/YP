

@extends('layouts.header')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card ">
                <div class="card-header ">{{ __('チャンネル登録') }}</div>
                <div class="card-body">
                    <form action="{{route('registedAccount/search')}}" method="get">
                        <input type="text" name="url" id="url"
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
                        <img src={{$thumbnailsUrl}} class="img-fluid">
                    </div>
                </div>
            <div class="align-self-auto m-4">
                <form method="post" action="{{route('registedAccount/regist')}}">
                @csrf
                <input type="hidden" name="title" value="{{$title}}">
                <input type="hidden" name="thumbnailsUrl" value="{{$thumbnailsUrl}}">
                <input type="hidden" name="accountId" value="{{$channelId}}">
                <input type="hidden" name="playlist" value="{{$playlist}}">
                <input type="submit" class="btn btn-primary"onclick="history.back()" value="戻る"></input>
                <input type="submit" class="btn btn-primary float-right" value="登録"></input>
            </form>
            </div>
            @endisset

        </div>
    </div>
</div>

@endsection
