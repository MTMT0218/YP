

@extends('layouts.header')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card ">
                <div class="card-header ">{{ __('YOUTUBE検索') }}</div>
                <div class="card-body">
                    <form action="{{route('searchYoutube/search')}}" method="get">
                        @csrf
                        <input type="search" id="keyword"
                        placeholder="アカウント名"
                        name="keyword"required>
                        <input type="submit" value="検索">
                    </form>
                </div>
            </div>
            @isset($title)
            <div class="card mt-4">
            <div class="card-columns ">
                @for($i=0;$i<$sizeChannel;$i++)
                <div class="card" style="height:15rem ;width:10rem; ">
                    <div class="card-header text-nowrap overflow-auto"> {{$title[$i]}}</div>
                    <div class="card-body">
                        <img src={{$thumbnails[$i]}} class="img-fluid">
                    </div>
                 </div>
                 @endfor
            </div>
        </div>
            @endisset
        </div>
    </div>
</div>

@endsection
