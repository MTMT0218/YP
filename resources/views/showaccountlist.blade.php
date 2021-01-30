

@extends('layouts.header')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">{{ __('登録アカウント') }}</div>
                <div class="card-body">
                    @isset($youtube_accounts)
                    <div class="card mt-4">
                        <div class="card-columns ">
                            @foreach($youtube_accounts as $account)
                                <div class="card" >
                                    <div class="card-header text-nowrap overflow-auto"> {{$account["title"]}}</div>
                                    <div class="card-body">
                                        <img src={{$account["thumbnails_url"]}} class="img-fluid">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
