<x-app-layout>

    @if (isset($slider))

    @else
        {{ Breadcrumbs::render('createslider') }}
    @endif


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
                                <label class="form-label" for="paragraphone-input">Paragraph One</label>
                                <input type="text" class="form-control" name="paragraphone" id="paragraphone" value="{{ isset($slider) ? $slider->paragraphone : old('paragraphone') }}" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="paragraphtwo-input">Paragraph Two</label>
                                <input type="text" class="form-control" name="paragraphtwo" id="paragraphtwo" value="{{ isset($slider) ? $slider->paragraphtwo : old('paragraphtwo') }}" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="paragraphthree-input">Paragraph Three</label>
                                <input type="text" class="form-control" name="paragraphthree" id="paragraphthree" value="{{ isset($slider) ? $slider->paragraphthree : old('paragraphthree') }}" placeholder="">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="sliderslug-input">Slug</label>
                                <input type="text" class="form-control" name="sliderslug" id="sliderslug" value="{{ isset($slider) ? $slider->slug : old('sliderslug') }}" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Slider Gallery</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="imageone-input">Image One</label>
                                <input type="file" name="sliderUploadFilePondOne" id="sliderUploadFilePondOne" accept="image/*" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="imagetwo-input">Image Two</label>
                                <input type="file" name="sliderUploadFilePondTwo" id="sliderUploadFilePondTwo" accept="image/*" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Visibility Status</label>
                            <select class="form-select" name="status" id="status" data-choices data-choices-search-false>
                                @foreach ($collectionstatus as $status)
                                    <option value="{{ $status->id }}" {{ (isset($slider) && $slider->status == $status->id) ? 'selected' : '' }}
                                        {{ (old("status") == $status->id ? "selected":"") }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Shop Now Button</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="shopnow-button-input" class="form-label">Button Text</label>
                            <input type="text" class="form-control" name="buttontext" id="buttontext" value="{{ isset($slider) ? $slider->buttontext : old('buttontext') }}" placeholder="Button Text" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @section('scripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        const inputElement = document.querySelector('#sliderUploadFilePondOne');
        const secondElement = document.querySelector('#sliderUploadFilePondTwo');
        const thirdElement = document.querySelector('#sliderUploadFilePondThree');
        const fourthElement = document.querySelector('#sliderUploadFilePondFour');
        const pond = FilePond.create(inputElement,{
            server:{
                url:'/uploadsliderone',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        });

        const secondpond = FilePond.create(secondElement,{
            server:{
                url:'/uploadslidertwo',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        });

    //     $('#createslider-form').validate({
    //     rules: {
    //         sliderslug: {
    //             required: true
    //         },
    //         sliderheading:{
    //             required:true
    //         }
    //     },
    // });
    </script>
    @endsection
</x-app-layout>
