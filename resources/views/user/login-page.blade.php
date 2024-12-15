<x-login-used>
        <form action="/api" method="GET" class="mb-0 pt-2 pt-md-0">
            <div class="col-md-auto">
                <button class="btn btn-primary btn-sm" style="margin-bottom: 50px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                        <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z"/>
                      </svg>
                    Back</button>
            </div>
        </form>
    <form action="/api/login" method="POST" class="mb-0 pt-2 pt-md-0">
        @csrf
        <div class="row align-items-center">
          <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
            <input name="email" class="form-control form-control-sm input-dark" type="email" placeholder="Email" autocomplete="off" />
          </div>
          <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
            <input name="password" class="form-control form-control-sm input-dark" type="password" placeholder="Password" />
          </div>
          <div class="col-md-auto">
            <a href="/forget-password" style="color: white">Forgot your password?</a>
          </div>
          <div class="col-md-auto">
            <button class="btn btn-primary btn-sm">Sign In</button>
          </div>
        </div>
      </form>
</x-login-used>
