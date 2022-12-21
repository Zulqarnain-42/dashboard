<x-app-layout>
    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <form method="POST" name="userform" action="{{ isset($product) ? route('product.update', $product->id) : route('users.store') }}" id="createuser-form" autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @if (isset($product))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="firstname-input">First Name</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" value="{{ isset($product) ? $product->title : old('firstname') }}" placeholder="Enter first name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="lastname-input">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" value="{{ isset($product) ? $product->title : old('lastname') }}" placeholder="Enter product title" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="username-input">Username</label>
                                <input type="text" class="form-control" name="username" id="username" value="{{ isset($product) ? $product->title : old('username') }}" placeholder="Enter product title" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="email-input">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ isset($product) ? $product->title : old('email') }}" placeholder="Enter product title" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="mobile-input">Mobile</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" value="{{ isset($product) ? $product->title : old('mobile') }}" placeholder="Enter product title" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="designation-input">Designation</label>
                                <input type="text" class="form-control" name="designation" id="designation" value="{{ isset($product) ? $product->title : old('designation') }}" placeholder="Enter product title" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="password-input">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Assign Permissions</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($permissions as $permission)
                            <div class="form-check form-switch mb-3 mt-3 form-check-inline">
                                <input class="form-check-input" type="checkbox" role="switch" name="userpermissions[]" id="SwitchCheck1" value="{{$permission->id}}">
                                <label class="form-check-label" for="SwitchCheck1">{{$permission->name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>

            <div class="col-lg-4">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" data-choices data-choices-search-false>
                                @foreach ($collectionstatus as $status)
                                    <option value="{{ $status->id }}"
                                        {{ isset($product) && $product->status == $status->id ? 'selected' : '' }}
                                        {{ (old("status") == $status->id ? "selected":"") }}>
                                        {{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Roles</h5>
                    </div>
                    <div class="card-body">
                        <select class="js-example-basic-single" name="role">
                            <option value="">Select a Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ isset($product) && $product->brandid == $brand->id ? 'selected' : '' }}
                                    {{ (old("role") == $role->id ? "selected":"") }}>
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Picture</h5>
                    </div>
                    <div class="card-body">
                        <input type="file" name="ProfileFilePond" id="ProfileFilePond" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
    </form>
    @section('scripts')
        <script src="{{ URL::asset('assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            const inputElement = document.querySelector('#ProfileFilePond');
            const pond = FilePond.create(inputElement, {
                server: {
                    url: '/uploadprofile',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }
            });

        </script>
    @endsection
</x-app-layout>
