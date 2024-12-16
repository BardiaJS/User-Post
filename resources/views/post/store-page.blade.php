<x-login-used>
    <div class="container py-md-5">
        <div class="row align-items-center">

          <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
            <form action="/store/post/{{auth()->user()->id}}" method="POST" id="registration-form">
              @csrf
              <div class="form-group">
                <label for="username-register" class="text-muted mb-1"><small>Name</small></label>
                <input value="{{old('name')}}" name="name" id="username-register" class="form-control" type="text" placeholder="Post Name" autocomplete="off" />
              </div>

              <div class="form-group">
                <label for="username-register" class="text-muted mb-1"><small>Content</small></label>
                <input value="{{old('content')}}" name="content" id="username-register" class="form-control" type="text" placeholder="Post Content" autocomplete="off" />
              </div>

              <div class="form-group">
                <label for="username-register" class="text-muted mb-1"><small>tags</small></label>
                <input value="{{old('tags')}}" name="tags" id="username-register" class="form-control" type="text" placeholder="Tags(sperate with ',')" autocomplete="off" />
              </div>

              <div class="form-group">
                <label for="password-register" class="text-muted mb-1"><small>Is Visible?</small></label>
                <input value="{{old('is_visible')}}" name="is_visible" id="password-register" class="form-control" placeholder="Is Visible?" />
              </div>
              <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Register</button>
            </form>
          </div>
        </div>
      </div>
</x-login-used>
