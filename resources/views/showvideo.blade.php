

@extends('layouts.header')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">{{ __('動画表示') }}</div>
                <div class="card-body">
                <div class="card embed-responsive embed-responsive-16by9" >
                    <iframe class="video embed-responsive-item " id="player"
                    src="https://www.youtube.com/embed/{{$video_id}}?enablejsapi=1">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
//api用のJSを読み込む
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

//APIを実行
  function onYouTubeIframeAPIReady() {
    player = new YT.Player("player",{
        events: {
            'onReady': onPlayerReady,
            'onStateChange':onPlayerStateChange
        }
    });
  }

      var Ready = false;
      var status="-1";
      var currentTime="";
      var video_id="{{$video_id}}";
      function onPlayerReady(event) {
          Ready = true;
      }

      function onPlayerStateChange(event){
        status = event.data;
        currentTime=player.getCurrentTime();
        console.log(video_id);
        $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/getwatchinginformation",
            method: 'POST',
            timeout: 10000,
            data: {'video_id':video_id,
                    'watched_flag':status,
                    'watched_at':currentTime },
            success: function(){
                console.log(currentTime);
              },
            error: function(){
                console.log("送信失敗");
                        }
        })
    }
</script>
@endsection
