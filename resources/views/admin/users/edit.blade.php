@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--gray-900);">Edit User</h1>
            <p style="color: var(--gray-600);">Update user details and permissions</p>
        </div>
        <a href="{{ route('admin.users') }}" class="btn-secondary">Cancel</a>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card" style="max-width: 600px; margin: 0 auto;">
            
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Role / Permissions</label>
                <div style="padding: 1rem; border: 1px solid var(--gray-200); border-radius: var(--radius-lg); background: var(--gray-50);">
                    <label class="custom-check" style="margin-bottom: 0;">
                        <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
                        <span style="font-weight: 500; color: var(--gray-900);">Grant Admin Access</span>
                    </label>
                    <p style="font-size: 0.85rem; color: var(--gray-600); margin-top: 5px; margin-left: 28px;">
                        Admins can manage recipes, reviews, and other users.
                    </p>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--gray-200);">
                <h4 style="margin-bottom: 1rem; font-size: 1rem; color: var(--gray-900);">Reset Password (Optional)</h4>
                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                <a href="{{ route('admin.users') }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">Update User</button>
            </div>
        </div>
    </form>
</div>
@endsection