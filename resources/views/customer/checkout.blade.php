<x-front-layout>
    <!-- Main Content -->
    <section class="bg-darkGrey relative py-[70px]">
        <div class="container">
            <header class="mb-[30px]">
                <h2 class="font-bold text-text_black text-[26px] mb-1">
                    Checkout & Drive Faster
                </h2>
                <p class="text-base text-text_semiblack">We will help you get ready today</p>
            </header>

            <div class="flex items-center gap-5 lg:justify-between">
                <!-- Form Card -->
                <form action="{{ route('front.checkout.store', $vehicle->slug) }}" method="POST"
                    class="bg-white p-[30px] pb-10 rounded-3xl max-w-[490px] w-full" x-data="app" x-cloak
                    id="checkoutForm">
                    @csrf
                    @method('POST')
                    <div class="grid grid-cols-2 items-center gap-y-6 gap-x-4 lg:gap-x-[30px]">
                        <!-- Full Name -->
                        <div class="flex flex-col col-span-2 gap-6">
                            <label for="" class="text-base font-semibold text-dark">
                                Full Name
                            </label>
                            <input type="text" name="name" id="name"
                                class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-text_semiblack placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px]"
                                placeholder="Insert Full Name" value="{{ Auth::user()->name }}">
                        </div>

                        <!-- RESULT DATES FROM-UNTIL -->
                        <div class="col-span-2 grid-cols-2 gap-y-6 gap-x-4 lg:gap-x-[30px] hidden">
                            <!-- Result Date From [HIDDEN] -->
                            <div class="flex flex-col col-span-1 gap-3">
                                <label for="" class="text-base font-semibold text-dark">
                                    From (result)
                                </label>
                                <input type="text" name="start_date" id="dateFrom"
                                    class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-text_semiblack placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                                    placeholder="Select Date" readonly x-model="dateFromYmd">
                            </div>
                            <!-- Result Date Until [HIDDEN] -->
                            <div class="flex flex-col col-span-1 gap-3">
                                <label for="" class="text-base font-semibold text-dark">
                                    Until (result)
                                </label>
                                <input type="text" name="end_date" id="dateUntil"
                                    class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-text_semiblack placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                                    placeholder="Select Date" readonly x-model="dateToYmd">
                            </div>
                        </div>

                        <!-- START: INPUT DATE -->
                        <div class="col-span-2 grid grid-cols-2 gap-y-6 gap-x-4 lg:gap-x-[30px] relative"
                            @keydown.escape="closeDatepicker()" @click.outside="closeDatepicker()">
                            <!-- Date From -->
                            <div class="flex flex-col col-span-1 gap-3">
                                <label for="" class="text-base font-semibold text-dark">
                                    From
                                </label>
                                <input readonly type="text"
                                    class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-text_semiblack placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                                    placeholder="Select Date" @click="endToShow = 'from'; init(); showDatepicker = true"
                                    x-model="outputDateFromValue">
                            </div>
                            <!-- Date Until -->
                            <div class="flex flex-col col-span-1 gap-3">
                                <label for="" class="text-base font-semibold text-dark">
                                    Until
                                </label>
                                <input readonly type="text"
                                    class="text-base font-medium focus:border-primary focus:outline-none placeholder:text-text_semiblack placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                                    placeholder="Select Date" @click="endToShow = 'to'; init(); showDatepicker = true"
                                    x-model="outputDateToValue">
                            </div>

                            <!-- START: Date-Range Picker -->
                            <div class="absolute p-5 mt-2 bg-white rounded-[18px] top-full border border-grey w-full z-50 shadow-[0_22px_50px_0_rgba(212,214,218,0.25)]"
                                x-show="showDatepicker" x-transition>
                                <div class="flex flex-col items-center">

                                    <!-- Month -->
                                    <div class="w-full mb-5">
                                        <div class="flex items-center justify-center gap-1">
                                            <button type="button"
                                                class="inline-flex p-1 mr-2 transition duration-100 ease-in-out rounded-full cursor-pointer hover:bg-gray-200"
                                                @click="if (month == 0) {year--; month=11;} else {month--;} getNoOfDays()">
                                                <svg class="inline-flex w-6 h-6 text-gray-500" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 19l-7-7 7-7" />
                                                </svg>
                                            </button>
                                            <span x-text="MONTH_NAMES[month]"
                                                class="text-base font-semibold text-dark"></span>
                                            <span x-text="year" class="text-base font-semibold text-dark"></span>
                                            <button type="button"
                                                class="inline-flex p-1 ml-2 transition duration-100 ease-in-out rounded-full cursor-pointer hover:bg-gray-200"
                                                @click="if (month == 11) {year++; month=0;} else {month++;}; getNoOfDays()">
                                                <svg class="inline-flex w-6 h-6 text-gray-500" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Day Names -->
                                    <div class="flex flex-wrap w-full mb-3 -mx-1">
                                        <template x-for="(day, index) in DAYS" :key="index">
                                            <div style="width: 14.26%" class="px-1">
                                                <div x-text="day" class="text-sm font-medium text-center text-dark">
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- Dates -->
                                    <div class="flex flex-wrap -mx-1">
                                        <template x-for="blankday in blankdays">
                                            <div style="width: 14.28%"
                                                class="p-1 text-sm text-center border border-transparent">
                                            </div>
                                        </template>
                                        <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                            <div style="width: 14.28%">
                                                <div @click="getDateValue(date, false)"
                                                    @mouseover="getDateValue(date, true)" x-text="date"
                                                    class="p-1 text-sm leading-loose text-center transition duration-100 ease-in-out cursor-pointer"
                                                    :class="{
                                                        'font-bold': isToday(date) ==
                                                            true,
                                                        'bg-primary text-white rounded-l-full': isDateFrom(
                                                                date) ==
                                                            true,
                                                        'bg-primary text-white rounded-r-full': isDateTo(
                                                            date) == true,
                                                        'bg-[#E2E1FF]': isInRange(date) ==
                                                            true,
                                                        'text-slate-300': isPast(date) == true
                                                    }">
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Date-Range Picker -->
                        </div>
                        <!-- END: INPUT DATE -->
                        {{-- HAVE LICENSED OR NOT --}}
                        <div class="flex flex-col col-span-2 gap-6">
                            {{-- conditional to add driver, when user have licensed or not --}}
                            @if (Auth::user()->driving_license_status == 'Verified')
                                <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
                                    <input
                                        class="relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:checked:border-primary dark:checked:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
                                        type="checkbox" value="" id="checkbox" name="checkbox" />
                                    <label class="inline-block pl-[0.15rem] hover:cursor-pointer"
                                        for="checkboxDefault">
                                        Add drivers to add to your comfort while driving
                                    </label>
                                </div>
                            @else
                                <div class="flex flex-col gap-y-3 opacity-50">
                                    <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem] ">
                                        <input
                                            class="relative float-left -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-['']  checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:bg-transparent checked:after:content-['']  focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600"
                                            type="checkbox" value="" id="checkbox" name="checkbox" checked disabled />
                                        <label class="text-text_semiblack inline-block pl-[0.15rem] "
                                            for="checkboxChecked">
                                            Add drivers to add to your comfort while driving
                                        </label>
                                    </div>
                                    <p class="pl-7  text-base text-text_semiblack">Verify driving license to rent without drivers</p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- CTA Button -->
                        <div class="col-span-2 mt-[26px]">
                            <!-- Button Primary -->
                            <div class="p-1 rounded-full bg-primary group">
                                <a href="#" class="btn-primary" id="checkoutButton">
                                    <p>
                                        Continue
                                    </p>
                                    <img src="/svgs/ic-arrow-right.svg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

                <img src="{{ $vehicle->thumbnail }}" class="max-w-[50%] rounded-2xl hidden lg:block" alt="">
            </div>
        </div>
    </section>

    <script type="text/javascript" src="/js/dateRangePicker.js"></script>


    <script>
        // on checkout button
        $('#checkoutButton').click(function() {
            $('#checkoutForm').submit();
        })
    </script>
</x-front-layout>
