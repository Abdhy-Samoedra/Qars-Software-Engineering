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
                columns: [
                    {
                        //memanggil nama dari tabel user
                        data: 'id',
                        name: 'id',
                    },{
                        //memanggil nama dari tabel user
                        data: 'user.name',
                        name: 'user.name',
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                    },
                    {
                        data: 'end_date',
                        name: 'end_date',
                    },
                    {
                        data: 'vehicle.id',
                        name: 'vehicle.id',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
                    },
                    {
                        data: 'total_price',
                        name: 'total_price',
                    },
                    {
                        //kolom button action
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '20%'
                    },
                ],
            });
        </script>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between mb-5 ">
                <div class="text-3xl font-medium text-blue-950">
                    {{ __('Transactions') }}
                </div>
            </div>
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-8 bg-white sm:p-6">
                    <table id="dataTable" class="hover stripe">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>User</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Car</th>
                                <th>Status</th>
                                <th>Payment Status</th>
                                <th>Total</th>
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
