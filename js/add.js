console.log('add.js is loaded');


class Input 
{
    #valid;
    #obj;
    constructor (_name)
    {
        this.#obj = document.getElementById(_name);
        this.parentBlock = this.#obj.parentNode.parentNode.parentNode;
        this.#valid = false;
        this.#obj.addEventListener("input", this.check.bind(this));
    }

    /**
     * @param {boolean} value
     */
    set valid(value)
    {
        this.#valid = value;

        if (value) {
            this.#obj.style.color = 'green';
        }  else {
            // this.#obj.value = parseInt(this.obj.value,10);
            this.#obj.style.color = 'red';
        }
    }

    get valid()
    {
        if (this.parentBlock.classList.contains('hide')) {
            this.#valid = true;  
        } else {
            this.check();   
        }

        return this.#valid;
    }

    /**
     * @param {HTMLElement} value
     */

    set obj(value)
    {
        this.#obj = value;
    }

    get obj() {
        return this.#obj;
    }

    getObj() 
    {
        return this.#obj;
    }

    check() {
        let elem = this.#obj;

        if (parseInt(elem.value,10) === NaN || parseInt(elem.value,10) === 0 || elem.value == '')  {
           console.log("Elem false");
            this.valid = false;
        } else {
            this.valid = true;   
            console.log("Elem true");
        }
        
    }

}

let sku = document.getElementById('sku');
let price = document.getElementById('price');
let _name = document.getElementById('name');

let size = new Input('size');
let weight = new Input('weight');
let width = new Input('width');
let height = new Input('height');
let _length = new Input('length');

let saveBtn = document.getElementById('save');
let type_select = document.getElementById('productType');
let current_block = document.getElementsByClassName(type_select.value.toLowerCase()+"__block")[0];
let error_msg = document.getElementById('error-message');
let SKU_list = [];

let sku_valid = false;
let price_valid = false;
let name_valid = false;

window.setInterval( function(){

    if (sku_valid === false || 
        price_valid === false ||
        name_valid === false ||
        size.valid === false ||
        weight.valid === false ||
        width.valid === false ||
        height.valid === false ||
        _length.valid === false) {
        saveBtn.style.color = 'red';
    } else {
        saveBtn.style.color = 'black';
    }

    // console.log("sku="+sku_valid, "price="+price_valid, "name="+name_valid,
    //             "size="+size.valid,"weight="+weight.valid,"width="+width.valid,
    //             "height="+height.valid,"length="+_length.valid);

  },10)

window.onload = () => {

    let xhr = new XMLHttpRequest();
    let mForm =  new FormData();

    xhr.open('POST','/add-product');
    mForm.append("UNIQUE", 'YES');

    xhr.send(mForm);

    xhr.onload = () => {

        //console.log('Return=',xhr.response);
        if (xhr.response != "FAIL") {
            SKU_list = xhr.response.split(' ');
            //console.log(SKU_list);
        } else {
            error_msg.innerHTML="ERROR: can't get identifiers list!";
            error_msg.parentNode.classList.toggle('hide');
        };
    
    }   



};

function saving() {
    console.log('Adding');
    let xhr = new XMLHttpRequest();
    let mForm =  new FormData(document.getElementById('product_form'));
    
    xhr.open('POST','/add-product');

    xhr.send(mForm);

    xhr.onload = () => {

        //console.log('Return=',xhr.response);
        if (xhr.response != "FAIL") {
            location.href="/";
            //console.log(SKU_list);
        } else {
            error_msg.innerHTML="ERROR: can't get identifiers list!";
            error_msg.parentNode.classList.toggle('hide');
        };

    }   
}

type_select.addEventListener("change", (event) => {
    let type = type_select.value.toLowerCase();
    let add_block = document.getElementsByClassName(type+"__block")[0];
    current_block.classList.toggle('hide');
    add_block.classList.toggle('hide');
    current_block = add_block;
});

sku.addEventListener("input", (event) => {
    if (SKU_list.includes(event.target.value) || event.target.value == '') {
        sku.style.color = 'red';
        sku_valid = false;
    } else {
        sku.style.color = 'green';
        sku_valid = true;
    }
});

price.addEventListener("input", (event) => {
    if (parseFloat(event.target.value) === NaN || 
        parseFloat(event.target.value) === 0 ||
        event.target.value == '')  {
        price.style.color = 'red';
        price_valid = false;
    } else {
        price.style.color = 'green';
        price_valid = true; 
    }
});

_name.addEventListener("input", (event) => {
    if (event.target.value == '') {
        name_valid = false;
    } else {
        name_valid = true;
    }
});
/*
function checkSize() {
    if (parseInt(size.value,10) === NaN || 
        parseInt(size.value,10) === 0 ||
        size.value == '')  {
        size.style.color = 'red';
        size_valid = false;
    } else {
       // event.target.value = parseInt(event.target.value,10);
        size.style.color = 'green';
        size_valid = true;   
    }
}

function checkWeight() {
    if (parseInt(weight.value,10) === NaN || 
        parseInt(weight.value,10) === 0 ||
        weight.value == '')  {
        weight.style.color = 'red';
        weight_valid = false;
    } else {
       // event.target.value = parseInt(event.target.value,10);
        weight.style.color = 'green';
        weight_valid = true;   
    }
}

function checkWidth() {
    if (parseInt(width.value,10) === NaN || 
        parseInt(width.value,10) === 0 ||
        width.value == '')  {
        width.style.color = 'red';
        width_valid = false;
    } else {
       // event.target.value = parseInt(event.target.value,10);
        width.style.color = 'green';
        width_valid = true;   
    }
}

function checkHeight() {
    if (parseInt(height.value,10) === NaN || 
        parseInt(height.value,10) === 0 ||
        height.value == '')  {
        height.style.color = 'red';
        height_valid = false;
    } else {
       // event.target.value = parseInt(event.target.value,10);
        height.style.color = 'green';
        height_valid = true;   
    }
}

function checkLength() {
    if (parseInt(length.value,10) === NaN || 
        parseInt(length.value,10) === 0 ||
        length.value == '')  {
        legth.style.color = 'red';
        length_valid = false;
    } else {
       // event.target.value = parseInt(event.target.value,10);
        length.style.color = 'green';
        length_valid = true;   
    }
}
*/

//(size.obj).addEventListener("input", size._check.bind(size));
/*
(weight.getObj()).addEventListener("input", weight._check);

(width.getObj()).addEventListener("input", width._check);

(height.getObj()).addEventListener("input", height.check);

(_length.getObj()).addEventListener("input", _length._check);
*/