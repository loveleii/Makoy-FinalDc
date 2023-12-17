@extends('base')

@include('navbar')

@section('content')
    <div class="container">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="table-heading mb-0">Summary of Charges</h2>
                <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#createChargeModal">
                    Create Charge
                </button>
            </div>

            <div class="table-wrapper">
                @if(count($charges) > 0)
                    <table class="custom-table">
                        <thead class="custom-thead">
                            <tr>
                                <th>ID</th>
                                <th>Charge Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($charges as $charge)
                                <tr>
                                    <td>{{ $charge->id }}</td>
                                    <td>{{ $charge->charge_description }}</td>
                                    <td>{{ $charge->amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No charges found.</p>
                @endif
            </div>
            <div class="total-amount text-end mt-3">
                <strong>Total Amount: {{ $totalAmount }}</strong>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createChargeModal" tabindex="-1" aria-labelledby="createChargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createChargeModalLabel">Create Charge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('charges.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="charge_description" class="form-label">Charge Description:</label>
                            <select class="form-select" id="charge_description" name="charge_description" required>
                                <option value="IPT">Information Processes and Technology</option>
                                <option value="DC 06">Domain Course</option>
                                <option value="IAS">Information Assurance System</option>
                                <option value="PL">Philippine Literature</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount:</label>
                            <input type="text" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var totalAmount = 0;
            @foreach($charges as $charge)
                totalAmount += {{ $charge->amount }};
            @endforeach

            document.querySelector('.total-amount strong').textContent = 'Total Amount: ' + totalAmount.toFixed(2);
        });
    </script>
@endsection

<style>
    /* Add your custom styles here */

    .table-container {
        margin-bottom: 2rem;
    }

    .table-heading {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .btn-primary {
        padding: 0.5rem 1rem;
        background-color: #3490dc;
        color: #fff;
        text-decoration: none;
        border-radius: 0.25rem;
        display: inline-block;
    }

    .table-wrapper {
        margin-top: 1rem;
        overflow-x: auto;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    .custom-thead {
        background-color: rgb(173, 164, 164);
    }

    .custom-table th,
    .custom-table td {
        padding: 0.75rem;
        text-align: center;
        border: 1px solid #e2e8f0;
    }

    .no-charges-msg {
        text-align: center;
    }
</style>
