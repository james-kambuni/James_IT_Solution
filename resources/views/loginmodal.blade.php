<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Please Log In</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" required autofocus>
          </div>
          <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" required>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button type="submit" class="btn btn-primary">Login</button>
          <a href="{{ route('register') }}">Don't have an account? Register</a>
        </div>
      </form>
    </div>
  </div>
</div>
