let cont_collapse=document.getElementById('cont-collapse')

let contact_btn=document.getElementsByClassName('contactus-profile')[0]

contact_btn.addEventListener('click',(e)=>{
    if(contact_btn.getAttribute("aria-expanded")=="true")
    {
 
        contact_btn.children[2].children[0].children[0].classList.add("open-anime") 
        contact_btn.children[2].children[0].children[0].classList.remove("close-anime") 

       
    }
    else{
        contact_btn.children[2].children[0].children[0].classList.add("close-anime") 
        contact_btn.children[2].children[0].children[0].classList.remove("open-anime") 



    }
})
