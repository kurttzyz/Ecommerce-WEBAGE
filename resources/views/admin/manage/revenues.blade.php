@extends('admin.layouts.layout')

@section('title_admin')
    ConnectingNotes | Admin
@endsection

@section('admin_layout')
    <h1>Manage Your Site Revenues</h1>

    <form method="GET" action="{{ route('admin.manage.revenues') }}" class="mb-4">
        <label for="month">Month:</label>
        <select name="month" id="month">
            <option value="">-- All Months --</option>
            @foreach(range(1, 12) as $m)
                <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}" {{ request('month') == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                </option>
            @endforeach
        </select>

        <label for="choice">Session:</label>
        <select name="choice" id="choice">
            <option value="">-- All Sessions --</option>
            @foreach($sessions as $session)
                <option value="{{ $session->session_id }}" {{ request('choice') == $session->session_id ? 'selected' : '' }}>
                    {{ $session->title }} <!-- Adjust this if the session name is stored in a different column -->
                </option>
            @endforeach
        </select>

        <button type="submit">Filter</button>
    </form>

    <canvas id="revenueChart" width="600" height="300"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Revenue (₱)',
                    data: @json($revenueData),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection