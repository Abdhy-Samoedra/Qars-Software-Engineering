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


<form class="w-full flex flex-col" action="{{ route('front.profile.update-driver', $user->id) }}" method="post"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')
    <div class="flex self-center mb-5 w-1/2">
        <div class="text-4xl font-medium text-blue-950">
            {{ __('Your Driver License') }}
        </div>
    </div>
    <div class="py-10 px-8 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md  w-1/2 container relative block">

        <div class ="flex flex-col items-center justify-center gap-[100px]">
            <!-- Profile Photo -->
            <div class="flex items-center justify-center w-full">
                <!-- Container -->
                <div class=" block justify-center">
                    @if ($user->driving_license_path)
                        <div x-data="{ photoName: null, photoPreview: null }"
                            class="col-span-6 sm:col-span-4 flex flex-col items-center justify-start">
                            <!-- Profile Photo File Input -->
                            <input name = "driving_license_path" type="file" id="photo" class="hidden"
                                wire:model.live="photo" x-ref="photo"
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
                                <img src="{{ Storage::url(json_decode($user->driving_license_path)) }}"
                                    alt="Driver License" class="rounded-md h-[306px] w-[486px] object-cover">
                            </div>

                            <!-- New Profile Photo Preview -->
                            <div class="my-10" x-show="photoPreview" style="display: none;">
                                <span class="block rounded-md  h-[306px] w-[486px] bg-cover bg-no-repeat bg-center"
                                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>

                            <label class = "block font-normal text-base text-gray-700">Status :
                                {{ $user->driving_license_status ? $user->driving_license_status : 'Pending' }}</label>

                            {{-- Upload Button --}}
                            <x-secondary-button class="mt-2" type="button" x-on:click.prevent="$refs.photo.click()">
                                {{ __('Upload Driver License') }}
                            </x-secondary-button>

                            {{-- Remove Button --}}
                            @if ($user->driving_license_path)
                                <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                    {{ __('Remove Driver License') }}
                                </x-secondary-button>
                            @endif

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
                    Save Driver License
                </button>
                <input type="hidden" value="driver_license" name="section">
            </div>
        </div>
    </div>
</form>
