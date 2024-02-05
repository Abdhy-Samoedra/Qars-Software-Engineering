<x-front-layout>
    <!-- Profile Overview -->
    <section class="relative px-[100px] py-[100px]" id="profile">
        <!-- Main Bubble -->
        @include('profile-form')
        <div class="hidden sm:flex justify-center">
            <div class="py-8 w-1/2">
                <div class="border-t border-gray-300"></div>
            </div>
        </div>
        @include('profile-sim')
    </section>
</x-front-layout>
