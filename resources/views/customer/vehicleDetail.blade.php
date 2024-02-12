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
          {{-- <div class="col-span-12 lg:col-span-8">
            <div class="bg-white p-4 rounded-[30px] flex flex-col gap-4" id="gallery">
              <img src="{{$vehicle->thumbnail}}"
                   class="md:h-[490px] rounded-[18px] h-auto w-full" alt="">
              <div class="grid items-center grid-cols-4 gap-3 md:gap-5">
                @foreach((json_decode($vehicle->car_picture)) as $pic)
                  @if($loop->index < 4)
                    <div>
                      <a href="#!" @click="changeActive(index)">
                        <img src="{{ Storage::url($pic) }}" alt="" class="thumbnail">
                      </a>
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
          </div> --}}

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
                  <h1 class="font-bold text-[28px] leading-[42px] text-dark mb-[6px]">
                    {{ $vehicle->brand }}
                  </h1>
                  <p class="text-secondary font-normal text-base mb-[10px]">
                    {{ $vehicle->type }}
                  </p>
                  <div class="flex items-center gap-2">
                    <span class="flex items-center gap-1">
                      
                      @if(isset($vehicleRating->transactions[0]->rating->rating))
                        @for ($i = 0; $i < intval($vehicleRating->transactions[0]->rating->rating); $i++)
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
                    <li class="flex items-center gap-3 text-base font-semibold text-dark">
                      <img src="/svgs/ic-checkDark.svg" alt="">
                      {{ $feature }}
                    </li>
                  @endforeach
                </ul>
                <!-- Price, CTA Button -->
                <div class="flex items-center justify-between gap-4 pt-5 mt-auto">
                  <div>
                    <p class="font-bold text-dark text-[22px]">
                      ${{ number_format($vehicle->rental_price) }}
                    </p>
                    <p class="text-base font-normal text-secondary">
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
  
    <!-- FAQ -->
    {{-- <section class="container relative py-[100px]">
      <header class="text-center mb-[50px]">
        <h2 class="font-bold text-dark text-[26px] mb-1">
          Frequently Asked Questions
        </h2>
        <p class="text-base text-secondary">Learn more about Vrom and get a success</p>
      </header> --}}
  
      <!-- Questions -->
      {{-- <div class="grid md:grid-cols-2 gap-x-[50px] gap-y-6 max-w-[910px] w-full mx-auto">
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
           id="faq1">
          <div class="flex items-center justify-between gap-1">
            <p class="text-base font-semibold text-dark">
              What if I crash the car?
            </p>
            <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
          </div>
          <div class="hidden pt-4 max-w-[335px]" id="faq1-content">
            <p class="text-base text-dark leading-[26px]">
              Ipsum top talent busy making race that
              agreed both party. You can si amet lorem
              dolor get the rewards after winninng.
            </p>
          </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
           id="faq2">
          <div class="flex items-center justify-between gap-1">
            <p class="text-base font-semibold text-dark">
              What if I crash the car?
            </p>
            <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
          </div>
          <div class="hidden pt-4 max-w-[335px]" id="faq2-content">
            <p class="text-base text-dark leading-[26px]">
              Ipsum top talent busy making race that
              agreed both party. You can si amet lorem
              dolor get the rewards after winninng.
            </p>
          </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
           id="faq3">
          <div class="flex items-center justify-between gap-1">
            <p class="text-base font-semibold text-dark">
              What if I crash the car?
            </p>
            <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
          </div>
          <div class="hidden pt-4 max-w-[335px]" id="faq3-content">
            <p class="text-base text-dark leading-[26px]">
              Ipsum top talent busy making race that
              agreed both party. You can si amet lorem
              dolor get the rewards after winninng.
            </p>
          </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
           id="faq4">
          <div class="flex items-center justify-between gap-1">
            <p class="text-base font-semibold text-dark">
              What if I crash the car?
            </p>
            <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
          </div>
          <div class="hidden pt-4 max-w-[335px]" id="faq4-content">
            <p class="text-base text-dark leading-[26px]">
              Ipsum top talent busy making race that
              agreed both party. You can si amet lorem
              dolor get the rewards after winninng.
            </p>
          </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
           id="faq5">
          <div class="flex items-center justify-between gap-1">
            <p class="text-base font-semibold text-dark">
              What if I crash the car?
            </p>
            <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
          </div>
          <div class="hidden pt-4 max-w-[335px]" id="faq5-content">
            <p class="text-base text-dark leading-[26px]">
              Ipsum top talent busy making race that
              agreed both party. You can si amet lorem
              dolor get the rewards after winninng.
            </p>
          </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
           id="faq6">
          <div class="flex items-center justify-between gap-1">
            <p class="text-base font-semibold text-dark">
              What if I crash the car?
            </p>
            <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
          </div>
          <div class="hidden pt-4 max-w-[335px]" id="faq6-content">
            <p class="text-base text-dark leading-[26px]">
              Ipsum top talent busy making race that
              agreed both party. You can si amet lorem
              dolor get the rewards after winninng.
            </p>
          </div>
        </a>
      </div>
    </section> --}}

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
          {{-- @dd($vehicleRating) --}}
          @if(isset($vehicleRating->transactions[0]->rating->review))
            @foreach($vehicleRating->transactions as $rate)
              <div class="splide__slide w-52 p-10 lg:max-w-[536px] bg-white rounded-xl">
                
                <p class="w-full">{{$rate->rating->review}}</p>
                <br><br>
                  <div class="flex flex-row justify-between">
                    <div>

                      <span class="font-bold text-dark text-[16px] mb-1">{{$rate->user->name}}</span>
                  
                      {{-- <p class="text-base text-secondary text-[12px]">Mobile Developer</p> --}}

                    </div>
                    <div>
                      <img src="{{ Storage::url($rate->user->profile_photo_path) }}" class="rounded-full w-20" alt=""> 
                    </div>
                  </div>
                
              </div>
              @endforeach
          @else
              <span class="font-bold text-dark text-[20px] mb-1">No Reviews Currently</span>
          @endif
            {{-- <img src="/images/illustration-01.webp" class="w-64 lg:max-w-[536px]" alt="">
            <img src="/images/illustration-01.webp" class="w-64 lg:max-w-[536px]" alt="">
            <img src="/images/illustration-01.webp" class="w-64 lg:max-w-[536px]" alt=""> --}}
            {{-- <div class="max-w-[268px] w-full"> --}}
                
                {{-- <div class="flex flex-col gap-[30px]">
                    <header>
                        <h2 class="font-bold text-text_black text-[26px] mb-1">
                            Extra Benefits
                        </h2>
                        <p class="text-base text-text_semiblack">You drive safety and famous</p>
                    </header>
                    <!-- Benefits Item -->
                    <div class="flex items-center gap-4">
                        <div class="bg-text_black rounded-[26px] p-[19px]">
                            <img src="/svgs/ic-car.svg" alt="">
                        </div>
                        <div>
                            <h5 class="text-lg text-text_black font-bold mb-[2px]">
                                Delivery
                            </h5>
                            <p class="text-sm font-normal text-text_semiblack">Just sit tight and wait</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-text_black rounded-[26px] p-[19px]">
                            <img src="/svgs/ic-card.svg" alt="">
                        </div>
                        <div>
                            <h5 class="text-lg text-text_black font-bold mb-[2px]">
                                Pricing
                            </h5>
                            <p class="text-sm font-normal text-text_semiblack">12x Pay Installment</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-text_black rounded-[26px] p-[19px]">
                            <img src="/svgs/ic-securityuser.svg" alt="">
                        </div>
                        <div>
                            <h5 class="text-lg text-text_black font-bold mb-[2px]">
                                Secure
                            </h5>
                            <p class="text-sm font-normal text-text_semiblack">Use your plate number</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-text_black rounded-[26px] p-[19px]">
                            <img src="/svgs/ic-convert3dcube.svg" alt="">
                        </div>
                        <div>
                            <h5 class="text-lg text-text_black font-bold mb-[2px]">
                                Fast Trade
                            </h5>
                            <p class="text-sm font-normal text-text_semiblack">Change car faster</p>
                        </div>
                    </div>
                </div> --}}
                <!-- CTA Button -->
                {{-- <div class="mt-[50px]">
                    <!-- Button Primary -->
                    <div class="p-1 rounded-full bg-primary group">
                        <a href="#!" class="btn-primary">
                            <p
                                class="transition-all duration-[320ms] translate-x-3 group-hover:-translate-x-10 text-center">
                                Explore Cars
                            </p>
                            <img src="/svgs/ic-arrow-right.svg"
                                class="transition-all duration-[320ms] opacity-0 group-hover:opacity-100 group-hover:translate-x-10"
                                alt="">
                        </a>
                    </div>
                </div> --}}
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
        {{-- <div class="splide__track">
          <div class="splide__list">            
            @foreach ($similiarItems as $similiarItem)
              <!-- Card -->
              <div class="splide__slide card-popular ">
                <div>
                  <h5 class="text-lg text-dark font-bold mb-[2px]">
                    {{ $similiarItem->brand }}
                  </h5>
                  <p class="text-sm font-normal text-secondary">
                    {{ $similiarItem->type ? $similiarItem->type : '-' }}
                  </p>
                  <a href="{{ route('front.detailCatalogue', $similiarItem->slug) }}" class="absolute inset-0"></a>
                </div>
                <img src="{{ $similiarItem->thumbnail }}" class="rounded-[18px] min-w-[216px] w-full h-[150px]"
                    alt="">
                <div class="flex items-center justify-between gap-1">
                  <!-- Price -->
                  <p class="text-sm font-normal text-secondary">
                    <span class="text-base font-bold text-primary">${{ $similiarItem->rental_price }}</span>/day
                  </p>
                  <!-- Rating -->
                  <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                    (3/5)
                    <img src="/svgs/ic-star.svg" alt="">
                  </p>
                </div>
              </div>
            @endforeach
          </div>
        </div> --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
          @foreach ($similiarItems as $similiarItem)
              <!-- Card -->
              {{-- @dd($similiarItem->transactions[0]->rating->rating) --}}
              <a href="{{ route('front.detailCatalogue', [$similiarItem->slug]) }}">
                <div class="card-popular">
                    <div>
                        <h5 class="text-lg text-text_black font-bold mb-[2px]">
                            {{ ($similiarItem->brand) }}
                        </h5>
                        <p class="text-sm font-normal text-text_semiblack">
                            {{ $similiarItem->vehicle_category_id ? $similiarItem->vehicleCategory->vehicle_category_name : '-' }}
                        </p>
                        {{-- <a href="{{ route('front.detail', $similiarItem->slug) }}" class="absolute inset-0"></a> --}}
                    </div>
                    <img src="{{ $similiarItem->thumbnail }}" class="rounded-[18px] min-w-[216px] w-full h-[150px]"
                        alt="">
                    <div class="flex items-center justify-between gap-1">
                        <!-- Price -->
                        <p class="text-sm font-normal text-text_semiblack">
                            <span
                                class="text-base font-bold text-primary">${{ number_format(($similiarItem->rental_price)) }}</span>/day
                        </p>
                        <!-- Rating -->
                        <p class="text-text_black text-xs font-semibold flex items-center gap-[2px]">
                          ({{ $similiarItem->transactions[0]->rating->rating ?? 'No rating available' }}/5)
                            <img src="/svgs/ic-star.svg" alt="">
                          </p>
                    </div>
                </div>
              </a>
          @endforeach
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