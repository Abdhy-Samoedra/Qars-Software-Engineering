<x-front-layout>
    <!-- Main Content -->
    <section class="relative py-[70px]">
      <div class="container">
        <!-- Breadcrumb -->
        <ul class="flex items-center gap-5 mb-[50px]">
          <li
              class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
            <a href="{{ route('front.index') }}">Home</a>
          </li>
          <li
              class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
            <a href="#!">
              {{ $vehicle->brand }}
            </a>
          </li>
          <li
              class="text-dark font-semibold text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
            Details
          </li>
        </ul>
  
        <div class="grid grid-cols-12 gap-[30px]">
          <!-- Car Preview -->          
          <div class="col-span-12 lg:col-span-8">
            <div class="bg-white p-4 rounded-[30px] flex flex-col gap-4" id="gallery">
              <img :src="thumbnails[activeThumbnail].url" :key="thumbnails[activeThumbnail].id"
                   class="md:h-[490px] rounded-[18px] h-auto w-full" alt="">
              <div class="grid items-center grid-cols-4 gap-3 md:gap-5">
                <div v-for="(thumbnail, index) in thumbnails" :key="thumbnail.id">
                  <a href="#!" @click="changeActive(index)">
                    <img :src="thumbnail.url" alt="" class="thumbnail"
                         :class="{ selected: index == activeThumbnail }">
                  </a>
                </div>
              </div>
            </div>
          </div>
  
          <!-- Details -->
          <div class="col-span-12 md:col-start-5 lg:col-start-auto md:col-span-8 lg:col-span-4">
            <div class="bg-white p-5 pb-[30px] rounded-3xl h-full">
              <div class="flex flex-col h-full divide-y divide-grey">
                <!-- Name, Category, Rating -->
                <div class="max-w-[230px] pb-5">
                  <h1 class="font-bold text-[28px] leading-[42px] text-text_black mb-[6px]">
                    {{ $vehicle->brand }}
                  </h1>
                  <p class="text-text_semiblack font-normal text-base mb-[10px]">
                    {{ $vehicle->type }}
                  </p>
                  <div class="flex items-center gap-2">
                    <span class="flex items-center gap-1">
                    @php
                        $temp = 0;
                        $count = 0;
                        $check = 0;
                        
                        if(isset($vehicleRating)){
                            foreach ($vehicleRating->transactions as $transaction) {
                                if (isset($transaction->rating->rating)) {
                                    $check = 1;
                                    $count += 1;
                                    $temp = $temp + $transaction->rating->rating;
                                }
                            }
                            if($check == 1){
                                $temp = $temp / $count;
                                $temp = number_format($temp, 1);
                            }else{
                                $temp = null;
                            }
                        }

                    @endphp
                      @if(isset($vehicleRating->transactions[0]->rating->rating))
                        @for ($i = 0; $i < intval($temp); $i++)
                          <img src="/svgs/ic-star.svg" class="h-[22px] w-[22px]" alt="">
                        @endfor
                      @else
                        No Ratings Available  
                      @endif
                    </span>
                    <p class="text-base font-semibold text-dark mt-[2px]">
                      @if($vehicleRating)
                        ({{count(($vehicleRating->transactions))}})
                      @else
                        (0)
                      @endif
                    </p>
                  </div>
                </div>
                <!-- Features -->
                <ul class="flex flex-col gap-4 flex-start pt-5 pb-[25px]">
                  @php
                    $features = explode(',', $vehicle->car_description);
                  @endphp
                  @foreach ($features as $feature)
                    <li class="flex items-center gap-3 text-base font-semibold text-text_black">
                      <img src="/svgs/ic-checkDark.svg" alt="">
                      {{ $feature }}
                    </li>
                  @endforeach
                </ul>
                <!-- Price, CTA Button -->
                <div class="flex items-center justify-between gap-4 pt-5 mt-auto">
                  <div>
                    <p class="font-bold text-primary text-[22px]">
                      ${{ number_format($vehicle->rental_price) }}
                    </p>
                    <p class="text-base font-normal text-text_semiblack">
                      /day
                    </p>
                  </div>
                  <div class="w-full max-w-[70%]">
                    <!-- Button Primary -->
                    <div class="p-1 rounded-full bg-primary group">
                      <a href="{{route('front.checkout' , $vehicle->slug)}}" class="btn-primary">
                        <p>
                          Rent Now
                        </p>
                        <img src="/svgs/ic-arrow-right.svg" alt="">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="splide container relative pt-[100px] pb-[100px]">
        <header class="mb-[30px]">
            <h2 class="font-bold text-text_black text-[26px] mb-1">
                Review
            </h2>
            <p class="text-base text-text_semiblack">Evaluate your wants</p>
            <p class="font-bold text-[20px] mt-7" id="forMobile">Swipe left, to see more.</p>
        </header>
        <div class="splide__track">
            <div class="splide__list flex items-center md:flex-row">

                {{-- Check if review is available in this vehicle --}}
                @if (isset($vehicleRating->transactions[0]->rating->review))
                    @foreach ($vehicleRating->transactions as $rate)
                        <div class="splide__slide w-52 p-10 lg:max-w-[536px] bg-white rounded-xl">

                            <p class="w-full">{{ $rate->rating->review ?? 'No Review' }}</p>
                            <br><br>
                            <div class="flex flex-row justify-between">
                                <div>

                                    <span class="font-bold text-dark text-[16px] mb-1">{{ $rate->user->name }}</span>

                                    {{-- <p class="text-base text-secondary text-[12px]">Mobile Developer</p> --}}

                                </div>
                                <div>
                                    <img src="{{ Storage::url($rate->user->profile_photo_path) }}"
                                        class="rounded-full w-20" alt="">
                                </div>
                            </div>

                        </div>
                    @endforeach
                @else
                    <span class="font-bold text-text_black text-[20px] mb-1">No Reviews Currently</span>
                @endif

            </div>
        </div>
        </div>
    </section>

    <!-- Similar Cars -->
    <section class="bg-darkGrey">
        <div class="container relative py-[100px]">
            <header class="mb-[30px]">
                <h2 class="font-bold text-text_black text-[26px] mb-1">
                    Similar Cars
                </h2>
                <p class="text-base text-text_semiblack">Start your big day</p>
                <p class="font-bold text-[20px] mt-7" id="forMobile">Swipe left, to see more.</p>
            </header>

            <!-- Cars -->

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
                @if (isset($similiarItems[0]))
                    @foreach ($similiarItems as $similiarItem)
                        <!-- Card -->
                        {{-- @dd($similiarItem->transactions[0]->rating->rating) --}}
                        <a href="{{ route('front.detailCatalogue', [$similiarItem->slug]) }}">
                            <div class="card-popular">
                                <div>
                                    <h5 class="text-lg text-text_black font-bold mb-[2px]">
                                        {{ $similiarItem->brand }}
                                    </h5>
                                    <p class="text-sm font-normal text-text_semiblack">
                                        {{ $similiarItem->vehicle_category_id ? $similiarItem->vehicleCategory->vehicle_category_name : '-' }}
                                    </p>
                                    {{-- <a href="{{ route('front.detail', $similiarItem->slug) }}" class="absolute inset-0"></a> --}}
                                </div>
                                <img src="{{ $similiarItem->thumbnail }}"
                                    class="rounded-[18px] min-w-[216px] w-full h-[150px]" alt="">
                                <div class="flex items-center justify-between gap-1">
                                    <!-- Price -->
                                    <p class="text-sm font-normal text-text_semiblack">
                                        <span
                                            class="text-base font-bold text-primary">${{ number_format($similiarItem->rental_price) }}</span>/day
                                    </p>
                                    <!-- Rating -->
                                    <p class="text-text_black text-xs font-semibold flex items-center gap-[2px]">
                                      {{-- Making the the rating that shown is the average from all existing ratings --}}
                                        @php
                                            $temp = 0;
                                            $count = 0;
                                            $check = 0;
                                            // Check if similiar item is exist
                                            if(isset($similiarItem)){
                                              // iterate all of the similiar items
                                                foreach ($similiarItem->transactions as $transaction) {
                                                  // check if rating exist in the similiar item
                                                    if (isset($transaction->rating->rating)) {
                                                        $check = 1;
                                                        $count += 1;
                                                        $temp = $temp + $transaction->rating->rating;
                                                    }
                                                }
                                                // with $check, we make sure $count can't be 0, so $temp can't be divided by zero
                                                if($check == 1){
                                                    $temp = $temp / $count;
                                                    $temp = number_format($temp, 1);
                                                }else{
                                                  // if rating doesn't exist, assign $temp as null
                                                    $temp = null;
                                                }
                                            } 
                                        @endphp
                                        {{-- Check if $temp is null or not --}}
                                        ({{ $temp ?? 'No rating available' }}/5)
                                        <img src="/svgs/ic-star.svg" alt="">
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                {{-- Show if no similiar items exist in this vehicle --}}
                    <span class="font-bold text-text_black text-[20px] mb-1">No Similiar Vehicle Currently</span>
                @endif
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script>
        const {
            createApp
        } = Vue
        createApp({
            data() {
                return {
                    activeThumbnail: 0,
                    thumbnails: [
                        @foreach (json_decode($vehicle->car_picture) as $key => $photo)
                            {
                                id: {{ $key }},
                                url: "{{ Storage::url($photo) }}"
                            },
                        @endforeach
                    ],
                }
            },
            methods: {
                changeActive(id) {
                    this.activeThumbnail = id;
                }
            }
        }).mount('#gallery')
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</x-front-layout>
