<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="#!" onclick="window.history.go(-1); return false;">
                ←
            </a>
            {!! __('Vehicle &raquo; Sunting &raquo; '). $vehicle->license_plate !!}
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

                <form class="w-full" action="{{ route('admin.vehicles.update', $vehicle->license_plate) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's License Plate *
                            </label>
                            <input value="{{ old('license_plate') ?? $vehicle->license_plate }}" name="license_plate"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Vehicle License Plate" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle License Plate. Example: Vehicle Category 1, Vehicle Category 2, Vehicle Category 3, dsb. Required. Max 255
                                characters.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle Category ID*
                            </label>
                            <select name="vehicle_category_id" required
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">Choose Vehicle Category ID</option>
                                @foreach ($vehicleCategory as $i)
                                    <option value="{{ $i->id }}" {{ $vehicle->vehicle_category_id == $i->id ? 'selected' : '' }}>
                                        {{ $i->id }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Nama type. Contoh: Item 1, Item 2, Item 3, dsb. Wajib diisi. Maksimal 255 karakter.
                            </div>
                        </div>
                    </div>

                    {{-- <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's Category ID *
                            </label>
                            <input value="{{ old('vehicle_category_id') ?? $vehicle->vehicle_category_id }}" name="vehicle_category_id"
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
                            <input value="{{ old('color') ?? $vehicle->color }}" name="color"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Vehicle Color" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle Color. Example: 2, 4, 6, 8, dsb. Required.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle Brand *
                            </label>
                            <input value="{{ old('merk') ?? $vehicle->merk }}" name="merk"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Vehicle Brand" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle Category Dascription. Example: A very good choice for offroad, Minimalistic car to carry the entire family, dsb. Required. Max 255
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
                            <input value="{{ old('type') ?? $vehicle->type }}" name="type"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Vehicle's Type" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle Category Dascription. Example: A very good choice for offroad, Minimalistic car to carry the entire family, dsb. Required. Max 255
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
                            <input value="{{ old('year_of_release') ?? $vehicle->year_of_release }}" name="year_of_release"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="number" placeholder="Vehicle's Year Of Release" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle's Dascription. Example: A very good choice for offroad, Minimalistic car to carry the entire family, dsb. Required. Max 255
                                characters.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's Fuel *
                            </label>
                            <input value="{{ old('fuel') ?? $vehicle->fuel }}" name="fuel"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Vehicle's Fuel" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle Category Dascription. Example: A very good choice for offroad, Minimalistic car to carry the entire family, dsb. Required. Max 255
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
                            <input value="{{ old('rental_price') ?? $vehicle->rental_price }}" name="rental_price"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="number" placeholder="Vehicle Category Description" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle Category Dascription. Example: A very good choice for offroad, Minimalistic car to carry the entire family, dsb. Required. Max 255
                                characters.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Vehicle's Description *
                            </label>
                            <input value="{{ old('car_description') ?? $vehicle->car_description }}" name="car_description"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Vehicle's Description" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Vehicle's Dascription. Example: A very good choice for offroad, Minimalistic car to carry the entire family, dsb. Required. Max 255
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
                                Update Vehicle
                            </button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    </div>
</x-app-layout>
