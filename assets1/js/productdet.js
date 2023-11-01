let add_item=document.getElementById('add-item')
let sub_item=document.getElementById('sub-item')

let cart_item_quantity=document.getElementById('cart-item-quantity')

cart_item_quantity.addEventListener("click",(e)=>{
    count_item=parseInt(e.currentTarget.children[1].innerHTML)

    // console.log(e.currentTarget.children[1].innerHTML)

    // new_price=parseInt(e.currentTarget.previousElementSibling.getAttribute("data-bs-price"))

     if(e.target.classList.contains("add"))
     {
         //console.log("add",e.currentTarget.previousElementSibling.lastElementChild.innerHTML)
         count_item+=1


     }

     else if(e.target.classList.contains("sub") && count_item>1)
     {
         //console.log("sub",count_item)
         count_item-=1


     }
     




     e.currentTarget.children[1].innerHTML=`${count_item}`
})

// let weight_products=document.querySelectorAll(".weight-products a")

// let flavoured_products=document.querySelectorAll(".flavoured-products a")


// weight_products.forEach(elem=>{
//     elem.addEventListener('click',(e)=>{
//         weight_products.forEach(elem2=>{
//             elem2.classList.remove("active")
//         })
//         elem.classList.add('active')
//     })
// })
// flavoured_products.forEach(elem=>{
//     elem.addEventListener('click',(e)=>{
//         flavoured_products.forEach(elem2=>{
//             elem2.classList.remove("active")
//         })
//         elem.classList.add('active')
//     })
// })

let multi_select=document.querySelectorAll(".multi_select a")

let single_select=document.querySelectorAll(".single_select a")
var SelectedAtt=[];
var itemRateShow=document.getElementById("itemratedisyply");
multi_select.forEach(elem=>{
    elem.addEventListener('click',(e)=>{

        if(elem.classList.contains("active"))
        {
            AddRemoveValues(false,elem.attributes['data-attvalue'].nodeValue)
            elem.classList.remove("active")
        }
        else{
           AddRemoveValues(true,elem.attributes['data-attvalue'].nodeValue)
            elem.classList.add('active')

        }
    })
})

single_select.forEach(elem=>{
    elem.addEventListener('click',(e)=>{
        var selectID=0;
        single_select.forEach(elem2=>{
            if(elem2.classList.contains("active"))
            {
                selectID=elem2.attributes['data-attvalue'].nodeValue;
                AddRemoveValues(false,selectID)
                elem2.classList.remove("active")
            }
        })
        var current=elem.attributes['data-attvalue'].nodeValue;
        if(selectID!==current)
        {
            AddRemoveValues(true,current)
            elem.classList.add('active')
        }
    })
})
function AddRemoveValues(IsAdd,valuesofAtt)
{
    if(IsAdd)
    {
        if(!SelectedAtt.includes(valuesofAtt))
        SelectedAtt.push(valuesofAtt)
    }
    else
    {
        if(SelectedAtt.includes(valuesofAtt)) 
        SelectedAtt=SelectedAtt.filter(item => item !== valuesofAtt)
    }
    UpdateValueFromDataBase(SelectedAtt.sort().join(','))

}

// window.addEventListener("load",UpdateValueFromDataBase(SelectedAtt.sort().join(',')))


function UpdateValueFromDataBase(bypassid)
{
    $.ajax({
        url: "action.php",
        type: "POST",
        data: {
            isitemrateget: true,
            itemId: atob(location.search.split('id=')[1]),
            attvalues:bypassid
        },
        success: function(data) {
            itemRateShow.innerHTML=data;


        },
        error: function(data) {
            console.log(data);
        }
    });
    
}
// function isActive(){

// }
let carouselimg=document.querySelectorAll(".carousel img")

carouselimg.forEach(elem=>{
// console.log(elem)
elem.style.cursor="pointer"

elem.addEventListener("click",()=>{
    // console.log(elem)

    

    imgsrc=elem.getAttribute('src')

  let  imgmodal=document.getElementById("img-modal")

    let modalactive=new bootstrap.Modal(imgmodal)

    let modalimgchng=imgmodal.children[0].children[0].children[1].children[0]
    

    modalimgchng.setAttribute("src",`${imgsrc}`)



    modalactive.show()


})
})


let your_rating=document.querySelectorAll(".your-rating i")
let your_rating_points=document.getElementById('your-rating-points')
let rating_point=document.getElementById('rating-point')

your_rating.forEach((elem,i)=>{
    // console.log(elem)

    elem.addEventListener("click",()=>{

        your_rating.forEach(elem2=>{
            elem2.classList.remove("bi-star-fill")
            elem2.classList.add("bi-star")
        })

        for(j=0;j<=i;j++)
        {

            your_rating[j].classList.add("bi-star-fill")
            your_rating[j].classList.remove("bi-star")

            your_rating_points.innerHTML=`${parseFloat(j+1)}.0`
            rating_point.setAttribute('value',`${parseFloat(j+1)}.0`);

        }
      
    })
})