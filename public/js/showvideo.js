
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
      var video_id="{{$video_id}}}";
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

     /* $(function() {
        function checkReady () {
            if(!Ready) {
            setTimeout(checkReady, 200);
        }}
        checkReady();
        $('#play').on('click', function() {
        $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/getwatchinginformation",
            type: 'POST',
            data: {'user_id':"test"},
            success: function(){
                console.log(currentTime);
              },
            error: function(){
                console.log("y");//通信が失敗した場合の処理
            }
        })

    });
    });*/

