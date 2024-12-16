
    <x-login-used>
        <!-- Container (Contact Section) -->
        <form action="/store-post-page/{{auth()->user()->id}}" method="POST" class="mb-0 pt-2 pt-md-0">
            @csrf
            <div class="col-md-auto">
                <button class="btn btn-primary btn-sm" style="margin-bottom: 50px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                        <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z"/>
                      </svg>
                    Back</button>
            </div>
        </form>
        <div id="contact" class="container" style="text-align: center; display:block; justify-content:center; align-items:center">

            <h1 class="text-center" style="margin-top: 100px">Thumbnail Upload</h1>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{$message}}</strong>
                </div>


            @endif
            <form method="POST" action="/add-thumbnail/post/{{$post->id}}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <input type="file" class="form-control" name="avatar" />
                <button type="submit" class="btn btn-success" style="margin-top: 30px">Upload</button>
            </form>
            <form method="GET" action="/welcome-page" enctype="multipart/form-data">
              <button type="submit" class="btn btn-success" style="margin-top: 30px; margin-bottom:30px">Skip For Now</button>
            </form>
        </div>
</x-login-used>


