<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Lost And Found') }}
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

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('admin.lostAndFounds.create') }}"
                    class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    + Lost And Found Announcement
                </a>
            </div>
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>Found Date</th>
                                <th>Picture</th>
                                <th>Description</th>
                                <th>Taken Status</th>
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
