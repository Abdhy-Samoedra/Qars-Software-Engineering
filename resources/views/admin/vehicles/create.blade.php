<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="#!" onclick="window.history.go(-1); return false;">
                ←
            </a>
            {!! __('Vehicle &raquo; Create') !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                            Error!
                        </div>
                        <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                            <p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>
                @endif
                <form class="w-full" action="{{ route('admin.vehicles.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's License Plate *
                            </label>
                            <input value="{{ old('id') }}" name="id"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Vehicle License Plate" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle License Plate. Example: B 3429 AYD, D 4425 HGF, H 3 RE, etc. Required. Max 255
                                characters.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle Category ID *
                            </label>
                            <select name="vehicle_category_id" required
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">Choose Vehicle Category ID</option>
                                @foreach ($vehicleCategory as $i)
                                    <option value="{{ $i->id }}">
                                        {{ $i->id }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle Category ID. Choose the correct Vehicle Category ID for the vehicle. Required.
                            </div>
                        </div>
                    </div>

                    {{-- <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's Category ID *
                            </label>
                            <input value="{{ old('vehicle_category_id') }}" name="vehicle_category_id"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="number" placeholder="Vehicle's Category ID" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle Category Dascription. Example: A very good choice for offroad, Minimalistic car to carry the entire family, dsb. Required. Max 255
                                characters.
                            </div>
                        </div>
                    </div> --}}

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's Color *
                            </label>
                            <input value="{{ old('color') }}" name="color"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Vehicle Color" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle Color. Example: Red, Green, Olive, Silver, etc. Required.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's Brand *
                            </label>
                            <input value="{{ old('brand') }}" name="brand"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Vehicle Brand" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle's Brand. Example: Mitshubishi, Daihatsu, Honda, etc. Required. Max 255
                                characters.
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's Type *
                            </label>
                            <input value="{{ old('type') }}" name="type"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Vehicle's Type" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle Type. Example: Honda Elverson 2, Pajero Sport, CV-342, etc. Required. Max 255
                                characters.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's Year Of Release *
                            </label>
                            <input value="{{ old('year_of_release') }}" name="year_of_release"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="number" placeholder="Vehicle's Year Of Release" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle's Year Of Release. Example: 2004, 2016, 1996, etc. Required.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's Fuel *
                            </label>
                            <input value="{{ old('fuel') }}" name="fuel"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Vehicle's Fuel" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle's Fuel. Example: Solar, Avtur, Pertamax Dex, etc. Required. Max 255
                                characters.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's Rental Price *
                            </label>
                            <input value="{{ old('rental_price') }}" name="rental_price"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="number" placeholder="Vehicle Category Description" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle's Rental Price per day. Example: 23000, 40000, 100000, etc. Required.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's Description *
                            </label>
                            <input value="{{ old('car_description') }}" name="car_description"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Vehicle's Description" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle's Description. Example: A very good choice for offroad, Minimalistic car to
                                carry the entire family, etc. Required. Max 255
                                characters.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's Pictures *
                            </label>
                            <input name="car_picture[]"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                accept="image/png,image/jpg,image/jpeg" id="grid-last-name" type="file" multiple>
                            <div class="mt-2 text-sm text-gray-500">
                                Max upload 5 pictures
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 text-right">
                            <button type="submit"
                                class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                                Store Vehicle
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
