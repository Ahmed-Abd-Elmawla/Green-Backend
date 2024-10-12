@extends('layouts.dashboard')
@section('page_title')
    {{ __('dashboard.expense.expenses') }}
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
                        <th scope="col">{{ __('dashboard.layout.amount') }}</th>
                        <th scope="col">{{ __('dashboard.layout.desc') }}</th>
                        <th scope="col">{{ __('dashboard.layout.date') }}</th>
                        <th scope="col">{{ __('dashboard.layout.representative') }}</th>
                        <th style="width:108px">{{ __('dashboard.layout.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expensesData as $expense)
                        <tr class="align-middle table-row-height">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $expense->user->name }}</td>
                            <td>{{ $expense->amount }}</td>
                            <td>{{ $expense->desc }}</td>
                            <td>{{ $expense->created_at }}</td>
                            <td class="p-0">
                                <div class="actions-cell">
                                    <a href="#" class="btn btn-link"
                                        data-bs-title="{{ __('dashboard.expense.show') }}"
                                        onclick="openInfoModal({{ json_encode($expense->user) }})">
                                        <i class="bi bi-eye fs-4 text-warning"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="p-0">
                                <div class="actions-cell">
                                    {{-- <a href="#" class="btn btn-link"
                                        data-bs-title="{{ __('dashboard.expense.update') }}"
                                        onclick="openModal('edit',{{ json_encode($expense) }})">
                                        <i class="bi bi-pencil-square fs-4 text-info"></i>
                                    </a> --}}
                                    <a href="#" class="btn btn-link"
                                        data-bs-title="{{ __('dashboard.expense.delete') }}"
                                        onclick="deleteElement('{{ $expense->uuid }}','{{ app()->getLocale() }}/dashboard/expenses')">
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
                {{ $expensesData->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <!-- /.card-body -->

    </div> <!-- /.card -->


    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-title]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        function openInfoModal(data) {
            var modal = new bootstrap.Modal(document.getElementById('InfoModal'));
            var image = document.getElementById('info-image');
            var name = document.getElementById('info-name');
            var email = document.getElementById('info-email');
            var phone = document.getElementById('info-phone');
            // var address = document.getElementById('address');

                image.src = data.image;
                name.innerHTML = data.name;
                email.innerHTML = data.email;
                phone.innerHTML = data.phone;
                // address.value = data.address;

            modal.show();
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
