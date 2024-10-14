<div class="col-lg-4">
    <div class="card mb-4">
      <div class="card-body text-center">
        @if(Auth::user()->image)
        <img src="{{ asset('frontend/images/profile/'.Auth::user()->image) }}" alt="avatar"
          class="rounded-circle img-fluid" style="width: 100px;">
          @else
          <img src="{{ asset('frontend/default-user.png') }}" alt="avatar"
          class="rounded-circle img-fluid" style="width: 100px;">
          @endif
          <ul class="list-group mt-4 mb-5">
            <li class="list-group-item">
              <a class="dropdown-item mb-1 font-weight-bolder" href="{{ route('user.dashboard') }}">Dashboard</a>
            </li>
            <li class="list-group-item">
              <a class="dropdown-item mb-1 font-weight-bolder" href="#" style="font-size:16px">Picup Request</a>
            </li>
            <li class="list-group-item">
              <a class="dropdown-item mb-1 font-weight-bolder" href="{{ route('user.setting') }}" style="font-size:16px">Setting</a>
            </li>
            
          </ul>
        <div class="d-flex justify-content-center mb-2">
          <a class="btn btn-primary" href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{-- <img src="{{ asset('frontend/images/icons/photo.svg') }}" alt="icon"> --}}
              Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </div>
      </div>
    </div>
  </div>