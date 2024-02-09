<x-front-layout>
    <!-- Profile Overview -->
    <section class="relative lg:px-[100px] lg:py-[100px]" id="profile">
        <!-- Main Bubble -->
        @include('profile-form')
        <div class="flex">
            <div class="flex mx-auto justify-center py-8 y-0.8 w-full lg:w-1/2">
                <div class="border-t border-transparent lg:border-gray-300 lg:min-w-[620px]"></div>
            </div>
        </div>
        @include('profile-sim')
    </section>
</x-front-layout>
