@extends('layouts.app')

@section('content')
    <div class="row p-4 mt-5" id="app">
        <div class="col-sm-12">
            <div class="my-1 p-3 bg-white rounded box-shadow">
                <h2 class="border-bottom border-gray jpb-2 mb">
                    {{ $thread->title }}

                    @if(auth()->check() && auth()->user()->id == $thread->user_id)
                        {{csrf_field()}}
                        <a class="text-dark h5" href="" v-on:click="setEditThread($event)">
                            <i class="far fa-edit p-1"></i>
                        </a>
                        <a v-if="edit_thread" class="text-dark h5" href="" v-on:click="editThread(thread, $event)">
                            <i class="fas fa-check"></i>
                        </a>
                        <a href="{{route('home')}}" class="text-dark h5" v-on:click="deleteThread()">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    @endif

                </h2>

                {{--Thread info--}}
                <div class="row mt-2">
                    <div class="col-1 col-sm-1">
                        <a href="#">
                            <img class="rounded-circle" src="{{ asset('images/'.$thread->user->avatar) }}" width="80"
                                 height="80">
                        </a>
                    </div>
                    <div class="col-11 border-bottom col-sm-10">
                        <div class="mb-auto">
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

                    <div class="col-1 border-bottom col-sm-1">
                        @if(Auth::check())
                            @if( count(auth()->user()->subscriber()->where('thread_id', '=', $thread->id)->get()) == 0)
                                <a href="/subscribe/{{$thread->id}}">Sub</a>
                            @else
                                <a href="/unsubscribe/{{$thread->id}}">Unsub</a>
                            @endif
                        @endif
                    </div>

                </div>

                <div class="row ml-5 mt-2">
                    <div class="col-11 ml-5" style="word-wrap: break-word">
                        @if(auth()->check() && auth()->user()->id==$thread->user_id)
                            <textarea v-if="edit_thread" id="thread_body" name="thread_body" class="form-control" rows="3" v-model="thread.body" required>
                            </textarea>
                            <p v-else>
                                @{{ thread.body }}
                            </p>
                        @else
                            <?php echo nl2br(htmlspecialchars($thread->body)) ?>
                        @endif
                    </div>
                </div>

            </div>
        </div>


        {{--Comments--}}
        <div class="col-sm-12">
            <div class="bg-white rounded box-shadow">
                <h3 class="border-bottom border-gray p-sm-1 ml-3 mr-3">Comments</h3>
                <div class="col-12 p-3">

                    @if(Auth::check())
                        <div class="input-group mb-3">
                            <input id="body" type="text"
                                   class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"
                                   name="body" value="{{ old('body') }}" v-model="body" placeholder="Input comments..."
                                   required autofocus>
                            @if ($errors->has('body'))
                                asdasdasd
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                            <div class="input-group-append" required>
                                <button type="submit" class="btn btn-outline-secondary"
                                        v-on:click="createComment()">Send
                                </button>
                            </div>

                        </div>
                        <p v-for="item in comments">
                            <template :name="item">
                                <div class="media mr-5">
                                    @include('threads.comment')
                                </div>
                            </template>
                        </p>
                    @else
                        <p>Please login in to see the comments...</p>
                    @endif

                </div>


            </div>
        </div>


    </div>

@endsection

