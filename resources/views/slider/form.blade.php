<x-app-layout>
    <form method="POST" action="{{ isset($slider) ? route('slider.update', $slider->id) : route('slider.store') }}" id="createslider-form" autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @if (isset($slider))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="slider-heading-input">Slider Heading</label>
                                <input type="text" class="form-control" name="sliderheading" id="sliderheading" value="{{ isset($slider) ? $slider->heading : old('sliderheading') }}" placeholder="Enter Slider Heading" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="slider-text-input">Slider Text</label>
                                <input type="text" class="form-control" name="slidertext" id="slidertext" value="{{ isset($slider) ? $slider->text : old('slidertext') }}" placeholder="Enter Slider text" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="slider-text2-input">Slider Text 2</label>
                                <input type="text" class="form-control" name="slidertext2" id="slidertext2" value="{{ isset($slider) ? $slider->text2 : old('slidertext2') }}" placeholder="Enter slider text" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="slider-slug-input">Slider Slug</label>
                                <input type="text" class="form-control" name="sliderslug" id="sliderslug" value="{{ isset($slider) ? $slider->slug : old('sliderslug') }}" placeholder="Enter slider slug" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Slider Gallery</h5>
                    </div>
                    <div class="card-body">
                        <input type="file" name="sliderUploadFilePond" id="sliderUploadFilePond" accept="image/*">
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
                                    <option value="{{ $status->id }}" {{ (isset($slider) && $slider->status == $status->id) ? 'selected' : '' }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="choices-publish-visibility-input" class="form-label">Visibility</label>
                            <select class="form-select" name="visibility" id="visibility" data-choices data-choices-search-false>
                                @foreach ($collectionvisibility as $visibilty)
                                    <option value="{{ $visibilty->id }}" {{ (isset($slider) && $slider->visibility == $visibilty->id) ? 'selected' : '' }}>{{ $visibilty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @section('scripts')

    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        const inputElement = document.querySelector('#sliderUploadFilePond');
        const pond = FilePond.create(inputElement,{
            server:{
                url:'/uploadslider',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                }
            }
        });
    </script>
    @endsection
</x-app-layout>
