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