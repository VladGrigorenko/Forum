@extends('layouts.app')

@section('content')
    <div class="row p-4 mt-5">
        <div class="col-sm-12 my-1 p-3 bg-white rounded box-shadow">
            <div class="row">

                <img class="rounded-circle mb-2 ml-4" src="/images/{{ $user->avatar }}" width="150"
                     height="150">

                <div class="col-6 ml-5">
                    <div class="row mb-2">
                        <h2 class="col-2"> {{$user->name}}  </h2>
                    </div>
                </div>
                <p class="mr-1">Change password</p>
                <form class="col-3 bg-light rounded box-shadow p-1" method="POST"
                      action="{{route('change_password' , auth()->user())}}">
                    {{ csrf_field() }}
                    <input id="old_password" type="password"
                           class="  form-control {{ $errors->has('old_password') ? ' is-invalid' : '' }} mb-1"
                           name="old_password" placeholder="Old password" required autofocus>

                    @if ($errors->has('old_password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('old_password') }}</strong>
                        </span>
                    @endif

                    <input id="new_password" type="password"
                           class="form-control {{ $errors->has('new_password') ? ' is-invalid' : '' }} mb-1"
                           name="new_password" placeholder="New password" required autofocus>

                    @if ($errors->has('new_password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('new_password') }}</strong>
                        </span>
                    @endif

                    <input id="repeat_password" type="password"
                           class="form-control {{ $errors->has('repeat_password') ? ' is-invalid' : '' }} mb-1"
                           name="repeat_password" placeholder="Repeat password" required autofocus>

                    @if ($errors->has('repeat_password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('repeat_password') }}</strong>
                        </span>
                    @endif

                    <button type="submit" class="btn btn-outline-secondary mt-1">Change</button>
                    @if($errors->has('message'))
                        <strong class="text-success">{{$errors->first('message')}}</strong>
                    @endif
                </form>
            </div>


            <div class="input-group mb-3">
                <form action="{{route('profile_avatar', auth()->user()) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="input-group col-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile04" name="avatar">
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Change</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12 bg-white">
            <h3 class="border-bottom border-gray p-sm-1 ml-3 mr-3">Your threads</h3>
            <div class=" p-3">
                @foreach(auth()->user()->thread as $thread)

                    <div class="col-12" style="word-wrap: break-word">
                        <strong>
                            <u>
                                <a href="/thread/{{$thread->id}}" class="text-dark">{{$thread->title }}</a>
                            </u>
                        </strong>
                        <div class="border-gray small">
                            <?php echo nl2br(htmlspecialchars($thread->body)) ?>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection