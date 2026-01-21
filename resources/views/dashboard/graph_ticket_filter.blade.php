<h2 class="text-white text-center text-shadow fw-bold mb-4">Support Tickets Graphs</h2>

<form action="{{ route('dashboard.graphs') }}" method="GET" class="glass-table p-4 rounded-3 mb-4">
    <div class="row g-3">
        <div class="col-md-2">
            <label for="month" class="form-label text-white">Month</label>
            <select name="month" id="month" class="input w-100">
                <option value="">All</option>
                @foreach (range(1, 12) as $month)
                    <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="problem" class="form-label text-white">Problem</label>
            <select name="problem" id="problem" class="input w-100">
                <option value="">All</option>
                @foreach ($problems as $problem)
                    <option value="{{ $problem }}" {{ request('problem') == $problem ? 'selected' : '' }}>
                        {{ $problem }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="status" class="form-label text-white">Status</label>
            <select name="status" id="status" class="input w-100">
                <option value="">All</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="support" class="form-label text-white">Support</label>
            <select name="support" id="support" class="input w-100">
                <option value="">All</option>
                @foreach ($supports as $support)
                    <option value="{{ $support }}" {{ request('support') == $support ? 'selected' : '' }}>
                        {{ $support }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="technician" class="form-label text-white">Technician</label>
            <select name="technician" id="technician" class="input w-100">
                <option value="">All</option>
                @foreach ($technicians as $technician)
                    <option value="{{ $technician }}" {{ request('technician') == $technician ? 'selected' : '' }}>
                        {{ $technician }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn-glass w-100 mt-4">Filter</button>
        </div>
    </div>
</form>