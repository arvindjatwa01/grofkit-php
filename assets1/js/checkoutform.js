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

let checkoutform=document.getElementsByClassName('checkout-form')[0]


////console.log(document.getElementById("zipcode"),checkoutform);

    let zipcode=document.getElementById("zipcode")
    let city=document.getElementById("city")

    let state=document.getElementById("state")
    let country=document.getElementById("country")

   
    zipcode.addEventListener("input",getcitycountry)

    function getcitycountry(){
    zipcode.value= zipcode.value.replace(/[^0-9]/g,"")
    // elem.value=elem.value.replace(/[^0-9]/,"")

    if(zipcode.value.length==6)
    {
        let pincodevalue=`https://api.postalpincode.in/pincode/${zipcode.value}`

        fetch(pincodevalue).then((response)=>{
            return response.json()
        
        }).then(data=>{
                
                city.value=data[0].PostOffice[0].District
                state.value=data[0].PostOffice[0].State
                country.value=data[0].PostOffice[0].Country
            // data.forEach(elem=>{
            //     ////console.log(elem.PostOffice[0].Country)
            //     city.value=elem.PostOffice[0].District
            //     state.value=elem.PostOffice[0].State
            //     country.value=elem.PostOffice[0].Country
            // })
        })
    }

    else{

       
                city.value=""
                state.value=""
                country.value=""
    
    }
   

    }

    checkoutform.addEventListener('scroll',e=>{
        ////console.log(checkoutform.scrollHeight,checkoutform.offsetHeight+checkoutform.scrollTop)

        if(checkoutform.scrollHeight==checkoutform.offsetHeight+checkoutform.scrollTop)
        {
            checkoutform.lastElementChild.style.boxShadow="none"
        }
        else{
    checkoutform.lastElementChild.style.boxShadow="0 0 0.8rem rgb(225, 225, 225)"

        }
    })

    let saveadd=document.getElementById("saveadd")
    let canceladd=document.getElementById('canceladd')

    saveadd.addEventListener('click',e=>{
        // window.open("selectaddress.php","_self")
        // e.preventDefault()

    })
    canceladd.addEventListener('click',e=>{
        // window.open("selectaddress.php","_self")

    });