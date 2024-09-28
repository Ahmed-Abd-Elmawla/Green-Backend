@extends('layouts.dashboard')
@section('page_title', 'Representative')
@section('content')
    {{-- <div class="card mb-4"> --}}
    {{-- <div class="card-header">
        <h3 class="card-title">Bordered Table</h3>
    </div> --}}
    <!-- /.card-header -->
    <div class="card-body m-3">
        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-outline-success rounded-0 float-end mb-2" data-bs-toggle="modal"
            {{-- data-bs-target="#CreatModal"> --}}
            onclick="openModal('create','/dashboard')">
            {{ __('dashboard.layout.create') }}
        </button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Task</th>
                    <th style="width:70px">{{ __('dashboard.layout.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr class="align-middle">
                    <td>1.</td>
                    <td>Update software</td>
                    {{-- <td><span class="badge text-bg-danger">55%</span></td> --}}
                    <td class="d-flex align-items-center border-start-0">
                        <a href="#"
                        {{-- data-bs-toggle="tooltip" --}}
                            data-bs-title="{{ __('dashboard.layout.edit_element') }}"
                            data-bs-toggle="modal"
                            {{-- data-bs-target="#EditModal" --}}
                            onclick="openModal('edit','/dashboard/123',123)">
                            <i class="bi bi-pencil-square fs-4 text-info"></i>
                        </a>
                        <a href="#" data-bs-toggle="tooltip"
                            data-bs-title="{{ __('dashboard.layout.delete_element') }}" class="ms-3 delete-btn"
                            onclick="deleteElement('123','ar/dashboard')">
                            <i class="bi bi-trash3 fs-4 text-danger"></i>
                        </a>
                    </td>
            </tbody>
        </table>

        <div class="clearfix">
            <ul class="pagination mt-2 m-0 float-end rounded-0">
                <li class="page-item"> <a class="page-link rounded-0" href="#">&laquo;</a> </li>
                <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                <li class="page-item"> <a class="page-link rounded-0" href="#">&raquo;</a> </li>
            </ul>
        </div>
    </div>
    <!-- /.card-body -->

    {{-- </div> <!-- /.card --> --}}


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
                    <form class="needs-validation" id="editCreateForm" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row g-3">

                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="validationCustom01" minlength="3" required>
                                    <div class="invalid-feedback">Please inter your name.</div>
                                </div>
                                <!--end::Col-->


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
                            <button type="submit"
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
    document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-title]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// When the modal is hidden, reset the form
document.getElementById('EditCreateModal').addEventListener('hidden.bs.modal', function () {
    var modalForm = document.getElementById('editCreateForm');
    modalForm.reset();  // Reset the form, which clears all inputs
});

function openModal(type, action, data = null) {
    var modal = new bootstrap.Modal(document.getElementById('EditCreateModal'));
    var modalTitle = document.getElementById('EditCreateModalLabel');
    // var modalBodyInput = document.getElementById('itemName');
    // var elementIdInput = document.getElementById('elementId');
    var modalForm = document.getElementById('editCreateForm');

    // Set content and form action based on the action type
    if (type === 'edit') {
        modalTitle.textContent = '{{__('dashboard.layout.edit_element')}}';
        // modalBodyInput.value = customContent;
        // elementIdInput.value = elementId;

        modalForm.action = action;



    } else if (type === 'create') {
        modalTitle.textContent = '{{__('dashboard.layout.create')}}';
        // modalBodyInput.value = '';  // Clear the input for a new item
        // elementIdInput.value = '';  // No element ID for creating

        modalForm.action = action;
    }

    modal.show();
}


</script>

@endsection
