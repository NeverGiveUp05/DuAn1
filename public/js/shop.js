const shopping = document.getElementById("shopping");
const listNumberCart = document.getElementsByClassName("number-cart");
const main = document.getElementById("main-shop");
const total = document.getElementById("total");

const makeShop = () => {
    main.innerHTML = "";

    if (arrPro.length == 0) {
        main.innerText = "Bạn chưa có sản phẩm nào";
    }

    arrPro.forEach((item) => {
        main.innerHTML += `
        <div class="item-product">
        <div class="thumb"><img src=${item.img} alt="" /></div>
    
        <div class="container-flex">
            <div class="info-product">
                <h3 id="product-name">${item.name}</h3>
            </div>
            <div class="trash" onClick="removePro(this)"><i class="fa-solid fa-trash-can"></i></div>
            <div class="item-bottom">
                <div class="quantity" data-name="${item.name}">
                    <div class="quantity-left" onClick="reduce(this)"><i class="fa-solid fa-minus"></i></div>
                    <input type="number" value="${
                        item.quantity
                    }" id="quantity-number" onChange="typeValue(this, this.value)"/>
                    <div class="quantity-right" onClick="increase(this)"><i class="fa-solid fa-plus"></i></div>
                </div>
    
                <div class="item-price">${new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 3,
                    currencyDisplay: "symbol",
                }).format(item.price * item.quantity)}</div>
            </div>
        </div>
    </div>
    `;
    });
};

const makeTotal = () => {
    let result = 0;

    arrPro.forEach((item) => {
        result += item.price * item.quantity;
    });

    result = new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
        minimumFractionDigits: 0,
        maximumFractionDigits: 3,
        currencyDisplay: "symbol",
    }).format(result);

    total.innerText = result;
};

const makeCountPro = () => {
    let result = arrPro.reduce((count, item) => count + item.quantity, 0);
    listNumberCart[0].innerText = listNumberCart[1].innerText = result;
};

const makeDataShop = () => {
    makeShop();

    makeTotal();

    makeCountPro();
};

localStorage.getItem("shop")
    ? (function running() {
          arrPro = JSON.parse(localStorage.getItem("shop"));

          makeDataShop();
      })()
    : (arrPro = []);

if (arrPro.length == 0) {
    main.innerText = "Bạn chưa có sản phẩm nào";
}

const openShop = () => {
    shopping.classList.add("open");
};

const closeShop = () => {
    shopping.classList.remove("open");
};

const addPro = (item, value) => {
    const find = arrPro.findIndex((product) => {
        return item.name === product.name;
    });

    if (find === -1) {
        if (value) {
            item = { ...item, quantity: value };
        } else {
            item = { ...item, quantity: 1 };
        }

        arrPro.push(item);

        Swal.fire({
            title: "Success!",
            text: "Đã thêm vào giỏ hàng",
            icon: "success",
            confirmButtonText: "Xác nhận",
        });
    } else {
        if (arrPro[find].quantity == 99) {
            Swal.fire({
                title: "Error!",
                text: "Vượt quá số lượng",
                icon: "error",
                confirmButtonText: "Xác nhận",
            });
        } else {
            if (value) {
                let result = arrPro[find].quantity + value;

                if (result > 99) {
                    Swal.fire({
                        title: "Error!",
                        text: "Vượt quá số lượng",
                        icon: "error",
                        confirmButtonText: "Xác nhận",
                    });
                } else {
                    arrPro[find].quantity = result;

                    Swal.fire({
                        title: "Success!",
                        text: "Đã thêm vào giỏ hàng",
                        icon: "success",
                        confirmButtonText: "Xác nhận",
                    });
                }
            } else {
                arrPro[find].quantity += 1;

                Swal.fire({
                    title: "Success!",
                    text: "Đã thêm vào giỏ hàng",
                    icon: "success",
                    confirmButtonText: "Xác nhận",
                });
            }
        }
    }

    makeDataShop();

    localStorage.setItem("shop", JSON.stringify(arrPro));
};

const reduce = (item) => {
    let productName = item.parentElement.getAttribute("data-name");
    arrPro.forEach((obj, index) => {
        if (obj.name === productName) {
            if (arrPro[index].quantity != 1) {
                arrPro[index].quantity -= 1;
            }
        }
    });

    makeDataShop();

    localStorage.setItem("shop", JSON.stringify(arrPro));
};

const increase = (item) => {
    let productName = item.parentElement.getAttribute("data-name");
    arrPro.forEach((obj, index) => {
        if (obj.name === productName) {
            if (arrPro[index].quantity == 99) {
                Swal.fire({
                    title: "Error!",
                    text: "Vượt quá số lượng",
                    icon: "error",
                    confirmButtonText: "Xác nhận",
                });
            } else {
                arrPro[index].quantity += 1;
            }
        }
    });

    makeDataShop();

    localStorage.setItem("shop", JSON.stringify(arrPro));
};

const removePro = (item) => {
    let productName = item.parentElement.children[0].innerText;
    arrPro.forEach((obj, index) => {
        if (obj.name === productName) {
            arrPro.splice(index, 1);
        }
    });

    makeDataShop();

    localStorage.setItem("shop", JSON.stringify(arrPro));
};

const typeValue = (element, value) => {
    if (Number(value) > 0 && Number(value) < 100) {
        let productName = element.parentElement.getAttribute("data-name");
        arrPro.forEach((obj, index) => {
            if (obj.name === productName) {
                arrPro[index].quantity = Number(value);
            }
        });
    }

    if (Number(value) > 99) {
        let productName = element.parentElement.getAttribute("data-name");
        arrPro.forEach((obj, index) => {
            if (obj.name === productName) {
                element.value = arrPro[index].quantity;
            }
        });

        Swal.fire({
            title: "Error!",
            text: "Vượt quá số lượng",
            icon: "error",
            confirmButtonText: "Xác nhận",
        });
    }

    makeDataShop();

    localStorage.setItem("shop", JSON.stringify(arrPro));
};
