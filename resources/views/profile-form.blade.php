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


<form class="w-full flex flex-col" action="{{ route('front.profile.update-info', $user->id) }}" method="post"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="flex self-center mb-3 lg:mb-5 w-full lg:w-1/2 justify-center lg:justify-start lg:min-w-[620px]">
        <div class="text-3xl lg:text-4xl font-medium text-blue-950">
            {{ __('Your Profile') }}
        </div>
    </div>
    <div class="flex self-center mb-3 lg:mb-5 w-full lg:w-1/2 justify-center lg:justify-start lg:min-w-[620px]">
        <div class="text-xl lg:text-xl font-medium text-blue-950">
            {{ __('Point : ') }} {{ $user->experience_point }}
        </div>
    </div>
    <div
        class="py-10 lg:px-8 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md  w-full lg:min-w-[620px] lg:w-1/2 container relative block">

        <div class ="flex flex-col lg:flex-row items-center justify-center lg:gap-[100px]">
            {{-- Form --}}
            <div name = "form" class = "flex flex-col w-auto lg:w-80 gap-y-5">
                {{-- Name --}}
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <input value="{{ old('name') ?? $user->name }}" name="name"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        id="profile-name" type="text" placeholder="Name" required>
                    <x-input-error for="name" class="mt-2" />
                </div>
                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <input value="{{ old('email') ?? $user->email }}" name="email"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        id="profile-email" type="email" placeholder="Email" required>
                    <x-input-error for="email" class="mt-2" />

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                            !$this->user->hasVerifiedEmail())
                        <p class="text-sm mt-2">
                            {{ __('Your email address is unverified.') }}

                            <button type="button"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                wire:click.prevent="sendEmailVerification">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if ($this->verificationLinkSent)
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    @endif
                </div>
                {{-- Phone Number --}}
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="phone" value="{{ __('Phone Number') }}" />
                    <input value="{{ old('phone') ?? $user->phone }}" name="phone"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        id="profile-phone" type="text" placeholder="phone" required>
                    <x-input-error for="phone" class="mt-2" />
                </div>


                {{-- Gender & Age --}}
                <div class="col-span-6 sm:col-span-4 flex flex-row w-full gap-[50px]">
                    <div class = "block w-1/2">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="grid-last-name">
                            Gender
                        </label>
                        <select name="gender" required
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full lg:w-full">
                            <option value="" class = "text-sm" disabled>Choose Gender</option>
                            <option value="Male" {{ (old('gender') ?? $user->gender) === 'Male' ? 'selected' : '' }}>
                                Male</option>
                            <option value="Female"
                                {{ (old('gender') ?? $user->gender) === 'Female' ? 'selected' : '' }}>Female
                            </option>
                        </select>
                    </div>
                    <div class = "block w-1/2">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="grid-last-name">
                            Age
                        </label>
                        <input value="{{ old('age') ?? $user->age }}" name="age"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full lg:w-full"
                            id="grid-last-name" type="number" placeholder="Age" required>
                    </div>
                </div>
            </div>


            <!-- Profile Photo -->
            <div class="gap-[29px] flex items-center justify-center ">
                <!-- Container -->
                <div class=" block justify-center">
                    @if ($user)
                        <div x-data="{ photoName: null, photoPreview: null }"
                            class="col-span-6 sm:col-span-4 flex flex-col items-center justify-start">
                            <!-- Profile Photo File Input -->
                            <input name = "profile_photo_path" type="file" id="photo" class="hidden"
                                wire:model.defer="photo" x-ref="photo"
                                x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        " />

                            <!-- Current Profile Photo -->
                            <div class="my-10" x-show="! photoPreview">
                                <img src="{{ $user->thumbnail }}" alt="{{ $user->name }}"
                                    class="rounded-full h-40 w-40 object-cover">
                            </div>

                            <!-- New Profile Photo Preview -->
                            <div class="my-10" x-show="photoPreview" style="display: none;">
                                <span class="block rounded-full w-40 h-40 bg-cover bg-no-repeat bg-center"
                                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>

                            {{-- Upload Button --}}
                            <x-secondary-button class="mt-2" type="button" x-on:click.prevent="$refs.photo.click()">
                                {{ __('Upload Photo') }}
                            </x-secondary-button>

                            {{-- Remove Button --}}
                            @if ($user->profile_photo_path)
                                <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                    {{ __('Remove Photo') }}
                                </x-secondary-button>
                            @endif

                            {{-- <input name="profile_photo_path"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                accept="image/png,image/jpg,image/jpeg" id="grid-last-name" type="file"> --}}

                            <x-input-error for="photo" class="mt-2" />
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mt-10">
            <div class="w-full px-3 text-right">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Save Profile
                </button>
            </div>
        </div>
    </div>
</form>
