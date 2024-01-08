<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="#!" onclick="window.history.go(-1); return false;">
                ←
            </a>
            {!! __('User &raquo; Edit &raquo; ') . $user->name !!}
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

                <form class="w-full" action="{{ route('admin.users.update', $user->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <img src="{{ str_replace('"', '', Storage::url($user->profile_photo_path)) }}" alt=""
                        class="mx-auto rounded-md w-28">

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Name *
                            </label>
                            <input value="{{ old('name') ?? $user->name }}" name="name"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Name" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Customer Name. Example: John Doe, Jane Doe, Ronald Christian, etc. Required. Max 255
                                characters.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Gender *
                            </label>
                            <select name="gender" required
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">Choose Gender</option>
                                <option value="Male"
                                    {{ (old('gender') ?? $user->gender) === 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female"
                                    {{ (old('gender') ?? $user->gender) === 'Female' ? 'selected' : '' }}>Female
                                </option>
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
                                Phone *
                            </label>
                            <input value="{{ old('phone') ?? $user->phone }}" name="phone"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="number" placeholder="Phone" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Phone. Example: 089123432132, 081800229090, 082184742434 etc. Required. Max 12
                                characters.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Email *
                            </label>
                            <input value="{{ old('email') ?? $user->email }}" name="email"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Email" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Customer Email. Example: johndoe@gmail.com, janedoe@rocketmail.com,
                                ronaldchristian@gmail.com, etc. Required. Max 255
                                characters.
                            </div>
                        </div>
                    </div>

                    @if(!empty($user->driving_license_path))
                        <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                            <div class="w-full">
                                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                    for="grid-last-name">
                                    Driving License Picture
                                </label>
                                <img src="{{ str_replace('"', '',Storage::url($user->driving_license_path)) }}" alt="" class="rounded-md w-80">
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Driving License Status *
                            </label>
                            <select name="driving_license_status" required
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">Choose Status</option>
                                <option value="Unverified"
                                    {{ (old('driving_license_status') ?? $user->driving_license_status) === 'Unverified' ? 'selected' : '' }}>
                                    Unverified</option>
                                <option value="Verified"
                                    {{ (old('driving_license_status') ?? $user->driving_license_status) === 'Verified' ? 'selected' : '' }}>
                                    Verified</option>
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
                                Age *
                            </label>
                            <input value="{{ old('age') ?? $user->age }}" name="age"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="number" placeholder="Age" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Phone. Example: 17, 18, 21 etc.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Role *
                            </label>
                            <select name="role" required
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">Choose Role</option>
                                <option value="Customer"
                                    {{ (old('role') ?? $user->role) === 'Customer' ? 'selected' : '' }}>Customer
                                </option>
                                <option value="Admin"
                                    {{ (old('role') ?? $user->role) === 'Admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Select one. Required.
                            </div>
                        </div>
                    </div>

                    {{-- <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="grid-last-name">
                                Foto*
                            </label>
                            <input name="driving_license_path"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                accept="image/png,image/jpg,image/jpeg" id="grid-last-name" type="file">
                        </div>
                    </div> --}}

                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 text-right">
                            <button type="submit"
                                class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                                Update User Information
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
