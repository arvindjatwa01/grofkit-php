let save_add=document.getElementsByClassName("save-address-list")[0]

let alertinfo=document.getElementById('alertinfo')


let addressobj=[
    {
        name:"Qazim Hussain",
        address:"7170 E. Eagle Street New Berlin, WI 53151",
        place:"home"
    },
    {
        name:"Qazim Hussain",
        address:"7170 E. Eagle Street New Berlin, WI 53151",
        place:"work"
    },
    {
        name:"Qazim Hussain",
        address:"7170 E. Eagle Street New Berlin, WI 53151",
        place:"work"
    },
    {
        name:"Qazim Hussain",
        address:"7170 E. Eagle Street New Berlin, WI 53151",
        place:"home"
    },
    {
        name:"Qazim Hussain",
        address:"7170 E. Eagle Street New Berlin, WI 53151",
        place:"work"
    }
]

// addressobj.forEach((addobj,i)=>{

// save_add.innerHTML+=`
// <label class="col-12" for="save-address-${i+1}">
        
// <div class="">
//     <input type="radio" id="save-address-${i+1}" name="addresssame">

// </div>

// <div class="address-info">
//     <div class="d-flex mb-25">
//         <h4 class="mb-0 me-2">Qazim Hussain</h4>

//         <span class="home-office">${addobj.place}</span>

//         <a href="checkout.php" class="editaddress-btn d-none shadow">Edit</a>


//     </div>

//     <h6 class="full-address mb-0">
//         7170 E. Eagle Street
//         New Berlin, WI 53151
//     </h6>
// </div>





// </label>
// `
// })
// save_add.children[0].children[0].children[0].setAttribute("checked","")
// save_add.children[0].children[0].children[0].checked=true

/* Close Label Commnet*/

save_add.children[0].children[1].children[0].lastElementChild.classList.remove("d-none")

let yes=document.querySelector(".yes")
let no=document.querySelector(".no")







// Array.from(save_add.children).forEach(elem=>{

//     elem.addEventListener("click",()=>{

//         let alertinfoactive= new bootstrap.Modal(alertinfo)

//         alertinfoactive.show()


//         yes.addEventListener("click",()=>{
//         alertinfoactive.hide()

//                   Array.from(save_add.children).forEach(elem2=>{
//             elem2.children[0].children[0].removeAttribute("checked")


//         })

        
// elem.children[0].children[0].setAttribute("checked","")
//         console.log("Hello")  


//         })
//         no.addEventListener("click",()=>{
//         alertinfoactive.hide()

                   


//         })



       
    
        
//     })
    
    
// /*Unwanted Comment Data */ 

//     // elem.addEventListener("change",(e)=>{
       
//     //     Array.from(save_add.children).forEach(elem2=>{

//     //         elem2.children[1].children[0].lastElementChild.classList.add("d-none")
           
//     //     })
        
//     //     elem.children[1].children[0].lastElementChild.classList.remove("d-none")

        



//     // })
// })


