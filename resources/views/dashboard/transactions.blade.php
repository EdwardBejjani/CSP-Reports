@extends('app')

@section('title', 'Transactions')

@section('content')
    <div class="vh-100-custom mt-15 mx-3">
        <h2 class="text-white text-center text-shadow fw-bold mb-4">Transactions</h2>
        <form action="{{ route('dashboard.transactions') }}" method="GET"
            class="card-glass-dark rounded-5 p-4 rounded-3 mb-4">
            <div class="row g-3 mb-4">
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="New" class="form-label text-white fw-bold">New</label>
                    <input type="checkbox" name="New" id="New" class="form-check-input check-input w-100" {{ $type['New'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Renew" class="form-label text-white fw-bold">Renew</label>
                    <input type="checkbox" name="Renew" id="Renew" class="form-check-input check-input w-100" {{ $type['Renew'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Transfer" class="form-label text-white fw-bold">Transfer</label>
                    <input type="checkbox" name="Transfer" id="Transfer" class="form-check-input check-input w-100" {{ $type['Transfer'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Rent" class="form-label text-white fw-bold">Rent IP</label>
                    <input type="checkbox" name="Rent" id="Rent" class="form-check-input check-input w-100" {{ $type['Rent'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Refill" class="form-label text-white fw-bold">Refill</label>
                    <input type="checkbox" name="Refill" id="Refill" class="form-check-input check-input w-100" {{ $type['Refill'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Comission" class="form-label text-white fw-bold">Comission</label>
                    <input type="checkbox" name="Comission" id="Comission" class="form-check-input check-input w-100" {{ $type['Comission'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Withdraw" class="form-label text-white fw-bold">Withdraw</label>
                    <input type="checkbox" name="Withdraw" id="Withdraw" class="form-check-input check-input w-100" {{ $type['Withdraw'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Reset" class="form-label text-white fw-bold">Reset FUP</label>
                    <input type="checkbox" name="Reset" id="Reset" class="form-check-input check-input w-100" {{ $type['Reset'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Changeservice" class="form-label text-white fw-bold">Change Service</label>
                    <input type="checkbox" name="Changeservice" id="Changeservice"
                        class="form-check-input check-input w-100" {{ $type['Changeservice'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Refund" class="form-label text-white fw-bold">Refund</label>
                    <input type="checkbox" name="Refund" id="Refund" class="form-check-input check-input w-100" {{ $type['Refund'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Boost" class="form-label text-white fw-bold">Boost</label>
                    <input type="checkbox" name="Boost" id="Boost" class="form-check-input check-input w-100" {{ $type['Boost'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Itv" class="form-label text-white fw-bold">Itv</label>
                    <input type="checkbox" name="Itv" id="Itv" class="form-check-input check-input w-100" {{ $type['Itv'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="ResetItv" class="form-label text-white fw-bold">Reset Itv</label>
                    <input type="checkbox" name="ResetItv" id="ResetItv" class="form-check-input check-input w-100" {{ $type['ResetItv'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Days" class="form-label text-white fw-bold">Add Days</label>
                    <input type="checkbox" name="Days" id="Days" class="form-check-input check-input w-100" {{ $type['Days'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Addon" class="form-label text-white fw-bold">Addons</label>
                    <input type="checkbox" name="Addon" id="Addon" class="form-check-input check-input w-100" {{ $type['Addon'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="Rename" class="form-label text-white fw-bold">Rename</label>
                    <input type="checkbox" name="Rename" id="Rename" class="form-check-input check-input w-100" {{ $type['Rename'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="paid" class="form-label text-white fw-bold">Paid</label>
                    <input type="checkbox" name="paid" id="paid" class="form-check-input check-input w-100" {{ $type['paid'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="unpaid" class="form-label text-white fw-bold">Unpaid</label>
                    <input type="checkbox" name="unpaid" id="unpaid" class="form-check-input check-input w-100" {{ $type['unpaid'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="cash" class="form-label text-white fw-bold">Cash</label>
                    <input type="checkbox" name="cash" id="cash" class="form-check-input check-input w-100" {{ $type['cash'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="discount" class="form-label text-white fw-bold">Discount</label>
                    <input type="checkbox" name="discount" id="discount" class="form-check-input check-input w-100" {{ $type['discount'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="wu" class="form-label text-white fw-bold">WU</label>
                    <input type="checkbox" name="wu" id="wu" class="form-check-input check-input w-100" {{ $type['wu'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="cheque" class="form-label text-white fw-bold">Cheque</label>
                    <input type="checkbox" name="cheque" id="cheque" class="form-check-input check-input w-100" {{ $type['cheque'] ? 'checked' : ''}}>
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center justify-content-end">
                    <label for="maintenance" class="form-label text-white fw-bold">Mainenance</label>
                    <input type="checkbox" name="maintenance" id="maintenance" class="form-check-input check-input w-100" {{ $type['maintenance'] ? 'checked' : ''}}>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-3 d-flex flex-column align-items-center">
                    <label for="date_from" class="form-label text-white fw-bold">Date From</label>
                    <input type="date" class="input w-100" id="date_from" name="date_from" value="{{ $date_from }}">
                </div>
                <div class="col-md-3 d-flex flex-column align-items-center">
                    <label for="date_till" class="form-label text-white fw-bold">Date Till</label>
                    <input type="date" class="input w-100" id="date_till" name="date_till" value="{{ $date_till }}">
                </div>
                <div class="col-md-3 d-flex flex-column align-items-center">
                    <label for="paid_from" class="form-label text-white fw-bold">Paid From</label>
                    <input type="date" class="input w-100" id="paid_from" name="paid_from"
                        value="{{ $paid_from ? $paid_from : ''}}">
                </div>
                <div class="col-md-3 d-flex flex-column align-items-center">
                    <label for="paid_till" class="form-label text-white fw-bold">Paid Till</label>
                    <input type="date" class="input w-100" id="paid_till" name="paid_till"
                        value="{{ $paid_till ? $paid_till : '' }}">
                </div>
                <div class="col-md-3 d-flex flex-column align-items-center">
                    <label for="credit" class="form-label text-white fw-bold">Credit</label>
                    <select name="credit" id="credit" class="input w-100">
                        <option value="" selected>Select A User</option>
                        <option value="admin">Admin</option>
                        @foreach ($resellers as $reseller)
                            <option value="{{ $reseller['Reseller'] }}">{{ $reseller['Reseller'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex flex-column align-items-center">
                    <label for="debit" class="form-label text-white fw-bold">Debit</label>
                    <select name="debit" id="debit" class="input w-100">
                        <option value="" selected>Select A User</option>
                        <option value="admin">Admin</option>
                        @foreach ($resellers as $reseller)
                            <option value="{{ $reseller['Reseller'] }}">{{ $reseller['Reseller'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex flex-column align-items-center">
                    <label for="username" class="form-label text-white fw-bold">Username</label>
                    <input type="text" class="input w-100" id="username" name="username"
                        value="{{ $username ? $username : '' }}">
                </div>
                <div class="col-md-1 d-flex flex-column align-items-center">
                    <label for="includereseller" class="form-label text-white fw-bold">Include Reseller</label>
                    <input type="checkbox" name="includereseller" id="includereseller"
                        class="form-check-input check-input w-100" {{ $includereseller ? 'checked' : ''}}>
                </div>
                <div class="col-md-2 d-flex flex-column align-items-center justify-content-end">
                    <button type="submit" class="input w-100 btn-glass-light fw-bold text-white text-shadow"><i
                            class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </form>
        @if(Route::is('dashboard.transactions'))
            <table class="glass-table">
                <thead>
                    <tr>
                        <th class="text-center text-white text-shadow fw-bold p-2">Date</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Paid On</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Debit</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Credit</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Username</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Name</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Basic</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Amount</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Type</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Method</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Description</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Comment</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Paid</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Expiry Date</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Service</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Old Balance</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">New Balance</th>
                        <th class="text-center text-white text-shadow fw-bold p-2">Done By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['transdate'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['paidon'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['payer'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['payee'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['username'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['fullname'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['basic_amount'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['amount'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['type'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['method'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">
                                {{ $transaction['description'] ? $transaction['description'] : '-'}}
                            </td>
                            <td class="text-white text-shadow p-2 text-center">
                                {{ $transaction['comment'] ? $transaction['comment'] : '-'}}
                            </td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['paid'] == 1 ? 'Yes' : 'No'}}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['expiry_date'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">
                                {{ $transaction['servicename'] ? $transaction['servicename'] : '-'}}
                            </td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['oldbalance'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">{{ $transaction['newbalance'] }}</td>
                            <td class="text-white text-shadow p-2 text-center">
                                {{ $transaction['done_by'] ? $transaction['done_by'] : '-'}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
@endsection
