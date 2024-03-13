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
            @if (session('error'))
                <div class="mb-5" role="alert">
                    <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                        Error!
                    </div>
                    <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                        <p>
                        <ul>
                            <li>{{ session('error') }}</li>
                        </ul>
                        </p>
                    </div>
                </div>
            @endif
            @if (session('success'))
                <div class="mb-5" role="alert">
                    <div class="px-4 py-2 font-bold text-white bg-green-700 rounded-t">
                        Success!
                    </div>
                    <div class="px-4 py-3 text-green-700 bg-green-100 border border-t-0 border-green-400 rounded-b">
                        <p>
                        <ul>
                            <li>{{ session('success') }}</li>
                        </ul>
                        </p>
                    </div>
                </div>
            @endif
            {{-- Content --}}
            <div>
                @foreach ($data as $voucherCategory)
                    <div class="bg-white rounded-lg flex flex-row p-4 my-4 relative"
                        data-voucher-id="{{ $voucherCategory->id }}">
                        <div>
                            <img src="{{ str_replace('"', '', Storage::url($voucherCategory->voucher_picture)) }}"
                                alt="" class="rounded-md w-96 h-64 object-left">
                        </div>
                        <div class="flex flex-col mx-12 my-9 text-lg">
                            <p class="my-1"><span class="inline-block w-48">Name</span>:
                                {{ $voucherCategory->voucher_name }}
                            </p>
                            <p class="my-1"><span class="inline-block w-48">Nominal</span>: Rp
                                {{ $voucherCategory->voucher_nominal }}</p>
                            <p class="my-1"><span class="inline-block w-48">Price</span>:
                                {{ $voucherCategory->voucher_price }} Points</p>
                            <p class="my-1"><span class="inline-block w-48">Expired Date</span>:
                                {{ $voucherCategory->expired_date }}</p>
                            <p class="my-1"><span class="inline-block w-48">Minimum Spending</span>: Rp
                                {{ $voucherCategory->minimum_spending }}</p>
                        </div>
                        <button
                            class="bg-blue-500 text-white px-4 py-2 rounded-md absolute bottom-4 right-4 btnPrchs
                                @if (isset($voucherCategory->vouchers[0])) @foreach ($voucherCategory->vouchers as $vouchers)
                                        @if ($vouchers->user_id == $user->id && $vouchers->qty == 1)
                                        bg-grey hover:bg-grey @endif
                                    @endforeach
                                @endif"
                            onclick="openModal(); selectVoucher(this);"
                            @if (isset($voucherCategory->vouchers[0])) @foreach ($voucherCategory->vouchers as $vouchers)
                                        @if ($vouchers->user_id == $user->id && $vouchers->qty == 1)
                                            disabled @endif
                            @endforeach
                @endif>Purchase</button>

            </div>
            @endforeach
        </div>
        </div>
        {{ $data->onEachSide(1)->links() }}

        {{-- Modal --}}
        <div id="modal" class="fixed inset-0 z-10 flex items-center justify-center hidden">
            <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
            <div class="bg-white p-8 rounded-md z-20">
                <p class="mb-4">Are you sure you want to buy this voucher?</p>
                <div class="flex flex-row">
                    <form id="purchaseForm" action="" method="POST"
                        class="bg-green-500 text-white px-4 py-2 rounded-md mr-4">
                        @csrf
                        <button onclick="confirmPurchase()">Yes</button>
                    </form>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-md" onclick="closeModal()">No</button>
                </div>
            </div>
        </div>
        <br>
        <footer class="w-screen mt-32 pt-32 pb-16 px-20 lg:px-[160px] bg-[#060523]">
            <div class="flex flex-col gap-y-16 max-w-6xl mx-auto">
                <div class="grid gap-y-12 md:grid-cols-2 md:gap-x-10">
                    <div class="flex flex-col gap-y-8 h-fit ">
                        <svg width="144" height="44" viewBox="0 0 144 44" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M35.523 38.804L29.2215 30.5126C14.518 31.7286 9.43259 30.0704 6.44767 24.8744C3.69748 20.087 10.8698 13.4874 15.0708 11.608L13.4125 9.50754C12.4175 9.61809 -7.26088 20.7839 2.90998 33.8291C12.7271 43.5578 28.7793 41.1993 35.523 38.804Z"
                                fill="#1D5D9B" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.9552 12.9347L27.8949 28.7437C23.1411 29.5544 13.0094 29.9801 9.65369 25.8693C5.23158 20.4523 10.2065 16.0302 15.9552 12.9347ZM16.7291 15.6985L25.3522 27.196C22.9569 27.6013 17.2267 28.2396 14.1864 26.3116C9.65369 23.4372 12.0859 19.4573 16.7291 15.6985Z"
                                fill="#1D5D9B" />
                            <path d="M15.2919 8.29146L14.0758 0L50.6688 44H42.9301L15.2919 8.29146Z" fill="#75C2F6" />
                            <path
                                d="M26.0155 8.62312L21.0406 2.76382L26.0155 6.0804C29.3321 5.30653 47.6838 3.86935 54.0959 14.0402C59.2256 22.1769 52.4745 30.0335 48.4577 32.9447L51.2215 38.4724L41.0507 26.4221C45.0306 23.5477 51.5532 18.0201 46.3572 12.1608C42.6318 7.9598 32.7592 7.62814 26.0155 8.62312Z"
                                fill="#75C2F6" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M27.3421 10.1709L40.0557 25.206C44.3673 22.7739 48.2453 17.799 45.3622 13.9296C42.0014 9.41909 31.7642 9.17588 27.3421 10.1709ZM29.8848 11.4975L38.3974 21.6683C39.9083 20.3786 42.2854 17.4188 41.6034 15.1457C40.6085 11.8291 36.1864 11.0553 29.8848 11.4975Z"
                                fill="#1D5D9B" />
                            <path
                                d="M76.4905 25.9869H80.3049L82.5641 28.9158L84.1761 30.823L88.0473 35.7954H83.9604L81.3266 32.4578L80.2028 30.8684L76.4905 25.9869ZM88.6036 22.1725C88.6036 24.6776 88.1343 26.8232 87.1959 28.6093C86.265 30.3878 84.9935 31.7501 83.3814 32.6962C81.777 33.6422 79.9568 34.1152 77.9209 34.1152C75.885 34.1152 74.0611 33.6422 72.449 32.6962C70.8446 31.7426 69.5731 30.3765 68.6346 28.5979C67.7037 26.8118 67.2383 24.67 67.2383 22.1725C67.2383 19.6674 67.7037 17.5255 68.6346 15.747C69.5731 13.9609 70.8446 12.5948 72.449 11.6487C74.0611 10.7027 75.885 10.2297 77.9209 10.2297C79.9568 10.2297 81.777 10.7027 83.3814 11.6487C84.9935 12.5948 86.265 13.9609 87.1959 15.747C88.1343 17.5255 88.6036 19.6674 88.6036 22.1725ZM84.3691 22.1725C84.3691 20.4091 84.0929 18.9219 83.5404 17.711C82.9955 16.4925 82.2386 15.5729 81.2699 14.9523C80.3011 14.3241 79.1848 14.0101 77.9209 14.0101C76.657 14.0101 75.5407 14.3241 74.5719 14.9523C73.6032 15.5729 72.8426 16.4925 72.2901 17.711C71.7452 18.9219 71.4727 20.4091 71.4727 22.1725C71.4727 23.9359 71.7452 25.4268 72.2901 26.6453C72.8426 27.8563 73.6032 28.7758 74.5719 29.404C75.5407 30.0246 76.657 30.3349 77.9209 30.3349C79.1848 30.3349 80.3011 30.0246 81.2699 29.404C82.2386 28.7758 82.9955 27.8563 83.5404 26.6453C84.0929 25.4268 84.3691 23.9359 84.3691 22.1725ZM98.7315 34.1493C97.6266 34.1493 96.6313 33.9525 95.7458 33.559C94.8679 33.1578 94.1716 32.5675 93.657 31.788C93.1499 31.0084 92.8964 30.0473 92.8964 28.9045C92.8964 27.9206 93.078 27.107 93.4413 26.4637C93.8046 25.8204 94.3003 25.3057 94.9285 24.9198C95.5566 24.5338 96.2643 24.2424 97.0514 24.0456C97.846 23.8413 98.6672 23.6937 99.5148 23.6029C100.537 23.4969 101.365 23.4023 102.001 23.3191C102.637 23.2282 103.098 23.092 103.386 22.9104C103.681 22.7212 103.829 22.4298 103.829 22.0362V21.9681C103.829 21.1129 103.575 20.4507 103.068 19.9814C102.561 19.5122 101.831 19.2776 100.877 19.2776C99.8706 19.2776 99.0721 19.4971 98.4818 19.936C97.899 20.375 97.5055 20.8934 97.3011 21.4913L93.464 20.9464C93.7667 19.8868 94.2662 19.0013 94.9625 18.2899C95.6588 17.5709 96.5102 17.0336 97.5168 16.6779C98.5234 16.3146 99.6359 16.133 100.854 16.133C101.695 16.133 102.531 16.2314 103.363 16.4281C104.196 16.6249 104.956 16.9503 105.645 17.4044C106.334 17.851 106.886 18.4602 107.303 19.2322C107.726 20.0041 107.938 20.9691 107.938 22.1271V33.7974H103.988V31.402H103.851C103.602 31.8864 103.25 32.3405 102.796 32.7643C102.349 33.1805 101.785 33.5173 101.104 33.7747C100.431 34.0244 99.6397 34.1493 98.7315 34.1493ZM99.7987 31.1295C100.624 31.1295 101.339 30.9668 101.944 30.6414C102.55 30.3084 103.015 29.8694 103.341 29.3245C103.674 28.7796 103.84 28.1855 103.84 27.5422V25.4874C103.711 25.5933 103.492 25.6917 103.182 25.7825C102.879 25.8734 102.538 25.9528 102.16 26.0209C101.782 26.0891 101.407 26.1496 101.036 26.2026C100.665 26.2556 100.344 26.301 100.071 26.3388C99.4581 26.4221 98.9094 26.5583 98.425 26.7475C97.9406 26.9367 97.5584 27.2016 97.2784 27.5422C96.9984 27.8752 96.8584 28.3066 96.8584 28.8363C96.8584 29.5932 97.1346 30.1646 97.6871 30.5506C98.2396 30.9365 98.9434 31.1295 99.7987 31.1295ZM113.349 33.7974V16.36H117.334V19.2662H117.516C117.834 18.2597 118.379 17.4839 119.15 16.939C119.93 16.3865 120.819 16.1103 121.818 16.1103C122.045 16.1103 122.299 16.1216 122.579 16.1443C122.867 16.1595 123.105 16.1859 123.294 16.2238V20.0041C123.12 19.9436 122.844 19.8906 122.465 19.8452C122.095 19.7922 121.735 19.7657 121.387 19.7657C120.638 19.7657 119.964 19.9285 119.366 20.2539C118.776 20.5718 118.31 21.0145 117.97 21.5821C117.629 22.1498 117.459 22.8044 117.459 23.5461V33.7974H113.349ZM141.085 20.9691L137.339 21.3778C137.233 20.9994 137.047 20.6437 136.782 20.3107C136.525 19.9777 136.177 19.709 135.738 19.5046C135.299 19.3003 134.762 19.1981 134.126 19.1981C133.271 19.1981 132.552 19.3835 131.969 19.7544C131.394 20.1252 131.11 20.6058 131.118 21.1962C131.11 21.7032 131.295 22.1157 131.674 22.4336C132.06 22.7514 132.696 23.0125 133.581 23.2169L136.555 23.8526C138.205 24.2083 139.431 24.7722 140.234 25.5441C141.043 26.3161 141.452 27.3265 141.46 28.5752C141.452 29.6726 141.13 30.6414 140.495 31.4815C139.866 32.314 138.992 32.9649 137.872 33.4341C136.752 33.9033 135.466 34.1379 134.012 34.1379C131.878 34.1379 130.16 33.6914 128.858 32.7983C127.557 31.8977 126.781 30.6452 126.531 29.0407L130.539 28.6547C130.72 29.4418 131.106 30.0359 131.697 30.437C132.287 30.8382 133.055 31.0387 134.001 31.0387C134.977 31.0387 135.761 30.8382 136.351 30.437C136.949 30.0359 137.248 29.5402 137.248 28.9499C137.248 28.4504 137.055 28.0379 136.669 27.7125C136.29 27.387 135.7 27.1373 134.898 26.9632L131.924 26.3388C130.251 25.9907 129.014 25.4041 128.211 24.5792C127.409 23.7467 127.012 22.6947 127.019 21.4232C127.012 20.3485 127.303 19.4176 127.893 18.6305C128.491 17.8358 129.32 17.2228 130.38 16.7914C131.447 16.3524 132.677 16.133 134.069 16.133C136.113 16.133 137.721 16.5681 138.894 17.4385C140.075 18.3088 140.805 19.4857 141.085 20.9691Z"
                                fill="#1D5D9B" />
                        </svg>
                        <p class="text-[#B9B8CE]  font-normal text-[14px] lg:text-base">
                            Legitimate, extravagant yet refined services <br>
                            which lends the ability toacquire various types <br>
                            of automobileon just a few touches
                        </p>
                        <div class="flex flex-row gap-x-5 md:gap-x-8 items-center ">
                            <a href="">
                                <svg width="27" height="19" viewBox="0 0 27 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M25.5279 1.45463C25.9472 1.8759 26.2493 2.40018 26.4042 2.97527C27.2959 6.58214 27.0899 12.2787 26.4215 16.0247C26.2666 16.5998 25.9645 17.1241 25.5452 17.5454C25.126 17.9666 24.6042 18.2702 24.0318 18.4258C21.9366 19 13.5037 19 13.5037 19C13.5037 19 5.07072 19 2.97547 18.4258C2.40313 18.2702 1.88135 17.9666 1.46209 17.5454C1.04283 17.1241 0.740722 16.5998 0.585848 16.0247C-0.311126 12.4335 -0.0652366 6.73352 0.568533 2.99268C0.723405 2.41759 1.02551 1.8933 1.44477 1.47202C1.86403 1.05075 2.38581 0.747189 2.95815 0.591579C5.0534 0.017395 13.4863 0 13.4863 0C13.4863 0 21.9193 0 24.0145 0.574174C24.5869 0.729794 25.1087 1.03336 25.5279 1.45463ZM17.7981 9.49999L10.8023 13.5714V5.42856L17.7981 9.49999Z"
                                        fill="#1D5D9B" />
                                </svg>
                            </a>
                            <a href="">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.5001 2.25225C15.8377 2.25225 16.2331 2.265 17.5511 2.32514C18.7699 2.38071 19.4317 2.58435 19.8722 2.75553C20.4557 2.98229 20.8721 3.25316 21.3095 3.69055C21.7469 4.12799 22.0178 4.54439 22.2445 5.12786C22.4157 5.56832 22.6194 6.23019 22.6749 7.44893C22.7351 8.767 22.7478 9.16236 22.7478 12.5C22.7478 15.8376 22.7351 16.233 22.6749 17.5511C22.6194 18.7698 22.4157 19.4317 22.2445 19.8721C22.0178 20.4556 21.7469 20.872 21.3095 21.3094C20.8721 21.7468 20.4557 22.0177 19.8722 22.2445C19.4317 22.4157 18.7699 22.6193 17.5511 22.6749C16.2333 22.735 15.8379 22.7478 12.5001 22.7478C9.16215 22.7478 8.76688 22.735 7.44895 22.6749C6.23021 22.6193 5.56834 22.4157 5.12788 22.2445C4.54441 22.0177 4.128 21.7468 3.69061 21.3094C3.25322 20.872 2.9823 20.4556 2.75554 19.8721C2.58436 19.4317 2.38072 18.7698 2.32515 17.5511C2.26501 16.233 2.25226 15.8376 2.25226 12.5C2.25226 9.16236 2.26501 8.767 2.32515 7.44893C2.38072 6.23019 2.58436 5.56832 2.75554 5.12786C2.9823 4.54439 3.25317 4.12799 3.69061 3.6906C4.128 3.25316 4.54441 2.98229 5.12788 2.75553C5.56834 2.58435 6.23021 2.38071 7.44895 2.32514C8.76703 2.265 9.1624 2.25225 12.5001 2.25225ZM12.5001 0C9.10524 0 8.67955 0.0143895 7.34629 0.0752221C6.01581 0.135906 5.10713 0.347233 4.31204 0.656209C3.49005 0.975655 2.79295 1.40307 2.09799 2.09798C1.40308 2.79294 0.975658 3.49004 0.656261 4.31203C0.347234 5.10712 0.135906 6.01579 0.0752224 7.34627C0.0143895 8.67952 0 9.1052 0 12.5C0 15.8948 0.0143895 16.3205 0.0752224 17.6537C0.135906 18.9842 0.347234 19.8929 0.656261 20.688C0.975658 21.51 1.40308 22.2071 2.09799 22.902C2.79295 23.5969 3.49005 24.0243 4.31204 24.3437C5.10713 24.6528 6.01581 24.8641 7.34629 24.9248C8.67955 24.9856 9.10524 25 12.5001 25C15.8949 25 16.3205 24.9856 17.6538 24.9248C18.9843 24.8641 19.893 24.6528 20.688 24.3437C21.51 24.0243 22.2071 23.5969 22.9021 22.902C23.597 22.2071 24.0244 21.51 24.3439 20.688C24.6529 19.8929 24.8642 18.9842 24.9249 17.6537C24.9857 16.3205 25.0001 15.8948 25.0001 12.5C25.0001 9.1052 24.9857 8.67952 24.9249 7.34627C24.8642 6.01579 24.6529 5.10712 24.3439 4.31203C24.0244 3.49004 23.597 2.79294 22.9021 2.09798C22.2071 1.40307 21.51 0.975655 20.688 0.656209C19.893 0.347233 18.9843 0.135906 17.6538 0.0752221C16.3205 0.0143895 15.8949 0 12.5001 0Z"
                                        fill="#1D5D9B" />
                                    <path
                                        d="M12.5117 6.08643C8.96661 6.08643 6.09277 8.96025 6.09277 12.5053C6.09277 16.0504 8.96661 18.9243 12.5117 18.9243C16.0568 18.9243 18.9306 16.0504 18.9306 12.5053C18.9306 8.96025 16.0568 6.08643 12.5117 6.08643ZM12.5117 16.672C10.2105 16.672 8.34503 14.8065 8.34503 12.5053C8.34503 10.2041 10.2105 8.33867 12.5117 8.33867C14.8129 8.33867 16.6784 10.2041 16.6784 12.5053C16.6784 14.8065 14.8129 16.672 12.5117 16.672Z"
                                        fill="#1D5D9B" />
                                    <path
                                        d="M20.6799 5.82962C20.6799 6.65801 20.0083 7.3296 19.1799 7.3296C18.3515 7.3296 17.6799 6.65801 17.6799 5.82962C17.6799 5.00118 18.3515 4.32959 19.1799 4.32959C20.0083 4.32959 20.6799 5.00118 20.6799 5.82962Z"
                                        fill="#1D5D9B" />
                                </svg>
                            </a>
                            <a href="">
                                <svg width="25" height="21" viewBox="0 0 25 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M25.0001 2.40485C24.081 2.81316 23.0919 3.08813 22.0544 3.21229C23.1135 2.57733 23.9268 1.5724 24.3093 0.374974C23.3194 0.96327 22.2203 1.38908 21.0528 1.6199C20.1171 0.623294 18.783 0 17.3089 0C14.4766 0 12.1801 2.29652 12.1801 5.12884C12.1801 5.53048 12.2259 5.92212 12.3134 6.29793C8.05033 6.08461 4.2714 4.04224 1.74156 0.939106C1.29992 1.69656 1.04743 2.57734 1.04743 3.51728C1.04743 5.29634 1.95154 6.86624 3.32896 7.78618C2.48734 7.75952 1.69739 7.52869 1.00493 7.14455V7.20871C1.00493 9.69439 2.77399 11.7668 5.11884 12.2392C4.68887 12.3559 4.23557 12.4192 3.7681 12.4192C3.43728 12.4192 3.11564 12.3867 2.80232 12.3267C3.45478 14.3641 5.34966 15.8473 7.59369 15.889C5.8388 17.2639 3.62727 18.0847 1.22409 18.0847C0.809114 18.0847 0.400808 18.0605 0 18.0122C2.26986 19.4671 4.96552 20.3171 7.862 20.3171C17.2956 20.3171 22.4544 12.5017 22.4544 5.72463C22.4544 5.50215 22.4503 5.2805 22.4394 5.06135C23.4427 4.3364 24.3126 3.43312 25.0001 2.40485Z"
                                        fill="#1D5D9B" />
                                </svg>
                            </a>
                            <a href="">
                                <svg width="23" height="22" viewBox="0 0 23 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.97371 2.37906C4.97371 3.67603 3.98618 4.72564 2.44184 4.72564C0.957665 4.72564 -0.0298722 3.67603 0.000689851 2.37906C-0.0298722 1.01905 0.957641 0 2.47142 0C3.98615 0 4.94411 1.01905 4.97371 2.37906ZM0.124853 21.6866V6.57941H4.81994V21.6856H0.124853V21.6866Z"
                                        fill="#1D5D9B" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.58119 11.4005C8.58119 9.51614 8.51911 7.90972 8.45703 6.58123H12.5351L12.7519 8.65086H12.8446C13.4625 7.69293 15.0069 6.24219 17.5091 6.24219C20.5978 6.24219 22.9148 8.28124 22.9148 12.728V21.6884H18.2197V13.3163C18.2197 11.369 17.5406 10.0414 15.8416 10.0414C14.5437 10.0414 13.772 10.9373 13.4635 11.8016C13.3393 12.111 13.2782 12.5427 13.2782 12.9763V21.6884H8.58309V11.4005H8.58119Z"
                                        fill="#1D5D9B" />
                                </svg>
                            </a>
                            <a href="">
                                <svg width="13" height="23" viewBox="0 0 13 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.6589 4.12273C11.0096 3.99286 10.1327 3.89585 9.58114 3.89585C8.08774 3.89585 7.99073 4.54515 7.99073 5.58405V7.43343H11.7239L11.3984 11.2643H7.99073V22.9167H3.31649V11.2643H0.914062V7.43343H3.31649V5.06384C3.31649 1.81806 4.84198 0 8.67212 0C10.0028 0 10.9768 0.194793 12.2425 0.454516L11.6589 4.12273Z"
                                        fill="#1D5D9B" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-y-8 md:grid-cols-4 md:gap-x-12">
                        <div class="flex flex-col gap-y-4">
                            <p class="text-[#B9B8CE] font-medium text-[16px] lg:text-[18px]">
                                Pages
                            </p>
                            <div class="flex flex-col gap-y-2">
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086]  font-normal hover:text-white ">
                                    Home
                                </a>
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086]  font-normal hover:text-white">
                                    Catalogs
                                </a>
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086]  font-normal hover:text-white">
                                    Booked
                                </a>
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086]  font-normal hover:text-white">
                                    Lost & Found
                                </a>
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086]  font-normal hover:text-white">
                                    Vouchers
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-col gap-y-4">
                            <p class="text-[#B9B8CE]  font-medium text-[16px] lg:text-[18px]">
                                Cars
                            </p>
                            <div class="flex flex-col gap-y-2">
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086]  font-normal hover:text-white">
                                    Catalog
                                </a>
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086]  font-normal hover:text-white">
                                    Vouchers
                                </a>
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086]  font-normal hover:text-white">
                                    Popular
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-col gap-y-4">
                            <p class="text-[#B9B8CE] font-medium text-[16px] lg:text-[18px]">
                                Creators
                            </p>
                            <div class="flex flex-col gap-y-2">
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086] font-normal hover:text-white">
                                    Abdhy
                                </a>
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086] font-normal hover:text-white">
                                    Bella
                                </a>
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086] font-normal hover:text-white">
                                    Daniel
                                </a>
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086] font-normal hover:text-white">
                                    Joel
                                </a>
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086] font-normal hover:text-white">
                                    Ryan
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-col gap-y-4">
                            <p class="text-[#B9B8CE] font-medium text-[16px] lg:text-[18px]">
                                Support
                            </p>
                            <div class="flex flex-col gap-y-2">
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086]  font-normal hover:text-white">
                                    FAQ
                                </a>
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086]  font-normal hover:text-white">
                                    Benefits
                                </a>
                                <a href=""
                                    class="text-[14px] lg:text-base text-[#717086]  font-normal hover:text-white">
                                    Lost & Found
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-y-10 ">
                    <hr class="bg-gray-200">
                    <div class="flex flex-col gap-y-5 text-center md:flex-row md:justify-between items-center">
                        <p class="text-[#717086]  font-normal lg:text-base"> Terms & Conditions | Privacy Policy</p>
                        <p class="text-[#717086]  font-normal lg:text-base"> Copyright © 2020. All right reserved </p>
                    </div>
                </div>
            </div>
    
        </footer>
    </x-front-layout>
</body>
<script>
    function selectVoucher(button) {
        // Get the voucher ID from the button's parent element (assumes using data attributes)
        const voucherElement = button.parentElement;
        const voucherId = voucherElement.getAttribute('data-voucher-id');

        // Update the form action with the selected voucher ID
        const form = document.getElementById('purchaseForm');
        form.action = "{{ route('front.createVoucher', '') }}" + '/' + voucherId;

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
        // Handle the purchase logic, e.g., submit the form
        const form = document.getElementById('purchaseForm');
        form.submit();

        // Close the modal after confirming the purchase
        closeModal();
    }
</script>

</html>
