@extends('master')

@section('title', 'users')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">    
        <div class="card-body">
            <h4 class="card-title">Users</h4>

                <form action="{{ route('assign.role') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                @if(auth()->user()->can('assign-role'))
                                    <th><input type="checkbox" id="select-all"></th> <!-- Select All Checkbox -->
                                @endif
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                    @if(auth()->user()->can('assign-role'))
                                        <td>
                                            <input type="checkbox" name="user_ids[]" value="{{ $user->id }}">
                                        </td>
                                    @endif
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            {{ $user->roles->isNotEmpty() ? $user->roles[0]->name : 'No Role' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                    @if(auth()->user()->can('assign-role'))
                    <div class="form-group mt-3">
                        <label for="role">Assign Role</label>
                        <select name="role_id" class="form-control" id="role">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-sm mt-2">Assign Role</button>
                    @endif
                </form>
            
        </div>
    </div>
</div>

<script>
    // JavaScript to handle "Select All" functionality
    document.getElementById('select-all').addEventListener('click', function(e) {
        const checkboxes = document.querySelectorAll('input[name="user_ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    });
</script>
@endsection