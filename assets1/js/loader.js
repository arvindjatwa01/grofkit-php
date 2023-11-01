document.addEventListener('readystatechange',()=>{
    // console.log(document.readyState)

    if(document.readyState!="complete")
    {
        document.body.style.visibility="hidden";
        document.querySelector(".loader").style.visibility="visible"
    }

    else{


        document.body.style.visibility="visible";
        document.querySelector(".loader").style.display="none"
    }
})