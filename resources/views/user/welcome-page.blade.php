<x-layout>
    <div class="container py-md-5 container--narrow">
        <div class="text-center">
          <h2>Hello <strong>{{auth('sanctum')->user()->display_name}}</strong></h2>
          <p class="lead text-muted">Welcome to your home panel!</p>
        </div>
      </div>
</x-layout>
