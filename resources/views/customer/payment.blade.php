<x-front-layout>
    <!-- Main Content -->
    <section class="bg-darkGrey relative py-[70px]">
        <div class="container">
            <header class="mb-[30px]">
                <h2 class="font-bold text-dark text-[26px] mb-1">
                    Checkout & Drive Faster
                </h2>
                <p class="text-base text-secondary">We will help you get ready today</p>
            </header>

            <div class="flex items-center gap-5 lg:justify-between">
                <!-- Form Card -->
                <form action="{{ route('front.payment.update', $transaction->id) }}"
                    class="bg-white p-[30px] pb-10 rounded-3xl max-w-[490px] w-full" method="POST" id="checkoutForm">
                    @csrf
                    @method('POST')
                    <div class="flex flex-col gap-[30px]">
                        <div class="flex flex-col gap-4">
                            <h5 class="text-lg font-semibold">
                                Review Order
                            </h5>
                            <!-- Items -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    Car choosen
                                </p>
                                <p class="text-base font-semibold">
                                    {{ $transaction->vehicle->brand }} {{ $transaction->vehicle->type }}
                                </p>
                            </div>
                            <!-- Items -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    Total day
                                </p>
                                <p class="text-base font-semibold">
                                    {{-- {{dd($transaction->start_date)}} --}}
                                    {{ $transaction->total_days }} days
                                </p>
                            </div>
                            <!-- Items -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    Price
                                </p>
                                <p class="text-base font-semibold">
                                    ${{ number_format($transaction->vehicle->rental_price) }} per day
                                </p>
                            </div>
                            <!-- Items -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    VAT (10%)
                                </p>
                                <p class="text-base font-semibold">
                                    ${{ number_format($transaction->vehicle->rental_price * $transaction->total_days * 0.1) }}
                                </p>
                            </div>
                            <!-- Items -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    Grand total
                                </p>
                                <p class="text-base font-semibold">
                                    ${{ number_format($transaction->total_price) }}
                                </p>
                            </div>
                            <!-- Drivers -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    Driver
                                </p>
                                <p class="text-base font-semibold">
                                    {{ $transaction->driver ? $transaction->driver->name : 'without driver' }}
                                </p>
                            </div>
                            <!-- point -->
                            <div class="flex items-center justify-between">
                                <p class="text-base font-normal">
                                    Potential points to earned
                                </p>
                                <p class="text-base font-semibold">
                                    {{-- {{$transaction->driver ? $transaction->driver->name : 'without driver'}} --}}
                                    {{ $transaction->exp_reward }}
                                </p>
                            </div>
                        </div>
                        {{-- add voucher --}}
                        <div class="flex flex-col gap-4">
                            <h5 class="text-lg font-semibold">
                                Add Voucher
                            </h5>
                            <!-- Modal toggle -->
                            <button data-modal-target="select-modal" data-modal-toggle="select-modal"
                                class="border border-grey rounded-[20px] p-5 min-h-[80px] text-gray  text-2xl font-semibold"
                                type="button">
                                <span class="opacity-50">+</span>
                            </button>
                            @include('.modal.voucher')
                        </div>
                        
                        {{-- choose payment method --}}
                        <div class="flex flex-col gap-4">
                            <h5 class="text-lg font-semibold">
                                Payment Method
                            </h5>
                            <div class="grid md:grid-cols-1 gap-4 md:gap-[30px] items-center">
                                <div class="relative boxPayment">
                                    <input type="radio" value="midtrans" name="payment_method" id="midtrans"
                                        class="absolute inset-0 z-50 opacity-0 cursor-pointer">
                                    <label for="midtrans"
                                        class="flex items-center justify-center gap-4 border border-grey rounded-[20px] p-5 min-h-[80px]">
                                        <img src="/svgs/logo-midtrans.svg" alt="">
                                        <p class="text-base font-semibold">
                                            Midtrans
                                        </p>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- CTA Button -->
                        <div class="col-span-2 mt-5">
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
                <img src="{{ $transaction->vehicle->thumbnail }}" class="max-w-[50%] rounded-2xl hidden lg:block"
                    alt="">
            </div>
        </div>
    </section>


    <script>
        // on checkout button
        $('#checkoutButton').click(function() {
            $('#checkoutForm').submit();
        })
    </script>
</x-front-layout>