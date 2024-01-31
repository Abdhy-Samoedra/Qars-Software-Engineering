const categoryButtons = document.querySelectorAll('.categoryBtn')
const pagination = document.querySelectorAll('.pagin')
const vehicleCard = document.querySelectorAll('.vehicle-card')
const nextPgn = document.querySelector('.pagin-next')
const prevPgn = document.querySelector('.pagin-prev')

const ulOfCatalogue = document.querySelector('.containList')

const ulOfCard = document.querySelector('.containCard')

const containCatalog = document.querySelector('.containCatalog')

console.log(containCatalog)
// console.log(ulOfCatalogue)


let  maxItem = (vehicleCard.length)-1;

let classNow = 'vehicle-card';

let elementNow = vehicleCard

let maxShowItem = 6


if(window.screen.width < 1024){
    maxShowItem = 4
}

if(window.screen.width < 550){
    // console.log('wkkwq')
    maxShowItem = 1
}






if(window.screen.width > 490 && window.screen.width < 600){
    ulOfCatalogue.querySelectorAll('.btnct').forEach(x => {
        x.classList.remove('w-24')
        x.classList.add('w-20')

        x.classList.add('text-sm')
    })
}

if(window.screen.width < 600){

    ulOfCatalogue.querySelectorAll('.btnct').forEach(x => {
        
        x.classList.add('text-xs')
        
    })
}

if(window.screen.width <= 490){
    ulOfCatalogue.querySelectorAll('.btnct').forEach(x => {
        x.classList.remove('w-24')
        x.classList.add('w-16')

        x.classList.add('text-sm')
    })
}

if(window.screen.width <= 400){
    ulOfCatalogue.querySelectorAll('.btnct').forEach(x => {
        x.classList.remove('w-16')
        x.classList.add('w-9')

        x.classList.add('text-sm')
    })
}

if(window.screen.width > 0 && window.screen.width < 1280){
    
    containCatalog.classList.add('items-center')
    containCatalog.classList.add('flex-col')
    containCatalog.classList.remove('flex-row')

    ulOfCatalogue.classList.remove('p-5')
    ulOfCatalogue.classList.add('p-2')

    ulOfCatalogue.classList.remove('flex-col')
    ulOfCatalogue.classList.add('flex-row')

    ulOfCatalogue.classList.remove('p-5')
    ulOfCatalogue.classList.add('p-2')

    ulOfCard.classList.add('justify-center')
}




let firstItem = 0;
let lastItem = maxShowItem-1;



const removeHidden = () => {
    document.querySelectorAll('li.hidden').forEach(z => {
        z.classList.remove('hidden')
    })
}

function forPagination(){
    
    elementNow.forEach((x, i) => {
        if( i > lastItem || i < firstItem ){
            x.classList.add('hidden')
        }else{
            x.classList.remove('hidden')
        }
    })
}

function resetPagin(){
    firstItem = 0
    lastItem = maxShowItem-1
}


forPagination()

// checkStatusPgn()

const checkStatusPgn = () => {
    // nextPgn.classList.add('bg-blue-900')
    
    if(lastItem >= maxItem){
        nextPgn.classList.remove('bg-blue-900')
        nextPgn.classList.add('bg-zinc-300')
    }
    else{
        nextPgn.classList.remove('bg-zinc-300')
        nextPgn.classList.add('bg-blue-900')
    }


    if(firstItem <= 0){
        prevPgn.classList.remove('bg-blue-900')
        prevPgn.classList.add('bg-zinc-300')
    }else{
        prevPgn.classList.remove('bg-zinc-300')
        prevPgn.classList.add('bg-blue-900')
    }
}



nextPgn.addEventListener('click', function(e){
    
    // console.log(lastItem)
    // console.log(lItem)
    if(lastItem < maxItem){
        firstItem = lastItem + 1  
        lastItem += maxShowItem
        forPagination()
    }
    // console.log(lastItem)
    // console.log(maxItem)
    // console.log(lastItem)
    checkStatusPgn()
})

prevPgn.addEventListener('click', function(e){
    
    // console.log(lastItem)
    // console.log(lItem)
    if(firstItem > 0){
        lastItem = firstItem - 1
        firstItem -= maxShowItem
        forPagination()
    }

    // console.log(lastItem)
    checkStatusPgn()
})

categoryButtons.forEach(x => {
 
    x.addEventListener('click', function(e) {

        

        document.querySelector('.activeCtgBtn').classList.remove('bg-blue-900')
        document.querySelector('.activeCtgBtn').classList.remove('text-white')
        document.querySelector('.activeCtgBtn').classList.remove('activeCtgBtn')

        e.target.classList.add('bg-blue-900')
        e.target.classList.add('text-white')
        e.target.classList.add('activeCtgBtn')

        removeHidden()
        resetPagin()

        if(x.innerText == "All"){
            
            vehicleCard.forEach((y, i) => {
                if(i >= maxShowItem) y.classList.add('hidden')
            })

            // classNow = 'vehicle-card'
            maxItem = vehicleCard.length - 1
            elementNow = vehicleCard
        }
        else if(x.innerText == "Off-Road"){
            document.querySelectorAll('.listCar li:not(.Cooper)').forEach((y) => {
                y.classList.add('hidden')
            })

            document.querySelectorAll('.Cooper').forEach((y, i) => {
                if(i >= maxShowItem) y.classList.add('hidden')
                
            })

            classNow = 'Cooper'
            elementNow = document.querySelectorAll('.Cooper')
            
        }
        else if(x.innerText == "Classic"){
            document.querySelectorAll('.listCar li:not(.Crosby)').forEach((j, i) => {
                j.classList.add('hidden')
                
            })

            document.querySelectorAll('.Crosby').forEach((y, i) => {
                if(i >= maxShowItem) y.classList.add('hidden')
                
            })

            classNow = 'Crosby'
            elementNow = document.querySelectorAll('.Crosby')
        }
        else if(x.innerText == "Family"){
            document.querySelectorAll('.listCar li:not(.Shannon)').forEach((r,i) => {
                r.classList.add('hidden')
            })

            document.querySelectorAll('.Shannon').forEach((y, i) => {
                if(i >= maxShowItem) y.classList.add('hidden')
                
            })

            classNow = 'Shannon'
            elementNow = document.querySelectorAll('.Shannon')
        }
        else if(x.innerText == "Sport"){
            document.querySelectorAll('.listCar li:not(.Dennis)').forEach((f,i) => {
                f.classList.add('hidden')
            })

            document.querySelectorAll('.Dennis').forEach((y, i) => {
                if(i >= maxShowItem) y.classList.add('hidden')
                
            })

            classNow = 'Dennis'
            elementNow = document.querySelectorAll('.Dennis')
        }
        else if(x.innerText == "Race"){
            document.querySelectorAll('.listCar li:not(.Forbes)').forEach((g,i) => {
                g.classList.add('hidden')
            })

            document.querySelectorAll('.Forbes').forEach((y, i) => {
                if(i >= maxShowItem) y.classList.add('hidden')
                
            })

            classNow = 'Forbes'
            elementNow = document.querySelectorAll('.Forbes')
        }

        maxItem = elementNow.length - 1
        // console.log(maxItem)
        // console.log(lastItem)

        
        checkStatusPgn() 
    })


    
});

checkStatusPgn() 
