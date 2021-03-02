

@extends('layouts.header')
@section('css')
<style type="text/css">
    .btn-outline-danger:hover{
        color:white;
        background-color:red;
    }
</style>
@endsection
@section('main')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-4 ">
                <div class="card-header d-flex ">
                    <div class="mr-auto">{{ __('チャンネル一覧') }}</div>
                    <a href="{{route('updatechannnel')}}"class="btn  btn-outline-primary ">{{_('更新')}}</a>
                    <a  id="delete" class="btn  btn-outline-primary " >{{_('削除')}}</a>
                </div>
                <!--削除フィールド-->
                <div class="alert alert-warning border-danger" id="delete_area">
                    <ul class="text-danger" id="delete_list">{{_("削除チャンネル一覧")}}</ul>
                    <form method="post" action="{{route('deletechannel')}}" id="delete_form" name="delete_form">
                        @csrf
                        <a role="button" class="btn  btn-danger" onclick="document.delete_form.submit();">{{_('上記チャンネルを削除する')}}</a>
                    </form>
                </div>
                <!--チャンネル一覧表示-->
                <div class="card-body">
                    @isset($youtube_accounts)
                        <div  class="row ">
                            @foreach($youtube_accounts as $account)
                                <div class="card col-6 col-md-3" >
                                    <div class="card-title">
                                        <div class=" badge  badge-primary" id="non_watched">
                                            <h5>{{$account["non_watched"]}}</h5>
                                        </div>
                                        <button class="btn btn-outline-danger  " id="delete_flag" data-id="{{$account["account_id"]}}" data-title="{{$account['title']}}">
                                            {{_("削除")}}
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <img src={{$account["thumbnails_url"]}} class="card-img-top img-thumbnail " data-toggle="modal" data-target="#modal{{$account["account_id"]}}">
                                        <div class="card-text text-nowrap overflow-auto">
                                            {{$account["title"]}}
                                        </div>

                                        <!--ダイアログ-->
                                        <div class="modal fade" id="modal{{$account["account_id"]}}" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
@section('js')
<script>

$(function()
{
    var count=0;
     $('#delete_area').hide();
    $("[id=delete_flag]").hide();
	$("#delete").on('click', function() {//削除ボタン機能
        count++;
        if(count%2==1){//初めのクリック
        $("[id=non_watched]").hide();
        $("[id=delete_flag]").show();
        $("#delete_area").show();
    }else{//再度クリックされたとき
        $('#delete_area').hide();
        $("[id=non_watched]").show();
        $("[id=delete_flag]").hide();
    }})
    ;
     $('[class=card-title]').on('click','[id=delete_flag]',function(){//チャンネルの削除ボタンをした場合の機能
        var title=$(this).data("title");
        var id=$(this).data("id");
        if($('#delete_area').find(`#${id}`).length==0){//すでに削除ボタンが押されチャンネルが削除チャンネル一覧に表示されているとき
        $('#delete_list').append(`<li id=${id}>${title}</li>`);
        $('#delete_form').append(`<input id=${id} name=id[] type="hidden" value=${id}></form>`);
        }else{$(`[id=${id}]`).remove();}
    })
} ) ;


</script>
@endsection
