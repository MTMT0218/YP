

@extends('layouts.header')
@section('main')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-4 ">
                <div class="card-header ">{{ __('チャンネル一覧') }}</div>
                <div class="card-body">
                    @isset($youtube_accounts)
                        <div  class="row">
                            @foreach($youtube_accounts as $account)
                                <div class="card col-6 col-md-3" >
                                    <div class="card-title badge  badge-primary"><h5>{{$account["non_watched"]}}</h5></div>
                                    <div class="card-body">
                                        <img src={{$account["thumbnails_url"]}} class="card-img-top img-thumbnail " data-toggle="modal" data-target="#modal{{$account["account_id"]}}">
                                        <div class="card-text text-nowrap overflow-auto">
                                            {{$account["title"]}}
                                        </div>

                                        <!--ダイアログ-->
                                        <div class="modal fade" id="modal{{$account["account_id"]}}" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                        @foreach ($account["youtube_videos"] as $videos)
                                                            <div class="card card col-6 col-md-3 text-white @switch($videos['watched_videos']['watched_flag'])@case(0)bg-info @break @case(1) bg-dark @break @case(2) bg-warning @break @endswitch" >
                                                                <form  name="form_{{$loop->index}}{{$loop->parent->index}}"  action="{{route('showvideo')}}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="title" value={{$videos["title"]}}>
                                                                    <input type="hidden" name="video_id" value={{$videos["video_id"]}}>
                                                                </form>
                                                                <a onclick="document.form_{{$loop->index}}{{$loop->parent->index}}.submit();">
                                                                    <img class="card-img-top float-none" src={{$videos["thumbnails_url"]}}>
                                                                </a>
                                                                <div class="card-body">
                                                                    <div class="card-text  text-nowrap overflow-hidden">
                                                                        {{$videos["title"]}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--ダイアログ-->
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

