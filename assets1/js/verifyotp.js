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



let otp_block=Array.from(document.getElementsByClassName("otp-block"))

var isBackSpace=false;
otp_block.forEach(elem=>{
    
    Array.from(elem.children).forEach((inputelem=>{
       inputelem.addEventListener("input",()=>{
         //console.log(inputelem.value)
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