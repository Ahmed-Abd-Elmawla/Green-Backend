@extends('layouts.dashboard')
@section('page_title')
    {{ __('dashboard.client.clients') }}
@endsection

@section('content')
    <div class="card card-success card-outline mb-4">
        {{-- <div class="card-header">
        <h3 class="card-title">Bordered Table</h3>
    </div> --}}
        <!-- /.card-header -->
        <div class="card-body mt-3 mb-3">
            <!-- Button to trigger modal -->
            {{-- <button type="button" class="btn btn-outline-success rounded-0 float-end mb-2" data-bs-toggle="modal"
                    onclick="openModal('create')"><i
                    class="bi bi-person-plus-fill m-1 ms-0"></i>
                {{ __('dashboard.client.add') }}
            </button> --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th scope="col">{{ __('dashboard.layout.name') }}</th>
                        <th scope="col">{{ __('dashboard.layout.email') }}</th>
                        <th scope="col">{{ __('dashboard.layout.phone') }}</th>
                        <th scope="col">{{ __('dashboard.layout.phone2') }}</th>
                        <th scope="col">{{ __('dashboard.layout.address') }}</th>
                        <th scope="col">{{ __('dashboard.layout.representative') }}</th>
                        <th style="width:108px">{{ __('dashboard.layout.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientsData as $client)
                        <tr class="align-middle table-row-height">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->phone2 }}</td>
                            <td>{{ $client->address }}</td>
                            <td class="p-0">
                                <div class="actions-cell">
                                    <a href="#" class="btn btn-link"
                                        data-bs-title="{{ __('dashboard.client.show') }}"
                                        onclick="openInfoModal({{ json_encode($client->user) }})">
                                        <i class="bi bi-eye fs-4 text-warning"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="p-0">
                                <div class="actions-cell">
                                    <a href="#" class="btn btn-link"
                                        data-bs-title="{{ __('dashboard.client.update') }}"
                                        onclick="openModal('edit',{{ json_encode($client) }})">
                                        <i class="bi bi-pencil-square fs-4 text-info"></i>
                                    </a>
                                    <a href="#" class="btn btn-link"
                                        data-bs-title="{{ __('dashboard.client.delete') }}"
                                        onclick="deleteElement('{{ $client->uuid }}','{{ app()->getLocale() }}/dashboard/clients')">
                                        <i class="bi bi-trash3 fs-4 text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="clearfix"></div>
            <div class="custom-pagination d-flex justify-content-center mt-5">
                {{ $clientsData->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <!-- /.card-body -->

    </div> <!-- /.card -->


    <!-- Start Edit Modal -->
    <div class="modal fade" id="EditCreateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="EditCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Using the modal-lg class for a large modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditCreateModalLabel">title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <div class="alert alert-info" role="alert" id="alert-warning">
                        <i class="bi bi-info-circle"></i>
                        {{ __('dashboard.validation.update_person') }}
                    </div> --}}
                    <form class="needs-validation" id="editCreateForm" enctype="multipart/form-data" novalidate>
                        {{-- @csrf --}}
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row g-3">
                                <input type="hidden" id="itemId">
                                <input type="hidden" id="appLocal" value="{{ app()->getLocale() }}">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">{{ __('dashboard.layout.name') }}</label>
                                    <input type="text" class="form-control" id="name" minlength="2" required>
                                    <div class="invalid-feedback">{{ __('dashboard.validation.inter_name') }}</div>
                                    <span class="invalid-feedback-req" id="name-error"></span>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">{{ __('dashboard.layout.email') }}</label>
                                    <input type="email" class="form-control" id="email" required>
                                    <div class="invalid-feedback">{{ __('dashboard.validation.inter_email') }}</div>
                                    <span class="invalid-feedback-req" id="email-error"></span>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">{{ __('dashboard.layout.phone') }}</label>
                                    <input type="text" class="form-control" id="phone" minlength="11" required>
                                    <div class="invalid-feedback">{{ __('dashboard.validation.inter_phone') }}</div>
                                    <span class="invalid-feedback-req" id="phone-error"></span>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="phone2" class="form-label">{{ __('dashboard.layout.phone2') }}</label>
                                    <input type="text" class="form-control" id="phone2" minlength="11" required>
                                    <div class="invalid-feedback">{{ __('dashboard.validation.inter_phone') }}</div>
                                    <span class="invalid-feedback-req" id="phone2-error"></span>
                                </div>
                                <!--end::Col-->
                                <div class="col-md-12">
                                    <label for="address" class="form-label">{{ __('dashboard.layout.address') }}</label>
                                    <input type="text" class="form-control" id="address" required>
                                    <div class="invalid-feedback">{{ __('dashboard.validation.inter_address') }}</div>
                                    <span class="invalid-feedback-req" id="address-error"></span>
                                </div>
                                {{-- <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="validationCustom03" class="form-label">City</label>
                                    <input type="text" class="form-control" id="validationCustom030" required>
                                    <div class="invalid-feedback">Please provide a valid city.</div>
                                </div>
                                <!--end::Col--> --}}

                                {{-- <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">State</label>
                                    <select class="form-select" id="validationCustom04" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option>...</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a valid state.</div>
                                </div> <!--end::Col--> --}}


                            </div> <!--end::Body-->
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-outline-danger"
                                data-bs-dismiss="modal">{{ __('dashboard.layout.close') }}</button>
                            <button id="editFormSubmit" onclick="submitForm(event,'edit')"
                                class="btn btn-outline-success">{{ __('dashboard.layout.save') }}</button>
                            {{-- <button id="CreateFormSubmit" onclick="submitForm(event)"
                                class="btn btn-outline-success">{{ __('dashboard.layout.save') }}</button> --}}
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit Modal -->

    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-title]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // When the modal is hidden, reset the form
        document.getElementById('EditCreateModal').addEventListener('hidden.bs.modal', function() {
            var modalForm = document.getElementById('editCreateForm');
            modalForm.reset();
        });

        function openModal(type, data = null) {
            var modal = new bootstrap.Modal(document.getElementById('EditCreateModal'));
            var modalTitle = document.getElementById('EditCreateModalLabel');
            var itemId = document.getElementById('itemId');
            var name = document.getElementById('name');
            var email = document.getElementById('email');
            var phone = document.getElementById('phone');
            var phone2 = document.getElementById('phone2');
            var address = document.getElementById('address');
            // var editBtn = document.getElementById('editFormSubmit');
            // var CreateBtn = document.getElementById('CreateFormSubmit');
            // var alert = document.getElementById('alert-warning');

            // Set content and form action based on the action type
            if (type === 'edit') {
                modalTitle.textContent = '{{ __('dashboard.client.update') }}';
                // alert.style.display = 'block'
                itemId.value = data.id;
                name.value = data.name;
                email.value = data.email;
                phone.value = data.phone;
                phone2.value = data.phone2;
                address.value = data.address;
                // editBtn.style.display = 'block'
                // CreateBtn.style.display = 'none'

            } else if (type === 'create') {
                modalTitle.textContent = '{{ __('dashboard.representative.add') }}';
                // alert.style.display = 'none'
                // editBtn.style.display = 'none'
                // CreateBtn.style.display = 'block'
            }
            modal.show();
        }

        function openInfoModal(data) {
            var modal = new bootstrap.Modal(document.getElementById('InfoModal'));
            var modalTitle = document.getElementById('InfoModalLabel');
            var image = document.getElementById('info-image');
            var name = document.getElementById('info-name');
            var email = document.getElementById('info-email');
            var phone = document.getElementById('info-phone');
            // var address = document.getElementById('address');

                itemId.value = data.id;
                image.src = data.image;
                name.innerHTML = data.name;
                email.innerHTML = data.email;
                phone.innerHTML = data.phone;
                // address.value = data.address;

            modal.show();
        }
    </script>

    <script>
        function submitForm(event, type = null) {
            if (event) {
                event.preventDefault();
            }
            // Prevent form submission if passwords don't match
            // if (!passwordMatch()) {
            //     return;
            // }

            // Create a new FormData object and append form fields
            var formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            // formData.append('password', document.getElementById('password').value);
            // formData.append('password_confirmation', document.getElementById('password_confirmation').value);
            formData.append('phone', document.getElementById('phone').value);
            formData.append('phone', document.getElementById('phone').value);
            formData.append('address', document.getElementById('address').value);
            // formData.append('image', document.getElementById('image').files[0]);

            if(document.getElementById('phone2').value != '') {
                formData.append('phone2', document.getElementById('phone2').value);
            }
            // if(document.getElementById('password_confirmation').value != '') {
            //     formData.append('password_confirmation', document.getElementById('password_confirmation').value);
            // }

            // Get the UUID and locale
            var uuid = document.getElementById('itemId').value;
            var local = document.getElementById('appLocal').value;
            var action = ''

            if (type === 'edit') {
                action = `/${local}/dashboard/clients/update/${uuid}`;
            } else {
                action = `/${local}/dashboard/clients/store`;
            }

            // Perform the fetch request
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
                    }
                })
                .catch(error => {
                    // console.error('Error:', error);
                    // Clear any existing validation errors
                    document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

                    // Handle validation errors
                    if (error.errors) {
                        for (const field in error.errors) {
                            const errorMessage = error.errors[field][0];
                            document.getElementById(`${field}-error`).textContent = errorMessage;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: '{{ __('dashboard.validation.error') }}',
                            text: error.errors[Object.keys(error.errors)[0]][0],
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'btn btn-outline-danger p-2 pe-3 ps-3',
                            },
                            confirmButtonText: '{{ __('dashboard.layout.close') }}',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: '{{ __('dashboard.validation.error') }}',
                            text: '{{ __('dashboard.validation.error_occurred') }}',
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'btn btn-outline-danger p-2 pe-3 ps-3',
                            },
                            confirmButtonText: '{{ __('dashboard.layout.close') }}',
                        });
                    }
                });
        }
    </script>

        <!-- Start show Modal -->
        <div class="modal fade" id="InfoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="InfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- Using the modal-lg class for a large modal -->
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="EditCreateModalLabel">title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                <div class="modal-body info-modal">

                    {{-- <div class="card"> --}}
                        <div class="container">
                        <img id="info-image" alt="User image" class="card__image rounded-circle mt-3" width="100" height="100" />
                        <div class="card__text">
                          <h2 class="mt-3" id="info-name"></h2>
                          <p id="info-email"></p>
                          <p id="info-phone"></p>
                        </div>
                    <button type="button" class="btn btn-outline-danger mt-3" data-bs-dismiss="modal" aria-label="Close">{{ __('dashboard.layout.close') }}</button>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End show Modal -->
@endsection
