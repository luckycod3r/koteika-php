let _console = {
    error: console.error
}

if(console.error){
    console.error = _console.error;
    system.logger = _console;
}
let zHelp = String;

String = function() {
    if (arguments[0] === console.error) {
        arguments[0] = _console.error;
    }
    return zHelp.apply(null, arguments)
}

console.error = function(...error){

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
