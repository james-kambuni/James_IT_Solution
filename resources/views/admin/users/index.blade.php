@extends('admin.layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="card">
    <!-- Card Header with Title and Add User Button -->
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="card-title">Users</h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary mr-2">
                    <i class="fas fa-plus"></i> Add User
                </a>
                <a href="{{ route('admin.users.export') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export Users
                </a>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <div class="card-header">
        <form action="{{ route('admin.users.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" 
                       placeholder="Search users..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bulk Actions Form -->
    <form id="bulk-form" action="{{ route('admin.users.bulk-actions') }}" method="POST">
        @csrf
        <div class="card-header bg-light">
            <div class="row">
                <div class="col-md-4">
                    <select name="action" class="form-control form-control-sm">
                        <option value="">Bulk Actions</option>
                        <option value="delete">Delete</option>
                        <option value="make_admin">Make Admin</option>
                        <option value="remove_admin">Remove Admin</option>
                        <option value="activate">Activate</option>
                         <option value="deactivate">Deactivate</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="50px"><input type="checkbox" id="select-all"></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td><input type="checkbox" name="selected_ids[]" value="{{ $user->id }}"></td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span style="color:red" class="badge badge-success">Admin</span>
                            @else
                                <span style= "color:green" class="badge badge-primary">User</span>
                            @endif
                        </td>
                        <td>
                            @if(auth()->user()->canImpersonate() && !$user->is_admin)
                            <form action="{{ route('admin.users.impersonate', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-info" title="Login as this user">
                                    <i class="fas fa-user-secret"></i>
                                </button>
                            </form>
                            @endif
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>

    <!-- Pagination -->
    <div class="card-footer">
        {{ $users->links() }}
    </div>
</div>

<!-- JavaScript for Bulk Actions -->
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const selectAllCheckbox = document.getElementById('select-all');
    const bulkForm = document.getElementById('bulk-form');
    const actionSelect = document.querySelector('select[name="action"]');
    const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');

    // Select/Deselect all checkboxes
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', (e) => {
            checkboxes.forEach(checkbox => {
                checkbox.checked = e.target.checked;
            });
        });
    }

    // Validate form on submit
    if (bulkForm) {
        bulkForm.addEventListener('submit', (e) => {
            const selected = Array.from(checkboxes).filter(checkbox => checkbox.checked);
            const action = actionSelect?.value;

            if (selected.length === 0) {
                e.preventDefault();
                alert('Please select at least one user.');
                return;
            }

            if (!action) {
                e.preventDefault();
                alert('Please select an action to perform.');
                return;
            }

            if (!confirm(`Are you sure you want to ${action.replace('_', ' ')} ${selected.length} user(s)?`)) {
                e.preventDefault();
            }
        });
    }
});
</script>
@endsection
@endsection