<div class="my-3 p-1 bg-white rounded box-shadow">
    <div class="row">
        <div class="col-auto">
            <a href="#">
                <img class="rounded-circle" src="{{ asset('images/'.$thread->user->avatar) }}" width="70" height="70">
            </a>
        </div>
        <div class="col-11">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="mr-3 text-truncate">
                    <a href="/thread/{{$thread->id}}"><h5
                                class="border-bottom border-gray pb-2 mb-0">{{ $thread->title }}</h5>
                    </a>
                </div>
                </p>
                @if(Auth::check())
                    @if( count(auth()->user()->subscriber()->where('thread_id', '=', $thread->id)->get()) == 0)
                        <a href="/subscribe/{{$thread->id}}">Sub</a>
                    @else
                        <a href="/unsubscribe/{{$thread->id}}">Unsub</a>
                    @endif
                @endif
            </div>
            <div class="media-body pb-1 small lh-150">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">
                        <u><a href="#" class="text-dark">{{ $thread->user->name }}</a></u>
                        at
                        {{ $thread->created_at->toTimeString().' '.$thread->created_at->toFormattedDateString() }}
                    </strong>
                </div>
                <br/>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12 ml-2 text-truncate">
            <?php echo nl2br(htmlspecialchars($thread->body)) ?>
        </div>
    </div>
    <div class="dropdown-divider"></div>
</div>