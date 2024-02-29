<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/5ea815c1d0.js"></script>
    <link href = "C:\laragon\www\Qars-Software-Engineering\resources\css\star.css" rel = "stylesheet">
</head>

<body>
    <x-front-layout>
        <section></section>
        <div class="container my-10">
            <!-- Breadcrumb -->
            <ul class="flex items-center gap-4 my-6">
                <li
                    class="text-dark font-semibold text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-4">
                    <a href="{{ route('front.order') }}">Booked</a>
                </li>
                <li
                    class="text-dark font-semibold text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-4">
                    <a href="/orders?status={{ $status }}">
                        {{ $status }}
                    </a>
                </li>
                <li
                    class="text-dark font-semibold text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-4">
                    {{ $transaction->id }}
                </li>
            </ul>
        </div>
        <div class="container">
            <div class="flex flex-row gap-14 my-6 w-full items-center">
                <div class="rounded-3xl w-full h-full m-2">
                    <img src="{{ $transaction->vehicle->thumbnail }}" class="rounded-3xl min-w-72 w-full h-80  m-2"
                        alt="{{ $transaction->car_brand }}">
                </div>
                <div class="rounded-3xl w-3/5 h-full m-2 bg-white p-5">
                    <div class="flex mb-2">
                        <h4 class="text-xl text-text_black font-bold w-full text-start">{{ $status }}</h4>
                    </div>
                    <div class="flex mb-2">
                        <span class="font-normal inline-block w-1/2 text-start">Car choosen</span>
                        <h5 class="text-lg text-text_black font-bold w-1/2 text-end">{{ $transaction->vehicle_brand }}
                        </h5>
                    </div>
                    <div class="flex mb-2">
                        <span class="font-normal inline-block w-1/2 text-start">Total Day</span>
                        <h5 class="text-lg text-text_black font-bold w-1/2 text-end">{{ $transaction->total_days }} Days
                        </h5>
                    </div>
                    <div class="flex mb-2">
                        <span class="font-normal inline-block w-1/2 text-start">Start Date</span>
                        <h5 class="text-lg text-text_black font-bold w-1/2 text-end">{{ $transaction->start_date }}</h5>
                    </div>
                    <div class="flex mb-2">
                        <span class="font-normal inline-block w-1/2 text-start">End Date</span>
                        <h5 class="text-lg text-text_black font-bold w-1/2 text-end">{{ $transaction->end_date }}</h5>
                    </div>
                    <div class="flex mb-2">
                        <span class="font-normal inline-block w-1/2 text-start">License Plate</span>
                        <h5 class="text-lg text-text_black font-bold w-1/2 text-end">{{ $transaction->vehicle_id }}
                        </h5>
                    </div>
                    <div class="flex mb-2">
                        <span class="font-normal inline-block w-1/2 text-start">Total Price</span>
                        <h5 class="text-lg text-text_black font-bold w-1/2 text-end">$
                            {{ number_format($transaction->total_price, 2, '.', ',') }}</h5>
                    </div>
                    {{-- Extend & Rate Button --}}
                    @if ($status == 'Reserved' || $status == 'On Going')
                        <div class="flex justify-end">
                            <button
                                class="bg-blue-900 hover:bg-blue-800 text-white font-semibold p-2 rounded-2xl w-full text-center my-1 py-3 {{ $transaction->extend == 1 || $status == 'Reserved' ? 'bg-grey hover:bg-grey' : '' }}"
                                onclick="openModal();"
                                {{ $transaction->extend == 1 || $status == 'Reserved' ? 'disabled' : '' }}>Extend</button>
                        </div>
                    @elseif ($status == 'Done')
                        @if ($exists)
                            <div class="flex justify-end">
                                <button
                                    class="bg-blue-900 hover:bg-blue-800 text-white font-semibold p-2 rounded-2xl w-full text-center my-1 py-3"
                                    onclick="openRatingModal();">See Rating</button>
                            </div>
                        @else
                            <div class="flex justify-end">
                                <button
                                    class="bg-blue-900 hover:bg-blue-800 text-white font-semibold p-2 rounded-2xl w-full text-center my-1 py-3"
                                    onclick="openRatingModal();">Rate</button>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <div id="modal" class="fixed inset-0 z-10 flex items-center justify-center hidden">
                <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                <div class="bg-white p-8 rounded-md z-20">
                    <p>Are you sure you want to extend this transaction?</p>
                    <p class="mb-4 text-red-800">You can only extend once for one day! Once you extend this action
                        cannot be reverted!</p>
                    <div class="flex flex-row">
                        <form action="{{ route('front.extendOrder', $transaction->id) }}" method="POST"
                            class="bg-green-500 text-white px-4 py-2 rounded-md mr-4">
                            @csrf
                            <button>Yes</button>
                        </form>
                        <button class="bg-red-500 text-white px-4 py-2 rounded-md" onclick="closeModal()">No</button>
                    </div>
                </div>
            </div>
            <div id="rate" class="fixed inset-0 z-10 flex items-center justify-center hidden">
                <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                <div class="bg-white p-8 rounded-md z-20">

                    <div class="flex flex-col">
                        <div class = "flex justify-end"><button data-bs-dismiss="rate"
                                class="bg-red-500 text-white px-2.5 py-1.5 font-semibold rounded-xl text-center justify-self-end"
                                onclick="closeRatingModal()">X</button></div>
                        @if ($exists)
                            <div class="flex mb-2">
                                <h4 class="text-xl text-text_black font-bold w-full text-start">Your Rating On
                                    {{ $transaction->vehicle_brand }}9-{{ $transaction->vehicle_id }}</h4>
                            </div>
                        @else
                            <div class="flex mb-2">
                                <h4 class="text-xl text-text_black font-bold w-full text-start">Rate
                                    {{ $transaction->vehicle_brand }}9-{{ $transaction->vehicle_id }}</h4>
                            </div>
                        @endif
                        <form action="{{ route('front.orderDetailRate', $transaction->id) }}" method="POST">
                            @csrf
                            <div class = "flex w-auto h-auto justify-end mb-2">

                            </div>
                            <style>
                                .rating-css div {
                                    color: gold;
                                    font-size: 30px;
                                    font-family: sans-serif;
                                    font-weight: 800;
                                    text-align: center;
                                    text-transform: uppercase;
                                    padding: 20px 0;
                                    transition: all 0.5s;
                                }

                                .rating-css input {
                                    display: none;
                                }

                                .rating-css input+label {
                                    font-size: 30px;
                                    cursor: pointer;
                                    transition: all 0.5s;
                                }

                                .rating-css input:checked+label~label {
                                    color: #151562;
                                }

                                .rating-css label:active {
                                    transform: scale(0.8);
                                    transition: 0.3s ease;
                                }

                                .star-icon .off {
                                    cursor: auto;
                                }
                            </style>
                            <div class="flex flex-col">
                                @if ($exists)
                                    <div class="rating-css">
                                        <div class="star-icon off">
                                            @for ($i = 1; $i <= $rating->rating; $i++)
                                                <input type="radio" value="{{ $i }}" name="product_rating"
                                                    checked id="rating{{ $i }}" disabled>
                                                <label for="rating{{ $i }}"
                                                    class="fa fa-star checked off"></label>
                                            @endfor
                                            @for ($i = $rating->rating + 1; $i <= 5; $i++)
                                                <input type="radio" value="{{ $i }}" name="product_rating"
                                                    id="rating{{ $i }}" disabled>
                                                <label for="rating{{ $i }}" class="fa fa-star off"></label>
                                            @endfor
                                        </div>
                                    </div>
                                @else
                                    <div class="rating-css">
                                        <div class="star-icon">
                                            <input type="radio" value="1" name="product_rating" checked
                                                id="rating1">
                                            <label for="rating1" class="fa fa-star"></label>
                                            <input type="radio" value="2" name="product_rating"
                                                id="rating2">
                                            <label for="rating2" class="fa fa-star"></label>
                                            <input type="radio" value="3" name="product_rating"
                                                id="rating3">
                                            <label for="rating3" class="fa fa-star"></label>
                                            <input type="radio" value="4" name="product_rating"
                                                id="rating4">
                                            <label for="rating4" class="fa fa-star"></label>
                                            <input type="radio" value="5" name="product_rating"
                                                id="rating5">
                                            <label for="rating5" class="fa fa-star"></label>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="description" value="{{ __('Description') }}" />
                                    <input value="{{ $exists ? $rating->review : '' }}" name="desc"
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 mb-3 w-96 rounded-md shadow-sm mt-1 block"
                                        id="description_rating" type="text" placeholder="Description"
                                        {{ $exists ? 'disabled' : '' }}>
                                    <x-input-error for="name" class="mt-2" />
                                </div>
                            </div>
                            <button
                                class="bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-md mr-4 {{ $exists ? 'hidden' : '' }}">
                                Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <footer class="py-10 md:pt-[100px] md:pb-[70px] container">
                <p class="text-base text-center text-text_semiblack">
                    All Rights Reserved. Copyright BuildWith Angga 2023.
                </p>
            </footer>
    </x-front-layout>
</body>
<script>
    let id = null;

    document.querySelector()

    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    function openRatingModal() {
        document.getElementById('rate').classList.remove('hidden');
    }

    function closeRatingModal() {
        document.getElementById('rate').classList.add('hidden');
    }
</script>

</html>
