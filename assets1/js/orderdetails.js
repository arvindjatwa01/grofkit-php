

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


// let order_details_obj=[
//     {
//         naam:"Pomegranate",
//         price:110,
//         imgsrc:"assets1/images/anar.jpg",
        
//     },
//     {
//         naam:"Cadbury Fuse",
//         price:30,
//         imgsrc:"assets1/images/cadfuse.jpg",
        
//     }, {
//         naam:"Grapes",
//         price:62,
//         imgsrc:"assets1/images/grapes.jpg",
//     }, {
//         naam:"Cornetto Icecream",
//         price:30,
//         imgsrc:"assets1/images/cornetto.jpg",
        
//     }, {
//         naam:"Cadbury Dairy milk silk",
//         price:170,
//         imgsrc:"assets1/images/dairymilk.jpg",
       
//     }, {
//         naam:"Chambal Soyabean Oil",
//         price:170,
//         imgsrc:"assets1/images/chambal.jpg",
        
//     }, {
//         naam:"Onion",
//         price:15,
//         imgsrc:"assets1/images/onion.jpg",
      
//     }, {
//         naam:"Tomato",
//         price:40,
//         imgsrc:"assets1/images/tomato.jpg",
       
//     }, {
//         naam:"Cadbury Dairy milk crispello chocolate bar",
//         price:23,
//         imgsrc:"assets1/images/crispello.jpg",
       
//     }, {
//         naam:"banana",
//         price:25,
//         imgsrc:"assets1/images/banana.jpg",
        
//     }, {
//         naam:"Gram flour",
//         price:80,
//         imgsrc:"assets1/images/gram flour.jpg",
       
//     }
// ]

Array.from(cart_items_cont).forEach(elem=>{

   
    
   



    //console.log(elem)

    // order_details_obj.forEach(cartelem=>{
    //     elem.innerHTML+=`

    //     <div class="cart-select-item  d-flex justify-content-between align-items-center">
    
    //                                         <div class="cart-item-details w-60 d-flex align-items-stretch">
    //                                             <div class="cart-img">
    //                                                 <img src="${cartelem.imgsrc}" alt="" class="img-fluid">
    //                                             </div>
    //                                             <div class="cart-item-name-det flex-grow-1 d-flex flex-column justify-content-md-evenly justify-content-center
    //                                             ">
    //                                                 <h6 class="mb-0 ">${cartelem.naam}</h6>
    //                                                 <span class="d-flex">
    //                                                 <span class="item-quant">1gm</span>
    //                                                 <span class="mx-1"> X </span>
    //                                                 <span class="item-price">&#8377;${cartelem.price}</span>
    //                                                 <span class="mx-1">=</span>
    //                                                 <span>&#8377;${cartelem.price}</span>
                                                                                                       
    //                                                 </span>
        
    //                                             </div>
    //                                         </div>
    //                                         <div class="cart-item-price order-details-amount   w-20" data-bs-price=${cartelem.price}"> <label> &#8377; </label> <label> ${cartelem.price}</label>  </div>
                                           
    //                                         <div class="cart-item-quantity w-20 d-flex justify-content-end align-items-center">
    //                                             <i class="fa-solid fa-trash del"></i>
    //                                             <i class="fa-solid fa-minus d-none sub"></i>
        
    //                                             <span class="item-value">1</span>
    //                                             <i class="fa-solid fa-plus add "></i>
    //                                         </div>
                                           
    //                                     </div>
        
    //     `
    // })

    Array.from(items_quantity).forEach(quant=>{
        quant.innerHTML=elem.children.length

        if(elem.children.length>1)
        {
            quant.nextElementSibling.innerHTML="Items"
        }
        else{
            quant.nextElementSibling.innerHTML="Item"

        }

    })




})




// items count code add in both cart.js and oreder-details.js

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

let cancel_btn=Array.from(document.getElementsByClassName('cancelbtnmodal'))

let cancelmodal=Array.from(document.getElementsByClassName("cancel-modal"))

let yesbtn=Array.from(document.getElementsByClassName("yes"))
let nobtn=Array.from(document.getElementsByClassName("no"))




cancel_btn.forEach(elem=>{
    elem.addEventListener("click",()=>{

        cancelmodal.forEach(modalelem=>{
            modalactive=new bootstrap.Modal(modalelem)

            modalactive.show()

            yesbtn.forEach(btnelem=>{
                btnelem.addEventListener("click",()=>{
                    //console.log("yes",elem)

                    
                    cancel_btn.forEach(elem2=>{
                        elem2.classList.add("d-none")
                        elem2.classList.remove("d-block")

                        elem2.nextElementSibling.classList.remove("d-none")
                        elem2.nextElementSibling.classList.add("d-block")

                    })

                    



                    


                    modalactive.hide()

                })
            })

          
            

            nobtn.forEach(btnelem=>{
                btnelem.addEventListener("click",()=>{
                    //console.log("no")
                    modalactive.hide()
                })
            })
        })

    })
})

let cancellation_btn=document.getElementsByClassName('cancellation-btn')

Array.from(cancellation_btn).forEach(elem=>{
    elem.addEventListener("click",()=>{
        Array.from(cancellation_btn).forEach(elem2=>{
            elem2.classList.add("d-none")
            elem2.classList.remove("d-block")
    
            elem2.previousElementSibling.classList.remove("d-none")
            elem2.previousElementSibling.classList.add("d-block")
    
        })
    })
  
})


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