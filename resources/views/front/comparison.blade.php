@extends('front.layouts.app')

@section('main')
<section class="section-0 lazy d-flex bg-image-style dark align-items-center" data-bg="{{ asset('assets/images/banner7.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1>Compare Services</h1>
                <p>Compare offerings by category, type, and budget in one view.</p>
            </div>
        </div>
    </div>
</section>

<section class="section-1 py-5">
    <div class="container">
        <div class="card border-0 shadow p-4 mb-4">
            <form action="{{ route('comparison') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Category</label>
                        <select name="category" class="form-control">
                            <option value="">All categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Service type</label>
                        <select name="serviceType" class="form-control">
                            <option value="">All service types</option>
                            @foreach ($serviceTypes as $serviceType)
                                <option value="{{ $serviceType->id }}" {{ request('serviceType') == $serviceType->id ? 'selected' : '' }}>
                                    {{ $serviceType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Max budget</label>
                        <input type="number" name="maxPrice" value="{{ request('maxPrice') }}" class="form-control" placeholder="Ex: 1500">
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Apply filters</button>
                        <a href="{{ route('comparison') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card border-0 shadow">
            <div class="card-body">
                <h3 class="mb-3">Comparison Table</h3>
                @if($services->isEmpty())
                    <div class="alert alert-info mb-0">
                        No services found for the selected filters.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Service</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Location</th>
                                    <th>Budget</th>
                                    <th>Experience</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $service->title }}</div>
                                            <div class="text-muted small">{{ \Illuminate\Support\Str::words(strip_tags($service->description), 10) }}</div>
                                        </td>
                                        <td>{{ optional($service->category)->name ?? '—' }}</td>
                                        <td>{{ optional($service->serviceType)->name ?? '—' }}</td>
                                        <td>{{ $service->location ?? '—' }}</td>
                                        <td>{{ $service->salary ? '$'.$service->salary : 'Negotiable' }}</td>
                                        <td>{{ $service->experience ?? '—' }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary" href="{{ route('serviceDetail', $service->id) }}">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
