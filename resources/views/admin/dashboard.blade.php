<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between mb-5 ">
                <div class="text-3xl font-medium text-blue-950">
                    {!! __('Welcome,') !!} {{ $name }}
                </div>
            </div>
            {{-- Count Total --}}
            <div class="grid grid-cols-4 gap-4 px-3 mt-4 mb-6 -mx-3">
                <div class="block p-6 bg-white rounded-lg">
                    <h5 class="mt-4 mb-8 text-6xl font-bold leading-tight text-center text-blue-950">
                        {{ $totalVehicle[0]->total }}
                    </h5>
                    <p class="mb-2 text-base font-medium text-center text-neutral-600">
                        Total Vehicle
                    </p>
                </div>
                <div class="block p-6 bg-white rounded-lg">
                    <h5 class="mt-4 mb-8 text-6xl font-bold leading-tight text-center text-blue-950">
                        {{ $totalDriver[0]->total }}
                    </h5>
                    <p class="mb-4 text-base font-medium text-center text-neutral-600">
                        Total Driver
                    </p>
                </div>
                <div class="block p-6 bg-white rounded-lg">
                    <h5 class="mt-4 mb-8 text-6xl font-bold leading-tight text-center text-blue-950">
                        {{ $totalUser[0]->total }}
                    </h5>
                    <p class="mb-4 text-base font-medium text-center text-neutral-600">
                        Total User
                    </p>
                </div>
                <div class="block p-6 bg-white rounded-lg">
                    <h5 class="mt-4 mb-8 text-6xl font-bold leading-tight text-center text-blue-950">
                        {{ $totalTransaction[0]->total }}
                    </h5>
                    <p class="mb-4 text-base font-medium text-center text-neutral-600">
                        Total Transaction
                    </p>
                </div>
            </div>
            {{-- ---------------------------------- License Request' Table ---------------------------------------------- --}}


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-blue-900 table-auto">
                    <thead class="text-xs text-white uppercase bg-blue-900">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($query as $item)
                            <tr class="odd:bg-white even:bg-gray-100">
                                <th scope="row" class="px-6 py-4 font-medium text-blue-900 whitespace-nowrap">
                                    {{ $item->id }}
                                </th>
                                <th class="px-6 py-4 font-normal" scope="row">
                                    {{ $item->name }}
                                </th>
                                <th class="px-6 py-4">
                                    <a href="{{ route('admin.users.edit', $item->slug) }}"
                                        class="solid font-normal bg-blue-900 text-white rounded-md p-2">
                                        Check
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                        @if (empty($query))
                            <tr>
                                <th colspan="5"
                                    class="px-6 py-4 font-medium text-black whitespace-nowrap text-center ">Nothing to
                                    verify.</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
