<x-login-used>
        <!-- Container (Contact Section) -->
        <div id="contact" class="container" style="text-align: center; display:block; justify-content:center; align-items:center">

            <h1 class="text-center" style="margin-top: 100px">Image Upload</h1>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{$message}}</strong>
                </div>


            @endif
            <form method="POST" action="/api/user/add-avatar" enctype="multipart/form-data">
                @csrf
                <input type="file" class="form-control" name="avatar" />
                <button type="submit" class="btn btn-success" style="margin-top: 30px">Upload</button>
            </form>
            <form method="GET" action="/api/login-page" enctype="multipart/form-data">

              <button type="submit" class="btn btn-success" style="margin-top: 30px; margin-bottom:30px">Skip For Now</button>


            </form>
        </div>
</x-login-used>
