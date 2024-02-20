<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
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
            <div class="flex flex-row gap-14 my-6 mx-20 w-full">
                <div class="rounded-3xl w-2/5 h-full m-2">
                    <img src="{{ $transaction->car_picture }}" class="rounded-3xl min-w-72 w-full h-48 m-2" alt="{{ $transaction->car_brand }}">
                </div>
                <div class="rounded-3xl w-2/5 h-full m-2 bg-white p-5">
                    <div class="flex mb-2">
                        <h4 class="text-xl text-text_black font-bold w-full text-start">{{$status}}</h4>
                    </div>
                    <div class="flex mb-2">
                        <span class="font-normal inline-block w-1/2 text-start">Car choosen</span>
                        <h5 class="text-lg text-text_black font-bold w-1/2 text-end">{{$transaction->vehicle_brand}}</h5>
                    </div>
                    <div class="flex mb-2">
                        <span class="font-normal inline-block w-1/2 text-start">Total Day</span>
                        <h5 class="text-lg text-text_black font-bold w-1/2 text-end">{{$transaction->total_days}} Days</h5>
                    </div>
                    <div class="flex mb-2">
                        <span class="font-normal inline-block w-1/2 text-start">Start Date</span>
                        <h5 class="text-lg text-text_black font-bold w-1/2 text-end">{{$transaction->start_date}}</h5>
                    </div>
                    <div class="flex mb-2">
                        <span class="font-normal inline-block w-1/2 text-start">End Date</span>
                        <h5 class="text-lg text-text_black font-bold w-1/2 text-end">{{$transaction->end_date}}</h5>
                    </div>
                    <div class="flex mb-2">
                        <span class="font-normal inline-block w-1/2 text-start">License Plate</span>
                        <h5 class="text-lg text-text_black font-bold w-1/2 text-end">{{$transaction->vehicle_id}}</h5>
                    </div>
                    <div class="flex mb-2">
                        <span class="font-normal inline-block w-1/2 text-start">Total Price</span>
                        <h5 class="text-lg text-text_black font-bold w-1/2 text-end">$ {{number_format($transaction->total_price, 2, '.', ',')}}</h5>
                    </div>
                    {{-- Extend & Rate Button --}}
                    @if ($status == 'Reserved' || $status == 'On Going')
                        <div class="flex justify-end">
                            <button class="bg-blue-900 hover:bg-blue-800 text-white font-semibold p-2 rounded-2xl w-full text-center my-1 py-3 {{$transaction->extend == 1 ? 'bg-grey hover:bg-grey' : ''}}" onclick="openModal();" {{$transaction->extend == 1 ? 'disabled' : ''}}>Extend</button>
                        </div>
                    @elseif ($status == 'Done')
                        <div class="flex justify-end">
                            {{-- menunggu ryan --}}
                            <a href=""
                                class="bg-blue-900 hover:bg-blue-800 text-white font-semibold p-2 rounded-2xl w-full text-center my-1 py-3">
                                Rate
                            </a>
                            {{-- menunggu ryan --}}
                        </div>
                    @endif
                <div>
                </div>
            </div>
        </div>
        <div id="modal" class="fixed inset-0 z-10 flex items-center justify-center hidden">
            <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
            <div class="bg-white p-8 rounded-md z-20">
                <p class="mb-4">Are you sure you want to extend this transaction?</p>
                <div class="flex flex-row">
                    <form action="{{ route('front.extendOrder', $transaction->id) }}" method="POST" class="bg-green-500 text-white px-4 py-2 rounded-md mr-4">
                        @csrf
                        <button>Yes</button>
                    </form>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md" onclick="closeModal()">No</button>
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
</script>
</html>
