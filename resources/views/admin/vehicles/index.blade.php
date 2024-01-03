<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Vehicle') }}
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
                        data: 'id',
                        name: 'id',
                        class: 'text-center'

                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'vehicle_category_id',
                        name: 'vehicle_category_id',
                        class: 'text-center'
                    },
                    {
                        data: 'color',
                        name: 'color',
                        class: 'text-center'
                    },
                    {
                        data: 'brand',
                        name: 'brand',
                        class: 'text-center'
                    },
                    {
                        data: 'type',
                        name: 'type',
                        class: 'text-center'
                    },
                    {
                        data: 'year_of_release',
                        name: 'year_of_release',
                        class: 'text-center'
                    },
                    {
                        data: 'rental_price',
                        name: 'rental_price',
                        class: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        class: 'text-center'
                    },
                    {
                        data: 'slug',
                        name: 'slug',
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
                    {{ __('Vehicle') }}
                </div>
                <div class="mb-0">
                    <a href="{{ route('admin.vehicles.create') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        {{ __('+ Add Vehicle') }}
                    </a>
                </div>
            </div>
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="dataTable" class="hover stripe">
                        <thead>
                            <tr>
                                <th>License Plate</th>
                                <th>Picture</th>
                                <th>Vehicle Category</th>
                                <th>Color</th>
                                <th>Brand</th>
                                <th>Type</th>
                                <th>Year Of Release</th>
                                <th>Rental Price</th>
                                <th>Status</th>
                                <th>Slug</th>
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
