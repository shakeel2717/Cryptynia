<div class="col-md-4 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">{{ $title }}</h6>
            </div>
            <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="my-2">{{ $value }}</h3>
                    <div class="d-flex align-items-baseline">
                        <p class="text-success">
                            <span>+0.0%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                        </p>
                    </div>
                </div>
                <div class="col-6 col-md-12 col-xl-7">
                    <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                </div>
            </div>
        </div>
    </div>
</div>
