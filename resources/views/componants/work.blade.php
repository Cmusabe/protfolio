<!-- Work Section -->
<section class="section-card py-5" id="work">
    <div class="container px-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">Work</span></h2>
            <p class="lead fw-light mb-4">Mijn recente projecten</p>
        </div>
        <div class="row gx-5">
            @foreach($projects as $project)
            <div class="col-md-6 mb-5">
                <div class="card h-100 shadow border-0">
                    <img class="card-img-top" src="{{ $project->thumbnail }}" alt="{{ $project->title }}" />
                    <div class="card-body p-4">
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $project->category }}</div>
                        <h5 class="card-title mb-3">{{ $project->title }}</h5>
                        <p class="card-text mb-0">{{ $project->short_description }}</p>
                    </div>
                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                        <div class="d-flex align-items-end justify-content-between">
                            <a class="btn btn-outline-primary btn-sm" href="{{ url('/projects/' . $project->id) }}">Bekijk details</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder" href="{{ url('/projects') }}">Bekijk alle projecten</a>
        </div>
    </div>
</section> 