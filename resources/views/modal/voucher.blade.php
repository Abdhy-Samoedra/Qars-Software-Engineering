<!-- Main modal -->
<div id="select-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-text_gray">
                <h3 class="text-lg font-semibold text-text_black">
                    Select Voucher
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center "
                    data-modal-toggle="select-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <ul class="space-y-4 mb-4">
                    @foreach ($validVouchers as $voucher)
                        <li>
                            <input type="radio" id="voucher-{{ $loop->index + 1 }}" name="voucher_category_id"
                                value="{{ $voucher->voucher_category->id }}" class="hidden peer" required onchange="toggleButtonStyle('voucher-{{ $loop->index + 1 }}', 'toggleButton')">
                            <label for="voucher-{{ $loop->index + 1 }}"
                                class="group inline-flex items-center justify-between w-full p-5 border border-gray-200 rounded-lg cursor-pointer  peer-checked:bg-success  hover:bg-primary">
                                <div class="flex flex-row gap-x-5 items-start">
                                    {{-- voucher image --}}
                                    <img src="{{ $voucher->voucher_category->thumbnail }}"
                                        class="max-w-[40%] rounded-xl" alt="">
                                    <div class="flex flex-col gap-y-2">
                                        <div class="w-full text-base font-semibold text-text_black ">
                                            {{ $voucher->voucher_category->voucher_name }}</div>
                                        <div class="w-full text-sm font-normal text-text_black ">Nominal :
                                            {{ $voucher->voucher_category->voucher_nominal }}</div>
                                        <div class="w-full text-sm font-normal text-text_black ">Min Spending :
                                            {{ $voucher->voucher_category->minimum_spending }}</div>
                                        <div class="w-full text-sm font-normal text-text_black ">Expired :
                                            {{ $voucher->voucher_category->expired_date }}</div>
                                    </div>
                                </div>
                            </label>
                        </li>
                    @endforeach
                </ul>
                {{-- <button class="text-white bg-primary opacity-90 hover:opacity-100 inline-flex w-full justify-center focus:ring-4 focus:outline-nonefont-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                    Use Voucher
                </button> --}}
            </div>
        </div>
    </div>
</div>
