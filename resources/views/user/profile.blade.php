<x-login-used>
    @if (session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="container container-narrow">
      <div class="alert text-center" style="background-color: #16a085">
        {{session('message')}}
      </div>
    </div>
  @endif

  @if (session()->has('failure'))
  <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="container container-narrow">
    <div class="alert text-center" style="background-color: #e60000">
      {{session('failure')}}
    </div>
  </div>
@endif
  <div class="row" style="text-align: center; margin-left:43%;">
    <p>You want to change wich part?</p>
  </div>
  <div class="row" style="text-align: center; margin-left:43%;">
    <a href="/create-cv-form/{{$user->id}}/edit/user" style="text-align: center">User Information</a>
  </div>
  <div class="row" style="text-align: center; margin-left:43%;">
    <a href="/create-cv-form/{{$user->id}}/edit/personal" style="text-align: center">Personal Information</a>
  </div>
  <div class="row" style="text-align: center; margin-left:43%;">
    <a href="/create-cv-form/{{$user->id}}/edit/skill" style="text-align: center">Skill Information</a>
  </div>
  <div class="row" style="text-align: center; margin-left:43%;">
    <a href="/create-cv-form/{{$user->id}}/edit/graduation" style="text-align: center">Graduation Information</a>
  </div>
  <div class="row" style="text-align: center; margin-left:43%;">
    <a href="/create-cv-form/{{$user->id}}/edit/experience" style="text-align: center">Work Experience</a>
  </div>
  <div class="row" style="text-align: center; margin-left:43%;">
    <a href="/create-cv-form/{{$user->id}}/edit/template" style="text-align: center">Change Template</a>
  </div>
  <div class="row" style="text-align: center; margin-left:43%;">
    <a href="/create-cv-form/{{$user->id}}/edit/password" style="text-align: center">Change Password</a>
  </div>
  <div class="row" style="text-align: center; margin-left:43%;">
    <a href="/image-upload/{{$user->id}}/edit" style="text-align: center">Change Image</a>
  </div>
</x-login-used>
