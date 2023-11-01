
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






// index.js



// let signup_tab=document.querySelector("#signup_sec")

//console.log(input_field)


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

        //console.log("Over")

        Array.from(shop_category_list).forEach(elem=>{
       
           
            if(!(e.currentTarget.classList.contains("shop-category")))
            {
                elem.style.display="flex"
        //console.log("flex",e.currentTarget)


            }

            else{
                elem.style.display="none"

        //console.log("none",e.currentTarget)


            }
      
    
            
        })

    })

})

Array.from(rightarrcar).forEach(rightelem=>{
    rightelem.addEventListener("click",(e)=>{
        //console.log("click")
        Array.from(category_carousel).forEach(categelem=>{
            categelem.scrollLeft+=categelem.children[0].children[0].clientWidth
            // if(categelem.offsetWidth+categelem.scrollLeft)


            //console.log(categelem.scrollLeft,categelem,e)
        })
    })
})

Array.from(leftarrcar).forEach(leftelem=>{
    leftelem.addEventListener("click",(e)=>{
        //console.log("click")

        Array.from(category_carousel).forEach(categelem=>{
        if(categelem.scrollLeft>0)
        {
            categelem.scrollLeft-=categelem.children[0].children[0].clientWidth

        }
        else{

        }

            // if(categelem.offsetWidth+categelem.scrollLeft)


            //console.log(categelem.scrollLeft,categelem,e)
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

    //console.log(categelem.scrollLeft,categelem)
})


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






// let mostbuysobj=[

//     {
//         naam:"Cornetto Icecream",
//         weight:"120 gm",
//         price:30,
//         mrp_price:27,

//         imgsrc:"assets1/images/cornetto.jpg"
//     },

//     {
//         naam:"Saras Shudh Ghee",
//         weight:"500 ml",
//         price:232,
//         mrp_price:215,

//         imgsrc:"assets1/images/saras-ghee.jpg"
//     },
//     {
//         naam:"Onion",
//         weight:"1 kg",
//         price:15,
//         mrp_price:12,

//         imgsrc:"assets1/images/onion.jpg"
//     },
  
//     {
//         naam:"Cadbury Dairy milk crispello chocolate bar",
//         weight:"35 gm",
//         price:23,
//         mrp_price:20,

//         imgsrc:"assets1/images/crispello.jpg"
//     },

//     {
//         naam:"banana",
//         weight:"1 kg",
//         price:25,
//         mrp_price:20,

//         imgsrc:"assets1/images/banana.jpg"
//     },
//     {
//         naam:"Gram flour",
//         weight:"1 kg",
//         price:80,
//         mrp_price:72,

//         imgsrc:"assets1/images/gram flour.jpg"
//     },
//     {
//         naam:"Cashew ",
//         weight:"500 gm",
//         price:400,
//         mrp_price:370,

//         imgsrc:"assets1/images/cashew.jpg"
//     },
//     {
//         naam:"Kissan Tomato Ketchup pouch",
//         weight:"950 gm",
//         price:100,
//         mrp_price:94,

//         imgsrc:"assets1/images/Kissan Tomato Ketchup pouc.jpg"
//     },
// ]

// showitems(mostbuysobj,items_second_sec)



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



let pincode_modal=document.getElementById('pincode-modal');

let pincode_anchor=document.querySelectorAll(".pincode-list input")



let pincode_modalactive=new bootstrap.Modal(pincode_modal,{
    backdrop:"static"
})

window.addEventListener('load',()=>{
    pincode_modalactive.show()

   
    
})

// console.log("hello",pincode_anchor)

// pincode_anchor.forEach(elem=>{
//     elem.addEventListener("click",()=>{
//         pincode_modalactive.hide()
//     })
// })