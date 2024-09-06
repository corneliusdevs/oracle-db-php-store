<!Doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IDEA HOME</title>
    <link rel="stylesheet" type="text/css" href="./index.css" />
</head>

<body>
    <main class="home-wrapper">
        <nav class='navbar'>
            <div class="menu-item"><a href="./index.php" style="color:red"><span>Home</span></a></div>
            <div class="menu-item"><span onclick="openLoginPrompt()" class="nav-menu-item">Admin</span></div>
            <div class="menu-item"><a href="./index.php#products"><span>Products</span></a></div>
        </nav>
        <section id="login_dialog" class="admin_login_container">
            <form id="login_prompt" class="login_prompt" onsubmit="handleLogin(event)">
                <div class="login-heading">
                    <span>ADMIN LOGIN</span>
                </div>
                <div class="input-container">
                    <input id="username" type="text" placeholder="username" required />
                </div>
                <div class="input-container">
                    <input id="password" type="password" placeholder="enter your password..." required />
                </div>
                <div class="submit-button-container">
                    <button class="submit-button" type="submit">Login</button>
                </div>
                <div class="close-login-prompt-icon" onclick='closeLoginPrompt()'><span>X</span></div>
            </form>
        </section>
        <section class="home-hero">
            <div class='hero-text-container'>
                <span class='hero-text'>IDEA FURNITURE</span>
            </div>
        </section>

        <div class="manufacturer-container">
            <header class="">Manufacturers</header>
            <div id="manufacturers-list">
            </div>
        </div>
        <div class="extra-info">
            <div class="filters-container">
                <div class="manufacturer-heading">FILTERS</div>
                <div class="filter-group">
                    <div class='filter'>
                        <select id="select-category-renderer" onchange="filterByCategory(event)">
                        </select>
                    </div>
                    <div>
                        <select id="color-renderer" onchange='filterByColor(event)'>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <div class="products-wrapper" id="products">
            <div>
                <header>Product List</header>
            </div>
            <div id="products_renderer">
                <div>Loading...</div>
            </div>

            <!-- INDIVIDUAL PROUCT HTML -->

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Create an XMLHttpRequest object
                    var xhr = new XMLHttpRequest();

                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var furnitureData = JSON.parse(xhr.responseText);

                            // store furnitureData in window object
                            window.furnitureData = furnitureData;
                            // Render furniture data using JavaScript
                            renderFurniture(furnitureData);
                        } else {
                            document.getElementById("products_renderer").innerHTML = "<div>An error occurred, Please try again later</div>";
                            console.log("Could not get furnitureData")
                        }
                    };

                    // Open a GET request to the PHP script that fetches furniture data
                    xhr.open("GET", "./db/getAllProducts.php", true);

                    xhr.setRequestHeader("Content-type", "application/json");

                    // Send the request
                    xhr.send();

                    function renderFurniture(furnitureData) {
                        let productHtml = ""
                        let manufacturers = [];
                        let manufacturersHTML = "";
                        let categories = [];
                        let categoriesHtml = "<option value=''>CATEGORIES</option>";
                        let sortbyFilters = [];
                        let sortbyFiltersHtml = `<option value=''>SORT BY</option>`

                        let colors = [];
                        let colorsHtml = `<option value=''>COLOR</option>`


                        for (let i = 0; i < furnitureData.length; i++) {
                            if (manufacturers.indexOf(furnitureData[i].MANUFACTURER) === -1) {
                                manufacturers.push(furnitureData[i].MANUFACTURER)
                                manufacturersHTML += `
                    <div class="manufacturer">
                        <div class="checkbox-container">
                            <input type="checkbox" value="${furnitureData[i].MANUFACTURER}" onchange='handleCheckboxChange(this)'/>
                        </div>
                        <div class="manufacturer-name">
                            <span>${furnitureData[i].MANUFACTURER}</span>
                        </div>
                    </div>
                    `
                            }

                            if (categories.indexOf(furnitureData[i].CATEGORY_NAME) === -1 && furnitureData[i].CATEGORY_NAME) {
                                categories.push(furnitureData[i].CATEGORY_NAME)
                                categoriesHtml += `
                            <option value='${furnitureData[i].CATEGORY_NAME}'>${furnitureData[i].CATEGORY_NAME}</option>
                    `
                            }

                            if (sortbyFilters.indexOf(furnitureData[i].MANUFACTURER) === -1) {
                                sortbyFilters.push(furnitureData[i].CATEGORY_NAME)
                                sortbyFiltersHtml += `
                            <option value='${furnitureData[i].CATEGORY_NAME}'>${furnitureData[i].CATEGORY_NAME}</option>
                    `
                            }

                            if (colors.indexOf(furnitureData[i].COLOR.toLowerCase()) === -1) {
                                colors.push(furnitureData[i].COLOR.toLowerCase())
                                colorsHtml += `
                            <option value='${furnitureData[i].COLOR}'>${furnitureData[i].COLOR}</option>
                    `
                            }

                            let ratings = "";
                            let noOfRatings = furnitureData[i].RATINGS
                            let noOfRatingsInserted = 0;

                            while (noOfRatings > 0 || noOfRatingsInserted < 5) {

                                if (noOfRatings > 0) {
                                    ratings += "&#9733;";
                                    noOfRatings--;
                                    noOfRatingsInserted++;
                                } else {
                                    ratings += "&#9734;";
                                    noOfRatingsInserted++;
                                }
                            }


                            productHtml += `<div class="product-wrapper"><div id="product-image-container" class="product-container"><img src="./img/${furnitureData[i].IMAGE_URL}" /></div><div id="product-info"><div class="product-info-header"><div class="product-name"><a href="./product-description.php?productId=${furnitureData[i].FURNITURE_ID}">${furnitureData[i].FURNITURE_NAME}</a></div><div class="availability">${furnitureData[i].STOCK > 0 ? '<span id="in-stock">IN STOCK</span>' : '<span id="out-of-stock">OUT OF STOCK</span>'}</div></div><div><span class="ratings">${ratings}</span></div><div class="footer"><div class="price">&#36;${furnitureData[i].PRICE}</div><div id="add-to-cart"><button  onclick="redirectToProductDescPage(${furnitureData[i].FURNITURE_ID})" class="button">DETAILS</button></div></div></div></div>`;
                        }

                        document.getElementById("products_renderer").innerHTML = productHtml;
                        document.getElementById("manufacturers-list").innerHTML = manufacturersHTML;
                        document.getElementById("select-category-renderer").innerHTML = categoriesHtml;
                        document.getElementById("color-renderer").innerHTML = colorsHtml
                    }

                });

                function redirectToProductDescPage(furnitureId) {
                    window.location.href = `./product-description.php?productId=${furnitureId}`;
                }

                function filterByCategory(event) {
                    let categoryName = event.target.value
                    let matchedFurnitureHtml = "";
                    console.log(furnitureData);
                    if (categoryName.length < 1) {
                        return
                    }
                    furnitureData.map((furniture) => {
                        if (furniture.CATEGORY_NAME === categoryName) {
                            let ratings = "";
                            let noOfRatings = furniture.RATINGS
                            let noOfRatingsInserted = 0;

                            while (noOfRatings > 0 || noOfRatingsInserted < 5) {

                                if (noOfRatings > 0) {
                                    ratings += "&#9733;";
                                    noOfRatings--;
                                    noOfRatingsInserted++;
                                } else {
                                    ratings += "&#9734;";
                                    noOfRatingsInserted++;
                                }
                            }
                            matchedFurnitureHtml += `<div class="product-wrapper"><div id="product-image-container" class="product-container"><img src="./img/${furniture.IMAGE_URL}" /></div><div id="product-info"><div class="product-info-header"><div class="product-name"><a href="./product-description.php?productId=${furnitureData.FURNITURE_ID}">${furniture.FURNITURE_NAME}</a></div><div class="availability">${furniture.STOCK > 0 ? '<span id="in-stock">IN STOCK</span>' : '<span id="out-of-stock">OUT OF STOCK</span>'}</div></div><div><span class="ratings">${ratings}</span></div><div class="footer"><div class="price">&#36;${furniture.PRICE}</div><div id="add-to-cart"><button  onclick="redirectToProductDescPage(${furniture.FURNITURE_ID})" class="button">DETAILS</button></div></div></div></div>`;
                        }
                    })

                    document.getElementById("products_renderer").innerHTML = matchedFurnitureHtml
                }

                function redirectToProductDescPage(furnitureId) {
                    window.location.href = `./product-description.php?productId=${furnitureId}`;
                }

                function filterByColor(event) {
                    let color = event.target.value
                    let matchedFurnitureHtml = "";

                    if (color.length < 1) {
                        return
                    }
                    furnitureData.map((furniture) => {
                        if (furniture.COLOR.toLowerCase() === color.toLowerCase()) {
                            let ratings = "";
                            let noOfRatings = furniture.RATINGS
                            let noOfRatingsInserted = 0;

                            while (noOfRatings > 0 || noOfRatingsInserted < 5) {

                                if (noOfRatings > 0) {
                                    ratings += "&#9733;";
                                    noOfRatings--;
                                    noOfRatingsInserted++;
                                } else {
                                    ratings += "&#9734;";
                                    noOfRatingsInserted++;
                                }
                            }
                            matchedFurnitureHtml += `<div class="product-wrapper"><div id="product-image-container" class="product-container"><img src="./img/${furniture.IMAGE_URL}" /></div><div id="product-info"><div class="product-info-header"><div class="product-name"><a href="./product-description.php?productId=${furnitureData.FURNITURE_ID}">${furniture.FURNITURE_NAME}</a></div><div class="availability">${furniture.STOCK > 0 ? '<span id="in-stock">IN STOCK</span>' : '<span id="out-of-stock">OUT OF STOCK</span>'}</div></div><div><span class="ratings">${ratings}</span></div><div class="footer"><div class="price">&#36;${furniture.PRICE}</div><div id="add-to-cart"><button  onclick="redirectToProductDescPage(${furniture.FURNITURE_ID})" class="button">DETAILS</button></div></div></div></div>`;
                        }
                    })

                    document.getElementById("products_renderer").innerHTML = matchedFurnitureHtml
                }


                function showFurniture(furnitureData) {
                    // Render furniture data on the webpage
                    let furnitureContainer = document.getElementById("products_renderer");
                    let html = '';

                    let ratings = "";
                    let noOfRatings = furnitureData.RATINGS
                    let noOfRatingsInserted = 0;

                    while (noOfRatings > 0 || noOfRatingsInserted < 5) {

                        if (noOfRatings > 0) {
                            ratings += "&#9733;";
                            noOfRatings--;
                            noOfRatingsInserted++;
                        } else {
                            ratings += "&#9734;";
                            noOfRatingsInserted++;
                        }
                    }

                    for (var i = 0; i < furnitureData.length; i++) {
                        var furniture = furnitureData[i];
                        html += `<div class="product-wrapper"><div id="product-image-container" class="product-container"><img src="./img/${furniture.IMAGE_URL}" /></div><div id="product-info"><div class="product-info-header"><div class="product-name"><a href="./product-description.php?productId=${furnitureData.FURNITURE_ID}">${furniture.FURNITURE_NAME}</a></div><div class="availability">${furniture.STOCK > 0 ? '<span id="in-stock">IN STOCK</span>' : '<span id="out-of-stock">OUT OF STOCK</span>'}</div></div><div><span class="ratings">${ratings}</span></div><div class="footer"><div class="price">&#36;${furniture.PRICE}</div><div id="add-to-cart"><button  onclick="redirectToProductDescPage(${furniture.FURNITURE_ID})" class="button">DETAILS</button></div></div></div></div>`;

                    }

                    furnitureContainer.innerHTML = html;
                }

                // Array to store products
                var products = [];
                // Function to handle checkbox changes when a manufacturer filter is selected
                function handleCheckboxChange(checkbox) {
                    var manufacturer = checkbox.value;

                    // If checkbox is checked
                    if (checkbox.checked) {
                        // Add products matching the manufacturer to the array
                        var matchingProducts = getProductsByManufacturer(manufacturer);
                        products = products.concat(matchingProducts);
                    } else {
                        // Remove products matching the manufacturer from the array
                        products = products.filter(function(product) {
                            return product.MANUFACTURER !== manufacturer;
                        });
                    }

                    // Print the updated array
                    console.log(products);

                    if (products.length === 0) {
                        showFurniture(furnitureData)
                    } else {
                        showFurniture(products)
                    }
                }

                // Function to get products by manufacturer
                function getProductsByManufacturer(manufacturer) {
                    return furnitureData.filter(function(furniture) {
                        return furniture.MANUFACTURER === manufacturer;
                    });
                }

                function openLoginPrompt() {
                    let loginDialog = document.getElementById("login_dialog");
                    loginDialog.style.display = "flex";
                    document.getElementById("login_prompt").innerHTML = `
                    <div class="login-heading">
                    <span>ADMIN LOGIN</span>
                </div>
                <div class="input-container">
                    <input id="username" type="text" placeholder="username" required/>
                </div>
                <div class="input-container">
                    <input id="password" type="password" placeholder="enter your password..." required/>
                </div>
                <div class="submit-button-container">
                    <button class="submit-button" type="submit">Login</button>
                </div>
                <div class="close-login-prompt-icon" onclick='closeLoginPrompt()'><span>X</span></div>
            `

                }

                function closeLoginPrompt() {
                    document.getElementById("login_dialog").style.display = "none"
                }

                function handleLogin(event) {
                    event.preventDefault()


                    let username = document.getElementById("username").value;
                    let password = document.getElementById("password").value;

                    let loginRequestBody = new URLSearchParams();

                    loginRequestBody.append('username', username);
                    loginRequestBody.append('password', password);

                    openLoginPrompt()
                    let loginPrompt = document.getElementById("login_prompt");
                    loginPrompt.innerHTML = `
                    <div class="login-heading">
                    <span>Logging you in...</span>
                </div>
                <div class="close-login-prompt-icon" onclick='closeLoginPrompt()'><span>X</span></div>
                    `

                    // Send the POST request using fetch
                    fetch('./login.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: loginRequestBody
                        })
                        .then(response => {
                            if (response.ok) {
                                // Login successful
                                return response.json();
                            } else {
                                // Login failed
                                throw new Error('Login failed');
                            }
                        })
                        .then(data => {
                            if (data.success === true) {

                                // store login info in local storage
                                localStorage.setItem("isLoggedIn", "true")
                                localStorage.setItem("username", username)

                                // navigate to admin.php
                                window.location.href = `admin.php`;
                                
                            } else {
                                window.isLoggedIn = false;
                                loginPrompt.innerHTML = `
                                <div class="login-heading">
                        <span style="color:red;font-weight:500;">INVALID CREDENTIALS</span>
                    </div>
                    <div class="input-container">
                        <input id="username" type="text" placeholder="username" required />
                    </div>
                    
                    <div class="input-container">
                        <input id="password" type="password" placeholder="enter your password..." required />
                    </div>
                    <div class="submit-button-container">
                        <button class="submit-button" type="submit">Login</button>
                    </div>
                    <div class="close-login-prompt-icon" onclick='closeLoginPrompt()'><span>X</span></div>
                                `

                            }

                        })
                        .catch(error => {
                            console.log('An error occurred during login:', error);

                            loginPrompt.innerHTML = `
                    <div class="login-heading">
                    <span>Something went wrong.</span>
                </div>
                <div class="close-login-prompt-icon" onclick='closeLoginPrompt()'><span>X</span></div>
                    `

                        });
                }
            </script>
        </div>
        </div>
    </main>
</body>

</html>