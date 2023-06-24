@extends('layouts.admin')
@section('title', 'Credit To agent')
@push('scripts')
    <script>
        $('#agentId').select2();
    </script>
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Credit</h3>
                </div>
                <div style="overflow-x: scroll" class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-capitalize">
                                <th>Agent</th>
                                <th>Due Date</th>
                                <th>Credit Balance</th>
                                <th>Consumed Credit</th>
                                <th> Credit/Advance History</th>
                                <th> Usage History</th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ @$credit_balance->agentName }}</td>
                                <td>{{ @$credit_balance->dueDate }}</td>
                                <td><span class="tag tag-success">{{ @$credit_balance->balance }}</span>
                                </td>
                                <td><span class="tag tag-success">{{ @$credit_balance->consumedCredit }}</span>
                                </td>
                                @isset($credit_balance)
                                    <td>
                                        <a href="{{ route('credit.show', $credit_balance->agentId) }}" title="History"
                                            class="view-btn">
                                            <i class="fas fa-history"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('agent-history') }}" title="History" class="view-btn">
                                        <i class="fas fa-money-bill-alt    "></i>    
                                        </a>
                                    </td>
                                @endisset
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection
