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
        <div>
            <div class="container containCatalog gap-12">
                 {{-- Title --}}
                <div class="my-5">
                    <h1 class="font-bold text-3xl my-1">Lost and Found</h1>
                    <p class="font-light text-sm">Find your belongings left in the car</p>
                </div>

                <div>
                    @foreach ($data as $lostAndFounds)
                        <div class="bg-white rounded-lg grid grid-cols-6 p-4 my-4 items-start gap-x-10">
                            <div class="rounded-md  object-left col-span-2">
                                <img src="{{ str_replace('"', '', Storage::url($lostAndFounds->lost_and_found_picture)) }}" alt="">
                            </div>
                            <div class="flex flex-col text-lg">
                                {{-- {{dd($lostAndFounds->vehicles)}} --}}
                                <p class="my-1" class="inline-block w-48">Car</p>
                                <p class="my-1" class="inline-block w-48">License Plate</p>
                                <p class="my-1" class="inline-block w-48">Found Date</p>
                                <p class="my-1" class="inline-block w-48">Taken Status</p>
                                <p class="my-1"  class="inline-block w-48">Description</p>

                            </div>
                            <div class="flex flex-col text-lg col-span-3">
                                <p class="my-1" class="inline-block w-48">: {{$lostAndFounds->vehicles ? $lostAndFounds->vehicles->type : '-' }}</p>
                                <p class="my-1" class="inline-block w-48">: {{$lostAndFounds->vehicle_id }}</p>
                                <p class="my-1" class="inline-block w-48">: {{$lostAndFounds->found_date }}</p>
                                @if($lostAndFounds->taken_status == 'Taken')
                                    <p class="my-1" class="inline-block w-48">: {{ $lostAndFounds->taken_date }}</p>
                                    @else
                                    <p class="my-1" class="inline-block w-48">:  - </p>
                                @endif
                                <p class="my-1"  class="inline-block w-48">: {{ $lostAndFounds->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            {{-- {{$data->onEachSide(1)->links()}} --}}
            <br>


            <footer class="py-10 md:pt-[100px] md:pb-[70px] container">
                <p class="text-base text-center text-text_semiblack">
                    All Rights Reserved. Copyright BuildWith Angga 2023.
                </p>
            </footer>    </x-front-layout>

</body>
