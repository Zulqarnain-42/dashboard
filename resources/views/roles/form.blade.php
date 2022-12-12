<x-app-layout>
    <form method="POST" name="rolesform" action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" id="createroles-form" autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @if (isset($role))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="role-name-input">Role Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ isset($role) ? $role->name : old('name') }}" placeholder="Enter Role Name" required>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-3 fs-14 text-muted">Assign Permissions</h6>
                        </div>
                        @foreach ($permissions as $permission)
                            <div class="form-check form-switch mb-3 mt-3">
                                <input class="form-check-input" type="checkbox" role="switch" name="rolepermission[]" id="SwitchCheck1" value="{{$permission->id}}">
                                <label class="form-check-label" for="SwitchCheck1">{{$permission->name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
