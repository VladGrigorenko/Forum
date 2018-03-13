@extends('layouts.app')

@section('content')
    <div class="row p-4">
        <div class="col-sm-12">

                @if (count($threads) == 0)
                        <h1 class="border-bottom p-5" align="center">Threads do not exist :(</h1>
                @else
                <div class="my-5 p-3 bg-white rounded box-shadow">
                    <h3 class="border-bottom border-gray jpb-2 mb-0">Threads</h3>
                    @foreach($threads as $thread)
                        @include('threads.threads')
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
