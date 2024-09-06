<!Doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PRODUCT PAGE</title>
    <link rel="stylesheet" type="text/css" href="./product-desc.css" />
</head>

<body>
    <main id="" class="">
    <nav class='navbar'>
            <div class="menu-item"><a href="./index.php" style="color:red"><span class="nav-menu-item">Home</span></a></div>
            <div class="menu-item"><a href="./admin.php"><span class="nav-menu-item">Admin</span></a></div>
            <div class="menu-item"><a href="./index.php#products"><span class="nav-menu-item">Products</span></a></div>
        </nav>
        <div class="container" id="furniture_details_renderer">
        </div>
    </main>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            try {
                // Create an XMLHttpRequest object
                var xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var furnitureData = JSON.parse(xhr.responseText);

                        // Render furniture data using JavaScript
                        renderFurniture(furnitureData);
                        console.log("success ", furnitureData)
                    } else {
                        console.log('Error occurred while getting product data.', xhr.responseText);
                        document.getElementById("furniture_details_renderer").innerHTML = '<div>An error occured while fetching</div>';
                    }
                };

                // get the query parameter 
                let productId = new URLSearchParams(window.location.search).get('productId')
                console.log("url params are ", window.location)

                // Open a GET request to the PHP script that fetches furniture data
                xhr.open("GET", `./db/getProductData.php?productId=${productId}`, true);
                xhr.setRequestHeader("Content-type", "application/json");

                // Send the request
                xhr.send();
            } catch (err) {
                document.getElementById("furniture_details_renderer").innerHTML = '<div>An error occured while fetching</div>';
            }

            function renderFurniture(furnitureData) {
                // Render furniture data on the webpage
                let furnitureContainer = document.getElementById("furniture_details_renderer");
                let html = '';

                for (var i = 0; i < furnitureData.length; i++) {
                    var furniture = furnitureData[i];
                    html += `<div>
                <header>${furniture.FURNITURE_NAME}</header>
            </div>
            <div id="product-image-container" class="product-container">
                <img src='./img/${furniture.IMAGE_URL}' />
            </div>
            <div id="product-info">
                <div class="product-info-header">
                    <div class="price">&#36;${furniture.PRICE}</div>
                    <div class="availability"><span id="availability">AVAILABILITY:</span>${furniture.STOCK > 0 ? '<span id="in-stock">IN STOCK</span>': '<span id="out-of-stock">OUT OF STOCK</span>' } </div>
                </div>
                <div id="product-desc">${furniture.DESCRIPTION}</div>
            </div>
            <div id="product-details">
                <div id="size-selector">
                    <span class="title"><b class="title">DIMENSION</b> : ${furniture.DIMENSIONS}</span>
                </div>
                <div id="size-selector">
                    <span class="title"><b class="title">WEIGHT</b> : ${furniture.WEIGHT}g</span>
                </div>
                <div id="product-color-container">
                    <span class="title"><b class="title">COLOR</b> : ${furniture.COLOR}</span>
                </div>
                <div id="product-color-container">
                    <span class="title"><b class="title">QUANTITY</b> : ${furniture.STOCK}</span>
                </div>
                <div id="product-color-container">
                    <span class="title"><b class="title">MANUFACTURER</b> : ${furniture.MANUFACTURER}</span>
                </div>
            </div>
                `
                }

                furnitureContainer.innerHTML = html;
            }
        });
    </script>

</body>

</html>