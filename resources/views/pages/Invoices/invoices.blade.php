@extends('layouts.dashboard')
@section('page_title')
    {{ __('dashboard.invoice.invoices') }}
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
                        <th scope="col">{{ __('dashboard.layout.code') }}</th>
                        <th scope="col">{{ __('dashboard.layout.name') }}</th>
                        <th scope="col">{{ __('dashboard.layout.payment_type') }}</th>
                        <th scope="col">{{ __('dashboard.layout.total_amount') }}</th>
                        <th scope="col">{{ __('dashboard.layout.paid') }}</th>
                        <th scope="col">{{ __('dashboard.layout.remaining') }}</th>
                        <th scope="col">{{ __('dashboard.layout.date') }}</th>
                        <th style="width:108px">{{ __('dashboard.layout.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoicesData as $invoice)
                        <tr class="align-middle table-row-height">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $invoice->code }}</td>
                            <td>{{ $invoice->client->name }}</td>
                            <td>{{ __('dashboard.layout.'.$invoice->payment_type) }}</td>
                            <td>{{ $invoice->total_amount }}</td>
                            <td>{{ $invoice->paid }}</td>
                            <td>{{ $invoice->remaining }}</td>
                            <td>{{ $invoice->created_at }}</td>
                            <td class="p-0">
                                <div class="actions-cell">
                                    <a href="#" class="btn btn-link"
                                        data-bs-title="{{ __('dashboard.invoice.show') }}"
                                        onclick="openInfoModal({{ json_encode($invoice) }})">
                                        <i class="bi bi-eye fs-4 text-warning"></i>
                                    </a>
                                    <a href="#" class="btn btn-link"
                                        data-bs-title="{{ __('dashboard.invoice.delete') }}"
                                        onclick="deleteElement('{{ $invoice->uuid }}','{{ app()->getLocale() }}/dashboard/invoices')">
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
                {{ $invoicesData->links('pagination::bootstrap-4') }}
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


        const translations = {
            package: "{{ __('dashboard.layout.package') }}",
            liter: "{{ __('dashboard.layout.liter') }}",
            milliliter: "{{ __('dashboard.layout.milliliter') }}",
            carton: "{{ __('dashboard.layout.carton') }}",
        };

        const paymentTypeTranslations = {
            cash: "{{ __('dashboard.layout.cash') }}",
            postpaid: "{{ __('dashboard.layout.postpaid') }}",
        };

        function openInfoModal(invoice) {
            console.log(invoice)
            var modal = new bootstrap.Modal(document.getElementById('InfoModal'));
            document.getElementById('infoModalLabel').textContent = '{{ __('dashboard.invoice.info') }}';

            document.getElementById('_name').textContent = invoice.user.name;
            document.getElementById('_email').textContent = invoice.user.email;
            document.getElementById('_phone').textContent = invoice.user.phone;
            document.getElementById('_address').textContent = invoice.user.address;
            document.getElementById('info-image').src = invoice.user.image;



            document.getElementById('name_').textContent = invoice.client.name;
            document.getElementById('email_').textContent = invoice.client.email;
            document.getElementById('phone_').textContent = invoice.client.phone;
            document.getElementById('address_').textContent = invoice.client.address;
            document.getElementById('dues').textContent = invoice.client.dues;
            document.getElementById('balance').textContent = invoice.client.balance;
            document.getElementById('net_account').textContent = invoice.client.net_account;


            document.getElementById('code').textContent = invoice.code;
            document.getElementById('date').textContent = invoice.created_at;
            document.getElementById('total_amount').textContent = invoice.total_amount;
            let paymentTranslation = paymentTypeTranslations[invoice.payment_type] || invoice.payment_type;
            document.getElementById('payment').textContent = paymentTranslation;
            document.getElementById('paid').textContent = invoice.paid;
            document.getElementById('remaining').textContent = invoice.remaining;


            let productsTableBody = document.getElementById('productsInfo');
            productsTableBody.innerHTML = '';


            invoice.products.forEach((product, index) => {
                let unitTranslation = translations[product.unit] || product.unit;

                let row = `<tr class="align-middle table-row-height">
                <td>${index + 1}</td>
                <td>
                    <div class="ul-widget-app__profile-pic">
                        <img class="rounded-circle" src="${product.image}" width="60" height="60">
                    </div>
                </td>
                <td>${product.name}</td>
                <td>${product.price}</td>
                <td>${product.quantity}</td>
                <td>${unitTranslation}</td>
            </tr>`;
                productsTableBody.innerHTML += row;
            });

            modal.show();
        }
    </script>


    <!-- Start show Modal -->
    <div class="modal fade" id="InfoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="InfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Using the modal-lg class for a large modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="editCreateForm" enctype="multipart/form-data" novalidate>
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row g-3">
                                <input type="hidden" id="itemId">
                                <input type="hidden" id="appLocal" value="{{ app()->getLocale() }}">
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <i class="nav-icon fa-solid fa-user-gear"></i>
                                    <label for="representative_info"
                                        class="form-label text-decoration-underline fw-bolder text-warning m-1">{{ __('dashboard.layout.representative_info') }}</label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-12 text-center">
                                    <img id="info-image" alt="User image" class="card__image rounded-circle mt-3" width="150" height="150" />
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="name"
                                        class="form-label">{{ __('dashboard.layout.representative_name') }}&nbsp;:&nbsp;</label>
                                    <label for="name" class="form-label text-success" id="_name"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="email"
                                        class="form-label">{{ __('dashboard.layout.email') }}&nbsp;:&nbsp;</label>
                                    <label for="email" class="form-label text-success" id="_email"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="phone"
                                        class="form-label">{{ __('dashboard.layout.phone') }}&nbsp;:&nbsp;</label>
                                    <label for="phone" class="form-label text-success" id="_phone"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="address"
                                        class="form-label">{{ __('dashboard.layout.address') }}&nbsp;:&nbsp;</label>
                                    <label for="address" class="form-label text-success" id="_address"></label>
                                </div>
                                <!--end::Col-->


                                <div>
                                    <hr class="opacity-25">
                                    </div>


                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <i class="nav-icon bi bi-person-vcard-fill"></i>
                                    <label for="client_info"
                                        class="form-label text-decoration-underline fw-bolder text-warning m-1">{{ __('dashboard.layout.client_info') }}</label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="name"
                                        class="form-label">{{ __('dashboard.layout.client_name') }}&nbsp;:&nbsp;</label>
                                    <label for="name" class="form-label text-success" id="name_"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="email"
                                        class="form-label">{{ __('dashboard.layout.email') }}&nbsp;:&nbsp;</label>
                                    <label for="email" class="form-label text-success" id="email_"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="phone"
                                        class="form-label">{{ __('dashboard.layout.phone') }}&nbsp;:&nbsp;</label>
                                    <label for="phone" class="form-label text-success" id="phone_"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="address"
                                        class="form-label">{{ __('dashboard.layout.address') }}&nbsp;:&nbsp;</label>
                                    <label for="address" class="form-label text-success" id="address_"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4">
                                    <label for="dues"
                                        class="form-label">{{ __('dashboard.layout.dues') }}&nbsp;:&nbsp;</label>
                                    <label for="dues" class="form-label text-success" id="dues"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4">
                                    <label for="balance"
                                        class="form-label">{{ __('dashboard.layout.balance') }}&nbsp;:&nbsp;</label>
                                    <label for="balance" class="form-label text-success" id="balance"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4">
                                    <label for="net_account"
                                        class="form-label">{{ __('dashboard.layout.net_account') }}&nbsp;:&nbsp;</label>
                                    <label for="net_account" class="form-label text-success" id="net_account"></label>
                                </div>
                                <!--end::Col-->
                                <div>
                                    <hr class="opacity-25">
                                    </div>
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <i class="nav-icon fa-solid fa-file-invoice"></i>
                                    <label for="invoice_info"
                                        class="form-label text-decoration-underline fw-bolder text-warning m-1">{{ __('dashboard.layout.invoice_info') }}</label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4">
                                    <label for="code"
                                        class="form-label">{{ __('dashboard.layout.code') }}&nbsp;:&nbsp;</label>
                                    <label for="code" class="form-label text-success" id="code"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4">
                                    <label for="date"
                                        class="form-label">{{ __('dashboard.layout.date') }}&nbsp;:&nbsp;</label>
                                    <label for="date" class="form-label text-success" id="date"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4">
                                    <label for="payment"
                                        class="form-label">{{ __('dashboard.layout.payment_type') }}&nbsp;:&nbsp;</label>
                                    <label for="payment" class="form-label text-success" id="payment"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4">
                                    <label for="total_amount"
                                        class="form-label">{{ __('dashboard.layout.total_amount') }}&nbsp;:&nbsp;</label>
                                    <label for="total_amount" class="form-label text-success" id="total_amount"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4">
                                    <label for="paid"
                                        class="form-label">{{ __('dashboard.layout.paid') }}&nbsp;:&nbsp;</label>
                                    <label for="paid" class="form-label text-success" id="paid"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-4">
                                    <label for="remaining"
                                        class="form-label">{{ __('dashboard.layout.remaining') }}&nbsp;:&nbsp;</label>
                                    <label for="remaining" class="form-label text-success" id="remaining"></label>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th scope="col">{{ __('dashboard.layout.image') }}</th>
                                                <th scope="col">{{ __('dashboard.layout.name') }}</th>
                                                <th scope="col">{{ __('dashboard.layout.price') }}</th>
                                                <th scope="col">{{ __('dashboard.layout.quantity') }}</th>
                                                <th scope="col">{{ __('dashboard.layout.unit') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="productsInfo">

                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Col-->

                            </div>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-outline-danger"
                                data-bs-dismiss="modal">{{ __('dashboard.layout.close') }}</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
        <!-- End show Modal -->
    @endsection
