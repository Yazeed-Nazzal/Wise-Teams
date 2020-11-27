@extends('layouts.app')
@section('title','Teams');
@section('nav-title','Add New Member')
@include('layouts.SideNavigation')
@section('content')
   <section class="New-Member mt-5">
       <div class="row mt-3 justify-content-center">
           <div class="col-sm-12 col-md-12">
               <form action="" method="post">
                   @csrf
                   <div class="form-group row justify-content-lg-center">
                       <label for="username"
                              class="col-lg-3 col-xl-2 col-form-label text-lg-right">Member Ussr Name</label>
                       <div class="col-lg-4 mt-2 mt-lg-0">
                           <input id="username" type="text"
                                  class="form-control @error('username') is-invalid @enderror" name="username"
                                  value="{{ old('username') }}" required placeholder="3170601031" autofocus>

                           @error('username')
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
           <div class="col-md-5 ml-5 mt-5">
               <div class="row align-content-center">
                   <div class="col-1 mr-3 ml-sm-0 mt-2">
                       <div class="Member-img d-inline-block"></div>
                   </div>
                   <div class="col-6 col-xl-3" style="margin-top: 13px">
                        <h5 class="pt-2">yazeed Nazal</h5>
                   </div>
                   <div class="col-3">
                       <form action="">
                           <div class="form-group">
                               <input type="text" class="form-control" autocomplete="off" name="member" id="member" style="display: none"
                                      aria-describedby="emailHelp">
                           </div>
                           <div class="form-group ">
                                   <button type="submit" class="btn Edit-Btn">
                                       Add
                                   </button>
                           </div>

                       </form>
                   </div>

               </div>
           </div>
       </div>

   </section>
@stop
