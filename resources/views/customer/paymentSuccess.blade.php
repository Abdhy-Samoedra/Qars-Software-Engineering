<x-front-layout>
    <div class="flex flex-col gap-y-16 items-center mt-20">
        <svg width="195" height="195" viewBox="0 0 195 195" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="97.5" cy="97.5" r="97.5" fill="#4FD3C4" />
            <path
                d="M84.6235 143C82.0981 143 79.5727 141.822 77.6449 139.453L50.8918 106.579C47.0361 101.841 47.0361 94.166 50.8918 89.4419C54.7475 84.704 60.982 84.6901 64.8377 89.4281L84.6235 113.741L131.162 56.5535C135.018 51.8155 141.253 51.8155 145.108 56.5535C148.964 61.2914 148.964 68.9663 145.108 73.7042L91.602 139.453C89.6742 141.822 87.1488 143 84.6235 143"
                fill="white" />
        </svg>
        <div class="flex flex-col gap-y-6">
            <h1 class="text-3xl font-bold text-center">Your order has been successful!</h1>
            <p class="text-center">You can go to the nearest Qars showroom to pick up the <br> 
                unit on the date you have chosen to do the rental</p>
        </div>
        <div class="flex flex-row gap-x-4">
            <div class="p-1 rounded-full bg-primary group" >
                <a href="{{ route('front.indexCatalogue')}}" class="relative block text-white py-3 px-[26px] min-h-[47px] bg-primary font-semibold text-base rounded-full transition-all duration-[320ms] drop-shadow-[0_15px_20px_rgba(29,93,155,0.3)] hover:drop-shadow-none hover:shadow-[0_0_0_1px_#ffffff_inset] min-w-[180px] text-center">
                    <p class="">
                        Book another car
                    </p>
                    
                </a>
            </div>
            <div class="p-1 rounded-full">
                <a href="{{ route('front.index') }}" class="relative block text-text_black py-3 px-[26px] min-h-[47px]  font-medium text-base rounded-full min-w-[180px] text-center">
                    <p class="text-text_black">
                        Back to Home
                    </p>
                </a>
            </div>
        </div>


    </div>
</x-front-layout>
