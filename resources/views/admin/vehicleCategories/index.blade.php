<x-app-layout>
    <x-slot name="title">Admin</x-slot>
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
                        data: 'vehicle_category_name',
                        name: 'vehicle_category_name',
                        class: 'text-center',
                    },
                    {
                        data: 'vehicle_category_capacity',
                        name: 'vehicle_category_capacity',
                        class: 'text-center',
                    },
                    {
                        data: 'vehicle_category_description',
                        name: 'vehicle_category_description',
                        class: 'text-center',

                        render: function(data, type, full, meta){
                            return "<div class='truncate w-96'>" +
                                data + "</div>";
                        },
                        target: 2
                    },
                    {
                        data: 'slug',
                        name: 'slug',
                        class: 'text-center',
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
                    {{ __('Vehicle Category') }}
                </div>
                <div class="mb-0">
                    <a href="{{ route('admin.vehicleCategories.create') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        {{ __('+ Add Vehicle Category') }}
                    </a>
                </div>
            </div>
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>Vehicle Category Name</th>
                                <th>Capacity</th>
                                <th>Description</th>
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
