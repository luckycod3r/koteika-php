
let _listened = [];

class Request{
    constructor(act, data, succ) {
        this.action = act;
        this.data = data;
        this.callback = succ;
    }

    post(){
        this.data.action = this.action;
        $.ajax("http://localhost/ajax",{
            data: this.data,
            method: "POST",
            success: (response) => this.callback(response)
        })
    }

    get(){
        this.data.action = this.action;
        $.ajax("http://localhost/ajax",{
            data: this.data,
            method: "GET",
            success: (response) => this.callback(response)
        })
    }
}

class NULLEvent{
    constructor(name,callback) {
        this.name = name;
        this.event = new Event(name);
        this.callback = callback;

        document.addEventListener(name,callback);
        _listened.push(this);
    }
}

class NULLRequest{
    constructor(name, ...data ) {
        for(let o of _listened){
            if(o.name == name){
                o.event.nulled = data
                document.dispatchEvent(o.event);
            }
        }

    }

}

let _3szeL = {
    CART : {
       opened : false,
        close : function(){
           this.opened = false;
        },
        open : function(){
           this.opened = true;
        }
    }
}

class CORE{

    constructor() {
        this.root = _3szeL;
    }

    CART(){
        return this.root.CART;
    }

}