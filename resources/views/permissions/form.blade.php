<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Create Slider</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Create Slider</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" name="permissionform" action="{{ isset($permission) ? route('permissions.update', $permission->id) : route('permissions.store') }}" id="createpermission-form" autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @if (isset($permission))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="permission-name-input">Name</label>
                            <input type="text" class="form-control" name="permissionname" id="permissionname" value="{{ isset($permission) ? $permission->title : old('permissionname') }}" placeholder="Enter Permission Name" required>
                        </div>
                        <div>
                            <label class="form-label" for="permission-url-input">URL</label>
                            <input type="text" class="form-control" name="permissionurl" id="permissionurl" value="{{ isset($permission) ? $permission->title : old('permissionurl') }}" placeholder="Enter Permission URL" required>
                        </div>
                    </div>
                </div>
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
