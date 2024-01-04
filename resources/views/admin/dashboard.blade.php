<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between mb-5 ">
                <div class="text-3xl font-medium text-blue-950">
                    {!! __('Welcome,') !!} {{ $name }}
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4 px-3 mt-4 mb-6 -mx-3">
                <div class="block p-6 bg-white rounded-lg">
                    <h5 class="mt-4 mb-8 text-6xl font-bold leading-tight text-center text-blue-950">
                        80
                    </h5>
                    <p class="mb-2 text-base font-medium text-center text-neutral-600">
                        Total Vehicle
                    </p>
                </div>
                <div class="block p-6 bg-white rounded-lg">
                    <h5 class="mt-4 mb-8 text-6xl font-bold leading-tight text-center text-blue-950">
                        80
                    </h5>
                    <p class="mb-4 text-base font-medium text-center text-neutral-600">
                        Total Driver
                    </p>
                </div>
                <div class="block p-6 bg-white rounded-lg">
                    <h5 class="mt-4 mb-8 text-6xl font-bold leading-tight text-center text-blue-950">
                        80
                    </h5>
                    <p class="mb-4 text-base font-medium text-center text-neutral-600">
                        Total User
                    </p>
                </div>
                <div class="block p-6 bg-white rounded-lg">
                    <h5 class="mt-4 mb-8 text-6xl font-bold leading-tight text-center text-blue-950">
                        80
                    </h5>
                    <p class="mb-4 text-base font-medium text-center text-neutral-600">
                        Total Transaction
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
