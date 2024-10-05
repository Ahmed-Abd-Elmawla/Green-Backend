@extends('layouts.dashboard')
@section('page_title')
    {{ __('dashboard.product.product') }}
@endsection

@section('content')
    <div class="card card-success card-outline mb-4">
        {{-- <div class="card-header">
        <h3 class="card-title">Bordered Table</h3>
    </div> --}}
        <!-- /.card-header -->
        <div class="card-body mt-3 mb-3">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-outline-success rounded-0 float-end mb-2" data-bs-toggle="modal"
                onclick="openModal('create')"><i class="bi bi-person-plus-fill m-1 ms-0"></i>
                {{ __('dashboard.product.add') }}
            </button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th scope="col">{{ __('dashboard.layout.image') }}</th>
                        <th scope="col">{{ __('dashboard.layout.name') }}</th>
                        <th scope="col">{{ __('dashboard.layout.stock') }}</th>
                        <th scope="col">{{ __('dashboard.layout.unit') }}</th>
                        <th scope="col">{{ __('dashboard.layout.price') }}</th>
                        <th scope="col">{{ __('dashboard.layout.offer') }}</th>
                        <th scope="col">{{ __('dashboard.layout.category') }}</th>
                        <th scope="col">{{ __('dashboard.layout.supplier') }}</th>
                        <th style="width:108px">{{ __('dashboard.layout.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsData as $product)
                        <tr class="align-middle table-row-height">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="ul-widget-app__profile-pic">
                                    <img class="rounded-circle" src="{{ $product->image }}" width="60" height="60">
                                </div>
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->unit }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->offer }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->supplier->name }}</td>

                            <td class="p-0">
                                <div class="actions-cell">
                                    <a href="#" class="btn btn-link"
                                        data-bs-title="{{ __('dashboard.product.update') }}"
                                        onclick="openModal('edit',{{ json_encode($product) }})">
                                        <i class="bi bi-pencil-square fs-4 text-info"></i>
                                    </a>
                                    <a href="#" class="btn btn-link"
                                        data-bs-title="{{ __('dashboard.product.delete') }}"
                                        onclick="deleteElement('{{ $product->uuid }}','{{ app()->getLocale() }}/dashboard/products')">
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
                {{ $productsData->links('pagination::bootstrap-4') }}
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
                    <div class="alert alert-info" role="alert" id="alert-warning">
                        <i class="bi bi-info-circle"></i>
                        {{ __('dashboard.validation.update_product') }}<br>
                        <i class="bi bi-info-circle"></i>
                        {{ __('dashboard.validation.update_product_2') }}
                    </div>
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
                                    <label for="supplier_id"
                                        class="form-label">{{ __('dashboard.layout.supplier') }}</label>
                                    <select class="form-select" id="supplier_id" required>
                                        <option selected disabled value="">{{ __('dashboard.layout.Choose') }}
                                        </option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ __('dashboard.validation.inter_supplier') }}</div>
                                    <span class="invalid-feedback-req" id="supplier_id-error"></span>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="category_id"
                                        class="form-label">{{ __('dashboard.layout.category') }}</label>
                                    <select class="form-select" id="category_id" required>
                                        <option selected disabled value="">{{ __('dashboard.layout.Choose') }}
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ __('dashboard.validation.inter_category') }}</div>
                                    <span class="invalid-feedback-req" id="category_id-error"></span>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="stock" class="form-label">{{ __('dashboard.layout.stock') }}</label>
                                    <input type="number" step="any" class="form-control" id="stock"
                                        minlength="8">
                                    <div class="invalid-feedback">{{ __('dashboard.validation.inter_stock') }}</div>
                                    <span class="invalid-feedback-req" id="stock-error"></span>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="unit" class="form-label">{{ __('dashboard.layout.unit') }}</label>
                                    <select class="form-select" id="unit" required>
                                        <option selected disabled value="">{{ __('dashboard.layout.Choose') }}
                                        </option>
                                        <option value="liter">{{ __('dashboard.layout.liter') }}</option>
                                        <option value="milliliter">{{ __('dashboard.layout.milliliter') }}</option>
                                        <option value="package">{{ __('dashboard.layout.package') }}</option>
                                        <option value="carton">{{ __('dashboard.layout.carton') }}</option>
                                    </select>
                                    <div class="invalid-feedback">{{ __('dashboard.validation.inter_unit') }}</div>
                                    <span class="invalid-feedback-req" id="unit-error"></span>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="price" class="form-label">{{ __('dashboard.layout.price') }}</label>
                                    <input type="number" step="any" class="form-control" id="price"
                                        minlength="8">
                                    <div class="invalid-feedback">{{ __('dashboard.validation.inter_price') }}</div>
                                    <span class="invalid-feedback-req" id="price-error"></span>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="offer" class="form-label">{{ __('dashboard.layout.offer') }}</label>
                                    <input type="number" step="any" class="form-control" id="offer" required>
                                    {{-- <div class="invalid-feedback">{{ __('dashboard.validation.inter_offer') }}</div> --}}
                                    <span class="invalid-feedback-req" id="offer-error"></span>
                                </div>
                                <!--end::Col-->
                                <div class="col-md-6">
                                    <label for="image" class="form-label">{{ __('dashboard.layout.image') }}</label>
                                    <input type="file" class="form-control" id="image">
                                    <div class="invalid-feedback">{{ __('dashboard.validation.inter_image') }}</div>
                                    <span class="invalid-feedback-req" id="image-error"></span>
                                </div>
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="desc" class="form-label">{{ __('dashboard.layout.desc') }}</label>
                                    <input type="textarea" class="form-control" id="desc" required>
                                    <div class="invalid-feedback">{{ __('dashboard.validation.inter_desc') }}</div>
                                    <span class="invalid-feedback-req" id="desc-error"></span>
                                </div>
                                <!--end::Col-->
                                {{-- <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="validationCustom03" class="form-label">City</label>
                                    <input type="text" class="form-control" id="validationCustom030" required>
                                    <div class="invalid-feedback">Please provide a valid city.</div>
                                </div>
                                <!--end::Col--> --}}

                            </div> <!--end::Body-->
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-outline-danger"
                                data-bs-dismiss="modal">{{ __('dashboard.layout.close') }}</button>
                            <button id="editFormSubmit" onclick="submitForm(event,'edit')"
                                class="btn btn-outline-success">{{ __('dashboard.layout.save') }}</button>
                            <button id="CreateFormSubmit" onclick="submitForm(event)"
                                class="btn btn-outline-success">{{ __('dashboard.layout.save') }}</button>
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
            var desc = document.getElementById('desc');
            var stock = document.getElementById('stock');
            var unit = document.getElementById('unit');
            var price = document.getElementById('price');
            var offer = document.getElementById('offer');
            var supplier = document.getElementById('supplier_id');
            var category = document.getElementById('category_id');

            var editBtn = document.getElementById('editFormSubmit');
            var CreateBtn = document.getElementById('CreateFormSubmit');
            var alert = document.getElementById('alert-warning');

            // Set content and form action based on the action type
            if (type === 'edit') {
                modalTitle.textContent = '{{ __('dashboard.product.update') }}';
                alert.style.display = 'block'
                itemId.value = data.id;
                name.value = data.name;
                desc.value = data.desc;
                stock.value = data.stock;
                unit.value = data.unit;
                price.value = data.price;
                offer.value = data.offer;
                supplier.value = data.supplier_id;
                category.value = data.category_id;

                editBtn.style.display = 'block'
                CreateBtn.style.display = 'none'

            } else if (type === 'create') {
                modalTitle.textContent = '{{ __('dashboard.product.add') }}';
                offer.value = '0';
                alert.style.display = 'none'
                editBtn.style.display = 'none'
                CreateBtn.style.display = 'block'
            }
            modal.show();
        }
    </script>

    <script>
        function submitForm(event, type = null) {
            if (event) {
                event.preventDefault();
            }

            // Create a new FormData object and append form fields
            var formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('desc', document.getElementById('desc').value);
            formData.append('stock', document.getElementById('stock').value);
            formData.append('unit', document.getElementById('unit').value);
            formData.append('price', document.getElementById('price').value);
            formData.append('offer', document.getElementById('offer').value);
            formData.append('supplier_id', document.getElementById('supplier_id').value);
            formData.append('category_id', document.getElementById('category_id').value);
            // formData.append('image', document.getElementById('image').files[0]);

            var imageInput = document.getElementById('image');

            if (imageInput.files && imageInput.files[0]) {
                formData.append('image', document.getElementById('image').files[0]);
            }

            // Get the UUID and locale
            var uuid = document.getElementById('itemId').value;
            var local = document.getElementById('appLocal').value;
            var action = ''

            if (type === 'edit') {
                action = `/${local}/dashboard/products/update/${uuid}`;
            } else {
                action = `/${local}/dashboard/products/store`;
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
@endsection
