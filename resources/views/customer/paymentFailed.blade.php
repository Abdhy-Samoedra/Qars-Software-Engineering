<x-front-layout>
    <div class="flex flex-col gap-y-16 items-center mt-20">
        <svg width="195" height="195" viewBox="0 0 195 195" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="97.5" cy="97.5" r="97.5" fill="#FC2947"/>
            <path d="M134.865 119.741L113.125 98.0107L134.853 76.2806C139.033 72.113 139.033 65.33 134.853 61.1624C130.674 56.9581 123.916 56.9703 119.736 61.1501L97.9954 82.8803L76.2547 61.1257C72.0752 56.9459 65.3049 56.9703 61.1255 61.1257C56.9582 65.3055 56.9582 72.0885 61.1255 76.2561L82.8784 98.0107L61.1743 119.704C56.9948 123.884 56.9948 130.667 61.1743 134.822C63.2641 136.924 65.9893 137.963 68.7268 137.963C71.4764 137.963 74.2016 136.924 76.2914 134.835L97.9954 113.129L119.748 134.871C121.838 136.961 124.563 138 127.301 138C130.038 138 132.776 136.949 134.865 134.871C139.045 130.691 139.045 123.921 134.865 119.741" fill="white"/>
            </svg>
            
        <div class="flex flex-col gap-y-6">
            <h1 class="text-3xl font-bold text-center">Your order has failed!</h1>
            <p class="text-center">We regret to inform you that there is an error with your payment. <br>Please review your payment information and try again.</p>
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
