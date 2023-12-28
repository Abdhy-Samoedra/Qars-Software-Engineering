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
                        data: 'id',
                        name: 'id',
                        class: 'text-center',
                    },{
                        data: 'name',
                        name: 'name',
                        class: 'text-center',
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        class: 'text-center',
                    },
                    {
                        data: 'email',
                        name: 'email',
                        class: 'text-center',
                    },
                    {
                        data: 'experience_point',
                        name: 'experience_point',
                        class: 'text-center',
                    },
                    {
                        data: 'driving_license_status',
                        name: 'driving_license_status',
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
                    {{ __('User') }}
                </div>

            </div>
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Point</th>
                                <th>License Status</th>
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
