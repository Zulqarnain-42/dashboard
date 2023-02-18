<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            @unless ($breadcrumbs->isEmpty())
                @foreach ($breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url && $loop->last)
                        <h4 class="mb-sm-0">{{ $breadcrumb->title }}</h4>
                    @endif
                @endforeach
                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            @foreach ($breadcrumbs as $breadcrumb)
                                @if ($breadcrumb->url && !$loop->last)
                                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                                @else
                                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                @endunless
        </div>
    </div>
</div>
