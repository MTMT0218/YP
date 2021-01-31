

@extends('layouts.header')
@section('js')
<script>
    (function() {
      window.addEventListener("load", function () {
        $('[data-toggle="popover"]').popover();
      });
    })();
    </script>
    <script type="text/javascript" src="js/jquery.matchHeight.js"></script>

<script type="text/javascript">
          $(function(){
            $('.js-matchHeigtht').matchHeight();
          });
</script>
    <style>

    </style>

@endsection
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">{{ __('チャンネル一覧') }}</div>
                <div class="card-body">
                    @isset($youtube_accounts)
                    <div class="card mt-4">
                        <div class="card-columns " >
                            @foreach($youtube_accounts as $account)
                                <div class="card js-matchHeigtht d-inline-block " >
                                    <div class="card-header"> {{$account["title"]}}</div>
                                    <div class="card-body">
                                        <img src={{$account["thumbnails_url"]}} class="img-fluid"
                                        data-toggle="modal" data-target="#modal{{$account["account_id"]}}"
                                        ><div class="modal fade" id="modal{{$account["account_id"]}}" tabindex="-1"
                                        role="dialog" aria-labelledby="label1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="card-columns d-inline-block">
                                                        @foreach ($account["youtube_videos"] as $videos)
                                                        <div class="card " >
                                                            <form  name="{{$videos["video_id"]}}"  action="{{route('showvideo')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="title" value={{$videos["title"]}}>
                                                                <input type="hidden" name="video_id" value={{$videos["video_id"]}}>

                                                            </form>
                                                            <a  onclick="document.{{$videos["video_id"]}}.submit();">
                                                        <img class="card-img-top float-none" src={{$videos["thumbnails_url"]}} alt="Card image cap">
                                                            </a>
                                                        <div class="card-body">
                                                            <div class="card-text overflow-auto">
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

