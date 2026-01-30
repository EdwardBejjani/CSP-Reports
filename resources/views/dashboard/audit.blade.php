@extends('app')

@section('title', 'Audit Logs')

@section('content')
    <div class="mt-15 vh-100-custom mx-3">
        <h2 class="text-white text-center text-shadow fw-bold mb-4">Audit Logs</h2>
        <form action="{{ route('dashboard.audit') }}" method="GET" class="card-glass-dark rounded-5 p-4 rounded-3 mb-4">
            <div class="row g-3 mb-4">
                <div class="col d-flex flex-column align-items-center">
                    <label for="date_from" class="form-label text-white fw-bold">Date From</label>
                    <input type="date" class="input w-100" name="date_from" id="date_from" value="{{ $date_from }}">
                </div>
                <div class="col d-flex flex-column align-items-center">
                    <label for="date_till" class="form-label text-white fw-bold">Date Till</label>
                    <input type="date" class="input w-100" name="date_till" id="date_till" value="{{ $date_till }}">
                </div>
                <div class="col d-flex flex-column align-items-center">
                    <label for="type" class="form-label text-white fw-bold">Type</label>
                    <select name="type" id="type" class="input w-100">
                        <option value="" selected>Select A Type</option>
                        <option value="renew_user">Renew User</option>
                        <option value="edit_user">Edit User</option>
                        <option value="add_user">Add User</option>
                        <option value="delete_user">Delete User</option>
                        <option value="rename_user">Rename User</option>
                        <option value="adddays_user">User Add Days</option>
                        <option value="resetfup_user">Reset User FUP</option>
                        <option value="reset_mac">Reset MAC</option>
                        <option value="rentip_user">Rent IP</option>
                        <option value="in/active_user">Inactive User</option>
                        <option value="transfer_money">Transfer Money</option>
                        <option value="withdraw_money">Withdraw Money</option>
                        <option value="changeservice_user">Change Service</option>
                        <option value="add_reseller">Add Reseller</option>
                    </select>
                </div>
                <div class="col d-flex flex-column align-items-center">
                    <label for="user" class="form-label text-white fw-bold">User</label>
                    <select name="user" id="user" class="input w-100">
                        <option value="" selected>Select A User</option>
                        @foreach ($resellers as $reseller)
                            <option value={{ $reseller['Reseller'] }}>{{ $reseller['Reseller']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col d-flex flex-column align-items-center">
                    <label for="username" class="form-label text-white fw-bold">Username</label>
                    <input type="text" class="input w-100" id="username" name="username">
                </div>
                <div class="col-md-2 d-flex flex-column align-items-center justify-content-end">
                    <button type="submit" class="input w-100 btn-glass-light fw-bold text-white text-shadow"><i
                            class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </form>
        @if(Route::is('dashboard.audit'))
            <table class="glass-table">
                <thead>
                    <tr>
                        <th class="text-center text-white text-shadow fw-bold p-2">Date</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Username</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">IP</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Type</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">User</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Changes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($audit as $auditLog)
                        <tr>
                            <td class="text-white text-shadow p-2 text-center">{{ $auditLog['datetime'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $auditLog['object_id'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $auditLog['ipaddress'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $auditLog['object_type'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $auditLog['user'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $auditLog['changes'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $audit->links() }}
            </div>
        @endif
    </div>
@endsection
