@extends('layouts.dashboard')
@section('page_title')
    {{ __('dashboard.finances.finances') }}
@endsection

@section('content')
    <div class="card card-success card-outline mb-4">
        <div class="card-body mt-3 mb-3">
            <input type="hidden" id="appLocal" value="{{ app()->getLocale() }}">
            {{-- <div class="alert alert-dark" role="alert" id="alert-warning">
                <i class="bi bi-info-circle"></i>
                {{ __('dashboard.validation.date') }}
            </div> --}}

            <div class="row">
                <div class="col-sm-4 text-center">
                    <div class="small-box text-bg-success">
                        <label class="form-label d-block fs-4">{{ __('dashboard.finances.total_income') }}</label>
                        <label class="form-label">{{$income}}</label>
                    </div>
                </div>

                <div class="col-sm-4 text-center">
                    <div class="small-box text-bg-primary">
                        <label class="form-label d-block fs-4">{{ __('dashboard.finances.total_postpaid') }}</label>
                        <label class="form-label">{{$postpaid * -1}}</label>
                    </div>
                </div>

                <div class="col-sm-4 text-center">
                    <div class="small-box text-bg-danger">
                        <label class="form-label d-block fs-4">{{ __('dashboard.finances.total_outcome') }}</label>
                        <label class="form-label">{{$outcome}}</label>
                    </div>
                </div>

                <div class="col-sm-4 text-center">
                    <label class="form-label">{{ __('dashboard.layout.type') }}</label>
                    <select class="form-select" id="type" required>
                        <option selected disabled value="">{{ __('dashboard.layout.Choose') }}</option>
                        <option value="income">{{ __('dashboard.layout.income') }}</option>
                        <option value="outcome">{{ __('dashboard.layout.outcome') }}</option>
                    </select>
                    <span class="invalid-feedback-req" id="type-error"></span>
                </div>

                <div class="col-sm-4 text-center">
                    <label class="form-label" for="startDate">{{ __('dashboard.layout.start_date') }}</label>
                    <input type="date" class="form-control" id="startDate" name="startDate">
                </div>

                <div class="col-sm-4 text-center">
                    <label class="form-label" for="endDate">{{ __('dashboard.layout.end_date') }}</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                </div>

            </div>
            <div class="col-sm-12 text-center">
                <label class="form-label"></label>
                <button type="button" class="btn btn-outline-success rounded-0 mt-5 mb-5" data-bs-toggle="modal"
                    onclick="getData()"><i class="fa-solid fa-magnifying-glass m-1 ms-0"></i>
                    {{ __('dashboard.layout.show_amount') }}
                </button>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-sm-4 text-center visually-hidden" id="income">
                    <div class="small-box text-bg-info">
                        <label class="form-label d-block fs-4">{{ __('dashboard.finances.total_income') }}</label>
                        <label class="form-label" id="income_lable"></label>
                    </div>
                </div>

                <div class="col-sm-4 text-center visually-hidden" id="outcome">
                    <div class="small-box text-bg-info">
                        <label class="form-label d-block fs-4">{{ __('dashboard.finances.total_outcome') }}</label>
                        <label class="form-label" id="outcome_lable"></label>
                    </div>
                </div>

            </div>

            <div class="clearfix"></div>
            <div class="custom-pagination d-flex justify-content-center mt-5" id="paginationContainer">
            </div>
        </div>
        <!-- /.card-body -->

    </div> <!-- /.card -->

    <script>
        function getData() {
            const type = document.getElementById('type').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const income = document.getElementById('income');
            const outcome = document.getElementById('outcome');

            if (!type) {
                showError('{{ __('dashboard.validation.choose_type') }}');
                return;
            }

            if (!startDate || !endDate) {
                showError('{{ __('dashboard.validation.choose_date') }}');
                return;
            }

            // Prepare the form data
            const formData = new FormData();
            formData.append('type', type);
            if (startDate) formData.append('start_date', startDate);
            if (endDate) formData.append('end_date', endDate);

            var local = document.getElementById('appLocal').value;
            const action = `/${local}/dashboard/finances`;

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
                        if(data.type == 'income'){
                            income.querySelector('#income_lable').textContent = data.data;
                            income.classList.remove('visually-hidden');
                            outcome.classList.add('visually-hidden');
                        }else{
                            outcome.querySelector('#outcome_lable').textContent = data.data;
                            outcome.classList.remove('visually-hidden');
                            income.classList.add('visually-hidden');
                        }
                    }
                })
                .catch(error => {
                    handleError(error);
                });
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
