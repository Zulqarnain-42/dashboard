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

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-setting-tab" data-bs-toggle="pill" data-bs-target="#v-pills-setting" type="button" role="tab" aria-controls="v-pills-setting" aria-selected="true">General Setting</button>
                    <button class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payment" type="button" role="tab" aria-controls="v-pills-payment" aria-selected="false">Payment Gateway</button>
                    <button class="nav-link" id="v-pills-shipping-tab" data-bs-toggle="pill" data-bs-target="#v-pills-shipping" type="button" role="tab" aria-controls="v-pills-shipping" aria-selected="false">Shipping</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-setting" role="tabpanel" aria-labelledby="v-pills-setting-tab">General Setting</div>
                    <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">Payments</div>
                    <div class="tab-pane fade" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">Shipping</div>                </div>
            </div>
        </div>
    </div>

</x-app-layout>
