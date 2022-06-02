window.onload = () => {
    products = JSON.parse(products);
    customers = JSON.parse(customers);


    const barcodeInput = document.querySelector(".search-barcode");
    const cartContainer = document.querySelector(".cart-container");
    const cart = document.querySelector(".cart");
    const productContainer = document.querySelector(".product-container");
    const searchProductInput = document.querySelector(".search-product");
    const proceedBtn = document.querySelector(".proceed-btn");
    const paymentInput = document.querySelector(".payment-input");
    const clearCartBtn = document.querySelector(".clear-cart");
    const customerList = document.querySelector(".customer-list");
    const sendBtn = document.querySelector(".btn-send");
    const alertMsg = document.querySelector(".success");
    const alertDanger = document.querySelector(".danger");
    const itemAlertMsg = document.querySelector(".alert-outofstock");

    console.log(products);
    // return;

    const enableButton = () =>
        proceedBtn.style.removeProperty("pointer-events");
    const disableButton = () =>
        (proceedBtn.style.cssText = "pointer-events:none");

    const searchBarcode = function (e) {
        if (e.key === "Enter") {
            e.preventDefault();

            const item = products.find(
                (cur) => cur.barcode === barcodeInput.value
            );

            if (!item) {
                showAlertMessage("Invalid Barcode");
            }

            if (item) {
                inputCartItem(item);

                calculateTotalPrice();

                setLocalStorage();
            }

            barcodeInput.value = "";
        }
    };

    const showAlertMessage = function (msg) {
        itemAlertMsg.style.display = "block";
        itemAlertMsg.innerHTML = msg;

        setTimeout(() => (itemAlertMsg.style.display = "none"), 1500);
    };

    const saveCustomer = function () {
        activeCustomer = customerList.value;
        localStorage.setItem("active_customer", activeCustomer);
    };

    const getIds = function () {
        const inCartItemIds = new Array();
        Array.from(cart.children, (tr) => inCartItemIds.push(+tr.dataset.id));

        return inCartItemIds;
    };

    const inputCartItem = function (item) {
        if (!item) return;

        if (item.stock === 0) {
            showAlertMessage("Item: out of stock!");
            return;
        }

        enableButton();

        if (getIds().includes(item.id)) {
            updateCartItem(item);
            return;
        }

        const html = `
        <tr name="product_id[]" data-id=${item.id}>
          <input type="hidden" name="product_id[]" value="${item.id}">
          <td><input type="text" name="item_name[]" class="form-control item-name" value="${item.name}" readonly></td>
          <td><input type="number" min="1" max="${item.stock}" name="quantity[]" class="form-control item-count" value="1" onkeydown="return false" ></td>
          <td><input type="text" name="item_price[]" class="form-control item-price" value="${item.price}" readonly></td>
          <td><button class="btn btn-sm btn-danger delete-cart-item"><i class="fas fa-trash"></i></button></td>
        </td>
      `;

        cart.insertAdjacentHTML("beforeend", html);
    };

    const inputSearchItem = function (e) {
        e.preventDefault();

        const element = e.target.closest(".search-item");

        if (!element) return;

        const item = products.find((item) => item.id === +element.dataset.id);

        inputCartItem(item);

        calculateTotalPrice();

        setLocalStorage();
    };

    let rowElement;
    const updateCartItem = function (item) {
        Array.from(cart.children, (tr) => {
            if (+tr.dataset.id === item.id) {
                rowElement = tr;
                const element = tr.querySelector(".item-count");

                const currentCount = +element.value;

                if (currentCount >= item.stock) return;

                element.value = currentCount + 1;
            }
        });

        calculateCountPrice(rowElement);
        rowElement = "";
    };

    const calculateTotalPrice = function () {
        const prices = new Array();

        const arr = document.getElementsByClassName("item-price");
        for (let i = 0; i < arr.length; i++) {
            prices.push(+arr[i].value);
        }

        const total_price = prices.reduce((acc, cur) => acc + cur, 0);
        document.querySelector(".total-price").innerHTML = total_price;
    };

    const calculateCountPrice = function (e) {
        let count, item;

        if (rowElement) {
            count = rowElement.querySelector(".item-count").value;
            const id = +rowElement.dataset.id;
            item = products.find((item) => item.id === id);

            rowElement.querySelector(".item-price").value = count * item.price;
            return;
        }

        count = +e.target.value;
        const parent = e.target.parentElement.parentElement;
        item = products.find((cur) => cur.id === +parent.dataset.id);

        parent.querySelector(".item-price").value = count * item.price;

        calculateTotalPrice();
        setLocalStorage();
    };

    const delete_cart_item = function (e) {
        e.preventDefault();

        // fix some unknown bug when type enter in received amount input field
        if (e.pointerId === -1) return;

        if (!e.target.closest("button")) return;

        const parentTr = e.target.closest("button").parentNode?.parentNode;
        parentTr.parentElement?.removeChild(parentTr);

        calculateTotalPrice();

        setLocalStorage();

        if (getIds().length === 0) disableButton();
    };

    function similarItems(a, b) {
        let equivalency = 0;
        const minLength = a.length > b.length ? b.length : a.length;
        const maxLength = a.length < b.length ? b.length : a.length;
        for (let i = 0; i < minLength; i++) {
            if (a[i] == b[i]) {
                equivalency++;
            }
        }

        const weight = equivalency / maxLength;
        return weight * 100;
    }

    const getProductList = function (item) {
        const html = `
        <div class="col-md-2 col-lg-2 col-sm-6 justify-content-center search-item" data-id="${item.id}">
          <div class="card">
              <div class="card-body">
                  <img src="/dist/img/product.png" class="card-img-top"  alt="">
                  <p style="text-align: center; margin-top:3px"><small> ${item.name} </small></p>                                                
              </div>
          </div>
        </div>
        `;

        productContainer.insertAdjacentHTML("beforeend", html);
    };

    const removeChildItems = function () {
        let lastChild = productContainer.lastElementChild;

        while (lastChild) {
            productContainer.removeChild(lastChild);
            lastChild = productContainer.lastElementChild;
        }
    };

    const searchProduct = function (e) {
        if (e.key === "Enter") {
            e.preventDefault();

            if (searchProductInput.value === "") {
                removeChildItems();

                products.forEach((item) => getProductList(item));
                return;
            }

            removeChildItems();
            const keyword = searchProductInput.value.toLowerCase();
            const item = products.find(
                (item) => item.name.toLowerCase() === keyword
            );

            if (!item) {
                products.forEach((item) => {
                    const similarValue = similarItems(
                        item.name.toLowerCase(),
                        keyword
                    );

                    if (!similarValue) return;

                    getProductList(item);
                });
                return;
            }
            getProductList(item);
        }
    };

    const proceedCheckout = function () {
        const total_price = document.querySelector(".total-price").innerHTML;
        paymentInput.value = total_price;

        paymentInput.min = 0;
        paymentInput.max = total_price;

        const targetCustomer = customers.find((c) => c.id === +activeCustomer);
        if (+targetCustomer.is_customer === 0) paymentInput.readOnly = true;
        if (+targetCustomer.is_customer !== 0) paymentInput.readOnly = false;
    };

    const setLocalStorage = function () {
        const cartItems = new Array();
        const total_price = document.querySelector(".total-price").innerHTML;

        Array.from(cart.children, (tr) => {
            const id = +tr.dataset.id;
            const name = tr.querySelector(".item-name").value;
            const count = +tr.querySelector(".item-count").value;
            const price = +tr.querySelector(".item-price").value;

            cartItems.push({ id, name, count, price });
        });

        localStorage.setItem("cart_items", JSON.stringify(cartItems));
        localStorage.setItem("total_price", total_price);
        localStorage.setItem("active_customer", activeCustomer);
    };

    const renderLocalStorage = function () {
        const customer_id = localStorage.active_customer;
        const cart_items = JSON.parse(localStorage.getItem("cart_items"));
        const total_price = localStorage.total_price;

        if (customer_id) {
            customerList.value = customer_id;
            activeCustomer = customer_id;
        }

        if (!cart_items) return;

        cart_items.forEach((item, i) => {
            const related_item = products.find(
                (cur) => cur.id === +cart_items[i].id
            );

            const html = `
            <tr name="product_id" data-id=${cart_items[i].id}>
              <input type="hidden" name="product_id[]" value="${cart_items[i].id}">
              <td><input type="text" name="item_name[]" class="form-control item-name" value="${cart_items[i].name}" readonly></td>
              <td><input type="number" min="1" max="${related_item.stock}" name="quantity[]" class="form-control item-count" value="${cart_items[i].count}" onkeydown="return false"></td>
              <td><input type="text" name="item_price[]" class="form-control item-price" value="${cart_items[i].price}" readonly></td>
              <td><button class="btn btn-sm btn-danger delete-cart-item"><i class="fas fa-trash"></i></button></td>
            </tr>
          `;

            cart.insertAdjacentHTML("beforeend", html);
        });

        document.querySelector(".total-price").innerHTML = total_price;

        enableButton();

        barcodeInput.focus();
    };

    const walkinCustomer = customerList.value;
    let activeCustomer = customerList.value;

    const clearCart = function () {
        cart.innerHTML = "";
        document.querySelector(".total-price").innerHTML = 0;

        customerList.value = walkinCustomer;
        activeCustomer = walkinCustomer;

        paymentInput.readOnly = false;

        disableButton();
        localStorage.clear();
        barcodeInput.focus();
    };

    const clearCheckout = function (e) {
        if (e) e.preventDefault();

        // remove all child
        clearCart();
    };

    if (alertMsg) {
        clearCart();

        setTimeout(() => {
            alertMsg.style.display = "none";
        }, 1000);
    }

    if (alertDanger) {
        setTimeout(() => {
            alertDanger.style.display = "none";
        }, 1000);
    }

    barcodeInput.addEventListener("keydown", searchBarcode);
    cartContainer.addEventListener("change", calculateCountPrice);
    cartContainer.addEventListener("click", delete_cart_item);
    searchProductInput.addEventListener("keydown", searchProduct);
    productContainer.addEventListener("click", inputSearchItem);
    proceedBtn.addEventListener("click", proceedCheckout);
    clearCartBtn.addEventListener("click", clearCheckout);
    customerList.addEventListener("change", saveCustomer);
    sendBtn.addEventListener("submit", clearCheckout);

    renderLocalStorage();
    barcodeInput.focus();
};
