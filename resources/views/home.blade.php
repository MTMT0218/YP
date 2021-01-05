@extends('layouts.header')
@section('main')
<div class="container h-100">
    <div class="row h-100">
        <div class="col-12 align-self-center ">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">YOUTUBBE埋め込み表示</h5>
                    <p class="card-text">
                        <form method="get" action="{{ route('view') }}">
                            <div class="form-group">
                                <div class="col-12">
                                    <label class="mt-4">URL：</label>
                                    <input type="text" class="form-control mb-4" name="url" required>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary">
                        </form>
                     </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

