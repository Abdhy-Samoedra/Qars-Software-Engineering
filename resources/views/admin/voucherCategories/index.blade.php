<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Voucher Category') }}
        </h2>
    </x-slot> --}}

    <x-slot name="script">
        <script>
            // AJAX DataTable
            var datatable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/en.json'
                },
                columns: [{
                        data: 'voucher_name',
                        name: 'voucher_name',
                        class: 'text-center'
                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'voucher_nominal',
                        name: 'voucher_nominal',
                        class: 'text-center'
                    },
                    {
                        data: 'voucher_price',
                        name: 'voucher_price',
                        class: 'text-center'
                    },
                    {
                        data: 'expired_date',
                        name: 'expired_date',
                        class: 'text-center'
                    },
                    {
                        data: 'minimum_spending',
                        name: 'minimum_spending',
                        class: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '15%'
                    },
                ],
            });
        </script>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between mb-5 ">
                <div class="text-3xl font-medium text-blue-950">
                    {{ __('Voucher Category') }}
                </div>
                <div class="mb-0">
                    <a href="{{ route('admin.voucherCategories.create') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        {{ __('+ Add Voucher Category') }}
                    </a>
                </div>
            </div>
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="dataTable" class="hover stripe">
                        <thead>
                            <tr>
                                <th>Voucher Name</th>
                                <th>Voucher Picture</th>
                                <th>Voucher Nominal</th>
                                <th>Voucher Price</th>
                                <th>Expired Date</th>
                                <th>Minimum Spending</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>