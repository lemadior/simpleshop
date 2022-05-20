<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK rel="stylesheet" type="text/css" href="css/fonts.css">
    <LINK rel="stylesheet" type="text/css" href="css/main.css">
    <title>Product Add</title>
</head>
<body>

    <header>
        <div class="header__title">
            <h1>Product Add</h1>
        </div>
        <div class="wrapper"> 
            <div class="burger-menu">
                <input id="menu-toggle" type="checkbox" />
                <label class="menu-btn" for="menu-toggle">
                    <span></span>
                </label>

                <div class="menubox">
                    <button id="add">SAVE</button>
                    <button id="delete-product-btn">CANCEL</button>
                </div>


                <!-- <ul class="menubox">
                    <li><a href="#">ADD</a></li>
                    <li><a href="#" >MASS DELETE</a></li>
                </ul> -->
            </div>
        </div>
        
    </header>
    <div class="error">
            <p id="error-message"></p>
            <p style="display: relative; color: black; font-size:x-small;">Click/tap to remove</p>
        </div>
        <div class="form__add"> 
            <form id="product_form">
                
                <div> 
                    <span><label for="sku">SKU</label></span>
                    <span><input type="text" name="sku" id="sku" required>*</span>
                </div>
                <div>
                    <span><label for="name">Name</label></span>
                    <span><input type="text" name="name" id="name" required>*</spa>
                </div>
                <div>
                    <span><label for="price">Price ($)</label></span>
                    <span><input type="number" min="0" name="price" id="price" required>*</span>
                </div>
                <div>
                    <span><label for="types" placeholder="Select type">Type Switcher</label></span>
                    <span><select name="types" id="productType">
                        <option value="value1" selected>DVD</option>
                        <option value="value2">Book</option>
                        <option value="value3">Furniture</option>
                    </select>
                    </span>
                </div>

                <div class="dvd__block">
                    <div>
                        <span><label for="size">Size (MB)</label></span>
                        <span><input type="number" min="0" name="size" id="size" required>*</span>
                    </div>
                    <p>Please, provide size</p>
                </div>

                <div class="book__block" style="display: none;">
                    <div>
                        <span><label for="weight">Weight (KG)</label></span>
                        <span><input type="number" min="0" name="weight" id="weight" required>*</span>
                    </div>
                    <p>Please, provide weight</p>
                </div>

                <div class="furniture__block" style="display: none;">
                    <div>
                        <span><label for="height">Height (CM)</label></span>
                        <span><input type="number" min="0" name="height" id="height" required>*</span>
                    </div>
                    <div>
                        <span><label for="width">Width (CM)</label></span>
                        <span><input type="number" min="0" name="width" id="width" required>*</span>
                    </div>
                    <div>
                        <span><label for="length">Length (CM)</label></span>
                        <span><input type="number" min="0" name="length" id="length" required>*</span>
                    </div>
                    <p>Please, provide dimensions</p>
                </div>
                
                 <p>✷ - required fields</p> 
            </form>
            
            

        </div>



    <footer>
        <!-- <div class="footer"> -->
            Scandiweb Test Assigment
        <!-- </div> -->
    </footer>
</body>
</html>