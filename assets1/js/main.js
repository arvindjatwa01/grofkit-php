// console.log("Hello")

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













// let signup_tab=document.querySelector("#signup_sec")

console.log(input_field)


Array.from(shop_category).forEach(categelem=>{

    categelem.addEventListener("mouseover",(e)=>{


        Array.from(shop_category_list).forEach(elem=>{


            if(e.currentTarget.classList.contains("shop-category"))
            {
                elem.style.display="flex"

            }

            else{
                elem.style.display="none"

            }
      

        

        })

    })


    categelem.addEventListener("mouseleave",(e)=>{

        console.log("Over")

        Array.from(shop_category_list).forEach(elem=>{
       
           
            if(!(e.currentTarget.classList.contains("shop-category")))
            {
                elem.style.display="flex"
        console.log("flex",e.currentTarget)


            }

            else{
                elem.style.display="none"

        console.log("none",e.currentTarget)


            }
      
    
            
        })

    })

})



Array.from(input_field).forEach(inputelem=>{
    inputelem.addEventListener("focusin",()=>{
        // console.log("Hello")
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
        // console.log("Hello")
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
        // console.log("Hello")







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


Array.from(rightarrcar).forEach(rightelem=>{
    rightelem.addEventListener("click",(e)=>{
        console.log("click")
        Array.from(category_carousel).forEach(categelem=>{
            categelem.scrollLeft+=categelem.children[0].children[0].clientWidth
            // if(categelem.offsetWidth+categelem.scrollLeft)


            console.log(categelem.scrollLeft,categelem,e)
        })
    })
})

Array.from(leftarrcar).forEach(leftelem=>{
    leftelem.addEventListener("click",(e)=>{
        console.log("click")

        Array.from(category_carousel).forEach(categelem=>{
        if(categelem.scrollLeft>0)
        {
            categelem.scrollLeft-=categelem.children[0].children[0].clientWidth

        }
        else{

        }

            // if(categelem.offsetWidth+categelem.scrollLeft)


            console.log(categelem.scrollLeft,categelem,e)
        })
    })
})



Array.from(category_carousel).forEach(categelem=>{

    categelem.addEventListener("scroll",elem=>{
        Array.from(leftarrcar).forEach(leftelem=>{
          if(categelem.scrollLeft>0)
          {
              leftelem.classList.remove("d-none")
          }
          else[
            leftelem.classList.add("d-none")

          ]
        })


        Array.from(rightarrcar).forEach(rightelem=>{
            if(categelem.scrollLeft+categelem.offsetWidth+10>=categelem.scrollWidth)
            {
                rightelem.classList.add("d-none")
            }
            else[
                rightelem.classList.remove("d-none")

  
            ]
          })
    })

    console.log(categelem.scrollLeft,categelem)
})




// dynamic content all categories

// all categories


function showitems(objname,secname)
{
    objname.forEach(categelem=>{

        Array.from(secname).forEach(firstsec=>{
            firstsec.innerHTML+=`
        
            <div class="col  card-primary d-flex flex-column shadow px-0">
            <div class="same-ratio mx-auto">
                <img src="${categelem.imgsrc}" alt="" class="w-100">
            </div>
        
            <div class="prod-info ">
                <div class="prod-name d-flex ">
                    <span class=" text-uppercase">
                            ${categelem.naam} - <span class="text-lowercase">${categelem.weight}</span> 
                    </span>
                </div>
        
                <span class="prod-price">
                <span class="outoffer-price">
                    &#8377;${categelem.price}
                    </span>
                    <span class="withoffer-price">
                    &#8377;${categelem.mrp_price}
                    </span>
                </span>
                
                <div class="prod-add-now  d-flex justify-content-between align-items-center">
                        <a  class="addprod-btn addbtn-style">

                        <span class="">Add to cart</span>
                        <div class="d-flex align-items-center d-none">

                           <i class="las la-minus flex-grow-1 sub-item"></i>

                           <span class="flex-grow-1 item-value">0</span>


                           <i class="las la-plus flex-grow-1 add-item"></i>

                           </div>

                           

                        </a>
                </div>
        
            </div>
          
        
        </div>
            
            `
        })
    })
}



// let allcategobj=[

//     {
//         naam:"Cadbury Fuse",
//         weight:"48 gm",
//         price:30,
//         mrp_price:27,
//         imgsrc:"assets1/images/cadfuse.jpg"
//     },
//     {
//         naam:"Grapes",
//         weight:"500 gm",
//         price:62,
//         mrp_price:57,

//         imgsrc:"assets1/images/grapes.jpg"
//     },
//     {
//         naam:"Cornetto Icecream",
//         weight:"120 gm",
//         price:30,
//         mrp_price:29,

//         imgsrc:"assets1/images/cornetto.jpg"
//     },
//     {
//         naam:"Cadbury Dairy milk silk",
//         weight:"130 gm",
//         price:170,
//         mrp_price:162,

//         imgsrc:"assets1/images/dairymilk.jpg"
//     },

//     {
//         naam:"Chambal Soyabean Oil",
//         weight:"1 ltr",
//         price:170,
//         mrp_price:167,

//         imgsrc:"assets1/images/chambal.jpg"
//     },
//     {
//         naam:"Tomato",
//         weight:"1 kg",
//         price:40,
//         mrp_price:36,

//         imgsrc:"assets1/images/tomato.jpg"
//     },
//     {
//         naam:"Aashirvaad Chakki Aata",
//         weight:"10 kg",
//         price:370,
//         mrp_price:341,

//         imgsrc:"assets1/images/aashrvaad.jpg"
//     },
//     {
//         naam:"Pomegranate",
//         weight:"1 kg",
//         mrp_price:98,
//         price:110,
//         imgsrc:"assets1/images/anar.jpg"
//     },
// ]


// showitems(allcategobj,items_first_sec)






let mostbuysobj=[

    {
        naam:"Cornetto Icecream",
        weight:"120 gm",
        price:30,
        mrp_price:27,

        imgsrc:"assets1/images/cornetto.jpg"
    },

    {
        naam:"Saras Shudh Ghee",
        weight:"500 ml",
        price:232,
        mrp_price:215,

        imgsrc:"assets1/images/saras-ghee.jpg"
    },
    {
        naam:"Onion",
        weight:"1 kg",
        price:15,
        mrp_price:12,

        imgsrc:"assets1/images/onion.jpg"
    },
  
    {
        naam:"Cadbury Dairy milk crispello chocolate bar",
        weight:"35 gm",
        price:23,
        mrp_price:20,

        imgsrc:"assets1/images/crispello.jpg"
    },

    {
        naam:"banana",
        weight:"1 kg",
        price:25,
        mrp_price:20,

        imgsrc:"assets1/images/banana.jpg"
    },
    {
        naam:"Gram flour",
        weight:"1 kg",
        price:80,
        mrp_price:72,

        imgsrc:"assets1/images/gram flour.jpg"
    },
    {
        naam:"Cashew ",
        weight:"500 gm",
        price:400,
        mrp_price:370,

        imgsrc:"assets1/images/cashew.jpg"
    },
    {
        naam:"Kissan Tomato Ketchup pouch",
        weight:"950 gm",
        price:100,
        mrp_price:94,

        imgsrc:"assets1/images/Kissan Tomato Ketchup pouc.jpg"
    },
]

showitems(mostbuysobj,items_second_sec)



let addprod_btn=document.getElementsByClassName('addprod-btn')

Array.from(addprod_btn).forEach(elem=>{
    elem.addEventListener("click",()=>{
        if(elem.classList.contains("addbtn-style"))
        {
            elem.classList.remove("addbtn-style")
            elem.classList.add("editbtn-style","flip-180")

            setTimeout(() => {
            elem.children[0].innerText="Edit"
                
            }, 00);


        }
        else{

        }
    })
})



let cartitemsobj=[
    {
        naam:"Cadbury Fuse",
        weight:"48 gm",
        price:30,
        imgsrc:"assets1/images/cadfuse.jpg"
    },
    {
        naam:"Grapes",
        weight:"500 gm",
        price:62,
        imgsrc:"assets1/images/grapes.jpg"
    },
    {
        naam:"Cornetto Icecream",
        weight:"120 gm",
        price:30,
        imgsrc:"assets1/images/cornetto.jpg"
    },
    {
        naam:"Cadbury Dairy milk silk",
        weight:"130 gm",
        price:170,
        imgsrc:"assets1/images/dairymilk.jpg"
    },

    {
        naam:"Chambal Soyabean Oil",
        weight:"1 ltr",
        price:170,
        imgsrc:"assets1/images/chambal.jpg"
    },
    {
        naam:"Tomato",
        weight:"1 kg",
        price:40,
        imgsrc:"assets1/images/tomato.jpg"
    },
   
    {
        naam:"Pomegranate",
        weight:"1 kg",
        price:110,
        imgsrc:"assets1/images/anar.jpg"
    },
]

let order_details_obj=[
    {
        naam:"Pomegranate",
        price:110,
        imgsrc:"assets1/images/anar.jpg",
        
    },
    {
        naam:"Cadbury Fuse",
        price:30,
        imgsrc:"assets1/images/cadfuse.jpg",
        
    }, {
        naam:"Grapes",
        price:62,
        imgsrc:"assets1/images/grapes.jpg",
    }, {
        naam:"Cornetto Icecream",
        price:30,
        imgsrc:"assets1/images/cornetto.jpg",
        
    }, {
        naam:"Cadbury Dairy milk silk",
        price:170,
        imgsrc:"assets1/images/dairymilk.jpg",
       
    }, {
        naam:"Chambal Soyabean Oil",
        price:170,
        imgsrc:"assets1/images/chambal.jpg",
        
    }, {
        naam:"Onion",
        price:15,
        imgsrc:"assets1/images/onion.jpg",
      
    }, {
        naam:"Tomato",
        price:40,
        imgsrc:"assets1/images/tomato.jpg",
       
    }, {
        naam:"Cadbury Dairy milk crispello chocolate bar",
        price:23,
        imgsrc:"assets1/images/crispello.jpg",
       
    }, {
        naam:"banana",
        price:25,
        imgsrc:"assets1/images/banana.jpg",
        
    }, {
        naam:"Gram flour",
        price:80,
        imgsrc:"assets1/images/gram flour.jpg",
       
    }
]



Array.from(cart_items_cont).forEach(elem=>{

    if(!(elem.classList.contains("order-all-items-container")))
    {
        // cartitemsobj.forEach(cartelem=>{
        //     elem.innerHTML+=`
    
        //     <div class="cart-select-item  d-flex justify-content-between align-items-center">
        
        //                                         <div class="cart-item-details w-60 d-flex align-items-stretch">
        //                                             <div class="cart-img">
        //                                                 <img src="${cartelem.imgsrc}" alt="" class="img-fluid">
        //                                             </div>
        //                                             <div class="cart-item-name-det flex-grow-1 d-flex flex-column justify-content-md-evenly justify-content-center
        //                                             ">
        //                                                 <h6 class="mb-0">${cartelem.naam}</h6>
        //                                                 <span class="d-flex">
        //                                                 <span class="item-quant">1gm</span>
        //                                                 <span class="mx-1"> X </span>
        //                                                 <span class="item-price">&#8377;${cartelem.price}</span>
        //                                                 <span class="mx-1">=</span>
        //                                                 <span>&#8377;${cartelem.price}</span>
                                                                                                           
        //                                                 </span>
            
        //                                             </div>
        //                                         </div>
        //                                         <div class="cart-item-price   w-20" data-bs-price=${cartelem.price}"> <label> &#8377; </label> <label> ${cartelem.price}</label>  </div>
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
    }

    else{
        console.log(elem)

        order_details_obj.forEach(cartelem=>{
            elem.innerHTML+=`
    
            <div class="cart-select-item  d-flex justify-content-between align-items-center">
        
                                                <div class="cart-item-details w-60 d-flex align-items-stretch">
                                                    <div class="cart-img">
                                                        <img src="${cartelem.imgsrc}" alt="" class="img-fluid">
                                                    </div>
                                                    <div class="cart-item-name-det flex-grow-1 d-flex flex-column justify-content-md-evenly justify-content-center
                                                    ">
                                                        <h6 class="mb-0 ">${cartelem.naam}</h6>
                                                        <span class="d-flex">
                                                        <span class="item-quant">1gm</span>
                                                        <span class="mx-1"> X </span>
                                                        <span class="item-price">&#8377;${cartelem.price}</span>
                                                        <span class="mx-1">=</span>
                                                        <span>&#8377;${cartelem.price}</span>
                                                                                                           
                                                        </span>
            
                                                    </div>
                                                </div>
                                                <div class="cart-item-price order-details-amount   w-20" data-bs-price=${cartelem.price}"> <label> &#8377; </label> <label> ${cartelem.price}</label>  </div>
                                               
                                                <div class="cart-item-quantity w-20 d-flex justify-content-end align-items-center">
                                                    <i class="fa-solid fa-trash del"></i>
                                                    <i class="fa-solid fa-minus d-none sub"></i>
            
                                                    <span class="item-value">1</span>
                                                    <i class="fa-solid fa-plus add "></i>
                                                </div>
                                               
                                            </div>
            
            `
        })
    
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
    }

  
  
})




// items count code

let cart_items_quantity=document.querySelectorAll(".cart-item-quantity")

// let count_item=1

Array.from(cart_items_quantity).forEach(cart=>{
    cart.addEventListener("click",(e)=>{
        // console.log(e.target)
        


       count_item=parseInt(e.currentTarget.children[2].innerHTML)

       new_price=parseInt(e.currentTarget.previousElementSibling.getAttribute("data-bs-price"))

        if(e.target.classList.contains("add"))
        {
            console.log("add",e.currentTarget.previousElementSibling.lastElementChild.innerHTML)
            count_item+=1


        }

        else if(e.target.classList.contains("sub"))
        {
            console.log("sub",count_item)
            count_item-=1


        }
        else if(e.target.classList.contains("del"))
        {
            console.log("del")
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

        console.log(cart_items_cont[0].children)

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









let myordersobj=[
    {
        
        price:1180,
        imgsrc:"assets1/images/invoice.png",
        delivered_date:"18 Apr 2022",
        status:"Ordered",
        order_id:"868678",
        order_placed_date:"12 Apr 2022",
        order_shipped_date:"14 Apr 2022",
        promocode:"OFFER50",
        totalitems:10
    },

    {
        
        price:1180,
        imgsrc:"assets1/images/invoice.png",
        delivered_date:"18 Apr 2022",
        status:"Cancellation request",
        order_id:"868678",
        order_placed_date:"12 Apr 2022",
        order_shipped_date:"14 Apr 2022",
        promocode:"OFFER50",
        totalitems:10,
        cancel_date:"29 Apr 2022"
    },
   
]

Array.from(my_orders_allitems).forEach(orderitem=>{
    myordersobj.forEach((elem,i)=>{

        console.log(elem.status)

        if(elem.status=="Ordered")
        {
            orderitem.innerHTML+=`

            <div class="accordion-item my-bag-${i+1}">
                          <h2 class="accordion-header " id="headingOne">
                            <div class="accordion-button flex-column align-items-stretch  order-short  p-0 " type="button"  aria-expanded="true" aria-controls="collapseOne">
    
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="order-img d-flex justify-content-center  h-100">
                                        <img src="${elem.imgsrc}" alt="" class="img-fluid">
                                    </div>
                                    <div class="order-track-info flex-grow-1">
                                      <!-- <h5 class="mb-0 ">Order#: <span class="order-id">99012</span></h5>
                                      <h5 class="mb-0"><span class="order-date">
                                        12-Apr-2022
                                      </span>,&nbsp;
                                      <span class="order-time">3:00 PM</span>
                                    </h5>
        
                                    <h5 class="mb-0">Delivered on <span class="delivered-date">16 Apr</span> </h5> -->
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-0 order-name">#${elem.order_id}</h5>
                                        <h5 class="mb-0 order-price fw-600" ><span>&#8377;</span><span>${elem.price}</span></h5>
        
                                        
                                    </div>
        
                                   
        
                                    <div class="d-flex">
                                        <h6 class="mb-0 ls-1">Delivered By :</h6>
                                        <h6 class="mb-0 delivered-date ">${elem.delivered_date}</h6>
                                    </div>
        
                                    <div class="d-flex">
                                        <h6 class="mb-0 ls-1">Status :</h6>
                                        <h6 class="mb-0 order-status ">${elem.status}</h6>
                                    </div>

                                    <div class="d-flex">
                                    <h6 class="mb-0 ls-1"> Total Items :</h6>
                                    <h6 class="mb-0 total-items "> ${elem.totalitems}</h6>
                                </div>

                                    <div class="d-flex">
                                    <h6 class="mb-0 ls-1">Promocode :</h6>
                                    <h6 class="mb-0 promocode-order "> ${elem.promocode}</h6>
                                </div>
                                
                                   
                                
        
                                   
                                     
                                  </div>
                                </div>
    
                                <div class="d-flex track-order-div justify-content-between ">
                                    <a href="orderdetails.php" class="details-myorder"  > Order Details</a>
                                    <a href="#collapseordered${i+1}" class="track-order" data-bs-toggle="collapse" >Track Order</a>
                                </div>
                               
    
                             
                            </div>
                          </h2>
                          <div id="collapseordered${i+1}" class="accordion-collapse bg-track collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body container-fluid">
    
                                <div class="row justify-content-center">
                                    <div class="col-lg-7 col-md-6 col-12 d-flex justify-content-evenly flex-column">
                                        <div class=" order-track-style ordered-done justify-content-between d-flex ">
                                         <span class="done-order "></span>
                                            <span class="pending-order"></span>
                                            <span class="pending-order"></span> 
                                           
                                            
    
                                        </div>
                                        <div class=" order-track-info-style justify-content-between d-flex  ">
    
                                            <div class="ordered  done">
                                                <img src="assets1/images/clipboard (1).png" alt="">
                                            </div>
    
                                            <div class="shipped">
                                                <img src="assets1/images/shipped.png" alt="">
                                            </div>
    
                                            <div class="delivered">
                                                <img src="assets1/images/delivered.png" alt="">
                                            </div>
                                            
    
                                        </div>
    
                                        <div class=" order-track-info-style  justify-content-between d-flex  ">
    
                                            <div class="ordered  done">
                                                <span> Placed</span>
                                                <span class="myorder-placed-date">${elem.order_placed_date}</span>
                                            </div>
    
                                            <div class="shipped">
                                                <span> Shipped</span>
                                                <span class="myorder-shipped-date">${elem.order_shipped_date}</span>
    
                                            </div>
    
                                            <div class="delivered">
                                                <span> Delivered</span>
                                                <span class="myorder-delivered-date">${elem.delivered_date}</span>
    
                                            </div>
                                            
    
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                          </div>
                        </div>
            `
            document.body.style.setProperty("--before-order-color","rgb(199, 199, 199)")
        }

        


        else if(elem.status=="Shipped")
        {
            orderitem.innerHTML+=`

            <div class="accordion-item my-bag-${i+1}">
                          <h2 class="accordion-header " id="headingOne">
                            <div class="accordion-button flex-column align-items-stretch  order-short  p-0 " type="button"  aria-expanded="true" aria-controls="collapseOne">
    
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="order-img d-flex justify-content-center  h-100">
                                        <img src="${elem.imgsrc}" alt="" class="img-fluid">
                                    </div>
                                    <div class="order-track-info flex-grow-1">
                                      <!-- <h5 class="mb-0 ">Order#: <span class="order-id">99012</span></h5>
                                      <h5 class="mb-0"><span class="order-date">
                                        12-Apr-2022
                                      </span>,&nbsp;
                                      <span class="order-time">3:00 PM</span>
                                    </h5>
        
                                    <h5 class="mb-0">Delivered on <span class="delivered-date">16 Apr</span> </h5> -->
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-0 order-name">#${elem.order_id}</h5>
                                        <h5 class="mb-0 order-price fw-600" ><span>&#8377;</span><span>${elem.price}</span></h5>
        
                                        
                                    </div>
        
                                   
        
                                    <div class="d-flex">
                                        <h6 class="mb-0 ls-1">Delivered By :</h6>
                                        <h6 class="mb-0 delivered-date ">${elem.delivered_date}</h6>
                                    </div>
        
                                    <div class="d-flex">
                                        <h6 class="mb-0 ls-1">Status :</h6>
                                        <h6 class="mb-0 order-status ">${elem.status}</h6>
                                    </div>

                                    <div class="d-flex">
                                    <h6 class="mb-0 ls-1"> Total Items :</h6>
                                    <h6 class="mb-0 total-items "> ${elem.totalitems}</h6>
                                </div>

                                    <div class="d-flex">
                                    <h6 class="mb-0 ls-1">Promocode :</h6>
                                    <h6 class="mb-0 promocode-order "> ${elem.promocode}</h6>
                                </div>
                                
                                   
                                
        
                                   
                                     
                                  </div>
                                </div>
    
                                <div class="d-flex track-order-div justify-content-between ">
                                    <a href="orderdetails.php" class="details-myorder"  > Order Details</a>
                                    <a href="#collapseshipped${i+1}" class="track-order" data-bs-toggle="collapse" >Track Order</a>
                                </div>
                               
    
                             
                            </div>
                          </h2>
                          <div id="collapseshipped${i+1}" class="accordion-collapse bg-track collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body container-fluid">
    
                                <div class="row justify-content-center">
                                    <div class="col-lg-7 col-md-6 col-12 d-flex justify-content-evenly flex-column">
                                        <div class=" order-track-style shipped-done justify-content-between d-flex ">
                                         <span class="done-order "></span>
                                            <span class="done-order"></span>
                                            <span class="pending-order"></span> 
                                           
                                            
    
                                        </div>
                                        <div class=" order-track-info-style justify-content-between d-flex  ">
    
                                            <div class="ordered  done">
                                                <img src="assets1/images/clipboard (1).png" alt="">
                                            </div>
    
                                            <div class="shipped">
                                                <img src="assets1/images/shipped.png" alt="">
                                            </div>
    
                                            <div class="delivered">
                                                <img src="assets1/images/delivered.png" alt="">
                                            </div>
                                            
    
                                        </div>
    
                                        <div class=" order-track-info-style  justify-content-between d-flex  ">
    
                                            <div class="ordered  done">
                                                <span> Placed</span>
                                                <span class="myorder-placed-date">${elem.order_placed_date}</span>
                                            </div>
    
                                            <div class="shipped done">
                                                <span> Shipped</span>
                                                <span class="myorder-shipped-date">${elem.order_shipped_date}</span>
    
                                            </div>
    
                                            <div class="delivered">
                                                <span> Delivered</span>
                                                <span class="myorder-delivered-date">${elem.delivered_date}</span>
    
                                            </div>
                                            
    
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                          </div>
                        </div>
            `
            document.body.style.setProperty("--before-order-color","#c2a70e")

        }


        else if(elem.status=="Cancellation request")
        {
            orderitem.innerHTML+=`

            <div class="accordion-item my-bag-${i+1} cancel-block">
                          <h2 class="accordion-header " id="headingOne">
                            <div class="accordion-button flex-column align-items-stretch  order-short  p-0 " type="button"  aria-expanded="true" aria-controls="collapseOne">
    
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="order-img d-flex justify-content-center  h-100">
                                        <img src="${elem.imgsrc}" alt="" class="img-fluid">
                                    </div>
                                    <div class="order-track-info flex-grow-1">
                                      <!-- <h5 class="mb-0 ">Order#: <span class="order-id">99012</span></h5>
                                      <h5 class="mb-0"><span class="order-date">
                                        12-Apr-2022
                                      </span>,&nbsp;
                                      <span class="order-time">3:00 PM</span>
                                    </h5>
        
                                    <h5 class="mb-0">Delivered on <span class="delivered-date">16 Apr</span> </h5> -->
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-0 order-name">#${elem.order_id}</h5>
                                        <h5 class="mb-0 order-price fw-600" ><span>&#8377;</span><span>${elem.price}</span></h5>
        
                                        
                                    </div>
        
                                   
        
                                    
        
                                    <div class="d-flex">
                                        <h6 class="mb-0 ls-1">Cancelled By :</h6>
                                        <h6 class="mb-0 cancelled-date ">${elem.cancel_date}</h6>
                                    </div>
                                    <div class="d-flex">
                                        <h6 class="mb-0 ls-1">Status :</h6>
                                        <h6 class="mb-0 order-status ">${elem.status}</h6>
                                    </div>

                                    <div class="d-flex">
                                    <h6 class="mb-0 ls-1"> Total Items :</h6>
                                    <h6 class="mb-0 total-items "> ${elem.totalitems}</h6>
                                </div>

                                    <div class="d-flex">
                                    <h6 class="mb-0 ls-1">Promocode :</h6>
                                    <h6 class="mb-0 promocode-order "> ${elem.promocode}</h6>
                                </div>
                                
                                   
                                
        
                                   
                                     
                                  </div>
                                </div>
    
                                <div class="d-flex track-order-div justify-content-between ">
                                    <a href="orderdetails.php" class="details-myorder"  > Order Details</a>
                                    <a href="orderdetails.php" class="re-order"  >Re-Order</a>
                                </div>
                               
    
                             
                            </div>
                          </h2>
                          
                        </div>
            `
        }

       

    })
})


Array.from(my_orders_allitems_prev).forEach(prevorder=>{
    myordersobj.forEach((elem,i)=>{
         if(elem.status=="Delivered")
        {
            prevorder.innerHTML+=`

            <div class="accordion-item my-bag-${i+1}">
                          <h2 class="accordion-header " id="headingOne">
                            <div class="accordion-button flex-column align-items-stretch  order-short  p-0 " type="button"  aria-expanded="true" aria-controls="collapseOne">
    
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="order-img d-flex justify-content-center  h-100">
                                        <img src="${elem.imgsrc}" alt="" class="img-fluid">
                                    </div>
                                    <div class="order-track-info flex-grow-1">
                                      <!-- <h5 class="mb-0 ">Order#: <span class="order-id">99012</span></h5>
                                      <h5 class="mb-0"><span class="order-date">
                                        12-Apr-2022
                                      </span>,&nbsp;
                                      <span class="order-time">3:00 PM</span>
                                    </h5>
        
                                    <h5 class="mb-0">Delivered on <span class="delivered-date">16 Apr</span> </h5> -->
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-0 order-name">#${elem.order_id}</h5>
                                        <h5 class="mb-0 order-price fw-600" ><span>&#8377;</span><span>${elem.price}</span></h5>
        
                                        
                                    </div>
        
                                   
        
                                    <div class="d-flex">
                                        <h6 class="mb-0 ls-1">Delivered By :</h6>
                                        <h6 class="mb-0 delivered-date ">${elem.delivered_date}</h6>
                                    </div>
        
                                    <div class="d-flex">
                                        <h6 class="mb-0 ls-1">Status :</h6>
                                        <h6 class="mb-0 order-status ">${elem.status}</h6>
                                    </div>

                                    <div class="d-flex">
                                    <h6 class="mb-0 ls-1"> Total Items :</h6>
                                    <h6 class="mb-0 total-items "> ${elem.totalitems}</h6>
                                </div>

                                    <div class="d-flex">
                                    <h6 class="mb-0 ls-1">Promocode :</h6>
                                    <h6 class="mb-0 promocode-order "> ${elem.promocode}</h6>
                                </div>
                                
                                   
                                
        
                                   
                                     
                                  </div>
                                </div>
    
                                <div class="d-flex track-order-div justify-content-between ">
                                    <a href="orderdetails.php" class="details-myorder"  > Order Details</a>
                                    <a href="#collapsedelivered${i+1}" class="track-order" data-bs-toggle="collapse" >Track Order</a>
                                </div>
                               
    
                             
                            </div>
                          </h2>
                          <div id="collapsedelivered${i+1}" class="accordion-collapse bg-track collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body container-fluid">
    
                                <div class="row justify-content-center">
                                    <div class="col-lg-7 col-md-6 col-12 d-flex justify-content-evenly flex-column">
                                        <div class=" order-track-style delivered-done justify-content-between d-flex ">
                                         <span class="done-order "></span>
                                            <span class="done-order"></span>
                                            <span class="done-order"></span> 
                                           
                                            
    
                                        </div>
                                        <div class=" order-track-info-style justify-content-between d-flex  ">
    
                                            <div class="ordered  done">
                                                <img src="assets1/images/clipboard (1).png" alt="">
                                            </div>
    
                                            <div class="shipped done">
                                                <img src="assets1/images/shipped.png" alt="">
                                            </div>
    
                                            <div class="delivered done">
                                                <img src="assets1/images/delivered.png" alt="">
                                            </div>
                                            
    
                                        </div>
    
                                        <div class=" order-track-info-style  justify-content-between d-flex  ">
    
                                            <div class="ordered  done">
                                                <span> Placed</span>
                                                <span class="myorder-placed-date">${elem.order_placed_date}</span>
                                            </div>
    
                                            <div class="shipped done">
                                                <span> Shipped</span>
                                                <span class="myorder-shipped-date">${elem.order_shipped_date}</span>
    
                                            </div>
    
                                            <div class="delivered done">
                                                <span> Delivered</span>
                                                <span class="myorder-delivered-date">${elem.delivered_date}</span>
    
                                            </div>
                                            
    
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                          </div>
                        </div>
            `
            document.body.style.setProperty("--after-order-color","rgb(199, 199, 199)")

        }
    })
})




let track_order=document.getElementsByClassName("track-order");

let delivered_order=document.getElementsByClassName("delivered-order")


Array.from(track_order).forEach(elem=>{
    elem.addEventListener("click",function(){

        Array.from(track_order).forEach(elem2=>{

            if(!(elem.getAttribute("href")==elem2.getAttribute("href")))
            {
                console.log(elem.getAttribute("href"),elem2.getAttribute("href"))
                elem2.innerHTML=`Track Order`
            }

            
        })
        if(elem.innerHTML==`Hide Details`)
        {
        elem.innerHTML=`Track Order`

        }
        else{
            elem.innerHTML=`Hide Details`

        }
    })
})

Array.from(delivered_order).forEach(elem=>{
    elem.addEventListener("click",function(){

        Array.from(delivered_order).forEach(elem2=>{

            if(!(elem.getAttribute("href")==elem2.getAttribute("href")))
            {
                console.log(elem.getAttribute("href"),elem2.getAttribute("href"))
                elem2.innerHTML=`View Details`
            }

            
        })
        if(elem.innerHTML==`Hide Details`)
        {
        elem.innerHTML=`View Details`

        }
        else{
            elem.innerHTML=`Hide Details`

        }
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
            document.body.style.setProperty("--chngmax-h","24vh")
        }
        else{
            elem.classList.add("view-det")
            elem.innerText="View Details"

            document.body.style.setProperty("--chngmax-h","52vh")



        }

        
    })
})


let promocode_input=document.getElementsByClassName("promocode_input")

Array.from(promocode_input).forEach(elem=>{
    elem.addEventListener("input",()=>{
        // console.log(elem.value)
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


let forgot_input=document.getElementsByClassName("forgot_input")

Array.from(forgot_input).forEach(elem=>{
    elem.addEventListener("input",()=>{
        // console.log(elem.value)

        elem.value=elem.value.replace(/[^0-9]/,"")

        

      
        if(elem.value.length==10){
           
            elem.nextElementSibling.removeAttribute("disabled","")



        }
        else{
            elem.nextElementSibling.setAttribute("disabled","")

            
           



        }
    })

    if(elem.value.length==10){
           
        elem.nextElementSibling.removeAttribute("disabled","")



    }
    else{
        elem.nextElementSibling.setAttribute("disabled","")

        
       



    }
})



// let forgot_btn=document.getElementsByClassName("forgot_btn")
// Array.from(forgot_btn).forEach(elem=>{
//     elem.addEventListener("click",function(){
//     //   window.open("verifyotp.html","_self")
//       console.log("Hello")
//     })
// })


let forgot_form=document.getElementsByClassName('forgot_form')

Array.from(forgot_form).forEach(elem=>{
    elem.addEventListener('submit',(e)=>{
        e.preventDefault()
        window.open("verifyotp.php","_self")

        console.log("submit")

    })
})

let otp_block=Array.from(document.getElementsByClassName("otp-block"))
var isBackSpace=false;
otp_block.forEach(elem=>{
    
    Array.from(elem.children).forEach((inputelem=>{
       inputelem.addEventListener("input",()=>{
         console.log(inputelem.value)
        if(inputelem.nextElementSibling!=null)
        {
            if(!isBackSpace)
             inputelem.nextElementSibling.focus()
        }
       })   
    }))
})

function backotp(e){
    isBackSpace=(e.key=="Backspace");
        // let firstchar=document.getElementById("firstchar").value;
        if(!(e.target.classList.contains("firstchar"))){
            if(e.key=="Backspace")
            {
                
                if(e.target.previousElementSibling!=null)
                {
                    e.target.focus()
                    setTimeout(()=>{
                        e.target.previousElementSibling.focus()
        
                    },1)
                }
                else{
                    
                }
            }

        }
    else if(e.key=="ArrowRight")
    {

        if(e.target.nextElementSibling!=null)
        {
            e.target.nextElementSibling.focus()

        }


    }
    else if(e.key=="ArrowLeft")
    {
        if(e.target.previousElementSibling!=null)
        {
            e.target.previousElementSibling.focus()
        }
    }
    else{
        otp_block[0].children[0].focus();
    }
}

document.addEventListener("keydown",backotp)




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
                    console.log("yes",elem)

                    
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
                    console.log("no")
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





if(document.body.classList.contains("checkoutform"))
{
    let zipcode=document.getElementById("zipcode")
    let city=document.getElementById("city")

    let state=document.getElementById("state")
    let country=document.getElementById("country")


    zipcode.addEventListener("input",getcitycountry)

    function getcitycountry(){
    zipcode.value= zipcode.value.replace(/[^0-9]/,"")
    // elem.value=elem.value.replace(/[^0-9]/,"")

    if(zipcode.value.length==6)
    {
        let pincodevalue=`https://api.postalpincode.in/pincode/${zipcode.value}`

        fetch(pincodevalue).then((response)=>{
            return response.json()
        
        }).then(data=>{
            console.log(data)
        
            data.forEach(elem=>{
                console.log(elem.PostOffice[0].Country)
                city.value=elem.PostOffice[0].District
                state.value=elem.PostOffice[0].State
                country.value=elem.PostOffice[0].Country

                function readonlyy(sameinp){
                    sameinp.setAttribute("readonly","")
                }
                readonlyy(city)
                readonlyy(state)
                readonlyy(country)


                


            })
        })
    }

    else{

        function readonlyy(sameinp){
            sameinp.removeAttribute("readonly")
        }
                city.value=""
                state.value=""
                country.value=""
        readonlyy(city)
        readonlyy(state)
        readonlyy(country)
    }
   

    }
}