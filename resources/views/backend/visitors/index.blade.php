<x-backend-layout title="Advanced Visitor Analytics">
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div>
            <p class="fw-semibold fs-18 mb-0">Visitor Analytics Hub</p>
            <span class="fs-semibold text-muted">Real-time audience insights, technographics, and traffic trends.</span>
        </div>
    </div>

    <!-- Start::Overview Stats -->
    <div class="row">
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex align-items-top">
                        <div class="flex-fill">
                            <p class="mb-0 text-muted">Total Visits</p>
                            <h4 class="fw-semibold mt-1 mb-0">{{ number_format($stats['total_visits']) }}</h4>
                        </div>
                        <div class="ms-3">
                            <span class="avatar avatar-md avatar-rounded bg-primary-transparent">
                                <i class="ri-eye-line fs-18"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <span class="text-success fw-semibold fs-12">
                            <i class="ri-arrow-up-s-fill align-middle me-1"></i>Lifetime Log
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex align-items-top">
                        <div class="flex-fill">
                            <p class="mb-0 text-muted">Unique Visitors</p>
                            <h4 class="fw-semibold mt-1 mb-0">{{ number_format($stats['unique_visitors']) }}</h4>
                        </div>
                        <div class="ms-3">
                            <span class="avatar avatar-md avatar-rounded bg-info-transparent">
                                <i class="ri-user-heart-line fs-18"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <span class="text-info fw-semibold fs-12">
                            <i class="ri-user-follow-line align-middle me-1"></i>Total Audience
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex align-items-top">
                        <div class="flex-fill">
                            <p class="mb-0 text-muted">Avg. Visit Duration</p>
                            <h4 class="fw-semibold mt-1 mb-0">{{ $stats['avg_duration'] }} <small
                                    class="text-muted fs-11">min</small></h4>
                        </div>
                        <div class="ms-3">
                            <span class="avatar avatar-md avatar-rounded bg-warning-transparent">
                                <i class="ri-timer-2-line fs-18"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <span class="text-warning fw-semibold fs-12">
                            <i class="ri-time-line align-middle me-1"></i>Session Avg
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-flex align-items-top">
                        <div class="flex-fill">
                            <p class="mb-0 text-muted">Unique Today</p>
                            <h4 class="fw-semibold mt-1 mb-0">{{ number_format($stats['unique_today']) }}</h4>
                        </div>
                        <div class="ms-3">
                            <span class="avatar avatar-md avatar-rounded bg-success-transparent">
                                <i class="ri-flashlight-line fs-18"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <span class="text-success fw-semibold fs-12">
                            <i class="ri-pulse-line align-middle me-1"></i>Active Now
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start::Traffic Trends -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Daily Visitors (Last 30 Days)</div>
                </div>
                <div class="card-body">
                    <div id="daily-traffic-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Device Distribution</div>
                </div>
                <div class="card-body">
                    <div id="device-pie-chart"></div>
                    <div class="mt-4">
                        <ul class="list-unstyled mb-0">
                            @foreach($devices as $device)
                                <li class="mb-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="text-muted fs-12">{{ $device->device_type }}</span>
                                        <span class="fw-semibold">{{ $device->count }}</span>
                                    </div>
                                    <div class="progress progress-xs mt-1">
                                        <div class="progress-bar bg-{{ $device->device_type == 'Mobile' ? 'primary' : ($device->device_type == 'Desktop' ? 'secondary' : 'success') }}"
                                            style="width: {{ ($device->count / max(1, $stats['total_visits'])) * 100 }}%">
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start::Audience Details -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Top Countries</div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table text-nowrap table-borderless">
                            <tbody>
                                @foreach($top_countries as $country)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="ri-map-pin-line text-muted me-2"></i>
                                                <span class="fw-semibold">{{ $country->country }}</span>
                                            </div>
                                        </td>
                                        <td class="text-end text-muted">{{ $country->count }} visits</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Top Referrers</div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table text-nowrap table-borderless">
                            <tbody>
                                @foreach($top_referrers as $referrer)
                                    <tr>
                                        <td class="text-truncate" style="max-width: 200px;">
                                            <span class="text-muted me-1">🔗</span>
                                            <span class="fw-semibold" title="{{ $referrer->referrer_url }}">
                                                {{ Str::limit(str_replace(['https://', 'http://', 'www.'], '', $referrer->referrer_url), 30) ?: 'Direct/Social' }}
                                            </span>
                                        </td>
                                        <td class="text-end text-muted">{{ $referrer->count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card custom-card">
                <div class="card-header border-bottom-0">
                    <div class="card-title">Browser & OS</div>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex justify-content-around text-center mb-4">
                        <div>
                            <p class="mb-0 text-muted fs-12">Top Browser</p>
                            <span class="fw-semibold fs-14">{{ $browsers->first()->browser ?? 'N/A' }}</span>
                        </div>
                        <div class="vr"></div>
                        <div>
                            <p class="mb-0 text-muted fs-12">Top OS</p>
                            <span class="fw-semibold fs-14">{{ $os->first()->platform ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div id="techno-chart"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start::Top Pages -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Top Visited Pages</div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Page URL</th>
                                    <th scope="col">Views</th>
                                    <th scope="col">Performance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($top_pages as $page)
                                    <tr>
                                        <td>
                                            <a href="{{ $page->page_url }}" target="_blank" class="text-primary">
                                                {{ Str::limit(str_replace(url('/'), '', $page->page_url), 60) ?: '/' }}
                                            </a>
                                        </td>
                                        <td class="fw-semibold">{{ $page->count }}</td>
                                        <td style="width: 200px;">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-primary"
                                                    style="width: {{ ($page->count / max(1, $top_pages->first()->count)) * 100 }}%">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start::Detailed Logs -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Detailed Activity Log</div>
                    <div class="d-flex gap-2 align-items-center flex-wrap">
                        <span class="fs-12 text-muted fw-semibold me-1">Visit Type:</span>
                        <div class="btn-group btn-group-sm me-3 border">
                            <a href="{{ route('visitors.index', array_merge(request()->query(), ['visit_type' => 'page'])) }}"
                                class="btn btn-{{ $visit_type === 'page' ? 'info' : 'outline-info' }}">Pages</a>
                            <a href="{{ route('visitors.index', array_merge(request()->query(), ['visit_type' => 'asset'])) }}"
                                class="btn btn-{{ $visit_type === 'asset' ? 'info' : 'outline-info' }}">Assets</a>
                            <a href="{{ route('visitors.index', array_merge(request()->query(), ['visit_type' => 'bot'])) }}"
                                class="btn btn-{{ $visit_type === 'bot' ? 'info' : 'outline-info' }}">Bots</a>
                            <a href="{{ route('visitors.index', array_merge(request()->query(), ['visit_type' => 'all'])) }}"
                                class="btn btn-{{ $visit_type === 'all' ? 'info' : 'outline-info' }}">All Traffic</a>
                        </div>

                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('visitors.index', array_merge(request()->query(), ['type' => null])) }}"
                                class="btn btn-{{ !request('type') ? 'primary' : 'outline-primary' }}">All Log</a>
                            <a href="{{ route('visitors.index', array_merge(request()->query(), ['type' => 'unique'])) }}"
                                class="btn btn-{{ request('type') === 'unique' ? 'primary' : 'outline-primary' }}">Unique IP</a>
                        </div>
                        <form action="{{ route('visitors.index') }}" method="GET" class="d-flex">
                            <input type="hidden" name="visit_type" value="{{ $visit_type }}">
                            <input type="hidden" name="type" value="{{ request('type') }}">
                            <input class="form-control form-control-sm" type="text" name="search"
                                value="{{ request('search') }}" placeholder="IP or City...">
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th>IP / Location</th>
                                    <th>Page</th>
                                    <th>Metadata</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($visitors as $visitor)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $visitor->ip_address }}</div>
                                            <span class="fs-11 text-muted">{{ $visitor->city }},
                                                {{ $visitor->country }}</span>
                                        </td>
                                        <td class="text-truncate" style="max-width: 250px;">
                                            <span
                                                class="badge bg-light text-dark mb-1">{{ $visitor->device_type }}</span>
                                            <span
                                                class="badge bg-info-transparent mb-1">{{ ucfirst($visitor->visit_type) }}</span><br>
                                            <small
                                                title="{{ $visitor->page_url }}">{{ Str::limit(str_replace(url('/'), '', $visitor->page_url), 35) ?: '/' }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="ri-computer-line me-1 text-muted"></i> {{ $visitor->browser }}
                                                <i class="ri-window-line ms-2 me-1 text-muted"></i> {{ $visitor->platform }}
                                            </div>
                                        </td>
                                        <td>
                                            <p class="mb-0 fs-12 fw-semibold">{{ $visitor->created_at->format('h:i A') }}
                                            </p>
                                            <span
                                                class="fs-10 text-muted">{{ $visitor->created_at->diffForHumans() }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $visitors->links('backend.pagination.paginate') }}
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            // Daily Traffic Chart
            var dailyOptions = {
                series: [{
                    name: 'Visitors',
                    data: @json($daily_stats->pluck('count'))
                }],
                chart: {
                    height: 320,
                    type: 'area',
                    toolbar: { show: false },
                    dropShadow: { enabled: true, color: '#000', top: 5, left: 0, blur: 3, opacity: 0.1 }
                },
                colors: ["rgb(132, 90, 223)"],
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                xaxis: {
                    categories: @json($daily_stats->pluck('date')),
                    labels: { rotate: -45, style: { fontSize: '10px' } }
                },
                tooltip: { x: { format: 'dd MMM yyyy' } },
                fill: {
                    type: 'gradient',
                    gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.1, stops: [0, 90, 100] }
                },
            };
            new ApexCharts(document.querySelector("#daily-traffic-chart"), dailyOptions).render();

            // Device Pie Chart
            var deviceOptions = {
                series: @json($devices->pluck('count')),
                labels: @json($devices->pluck('device_type')),
                chart: { height: 260, type: 'donut' },
                colors: ["rgb(132, 90, 223)", "rgb(35, 183, 229)", "rgb(38, 191, 148)"],
                legend: { position: 'bottom' },
                stroke: { width: 0 },
                dataLabels: { enabled: false }
            };
            new ApexCharts(document.querySelector("#device-pie-chart"), deviceOptions).render();

            // Technographics Chart (Bar Chart for Browser Comparison)
            var technoOptions = {
                series: [{
                    name: 'Usage',
                    data: @json($browsers->take(5)->pluck('count'))
                }],
                chart: { height: 200, type: 'bar', toolbar: { show: false } },
                plotOptions: { bar: { borderRadius: 4, horizontal: true } },
                colors: ["rgb(132, 90, 223)"],
                dataLabels: { enabled: false },
                xaxis: { categories: @json($browsers->take(5)->pluck('browser')) }
            };
            new ApexCharts(document.querySelector("#techno-chart"), technoOptions).render();
        </script>
    @endpush
</x-backend-layout>