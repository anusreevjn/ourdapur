@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--gray-900);">Users</h1>
            <p style="color: var(--gray-600);">Manage registered users</p>
        </div>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 32px; height: 32px; background: var(--gray-200); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: var(--gray-600); font-size: 0.8rem;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span style="font-weight: 600; color: var(--gray-900);">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td style="color: var(--gray-600);">{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span class="badge badge-orange">Admin</span>
                            @else
                                <span class="badge badge-gray">User</span>
                            @endif
                        </td>
                        <td style="color: var(--gray-600); font-size: 0.9rem;">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                   class="btn-sm" 
                                   style="background: #2563eb; color: white; text-decoration: none; border-radius: 6px; padding: 0.4rem 0.8rem; font-weight: 500;">
                                   Edit
                                </a>
                                
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="btn-sm btn-danger" 
                                                style="border: none; cursor: pointer; border-radius: 6px;"
                                                onclick="return confirm('Delete this user?')">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 3rem; color: var(--gray-400);">
                            No users found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 1.5rem;">
        {{ $users->links() }}
    </div>
</div>
@endsection