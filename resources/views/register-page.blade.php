<x-layout>
    <div class="container py-md-5">
        <div class="row align-items-center">
          <div class="col-lg-7 py-3 py-md-5">
            <img src="images/1600682639793.gif">
          </div>
          <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
            <form action="/api/register" method="POST" id="registration-form">
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

              <div class="form-group">
                <label for="password-register" class="text-muted mb-1"><small>IS Admin?</small></label>
                <input value="{{old('is_admin')}}" name="is_admin" id="password-register" class="form-control" placeholder="Is Admin?" />
              </div>
              <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Register</button>
            </form>
          </div>
        </div>
      </div>

</x-layout>
