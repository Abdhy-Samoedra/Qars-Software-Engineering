<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="#!" onclick="window.history.go(-1); return false;">
                ←
            </a>
            {!! __('Lost and Found &raquo; Edit Announcement &raquo; ') . $lostAndFound->found_date !!}
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

                <form class="w-full" action="{{ route('admin.lostAndFounds.update', $lostAndFound->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="flex flex-col px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                License Plate *
                            </label>
                            <select name="vehicle_id" required
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">Choose License Plate</option>
                                @foreach ($vehicles as $i)
                                    <option value="{{ $i->id }}">
                                        {{ $i->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex gap-x-10 flex-row items-center justify-between px-3 mt-4 mb-6 -mx-3">
                            <div class="w-2/4">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    Found Date *
                                </label>
                                <input value="{{ old('found_date') ?? $lostAndFound->found_date }}" name="found_date"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="date" placeholder="Found Date" required>
                                <div class="mt-2 text-sm text-gray-500">
                                    Found Date. Example: 2023-12-23, 2023-02-23, 2043-12-23, etc. Required.
                                </div>
                            </div>
                                <div class="w-2/4">
                                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                        for="grid-last-name">
                                        Foto *
                                    </label>
                                    <input name="lost_and_found_picture"
                                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                        accept="image/png,image/jpg,image/jpeg" id="grid-last-name" type="file">
                                    <div class="mt-2 text-sm text-gray-500">
                                        Upload 1 picture only
                                    </div>
                                </div>
                        </div>


                       

                        <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    Description *
                                </label>
                                <input value="{{ old('description') ?? $lostAndFound->description }}" name="description"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="text" placeholder="Description" required>
                                <div class="mt-2 text-sm text-gray-500">
                                    Description. Example: A very good choice for offroad, Minimalistic car to carry the
                                    entire family, dsb. Required. Max 255
                                    characters.
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    Taken Status *
                                </label>
                                <select name="taken_status" required
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="">--choose status--</option>
                                    <option value="Not Taken"
                                        {{ (old('taken_status') ?? $lostAndFound->taken_status) === 'Not Taken' ? 'selected' : '' }}>
                                        Not Taken</option>
                                    <option value="Taken"
                                        {{ (old('taken_status') ?? $lostAndFound->taken_status) === 'Taken' ? 'selected' : '' }}>
                                        Taken</option>
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
                                    Taken Date
                                </label>
                                <input value="{{ old('taken_date') ?? $lostAndFound->taken_date }}" name="taken_date"
                                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="date" placeholder="Found Date">
                                <div class="mt-2 text-sm text-gray-500">
                                    Taken Date. Example: 2023-12-23, 2023-02-23, 2043-12-23, etc.
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap mb-6 -mx-3">
                            <div class="w-full px-3 text-right">
                                <button type="submit"
                                    class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                                    Update Announcement
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
