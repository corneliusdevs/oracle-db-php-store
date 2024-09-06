<!Doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ADMIN DASHBAORD</title>
    <link rel="stylesheet" type="text/css" href="./admin.css" />
    <script>
        let username = localStorage.getItem("username")
        let isLoggedIn = localStorage.getItem("isLoggedIn");

        if((!username) | (isLoggedIn !== "true")){
           window.location.href = "index.php"
        }
    </script>
</head>

<body>
    <main>
        <nav class='navbar'>
            <div class="menu-item"><a href="./index.php"><span>Home</span></a></div>
            <div class="menu-item"><span class="nav-menu-item" style="color:red;">Admin</span></div>
            <div class="menu-item"><a href="./index.php#products"><span>Products</span></a></div>
        </nav>
    </main>
    <div class="categories-container">
        <header>Purchases</header>
        <div class="category-container">
            <div class="category">
                <div class="category-text"><span>See all purchases</span></div>
                <div class="add-icon" data-dropdown="dropdown1" data-button="add1" onclick="expand( this.getAttribute('data-dropdown'), this.getAttribute('data-button'), renderAllPurchasesInfo)"><span id="add1" class="add">&#43;</span></div>
            </div>
            <div id="dropdown1" class="dropdown">

            </div>
        </div>

    </div>
    <div class="categories-container">
        <header>Customers</header>
        <div class="category-container">
            <div class="category">
                <div class="category-text"><span>See all customers</span></div>
                <div class="add-icon" data-dropdown="dropdown2" data-button="add2" onclick="expand( this.getAttribute('data-dropdown'), this.getAttribute('data-button'), renderAllCustomersInfo)"><span id="add2" class="add">&#43;</span></div>
            </div>
            <div id="dropdown2" class="dropdown">
            </div>
        </div>

    </div>
    <div class="categories-container">
        <header>Suppliers</header>
        <div class="category-container">
            <div class="category">
                <div class="category-text"><span>See all suppliers</span></div>
                <div class="add-icon" data-dropdown="dropdown3" data-button="add3" onclick="expand( this.getAttribute('data-dropdown'), this.getAttribute('data-button'),renderAllSuppliersInfo)"><span id="add3" class="add">&#43;</span></div>
            </div>
            <div id="dropdown3" class="dropdown">
            </div>
        </div>

    </div>
    <div class="categories-container">
        <header>Furniture</header>
        <div class="category-container">
            <div class="category">
                <div class="category-text"><span>See all furniture</span></div>
                <div class="add-icon" data-dropdown="dropdown5" data-button="add5" onclick="expand( this.getAttribute('data-dropdown'), this.getAttribute('data-button'),renderAllFurnitureInfo)"><span id="add5" class="add">&#43;</span></div>
            </div>
            <div id="dropdown5" class="dropdown">
            </div>
        </div>

    </div>
    <div class="categories-container">
        <header>Stores</header>
        <div class="category-container">
            <div class="category">
                <div class="category-text"><span>See all stores</span></div>
                <div class="add-icon" data-dropdown="dropdown4" data-button="add4" onclick="expand( this.getAttribute('data-dropdown'), this.getAttribute('data-button'),renderAllStoresInfo)"><span id="add4" class="add">&#43;</span></div>
            </div>
            <div id="dropdown4" class="dropdown">
            </div>
        </div>
    </div>
    <script>
        let databaseTables = ['PURCHASES', 'Customers', 'SUPPLIERS', 'CATEGORIES', 'Employees', 'STORES']
    </script>
    <script>
        const expand = (dropdownID, buttonID, renderFunction) => {
            let currentButton = document.getElementById(buttonID);
            let currentDropdown = document.getElementById(dropdownID);
            if (currentButton.innerHTML === "+") {
                currentDropdown.style.display = "block";
                currentButton.innerHTML = "&#8722";

                // call the render function with the currentDropdown element
                renderFunction(currentDropdown)
            } else {
                currentDropdown.style.display = "none";
                currentButton.innerHTML = "&#43;";
            }
        }

        function renderAllStoresInfo(domElement) {
            //set loading state
            domElement.innerHTML = "<div>Loading...</div>";
            // Create an XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            xhr.onload = function() {
                if (xhr.status === 200) {
                    let allStoresInfo = JSON.parse(xhr.responseText);

                    // store furnitureData in window object
                    window.allStoresInfo = allStoresInfo;
                    // get htmlText to render
                    const htmlTextToRender = generateHtmlText(allStoresInfo);
                    domElement.innerHTML = htmlTextToRender
                } else {
                    domElement.innerHTML = "<div>An error occurred, Please try again later</div>";
                    console.log("Could not get allFurniture Data")
                }
            };

            // Open a GET request to the PHP script that fetches purchases data
            xhr.open("GET", "./db/getAllStores.php", true);

            xhr.setRequestHeader("Content-type", "application/json");

            if (typeof window.allStoresInfo === "undefined" | typeof window.allStoresInfo === null) {
                // Send the request
                xhr.send()
            } else {
                const htmlTextToRender = generateHtmlText(window.allStoresInfo);
                domElement.innerHTML = htmlTextToRender
            };

        }

        function renderAllSuppliersInfo(domElement) {
            //set loading state
            domElement.innerHTML = "<div>Loading...</div>";
            // Create an XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            xhr.onload = function() {
                if (xhr.status === 200) {
                    let allSuppliersInfo = JSON.parse(xhr.responseText);

                    // store furnitureData in window object
                    window.allSuppliersInfo = allSuppliersInfo;
                    // get htmlText to render
                    const htmlTextToRender = generateHtmlText(allSuppliersInfo);
                    domElement.innerHTML = htmlTextToRender
                } else {
                    domElement.innerHTML = "<div>An error occurred, Please try again later</div>";
                    console.log("Could not get allFurniture Data")
                }
            };

            // Open a GET request to the PHP script that fetches purchases data
            xhr.open("GET", "./db/getAllSuppliers.php", true);

            xhr.setRequestHeader("Content-type", "application/json");

            if (typeof window.allSuppliersInfo === "undefined" | typeof window.allSuppliersInfo === null) {
                // Send the request
                xhr.send()
            } else {
                const htmlTextToRender = generateHtmlText(window.allSuppliersInfo);
                domElement.innerHTML = htmlTextToRender
            };

        }

        function renderAllCustomersInfo(domElement) {
            //set loading state
            domElement.innerHTML = "<div>Loading...</div>";
            // Create an XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            xhr.onload = function() {
                if (xhr.status === 200) {
                    let allCustomersData = JSON.parse(xhr.responseText);

                    // store furnitureData in window object
                    window.allCustomersData = allCustomersData;
                    // get htmlText to render
                    const htmlTextToRender = generateHtmlText(allCustomersData);
                    domElement.innerHTML = htmlTextToRender
                } else {
                    domElement.innerHTML = "<div>An error occurred, Please try again later</div>";
                    console.log("Could not get allFurniture Data")
                }
            };

            // Open a GET request to the PHP script that fetches purchases data
            xhr.open("GET", "./db/getAllCustomers.php", true);

            xhr.setRequestHeader("Content-type", "application/json");

            if (typeof window.allCustomersData === "undefined" | typeof window.allCustomersData === null) {
                // Send the request
                xhr.send()
            } else {
                const htmlTextToRender = generateHtmlText(window.allCustomersData);
                domElement.innerHTML = htmlTextToRender
            };

        }

        function renderAllPurchasesInfo(domElement) {
            //set loading state
            domElement.innerHTML = "<div>Loading...</div>";
            // Create an XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            xhr.onload = function() {
                if (xhr.status === 200) {
                    let allPurchasesData = JSON.parse(xhr.responseText);

                    // store furnitureData in window object
                    window.allPurchasesData = allPurchasesData;
                    // get htmlText to render
                    const htmlTextToRender = generateHtmlText(allPurchasesData);
                    domElement.innerHTML = htmlTextToRender
                } else {
                    domElement.innerHTML = "<div>An error occurred, Please try again later</div>";
                    console.log("Could not get allFurniture Data")
                }
            };

            // Open a GET request to the PHP script that fetches purchases data
            xhr.open("GET", "./db/getAllPurchases.php", true);

            xhr.setRequestHeader("Content-type", "application/json");

            if (typeof window.allPurchasesData === "undefined" | typeof window.allPurchasesData === null) {
                // Send the request
                xhr.send()
            } else {
                const htmlTextToRender = generateHtmlText(window.allPurchasesData);
                domElement.innerHTML = htmlTextToRender
            };

        }

        function renderAllFurnitureInfo(domElement) {
            //set loading state
            domElement.innerHTML = "<div>Loading...</div>";
            // Create an XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            xhr.onload = function() {
                if (xhr.status === 200) {
                    let allFurnitureData = JSON.parse(xhr.responseText);

                    // store furnitureData in window object
                    window.allFurnitureData = allFurnitureData;
                    // get htmlText to render
                    const htmlTextToRender = generateHtmlText(allFurnitureData);
                    domElement.innerHTML = htmlTextToRender
                } else {
                    domElement.innerHTML = "<div>An error occurred, Please try again later</div>";
                    console.log("Could not get allFurniture Data")
                }
            };

            // Open a GET request to the PHP script that fetches furniture data
            xhr.open("GET", "./db/getAllProducts.php", true);

            xhr.setRequestHeader("Content-type", "application/json");

            if (typeof window.allFurnitureData === "undefined" | typeof window.allFurnitureData === null) {
                // Send the request
                xhr.send()
            } else {
                const htmlTextToRender = generateHtmlText(window.allFurnitureData);
                domElement.innerHTML = htmlTextToRender
            };

        }


        function generateHtmlText(data) {
            let html = "";
            let tableHtmlStartString = "<table><tr>"
            let tableHtmlMiddleStringStart = ""
            let tableHtmlMiddleStringMiddle = "</tr>"
            let tableHtmlMiddleStringEnd = ""
            let tableHtmlEndString = "</tr></table>"

            let objKeys = [];

            for (let i = 0; i < data.length; i++) {

                let obj = data[i];

                let tableHtmlRow = '<tr>'
                let tablehtmlRowMiddleStr = ""
                let tableHtmlRowEnd = "</tr>"
                for (let key in obj) {
                    if (obj.hasOwnProperty(key)) {
                        let value = obj[key];
                        if (objKeys.indexOf(key) === -1) {
                            objKeys.push(key)
                            tableHtmlMiddleStringStart += `<th>${key}</th>`;
                        }
                        tablehtmlRowMiddleStr += `<td>${value}</td>`;
                    }
                }
                tableHtmlMiddleStringEnd += (tableHtmlRow + tablehtmlRowMiddleStr + tableHtmlRowEnd)

            }

            html = tableHtmlStartString + tableHtmlMiddleStringStart + tableHtmlMiddleStringMiddle + tableHtmlMiddleStringEnd + tableHtmlEndString

            // return generated html
            return html
        }
    </script>
    <script>
        function logoutUser (){
            localStorage.removeItem("username");
            localStorage.removeItem("isLoggedIn");
            localStorage.setItem("isLoggedIn", "false");
        }

         // logout user when navigating out of the page 
        window.addEventListener("beforeunload", logoutUser)
    </script>

</body>

</html>