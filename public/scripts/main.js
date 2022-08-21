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



<<<<<<< HEAD
// OTHER CODE...
=======
}
console.error.toString = null;



function get_cart(){
    $.ajax({
        url: '/handler',
        method: 'post',
        dataType: 'text',
        data: {action: 'cart'},
        success: function(data){
            alert(data);
        }
    });
}

function add_cart(){
    $.ajax({
        url: '/handler',
        method: 'post',
        dataType: 'text',
        data: {action: 'cart'},
        success: function(data){
            alert(data);
        }
    });
}

add_cart();
get_cart();
>>>>>>> origin/master
