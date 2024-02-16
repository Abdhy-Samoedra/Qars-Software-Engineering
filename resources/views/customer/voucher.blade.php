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
        <div class="container gap-12">
            {{-- Title --}}
            <div class="my-5">
                <h1 class="font-bold text-3xl my-1">Vouchers</h1>
                <p class="font-light text-sm">Save some money by using your experience points</p>
            </div>
            {{-- Content --}}
            <div>
                @foreach ($data as $voucher)
                    <div class="bg-white rounded-lg flex flex-row p-4 my-4 relative" data-voucher-id="{{$voucher->id}}">
                        <div>
                            <img src="{{ str_replace('"', '', Storage::url($voucher->voucher_picture)) }}" alt="" class="rounded-md w-96 h-64 object-left">
                        </div>
                        <div class="flex flex-col mx-12 my-9 text-lg">
                            <p class="my-1"><span class="inline-block w-48">Name</span>:  {{ $voucher->voucher_name }}</p>
                            <p class="my-1"><span class="inline-block w-48">Nominal</span>:  Rp {{ $voucher->voucher_nominal }}</p>
                            <p class="my-1"><span class="inline-block w-48">Price</span>:  {{ $voucher->voucher_price }} Points</p>
                            <p class="my-1"><span class="inline-block w-48">Expired Date</span>:  {{ $voucher->expired_date }}</p>
                            <p class="my-1"><span class="inline-block w-48">Minimum Spending</span>:  Rp {{ $voucher->minimum_spending }}</p>
                        </div>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-md absolute bottom-4 right-4" onclick="openModal(); selectVoucher(this);">Purchase</button>
                    </div>
                @endforeach
            </div>
        </div>
        {{$data->onEachSide(1)->links()}}
        {{-- Modal --}}
        <div id="modal" class="fixed inset-0 z-10 flex items-center justify-center hidden">
            <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
            <div class="bg-white p-8 rounded-md z-20">
                <p class="mb-4">Are you sure you want to buy this voucher?</p>
                <button class="bg-green-500 text-white px-4 py-2 rounded-md mr-4" onclick="confirmPurchase(id)">Yes</button>
                <button class="bg-red-500 text-white px-4 py-2 rounded-md" onclick="closeModal()">No</button>
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

    function selectVoucher(button) {
        // Get the voucher details from the button's parent element (assumes using data attributes)
        const voucherElement = button.parentElement;
        id = voucherElement.getAttribute('data-voucher-id');

        // Open the modal after selecting the voucher
        openModal();
    }

    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    function confirmPurchase() {
        // Use AJAX to send the voucher data to the server
        // You can adjust the URL to match your Laravel route
        const url = '/vouchers';

        // Send a POST request with the voucher data
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                @csrf,
            },
            body: JSON.stringify({ id }),
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response from the server
            console.log(data);
        })
        .catch(error => console.error('Error:', error))
        .finally(() => {
            // Close the modal after confirming the purchase
            closeModal();
        });
    }
</script>
</html>

