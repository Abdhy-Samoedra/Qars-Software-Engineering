<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Vehicle') }}
        </h2>
    </x-slot>

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
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
                },
                columns: [{
                        data: 'license_plate',
                        name: 'license_plate',
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
                        data: 'merk',
                        name: 'merk',
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

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('admin.vehicles.create') }}"
                    class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    + Buat Vehicle
                </a>
            </div>
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="dataTable">
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