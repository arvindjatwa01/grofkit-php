
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



// let myordersobj=[
//     {
        
//         price:1180,
//         imgsrc:"assets1/images/invoice.png",
//         delivered_date:"18 Apr 2022",
//         status:"Ordered",
//         order_id:"868678",
//         order_placed_date:"12 Apr 2022",
//         order_shipped_date:"14 Apr 2022",
//         promocode:"OFFER50",
//         totalitems:10
//     },
//     {
        
//         price:1180,
//         imgsrc:"assets1/images/invoice.png",
//         delivered_date:"18 Apr 2022",
//         status:"Delivered",
//         order_id:"868678",
//         order_placed_date:"12 Apr 2022",
//         order_shipped_date:"14 Apr 2022",
//         promocode:"OFFER50",
//         totalitems:10
//     },

//     {
        
//         price:1180,
//         imgsrc:"assets1/images/invoice.png",
//         delivered_date:"18 Apr 2022",
//         status:"Cancellation request",
//         order_id:"868678",
//         order_placed_date:"12 Apr 2022",
//         order_shipped_date:"14 Apr 2022",
//         promocode:"OFFER50",
//         totalitems:10,
//         cancel_date:"29 Apr 2022"
//     },
   
// ]

Array.from(my_orders_allitems).forEach(orderitem=>{
    // myordersobj.forEach((elem,i)=>{

    //     //console.log(elem.status)

    //     if(elem.status=="Ordered")
    //     {
    //         orderitem.innerHTML+=`

    //         <div class="accordion-item my-bag-${i+1}">
    //                       <h2 class="accordion-header " id="headingOne">
    //                         <div class="accordion-button flex-column align-items-stretch  order-short  p-0 " type="button"  aria-expanded="true" aria-controls="collapseOne">
    
    //                             <div class="d-flex align-items-center flex-grow-1">
    //                                 <div class="order-img d-flex justify-content-center  h-100">
    //                                     <img src="${elem.imgsrc}" alt="" class="img-fluid">
    //                                 </div>
    //                                 <div class="order-track-info flex-grow-1">
    //                                   <!-- <h5 class="mb-0 ">Order#: <span class="order-id">99012</span></h5>
    //                                   <h5 class="mb-0"><span class="order-date">
    //                                     12-Apr-2022
    //                                   </span>,&nbsp;
    //                                   <span class="order-time">3:00 PM</span>
    //                                 </h5>
        
    //                                 <h5 class="mb-0">Delivered on <span class="delivered-date">16 Apr</span> </h5> -->
    //                                 <div class="d-flex justify-content-between">
    //                                     <h5 class="mb-0 order-name">#${elem.order_id}</h5>
    //                                     <h5 class="mb-0 order-price fw-600" ><span>&#8377;</span><span>${elem.price}</span></h5>
        
                                        
    //                                 </div>
        
                                   
        
    //                                 <div class="d-flex">
    //                                     <h6 class="mb-0 ls-1">Delivered By :</h6>
    //                                     <h6 class="mb-0 delivered-date ">${elem.delivered_date}</h6>
    //                                 </div>
        
    //                                 <div class="d-flex">
    //                                     <h6 class="mb-0 ls-1">Status :</h6>
    //                                     <h6 class="mb-0 order-status ">${elem.status}</h6>
    //                                 </div>

    //                                 <div class="d-flex">
    //                                 <h6 class="mb-0 ls-1"> Total Items :</h6>
    //                                 <h6 class="mb-0 total-items "> ${elem.totalitems}</h6>
    //                             </div>

    //                                 <div class="d-flex">
    //                                 <h6 class="mb-0 ls-1">Promocode :</h6>
    //                                 <h6 class="mb-0 promocode-order "> ${elem.promocode}</h6>
    //                             </div>
                                
                                   
                                
        
                                   
                                     
    //                               </div>
    //                             </div>
    
    //                             <div class="d-flex track-order-div justify-content-between ">
    //                                 <a href="orderdetails.php" class="details-myorder"  > Order Details</a>
    //                                 <a href="#collapseordered${i+1}" class="track-order" data-bs-toggle="collapse" >Track Order</a>
    //                             </div>
                               
    
                             
    //                         </div>
    //                       </h2>
    //                       <div id="collapseordered${i+1}" class="accordion-collapse bg-track collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
    //                         <div class="accordion-body container-fluid">
    
    //                             <div class="row justify-content-center">
    //                                 <div class="col-lg-7 col-md-6 col-12 d-flex justify-content-evenly flex-column">
    //                                     <div class=" order-track-style ordered-done justify-content-between d-flex ">
    //                                      <span class="done-order "></span>
    //                                         <span class="pending-order"></span>
    //                                         <span class="pending-order"></span> 
                                           
                                            
    
    //                                     </div>
    //                                     <div class=" order-track-info-style justify-content-between d-flex  ">
    
    //                                         <div class="ordered  done">
    //                                             <img src="assets1/images/clipboard (1).png" alt="">
    //                                         </div>
    
    //                                         <div class="shipped">
    //                                             <img src="assets1/images/shipped.png" alt="">
    //                                         </div>
    
    //                                         <div class="delivered">
    //                                             <img src="assets1/images/delivered.png" alt="">
    //                                         </div>
                                            
    
    //                                     </div>
    
    //                                     <div class=" order-track-info-style  justify-content-between d-flex  ">
    
    //                                         <div class="ordered  done">
    //                                             <span> Placed</span>
    //                                             <span class="myorder-placed-date">${elem.order_placed_date}</span>
    //                                         </div>
    
    //                                         <div class="shipped">
    //                                             <span> Shipped</span>
    //                                             <span class="myorder-shipped-date">${elem.order_shipped_date}</span>
    
    //                                         </div>
    
    //                                         <div class="delivered">
    //                                             <span> Delivered</span>
    //                                             <span class="myorder-delivered-date">${elem.delivered_date}</span>
    
    //                                         </div>
                                            
    
    //                                     </div>
    //                                 </div>
    //                             </div>
                              
    //                         </div>
    //                       </div>
    //                     </div>
    //         `
    //         document.body.style.setProperty("--before-order-color","rgb(199, 199, 199)")
    //     }

        


    //     else if(elem.status=="Shipped")
    //     {
    //         orderitem.innerHTML+=`

    //         <div class="accordion-item my-bag-${i+1}">
    //                       <h2 class="accordion-header " id="headingOne">
    //                         <div class="accordion-button flex-column align-items-stretch  order-short  p-0 " type="button"  aria-expanded="true" aria-controls="collapseOne">
    
    //                             <div class="d-flex align-items-center flex-grow-1">
    //                                 <div class="order-img d-flex justify-content-center  h-100">
    //                                     <img src="${elem.imgsrc}" alt="" class="img-fluid">
    //                                 </div>
    //                                 <div class="order-track-info flex-grow-1">
    //                                   <!-- <h5 class="mb-0 ">Order#: <span class="order-id">99012</span></h5>
    //                                   <h5 class="mb-0"><span class="order-date">
    //                                     12-Apr-2022
    //                                   </span>,&nbsp;
    //                                   <span class="order-time">3:00 PM</span>
    //                                 </h5>
        
    //                                 <h5 class="mb-0">Delivered on <span class="delivered-date">16 Apr</span> </h5> -->
    //                                 <div class="d-flex justify-content-between">
    //                                     <h5 class="mb-0 order-name">#${elem.order_id}</h5>
    //                                     <h5 class="mb-0 order-price fw-600" ><span>&#8377;</span><span>${elem.price}</span></h5>
        
                                        
    //                                 </div>
        
                                   
        
    //                                 <div class="d-flex">
    //                                     <h6 class="mb-0 ls-1">Delivered By :</h6>
    //                                     <h6 class="mb-0 delivered-date ">${elem.delivered_date}</h6>
    //                                 </div>
        
    //                                 <div class="d-flex">
    //                                     <h6 class="mb-0 ls-1">Status :</h6>
    //                                     <h6 class="mb-0 order-status ">${elem.status}</h6>
    //                                 </div>

    //                                 <div class="d-flex">
    //                                 <h6 class="mb-0 ls-1"> Total Items :</h6>
    //                                 <h6 class="mb-0 total-items "> ${elem.totalitems}</h6>
    //                             </div>

    //                                 <div class="d-flex">
    //                                 <h6 class="mb-0 ls-1">Promocode :</h6>
    //                                 <h6 class="mb-0 promocode-order "> ${elem.promocode}</h6>
    //                             </div>
                                
                                   
                                
        
                                   
                                     
    //                               </div>
    //                             </div>
    
    //                             <div class="d-flex track-order-div justify-content-between ">
    //                                 <a href="orderdetails.php" class="details-myorder"  > Order Details</a>
    //                                 <a href="#collapseshipped${i+1}" class="track-order" data-bs-toggle="collapse" >Track Order</a>
    //                             </div>
                               
    
                             
    //                         </div>
    //                       </h2>
    //                       <div id="collapseshipped${i+1}" class="accordion-collapse bg-track collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
    //                         <div class="accordion-body container-fluid">
    
    //                             <div class="row justify-content-center">
    //                                 <div class="col-lg-7 col-md-6 col-12 d-flex justify-content-evenly flex-column">
    //                                     <div class=" order-track-style shipped-done justify-content-between d-flex ">
    //                                      <span class="done-order "></span>
    //                                         <span class="done-order"></span>
    //                                         <span class="pending-order"></span> 
                                           
                                            
    
    //                                     </div>
    //                                     <div class=" order-track-info-style justify-content-between d-flex  ">
    
    //                                         <div class="ordered  done">
    //                                             <img src="assets1/images/clipboard (1).png" alt="">
    //                                         </div>
    
    //                                         <div class="shipped">
    //                                             <img src="assets1/images/shipped.png" alt="">
    //                                         </div>
    
    //                                         <div class="delivered">
    //                                             <img src="assets1/images/delivered.png" alt="">
    //                                         </div>
                                            
    
    //                                     </div>
    
    //                                     <div class=" order-track-info-style  justify-content-between d-flex  ">
    
    //                                         <div class="ordered  done">
    //                                             <span> Placed</span>
    //                                             <span class="myorder-placed-date">${elem.order_placed_date}</span>
    //                                         </div>
    
    //                                         <div class="shipped done">
    //                                             <span> Shipped</span>
    //                                             <span class="myorder-shipped-date">${elem.order_shipped_date}</span>
    
    //                                         </div>
    
    //                                         <div class="delivered">
    //                                             <span> Delivered</span>
    //                                             <span class="myorder-delivered-date">${elem.delivered_date}</span>
    
    //                                         </div>
                                            
    
    //                                     </div>
    //                                 </div>
    //                             </div>
                              
    //                         </div>
    //                       </div>
    //                     </div>
    //         `
    //         document.body.style.setProperty("--before-order-color","#c2a70e")

    //     }


    //     else if(elem.status=="Cancellation request")
    //     {
    //         orderitem.innerHTML+=`

    //         <div class="accordion-item my-bag-${i+1} cancel-block">
    //                       <h2 class="accordion-header " id="headingOne">
    //                         <div class="accordion-button flex-column align-items-stretch  order-short  p-0 " type="button"  aria-expanded="true" aria-controls="collapseOne">
    
    //                             <div class="d-flex align-items-center flex-grow-1">
    //                                 <div class="order-img d-flex justify-content-center  h-100">
    //                                     <img src="${elem.imgsrc}" alt="" class="img-fluid">
    //                                 </div>
    //                                 <div class="order-track-info flex-grow-1">
    //                                   <!-- <h5 class="mb-0 ">Order#: <span class="order-id">99012</span></h5>
    //                                   <h5 class="mb-0"><span class="order-date">
    //                                     12-Apr-2022
    //                                   </span>,&nbsp;
    //                                   <span class="order-time">3:00 PM</span>
    //                                 </h5>
        
    //                                 <h5 class="mb-0">Delivered on <span class="delivered-date">16 Apr</span> </h5> -->
    //                                 <div class="d-flex justify-content-between">
    //                                     <h5 class="mb-0 order-name">#${elem.order_id}</h5>
    //                                     <h5 class="mb-0 order-price fw-600" ><span>&#8377;</span><span>${elem.price}</span></h5>
        
                                        
    //                                 </div>
        
                                   
        
                                    
        
    //                                 <div class="d-flex">
    //                                     <h6 class="mb-0 ls-1">Cancelled By :</h6>
    //                                     <h6 class="mb-0 cancelled-date ">${elem.cancel_date}</h6>
    //                                 </div>
    //                                 <div class="d-flex">
    //                                     <h6 class="mb-0 ls-1">Status :</h6>
    //                                     <h6 class="mb-0 order-status ">${elem.status}</h6>
    //                                 </div>

    //                                 <div class="d-flex">
    //                                 <h6 class="mb-0 ls-1"> Total Items :</h6>
    //                                 <h6 class="mb-0 total-items "> ${elem.totalitems}</h6>
    //                             </div>

    //                                 <div class="d-flex">
    //                                 <h6 class="mb-0 ls-1">Promocode :</h6>
    //                                 <h6 class="mb-0 promocode-order "> ${elem.promocode}</h6>
    //                             </div>
                                
                                   
                                
        
                                   
                                     
    //                               </div>
    //                             </div>
    
    //                             <div class="d-flex track-order-div justify-content-between ">
    //                                 <a href="orderdetails.php" class="details-myorder"  > Order Details</a>
    //                                 <a href="orderdetails.php" class="re-order"  >Re-Order</a>
    //                             </div>
                               
    
                             
    //                         </div>
    //                       </h2>
                          
    //                     </div>
    //         `
    //     }

       

    // })
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
                                        <h6 class="mb-0 ls-1">Delivered on :</h6>
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
                //console.log(elem.getAttribute("href"),elem2.getAttribute("href"))
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
                //console.log(elem.getAttribute("href"),elem2.getAttribute("href"))
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
