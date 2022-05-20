<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK rel="stylesheet" type="text/css" href="css/fonts.css">
    <LINK rel="stylesheet" type="text/css" href="css/main.css">
    <title><?=$title;?></title>
</head>
<body>

        <header>
            <div class="header__title">
                <h1><?=$headerTitle;?></h1>
            </div>
            <div class="<?=$headerButtons;?>"> 
                <div class="burger-menu">
                    <input id="menu-toggle" type="checkbox" />
                    <label class="menu-btn" for="menu-toggle">
                        <span></span>
                    </label>

                    <div class="menubox">
                        <button id="add">ADD</button>
                        <button id="delete-product-btn">MASS DELETE</button>
                    </div>
                </div>
            </div>
        </header>

        <?= $error; ?>