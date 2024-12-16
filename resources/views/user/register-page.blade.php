<x-layout>
    <div class="container py-md-5">
        <div class="row align-items-center">
          <div class="col-lg-7 py-3 py-md-5">
            <img src="register.png">
          </div>
          <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
            @if(auth()->user())
                @if ((auth()->user()->is_admin == 1) or (auth()->user()->is_super_admin == 1))
                    <form action="/welcome-page" method="GET" class="mb-0 pt-2 pt-md-0">
                        <div class="col-md-auto">
                            <button class="btn btn-primary btn-sm" style="margin-bottom: 50px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                                    <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z"/>
                                </svg>
                                Back
                            </button>
                        </div>
                    </form>
                @endif
            @endif
            <form action="/register" method="POST" id="registration-form">
              @csrf
              <div class="form-group">
                <label for="username-register" class="text-muted mb-1"><small>First Name</small></label>
                <input value="{{old('first_name')}}" name="first_name" id="username-register" class="form-control" type="text" placeholder="Enter first name" autocomplete="off" />
              </div>

              <div class="form-group">
                <label for="username-register" class="text-muted mb-1"><small>Last Name</small></label>
                <input value="{{old('last_name')}}" name="last_name" id="username-register" class="form-control" type="text" placeholder="Enter last name" autocomplete="off" />
              </div>

              <div class="form-group">
                <label for="username-register" class="text-muted mb-1"><small>Display Name</small></label>
                <input value="{{old('ddisplay_name')}}" name="display_name" id="username-register" class="form-control" type="text" placeholder="Enter display name" autocomplete="off" />
              </div>

              <div class="form-group">
                <label for="password-register" class="text-muted mb-1"><small>Email</small></label>
                <input value="{{old('email')}}" name="email" id="password-register" class="form-control" type="text" placeholder="Email" />
              </div>

              <div class="form-group">
                <label for="password-register" class="text-muted mb-1"><small>Password</small></label>
                <input value="{{old('password')}}" name="password" id="password-register" class="form-control" type="password" placeholder="Create a password" />
              </div>

              @if(auth()->user())
                @if (auth()->user()->is_super_admin == true)
                <div class="form-group">
                    <label for="password-register" class="text-muted mb-1"><small>IS Admin?</small></label>
                    <input value="{{old('is_admin')}}" name="is_admin" id="password-register" class="form-control" placeholder="Is Admin?" />
                  </div>
                @endif
              @endif
              <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Register</button>
            </form>
          </div>
        </div>
      </div>

</x-layout>
