<form class="w-full flex flex-col" action="{{ route('front.profile.update-driver', $user->id) }}" method="post"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')
    <div class="flex self-center mb-3 lg:mb-5 w-full lg:w-1/2 justify-center lg:justify-start lg:min-w-[620px]">
        <div class="text-3xl lg:text-4xl font-medium text-blue-950">
            {{ __('Your Driver License') }}
        </div>
    </div>
    <div
        class="py-10 lg:px-8 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md  w-full lg:min-w-[620px] lg:w-1/2 container relative block">

        <div class ="flex flex-col items-center justify-center gap-[100px]">
            <!-- Profile Photo -->
            <div class="flex items-center justify-center w-full">
                <!-- Container -->
                <div class=" block justify-center">
                    @if ($user)
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
                                <img src="{{ $user->driving_license_path ? Storage::url(json_decode($user->driving_license_path)) : 'https://via.placeholder.com/800x600' }}"
                                    alt="Driver License"
                                    class="rounded-md h-[153px] w-[243px] md:h-[306px] md:w-[486px] object-cover">
                            </div>

                            <!-- New Profile Photo Preview -->
                            <div class="my-10" x-show="photoPreview" style="display: none;">
                                <span
                                    class="block rounded-md  h-[153px] w-[243px] md:h-[306px] md:w-[486px] bg-cover bg-no-repeat bg-center"
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
