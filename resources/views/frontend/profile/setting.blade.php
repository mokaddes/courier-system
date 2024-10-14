
@extends('frontend.layouts.app')

@section('title')
    {{ __('Profile') }}
@endsection

@section('content')
<section style="background-color: #eee;">
    <div class="container py-5">
      
      <div class="row">
        @include('frontend.layouts.profile')
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
                <h5 class="text-center">Update Your Profile</h4>
             <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="form-group">
                  <label for="">Profile Image</label>
                  <input type="file" name="image" class="form-control">  
              </div>
              <div class="row">
                 <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" autocomplete="off" placeholder="Please Enter Your Name.." required>
                    </div>
                 </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" autocomplete="off" placeholder="Please Enter Your Email.." required>
                    </div>
                 </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}" autocomplete="off" placeholder="Please Enter Your Phone.." required>
                    </div>
                 </div> 
                 <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea name="address" id="address" cols="30" rows="2" class="form-control">{{ Auth::user()->address }}</textarea>
                    </div>
                 </div>    
              </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form> 
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-body">
                <h5 class="text-center">Change Your Password</h4>
            <form action="{{ route('user.password.change') }}" method="post">
              <div class="row">
                    @csrf
                 <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Old Password</label>
                        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" autocomplete="off" placeholder="Please Enter Your Old Password..">
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                 </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">New Passowrd</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" placeholder="Please Enter Your New Password..">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                 </div>
                 <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="off" placeholder="Please Enter Your Confirm Password..">
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                 </div>    
              </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection