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
            {{-- Title --}}
            <div class="my-5">
                <h1 class="font-bold text-3xl my-1">Vouchers</h1>
                <p class="font-light text-sm">Save some money by using your experience points</p>
            </div>
            {{-- Content --}}
            <div>
                @foreach ($data as $voucher)
                    <div class="bg-white rounded-lg flex flex-row p-4 my-4">
                        <div>
                            <img src="{{ str_replace('"', '', Storage::url($voucher->voucher_picture)) }}" alt="" class="rounded-md w-96 h-64 object-left">
                        </div>
                        <div class="flex flex-col mx-12 my-9 text-lg">
                            <p class="my-1"><span class="inline-block w-48">Name</span>:  {{ $voucher->voucher_name }}</p>
                            <p class="my-1"><span class="inline-block w-48">Nominal</span>:  {{ $voucher->voucher_nominal }}</p>
                            <p class="my-1"><span class="inline-block w-48">Price</span>:  {{ $voucher->voucher_price }}</p>
                            <p class="my-1"><span class="inline-block w-48">Expired Date</span>:  {{ $voucher->expired_date }}</p>
                            <p class="my-1"><span class="inline-block w-48">Minimum Spending</span>:  {{ $voucher->minimum_spending }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{$data->onEachSide(1)->links()}}
        <br>
        <footer class="py-10 md:pt-[100px] md:pb-[70px] container">
            <p class="text-base text-center text-text_semiblack">
                All Rights Reserved. Copyright BuildWith Angga 2023.
            </p>
        </footer>
    </x-front-layout>
</body>
</html>
