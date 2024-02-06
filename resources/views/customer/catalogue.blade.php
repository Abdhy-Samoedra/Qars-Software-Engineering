<x-front-layout>
    <style>
        .vehicle-card {
            opacity: 1;
            transition: opacity 1s;
        }
        .vehicle-card.hide {
            opacity: 0;
        }
    </style>
    <br>
    <div class="flex container containCatalog gap-12">
            {{-- nav category --}}
        <div class="flex flex-col items-center gap-y-2.5 sticky mb-6">
            <div class="font-bold text-xl">
                <h2>Categories</h2>
            </div>

            <div>
                <ul class="bg-white flex p-5 gap-y-5 flex-col items-center font-medium rounded-xl containList">
                    <li><button class="categoryBtn p-2 rounded-lg bg-blue-900 text-white w-24 activeCtgBtn btnct">All</button></li>
                    <li><button class="categoryBtn p-2 rounded-lg w-24 btnct">Off-Road</button></li>
                    <li><button class="categoryBtn p-2 rounded-lg w-24 btnct">Classic</button></li>
                    <li><button class="categoryBtn p-2 rounded-lg w-24 btnct">Family</button></li>
                    <li><button class="categoryBtn p-2 rounded-lg w-24 btnct">Sport</button></li>
                    <li><button class="categoryBtn p-2 rounded-lg w-24 btnct">Race</button></li>
                </ul>
            </div>

            {{-- <div>
                <ul class="bg-white flex p-2 flex-row items-center gap-y-5 font-medium rounded-xl containList">
                    <li><button class="categoryBtn p-2 rounded-lg bg-blue-900 text-white w-18 text-sm activeCtgBtn">All</button></li>
                    <li><button class="categoryBtn p-2 rounded-lg w-18 text-sm">Off-Road</button></li>
                    <li><button class="categoryBtn p-2 rounded-lg w-18 text-sm">Classic</button></li>
                    <li><button class="categoryBtn p-2 rounded-lg w-18 text-sm">Family</button></li>
                    <li><button class="categoryBtn p-2 rounded-lg w-18 text-sm">Sport</button></li>
                    <li><button class="categoryBtn p-2 rounded-lg w-18 text-sm">Race</button></li>
                </ul>
            </div> --}}

        </div>

        {{-- content --}}
        <div class="flex flex-col gap-6">
            <div class="listCar">
                <ul class="flex container flex-wrap gap-6 pr-0 pl-0 containCard">
                    @foreach ($vehicles as $key => $vehicle)
                        <li class=" {{ $vehicle->vehicle_category_id ? $vehicle->vehicleCategory->vehicle_category_name : '-' }} {{$key}} vehicle-card">
                            <a href="{{ route('front.detailCatalogue', [$vehicle->slug]) }}">
                                <div class="card-popular">    
                                    <div>
                                        <h5 class="text-lg text-text_black font-bold mb-[2px]">
                                            {{$vehicle->brand}}
                                        </h5>
                                        <p class="text-sm font-normal text-text_semiblack">
                                            {{ $vehicle->vehicle_category_id ? $vehicle->vehicleCategory->vehicle_category_name : '-' }}
                                        </p>
                                        
                                    </div>
                                    
                                    <img src="{{ $vehicle->thumbnail }}" class="rounded-[18px] min-w-[216px] w-full h-[150px]"
                                        alt="">
                                    <div class="flex items-center justify-between gap-1">
                                        <!-- Price -->
                                        <p class="text-sm font-normal text-text_semiblack">
                                            <span class="text-base font-bold text-primary">${{ number_format($vehicle->rental_price) }}</span>/day
                                        </p>
                                        <!-- Rating -->
                                        <p class="text-text_black text-xs font-semibold flex items-center gap-[2px]">
                                            (4,7/5)
                                            <img src="/svgs/ic-star.svg" alt="">
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            
            <div class="flex justify-end gap-5 container pagin p-6">
                <button class="bg-blue-900 pagin-prev p-2 rounded-xl text-white w-20"><</button>
                <button class="bg-blue-900 pagin-next p-2 rounded-xl text-white w-20">></button>
            </div>
            
        </div>
    </div>
</x-front-layout>