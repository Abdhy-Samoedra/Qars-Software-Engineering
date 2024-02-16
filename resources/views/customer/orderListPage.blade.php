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
        <div class="container containCatalog gap-12">
            {{-- Active Buttons --}}
            <div class="my-14">
                <a href="/orders?status=reserved"
                    class="{{ Request::get('status') == 'reserved' || !Request::get('status') ? 'bg-blue-900 text-white font-semibold' : 'font-normal bg-slate-300 hover:bg-blue-800 hover:text-white' }} p-2 rounded-lg m-2">Reserved</a>
                <a href="/orders?status=ongoing"
                    class="{{ Request::get('status') == 'ongoing' ? 'bg-blue-900 text-white font-semibold' : 'font-normal bg-slate-300 hover:bg-blue-800 hover:text-white' }} p-2 rounded-lg m-2">On Going</a>
                <a href="/orders?status=done"
                    class="{{ Request::get('status') == 'done' ? 'bg-blue-900 text-white font-semibold' : 'font-normal bg-slate-300 hover:bg-blue-800 hover:text-white' }} p-2 rounded-lg m-2">Done</a>
            </div>

            {{-- Content --}}
            <div class="flex flex-col gap-6">
                <div>
                    <ul class="flex container flex-wrap gap-6 pr-0 pl-0 containCard">
                        @foreach ($data as $transaction)
                            <li>
                                <a href="{{ route('front.orderDetail', [$transaction->id]) }}">
                                    <div class="bg-white rounded-3xl p-4">
                                        <div>
                                            <h5 class="text-lg text-text_black font-bold">
                                                {{$transaction->vehicle_brand}}
                                            </h5>
                                            <p class="text-sm font-normal text-text_semiblack">
                                                {{$transaction->category_name}}
                                            </p>

                                        </div>

                                        <img src="{{ $transaction->car_picture }}" class="rounded-3xl min-w-72 w-full h-48 m-2"
                                            alt="{{ $transaction->car_brand }}">
                                        {{-- Start Date --}}
                                        <div class="flex items-center justify-between gap-1">
                                            <p class="text-sm font-semibold text-blue-900 mt-2">
                                                {{ $transaction->start_date }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{$data->onEachSide(1)->links()}}
            <br>
        </div>
        <br>
        <footer class="py-10 md:pt-[100px] md:pb-[70px] container">
            <p class="text-base text-center text-text_semiblack">
                All Rights Reserved. Copyright BuildWith Angga 2023.
            </p>
        </footer>
    </x-front-layout>
</body>
</html>
