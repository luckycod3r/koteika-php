// CORE

const ECORE = new CORE();
const CART = ECORE.CART();

// REGISTER NEW EVENTS...

new NULLEvent("cartOpen",(e)=>{
    console.log(e)
    if(CART.opened){
        CART.close();
    }
    else{
        CART.open();
    }
});

new NULLEvent("cartAdd",(e)=>{
    let r = new Request("cartAdd",{
        item : e.nulled[0]
    });
    r.post();
})



// OTHER CODE...