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
                        data: 'vehicle_id',
                        name: 'vehicle_id',
                        class: 'text-center',
                    },{
                        data: 'found_date',
                        name: 'found_date',
                        class: 'text-center',
                    },{
                        data: 'thumbnail',
                        name: 'thumbnail',
                        orderable: false,
                        searchable: false,
                    },{
                        data: 'description',
                        name: 'description',
                        class: 'text-center',

                        render: function(data, type, full, meta){
                            return "<div class='truncate w-36'>" +
                                data + "</div>";
                        },
                        target: 2
                    },{
                        data: 'taken_status',
                        name: 'taken_status',
                        class: 'text-center',
                    },{
                        data: 'taken_date',
                        name: 'taken_date',
                        class: 'text-center',
                    },{
                        data: 'slug',
                        name: 'slug',
                        class: 'text-center',
                    },{
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
                    {{ __('Lost and Found') }}
                </div>
                <div class="mb-0">
                    <a href="{{ route('admin.lostAndFounds.create') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        {{ __('+ Add Announcement') }}
                    </a>
                </div>
            </div>


            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-8 bg-white sm:p-6">
                    <table id="dataTable" class="hover stripe">
                        <thead>
                            <tr>
                                <th>License Plate</th>
                                <th>Found Date</th>
                                <th>Picture</th>
                                <th>Description</th>
                                <th>Taken Status</th>
                                <th>Taken Date</th>
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
