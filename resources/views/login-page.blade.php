<x-login-used>
    <form action="/api/login" method="POST" class="mb-0 pt-2 pt-md-0">
        <a href="/api" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
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
