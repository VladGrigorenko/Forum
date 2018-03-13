@extends('layouts.app')

@section('content')
    <div class="container-fluid p-5">
        <div class="row p-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">New thread</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('create') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Name thread</label>
                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                           name="title" value="{{ old('title') }}" required autofocus>
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="body" class="col-md-4 col-form-label text-md-right">Body</label>

                                <div class="col-md-6" >
                                    <textarea id="body"
                                              class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"
                                              rows="3" name="body" value="{{ old('body') }}" required
                                    ></textarea>


                                    @if ($errors->has('body'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-secondary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection