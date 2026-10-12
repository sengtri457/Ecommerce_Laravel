@extends('layouts.admin')

@section('title', 'Customers & Users')
@section('header_title', 'Users & Access Control')

@section('content')
<div class="stat-card mb-4">
    <div class="row align-items-center mb-3">
        <div class="col-md-8">
            <form action="{{ route('admin.users.index') }}" method="GET" class="form-inline">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control mr-2 mb-2" placeholder="Search name or email...">
                <select name="role" class="form-control mr-2 mb-2">
                    <option value="">All Roles</option>
                    <option value="customer" {{ request('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                <button type="submit" class="btn btn-outline-primary-2 mb-2">Filter</button>
                @if(request()->anyFilled(['q', 'role']))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-link text-muted mb-2 ml-2">Clear</a>
                @endif
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-admin mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Orders</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="font-weight-bold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '—' }}</td>
                        <td>{{ $user->orders_count }} orders</td>
                        <td>
                            <span class="badge {{ $user->role === 'admin' ? 'badge-primary' : 'badge-light' }} text-uppercase">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="text-right">
                            @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.users.toggle-role', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary px-2 py-1" onclick="return confirm('Change role for {{ $user->name }}?');">
                                        {{ $user->role === 'admin' ? 'Demote to Customer' : 'Make Admin' }}
                                    </button>
                                </form>
                            @else
                                <span class="text-muted" style="font-size: 1.15rem;">Current Account</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
