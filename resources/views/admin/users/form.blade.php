<div class="card-body">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
               value="{{ old('name', $user->name ?? '') }}" required>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
               value="{{ old('email', $user->email ?? '') }}" required>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">{{ isset($user) ? 'New ' : '' }}Password</label>
        <input type="password" name="password" id="password" 
               class="form-control @error('password') is-invalid @enderror" 
               {{ !isset($user) ? 'required' : '' }}>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" 
               class="form-control" {{ !isset($user) ? 'required' : '' }}>
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="is_admin" id="is_admin" 
                   class="custom-control-input" value="1"
                   {{ old('is_admin', $user->is_admin ?? false) ? 'checked' : '' }}>
            <label class="custom-control-label" for="is_admin">Admin User</label>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-default">Cancel</a>
</div>