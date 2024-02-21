<x-front-layout>
    <div class="flex flex-col gap-y-16 items-center mt-20">
        <svg width="163" height="206" viewBox="0 0 163 206" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M96.0411 107.097C98.6306 97.4332 116.078 95.0269 127.954 84.59C141.495 72.6893 150.554 38.8819 150.554 38.8819L53.9614 13C53.9614 13 44.9028 46.8074 50.6797 63.8845C55.7461 78.8611 69.6528 89.6686 67.0633 99.3327C64.4738 108.997 47.0265 111.403 35.1506 121.84C21.609 133.741 12.5504 167.548 12.5504 167.548L109.143 193.43C109.143 193.43 118.202 159.623 112.425 142.546C107.358 127.569 93.4516 116.761 96.0411 107.097Z" fill="#CED6DD"/>
            <path d="M102.367 25.6867L63.73 15.334C63.73 15.334 58.5536 34.6525 59.5009 50.4355C60.7363 71.0165 82.0095 82.3434 76.8319 101.667C71.6542 120.99 60.0086 164.452 64.8383 165.746C69.6679 167.04 81.3147 123.573 86.4911 104.255C91.6675 84.9364 115.76 85.7601 127.116 68.5528C135.828 55.358 141.004 36.0395 141.004 36.0395L102.367 25.6867Z" fill="#75C2F6"/>
            <path d="M118.912 195.764C118.225 198.326 116.549 200.51 114.253 201.836C111.956 203.162 109.226 203.521 106.664 202.835L10.0718 176.953C7.51004 176.266 5.32585 174.59 3.99976 172.294C2.67368 169.997 2.31433 167.267 3.00076 164.705C3.68719 162.144 5.36318 159.959 7.66002 158.633C9.95686 157.307 12.6864 156.948 15.2482 157.634L111.841 183.516C114.403 184.203 116.587 185.879 117.913 188.176C119.239 190.472 119.598 193.202 118.912 195.764ZM160.323 41.2156C159.636 43.7774 157.96 45.9616 155.664 47.2877C153.367 48.6137 150.637 48.9731 148.075 48.2867L51.4829 22.4048C48.9211 21.7183 46.7369 20.0423 45.4108 17.7455C44.0847 15.4487 43.7254 12.7191 44.4118 10.1573C45.0982 7.59551 46.7742 5.41132 49.0711 4.08524C51.3679 2.75916 54.0975 2.39981 56.6593 3.08624L153.252 28.9681C155.814 29.6546 157.998 31.3306 159.324 33.6274C160.65 35.9242 161.009 38.6538 160.323 41.2156Z" fill="#1D5D9B"/>
            </svg>
            
        <div class="flex flex-col gap-y-6">
            <h1 class="text-3xl font-bold text-center">Your Transaction being processed</h1>
            <p class="text-center">YYour payment is currently in the process of being securely <br>
                handled within the web app.Thank you for your patience</p>
        </div>
        <div class="flex flex-row gap-x-4">
            <div class="p-1 rounded-full bg-primary group" >
                <a href="{{ route('front.indexCatalogue')}}" class="relative block text-white py-3 px-[26px] min-h-[47px] bg-primary font-semibold text-base rounded-full transition-all duration-[320ms] drop-shadow-[0_15px_20px_rgba(29,93,155,0.3)] hover:drop-shadow-none hover:shadow-[0_0_0_1px_#ffffff_inset] min-w-[180px] text-center">
                    <p class="">
                        Book another car
                    </p>
                    
                </a>
            </div>
            <div class="p-1 rounded-full">
                <a href="{{ route('front.index') }}" class="relative block text-text_black py-3 px-[26px] min-h-[47px]  font-medium text-base rounded-full min-w-[180px] text-center">
                    <p class="text-text_black">
                        Back to Home
                    </p>
                </a>
            </div>
        </div>


    </div>
</x-front-layout>
