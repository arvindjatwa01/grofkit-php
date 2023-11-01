

let shop_category_list=document.getElementsByClassName('shop-category-list')

let shop_category=document.getElementsByClassName('shop-category')

let input_field=document.querySelectorAll(".login-signup-field")

let alt_signbtn=document.getElementsByClassName("alt_signbtn")[0]

let logsign_content=document.getElementsByClassName("loginsignuptab-content")

let login_tabs=document.getElementsByClassName("log-intabs")

let leftarrcar=document.getElementsByClassName("left-arr-car")
let rightarrcar=document.getElementsByClassName("right-arr-car")

let category_carousel=document.getElementsByClassName('category-carousel')

let main_content_index=document.getElementsByClassName('main-content-index')
let items_first_sec=document.getElementsByClassName('items-first-sec')

let items_second_sec=document.getElementsByClassName("items-second-sec")

let cart_items_cont=document.getElementsByClassName('cart-select-items-container')


let items_quantity=document.getElementsByClassName("items-quantity")

let my_orders_allitems=document.getElementsByClassName('my-orders-allitems')

let my_orders_allitems_prev=document.getElementsByClassName("my-orders-allitems-prev")


Array.from(input_field).forEach(inputelem=>{
    inputelem.addEventListener("focusin",()=>{
        inputelem.style.borderColor="white";
        inputelem.style.boxShadow="1px 0px 1px  white";
        inputelem.children[0].style.color="white";
        inputelem.children[1].style.color="white";



        if(inputelem.lastElementChild!=null)
        {
            inputelem.lastElementChild.style.color="white"

        }



       

      



    })
})

Array.from(input_field).forEach(inputelem=>{
    inputelem.addEventListener("focusout",()=>{
        //console.log("Hello")
        inputelem.style.borderColor="rgba(255, 255, 255, 0.297)";
        inputelem.style.boxShadow="1px 0px 1px  rgba(255, 255, 255, 0.297)";
        inputelem.children[0].style.color="rgba(255, 255, 255, 0.297)";
        inputelem.children[1].style.color="rgba(255, 255, 255, 0.297)";



        if(inputelem.lastElementChild!=null)
        {
            inputelem.lastElementChild.style.color="rgba(255, 255, 255, 0.297)"

        }



        



    })
})






Array.from(input_field).forEach(inputelem=>{
    inputelem.addEventListener("input",()=>{







        //  if(inputelem.lastElementChild!=null)
        //  {

        //      if(inputelem.children[1].value.length!=0)

        //     {
        //         inputelem.lastElementChild.style.color="white"
        //         inputelem.lastElementChild.classList.remove('d-none')

               


        //     }

        //     else{

        //         inputelem.lastElementChild.classList.add('d-none')

                
        //     }
        
        // }



    })

    // inputelem.lastElementChild.addEventListener("click",()=>{

    //     inputelem.style.borderColor="white";
    //     inputelem.style.boxShadow="1px 0px 1px  white";
    //     inputelem.children[0].style.color="white";
    //     inputelem.children[1].style.color="white";



    //     if(inputelem.lastElementChild!=null)
    //     {
    //         inputelem.lastElementChild.style.color="white"

    //     }



    //     if(inputelem.lastElementChild.classList.contains("la-eye"))
    //     {
    //         inputelem.lastElementChild.classList.add("la-eye-slash") 
    //         inputelem.lastElementChild.classList.remove("la-eye") 
    //         inputelem.children[1].setAttribute("type","text")

    //     }
    //     else{
    //         inputelem.lastElementChild.classList.remove("la-eye-slash") 
    //         inputelem.lastElementChild.classList.add("la-eye") 
    //         inputelem.children[1].setAttribute("type","password")

    //     }
    // })
})

Array.from(logsign_content).forEach(elem=>{
    alt_signbtn.addEventListener("click",()=>{
        elem.children[0].classList.remove("show","active")
        elem.children[1].classList.add("show","active")

        Array.from(login_tabs).forEach(tabelem=>{
            tabelem.children[0].classList.remove("active")
            tabelem.children[1].classList.add("active")
        })

    })
})


if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition((pos)=>{
        console.log(pos.coords.latitude,pos.coords.longitude,pos.address,navigator)
        let latitude=pos.coords.latitude
        let longitude=pos.coords.longitude;

        function displayLocation(latitude,longitude){
            var geocoder;
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(latitude, longitude);
        
            geocoder.geocode(
                {'latLng': latlng}, 
                function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var add= results[0].formatted_address ;
                            var  value=add.split(",");
        
                            count=value.length;
                            country=value[count-1];
                            state=value[count-2];
                            city=value[count-3];
                            console.log(city)
                            // x.innerHTML = "city name is: " + city;
                        }
                        else  {
                            // x.innerHTML = "address not found";
                        }
                    }
                    else {
                        // x.innerHTML = "Geocoder failed due to: " + status;
                    }
                }
            );
        }
       
    })
}




