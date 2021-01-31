@extends('layouts.app')
@section('title','Find Teams');
@section('nav-title','Find Teams')
@include('layouts.SideNavigation')
@section('content')
@section('content')
    <section class="New-Member mt-5">
        <div class="row mt-3 justify-content-center">
            <div class="col-sm-12 col-md-12">
                <form action="/teams/find" method="post">
                    @csrf
                    <div class="form-group row justify-content-lg-center">
                        <label for="name"
                               class="col-lg-3 col-xl-2 col-form-label text-lg-right">Team Name</label>
                        <div class="col-lg-4 mt-2 mt-lg-0">
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{ old('name') }}" required placeholder="Java dr.ahamd" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group mt-3 mt-lg-0">
                            <div class="col-lg-2 ">
                                <button type="submit" class="btn Edit-Btn">
                                    Find
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @if(isset($teams))
                @foreach($teams as $team)
                    <div class="col-md-5 ml-5 mt-5">
                        <div class="row align-content-center">
                            <div class="col-1 mr-3 ml-sm-0 mt-2">
                                <div class="Member-img d-inline-block"
                                     style="background-image: url('{{asset("images/book.png")}}')"></div>
                            </div>
                            <div class="col-6 col-xl-3" style="margin-top: 13px">
                                <h5 class="pt-2">{{$team->name}}</h5>
                            </div>
                            <div class="col-3">
                                <form action="/teams/join/{{$team->id}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" autocomplete="off" name="member"
                                               id="member" style="display: none"
                                               aria-describedby="emailHelp">
                                    </div>
                                        <div class="form-group ">
                                            <button type="submit" class="btn Edit-Btn">
                                                Join
                                            </button>
                                        </div>

                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </section>
@stop
