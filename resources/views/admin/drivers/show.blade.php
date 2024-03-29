<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="#!" onclick="window.history.go(-1); return false;">
                ←
            </a>
            {!! __('Driver &raquo; Details &raquo; ') . $driver->name !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                            Ada kesalahan!
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
                <form class="w-full" enctype="multipart/form-data">
                    @csrf
                    @method('put')


                    {{-- <img src="{{ Storage::url(json_decode($driver->picture) }}" alt="Thumbnail" class="w-20 mx-auto rounded-md"> --}}
                    {{-- @foreach (json_decode($driver->picture, true) as $image)
                        <img src="{{ $image }}" alt="" class="w-20 mx-auto rounded-md">pop
                    @endforeach --}}

                    <img src="{{ Storage::url($driver->picture) }}" alt="" class="mx-auto rounded-md w-28">


                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Name
                            </label>
                            <input value="{{ old('name') ?? $driver->name }}" name="name"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Nama" required disabled>

                        </div>
                    </div>
                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Gender
                            </label>
                            <input value="{{ old('gender') ?? $driver->gender }}" name="gender"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Nama" required disabled>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Phone
                            </label>
                            <input value="{{ old('phone') ?? $driver->phone }}" name="phone"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="number" placeholder="Phone" required disabled>

                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Driver Status *
                            </label>
                            <select name="status" required disabled
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <option>Choose Driver Status</option>
                                <option value="available"
                                    {{ (old('status') ?? $driver->status) == "available" ? 'selected' : '' }}>Available</option>
                                <option value="unavailable"
                                    {{ (old('status') ?? $driver->status) == "unavailable" ? 'selected' : '' }}>Unavailable</option>
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Select one. Required.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Age
                            </label>
                            <input value="{{ old('age') ?? $driver->age }}" name="age"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="number" placeholder="Age" required disabled>

                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</x-app-layout>
