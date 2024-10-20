@extends('layouts.dashboard')
@section('page_title')
    {{ __('dashboard.account.account_statement') }}
@endsection

@section('content')
    <div class="card card-success card-outline mb-4">
        <div class="card-body mt-3 mb-3">
            <input type="hidden" id="appLocal" value="{{ app()->getLocale() }}">
            <div class="alert alert-dark" role="alert" id="alert-warning">
                <i class="bi bi-info-circle"></i>
                {{ __('dashboard.validation.date') }}
            </div>

            <div class="row">
                <div class="col-sm-3 text-center">
                    <label class="form-label">{{ __('dashboard.layout.client_name') }}</label>
                    <select class="form-select" id="name_select" required>
                        <option selected disabled value="">{{ __('dashboard.layout.Choose') }}</option>
                        @foreach ($clientsData as $client)
                            <option value="{{ $client->uuid }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback-req" id="name_select-error"></span>
                </div>

                <div class="col-sm-3 text-center">
                    <label class="form-label">{{ __('dashboard.layout.type') }}</label>
                    <select class="form-select" id="type" required>
                        <option selected disabled value="">{{ __('dashboard.layout.Choose') }}</option>
                        <option value="all">{{ __('dashboard.layout.all') }}</option>
                        <option value="invoices">{{ __('dashboard.invoice.invoices') }}</option>
                        <option value="collections">{{ __('dashboard.collection.collections') }}</option>
                    </select>
                    <span class="invalid-feedback-req" id="type-error"></span>
                </div>

                <div class="col-sm-3 text-center">
                    <label class="form-label" for="startDate">{{ __('dashboard.layout.start_date') }}</label>
                    <input type="date" class="form-control" id="startDate" name="startDate">
                </div>

                <div class="col-sm-3 text-center">
                    <label class="form-label" for="endDate">{{ __('dashboard.layout.end_date') }}</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                </div>

            </div>
            <div class="col-sm-12 text-center">
                <label class="form-label"></label>
                <button type="button" class="btn btn-outline-success rounded-0 mt-5 mb-5" data-bs-toggle="modal"
                    onclick="getData()"><i class="fa-solid fa-magnifying-glass m-1 ms-0"></i>
                    {{ __('dashboard.layout.show') }}
                </button>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th scope="col">{{ __('dashboard.layout.date') }}</th>
                        <th scope="col">{{ __('dashboard.layout.creditor') }}</th>
                        <th scope="col">{{ __('dashboard.layout.debtor') }}</th>
                        <th scope="col">{{ __('dashboard.layout.type') }}</th>
                    </tr>
                </thead>
                <tbody id="tableBody">

                </tbody>
            </table>

            <div class="clearfix"></div>
            <div class="custom-pagination d-flex justify-content-center mt-5" id="paginationContainer">
            </div>
        </div>
        <!-- /.card-body -->

    </div> <!-- /.card -->

    <script>
        let currentPage = 1;
        const rowsPerPage = 10;
        let allData = [];

        function getData() {
            // Get the selected client UUID and other form data
            const clientUUID = document.getElementById('name_select').value;
            const type = document.getElementById('type').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            // Validate form inputs
            if (!clientUUID) {
                showError('{{ __('dashboard.validation.choose_name') }}');
                return;
            }

            if (!type) {
                showError('{{ __('dashboard.validation.choose_type') }}');
                return;
            }

            // Prepare the form data
            const formData = new FormData();
            formData.append('type', type);
            if (startDate) formData.append('start_date', startDate);
            if (endDate) formData.append('end_date', endDate);

            var local = document.getElementById('appLocal').value;
            const action = `/${local}/dashboard/statement/${clientUUID}`;

            // Make the fetch request
            fetch(action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => Promise.reject(data));
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        // Assuming 'data' contains the statement information
                        populateTable(data);
                    }
                })
                .catch(error => {
                    handleError(error);
                });
        }

        function populateTable(data) {
            allData = data;
            const tableBody = document.getElementById('tableBody');
            const paginationContainer = document.getElementById('paginationContainer');

            if (data.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="5" class="text-center">No data available.</td></tr>';
                paginationContainer.innerHTML = '';
                return;
            }

            displayTable(currentPage);
            if (data.length > rowsPerPage) {
                setupPagination();
            } else {
                paginationContainer.innerHTML = ''; // Hide pagination if not needed
            }
        }

        function displayTable(page) {
            const tableBody = document.getElementById('tableBody');
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = allData.slice(start, end);

            tableBody.innerHTML = '';
            paginatedData.forEach((item, index) => {
                const row = `
                    <tr>
                        <td>${start + index + 1}</td>
                        <td>${item.created_at}</td>
                        <td>${item.credit}</td>
                        <td>${item.debit}</td>
                        <td>${item.type}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        function setupPagination() {
            const paginationContainer = document.getElementById('paginationContainer');
            const pageCount = Math.ceil(allData.length / rowsPerPage);
            let paginationHTML = '';

            for (let i = 1; i <= pageCount; i++) {
                paginationHTML += `<li class="page-item ${i === currentPage ? 'activee' : ''}">
                                      <a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>
                                   </li>`;
            }

            paginationContainer.innerHTML = `
                <nav>
                    <ul class="pagination">
                        ${paginationHTML}
                    </ul>
                </nav>
            `;
        }

        function changePage(page) {
            currentPage = page;
            displayTable(currentPage);
            setupPagination();
        }

        function showError(message) {
            Swal.fire({
                icon: 'error',
                title: '{{ __('dashboard.validation.error') }}',
                text: message,
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-danger p-2 pe-3 ps-3',
                },
                confirmButtonText: '{{ __('dashboard.layout.close') }}',
            });
        }

        function handleError(error) {
            // Clear any existing validation errors
            document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

            // Handle validation errors
            if (error.errors) {
                for (const field in error.errors) {
                    const errorMessage = error.errors[field][0];
                    const errorElement = document.getElementById(`${field}-error`);
                    if (errorElement) {
                        errorElement.textContent = errorMessage;
                    }
                }
                showError(error.errors[Object.keys(error.errors)[0]][0]);
            } else {
                showError('{{ __('dashboard.validation.error_occurred') }}');
            }
        }
    </script>
@endsection
