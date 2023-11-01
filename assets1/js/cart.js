

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



// let cartitemsobj=[
//     {
//         naam:"Cadbury Fuse",
//         weight:"48 gm",
//         price:30,
//         imgsrc:"../assets/images/cadfuse.jpg"
//     },
//     {
//         naam:"Grapes",
//         weight:"500 gm",
//         price:62,
//         imgsrc:"../assets/images/grapes.jpg"
//     },
//     {
//         naam:"Cornetto Icecream",
//         weight:"120 gm",
//         price:30,
//         imgsrc:"../assets/images/cornetto.jpg"
//     },
//     {
//         naam:"Cadbury Dairy milk silk",
//         weight:"130 gm",
//         price:170,
//         imgsrc:"../assets/images/dairymilk.jpg"
//     },

//     {
//         naam:"Chambal Soyabean Oil",
//         weight:"1 ltr",
//         price:170,
//         imgsrc:"../assets/images/chambal.jpg"
//     },
//     {
//         naam:"Tomato",
//         weight:"1 kg",
//         price:40,
//         imgsrc:"../assets/images/tomato.jpg"
//     },
   
//     {
//         naam:"Pomegranate",
//         weight:"1 kg",
//         price:110,
//         imgsrc:"../assets/images/anar.jpg"
//     },
// ]




// cart_items

// Array.from(cart_items_cont).forEach(elem=>{

   
    
//         cartitemsobj.forEach(cartelem=>{
//             elem.innerHTML+=`
    
//             <div class="cart-select-item  d-flex justify-content-between align-items-center">
        
//                                                 <div class="cart-item-details w-60 d-flex align-items-stretch">
//                                                     <div class="cart-img">
//                                                         <img src="${cartelem.imgsrc}" alt="" class="img-fluid">
//                                                     </div>
//                                                     <div class="cart-item-name-det flex-grow-1 d-flex flex-column justify-content-md-evenly justify-content-center
//                                                     ">
//                                                         <h6 class="mb-0">${cartelem.naam}</h6>
//                                                         <span class="d-flex">
//                                                         <span class="item-quant">1gm</span>
//                                                         <span class="mx-1"> X </span>
//                                                         <span class="item-price">&#8377;${cartelem.price}</span>
//                                                         <span class="mx-1">=</span>
//                                                         <span>&#8377;${cartelem.price}</span>
                                                                                                           
//                                                         </span>
            
//                                                     </div>
//                                                 </div>
//                                                 <div class="cart-item-price   w-20" data-bs-price=${cartelem.price}"> <label> &#8377; </label> <label> ${cartelem.price}</label>  </div>
//                                                 <div class="cart-item-quantity w-20 d-flex justify-content-end align-items-center">
//                                                     <i class="fa-solid fa-trash del"></i>
//                                                     <i class="fa-solid fa-minus d-none sub"></i>
            
//                                                     <span class="item-value">1</span>
//                                                     <i class="fa-solid fa-plus add "></i>
//                                                 </div>
                                               
//                                             </div>
            
//             `
//         })
    
//         Array.from(items_quantity).forEach(quant=>{
//             quant.innerHTML=elem.children.length
    
//             if(elem.children.length>1)
//             {
//                 quant.nextElementSibling.innerHTML="Items"
//             }
//             else{
//                 quant.nextElementSibling.innerHTML="Item"
    
//             }
    
//         })
   

    
//         // console.log(elem)

        
    

  
  
// })


let detail_btn=document.getElementsByClassName('details-order')

Array.from(detail_btn).forEach(elem=>{
    elem.addEventListener("click",function(){
        // alert("Hello")
        if(elem.classList.contains("view-det"))
        {
            elem.innerText="Hide Details"

            elem.classList.remove("view-det")
            document.body.style.setProperty("--chngmax-h","20vh")
            document.body.style.setProperty("--chngmax-h2","45vh")
        }
        else{
            elem.classList.add("view-det")
            elem.innerText="View Details"

            document.body.style.setProperty("--chngmax-h","42.8vh")
            document.body.style.setProperty("--chngmax-h2","17vh")



        }

        
    })
})


let promocode_input=document.getElementsByClassName("promocode_input")

Array.from(promocode_input).forEach(elem=>{
    elem.addEventListener("input",()=>{
        // //console.log(elem.value)
        if(elem.value.length>0){
            elem.nextElementSibling.removeAttribute("disabled")
            elem.classList.add("focusinput")
            elem.classList.remove("focusdisabled")



        }
        else{
            elem.nextElementSibling.setAttribute("disabled","")

            elem.classList.remove("focusinput")
            elem.classList.add("focusdisabled")
           



        }
    })
})

let canc_promo=document.getElementsByClassName("canc-promo")

Array.from(canc_promo).forEach(elem=>{
    elem.addEventListener("click",()=>{
        setTimeout(()=>{
            window.location.href="cart.php"

        },100)
        elem.parentElement.classList.add("d-none")
        elem.parentElement.previousElementSibling.classList.remove('d-none')
    })
})


let cart_items_quantity=document.querySelectorAll(".cart-item-quantity")



// let count_item=1

Array.from(cart_items_quantity).forEach(cart=>{
    cart.addEventListener("click",(e)=>{
        // //console.log(e.target)
        


       count_item=parseInt(e.currentTarget.children[2].innerHTML)

       new_price=parseInt(e.currentTarget.previousElementSibling.getAttribute("data-bs-price"))

        if(e.target.classList.contains("add"))
        {
            //console.log("add",e.currentTarget.previousElementSibling.lastElementChild.innerHTML)
            count_item+=1


        }

        else if(e.target.classList.contains("sub"))
        {
            //console.log("sub",count_item)
            count_item-=1


        }
        else if(e.target.classList.contains("del"))
        {
            //console.log("del")
            e.currentTarget.parentElement.remove()
        }




        e.currentTarget.children[2].innerHTML=`${count_item}`

        new_price*=count_item

        e.currentTarget.previousElementSibling.children[1].innerHTML=new_price




        if(count_item>1){
            e.currentTarget.children[0].classList.add('d-none')
            e.currentTarget.children[1].classList.remove('d-none')

        }
        else{
            e.currentTarget.children[0].classList.remove('d-none')
            e.currentTarget.children[1].classList.add('d-none')
        }

        //console.log(cart_items_cont[0].children)

        Array.from(cart_items_cont).forEach(carts_cont=>{

            Array.from(items_quantity).forEach(quant=>{

                quant.innerHTML=carts_cont.children.length

                if(carts_cont.children.length>1)
                {
                    quant.nextElementSibling.innerHTML="Items"
                }
                else{
                    quant.nextElementSibling.innerHTML="Item"

                }

            })

        })
    })
})