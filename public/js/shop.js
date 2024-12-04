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
        if (item.phan_tram_giam > 0) {
            cost = item.gia_ban * item.so_luong * (1 - item.phan_tram_giam / 100);
        } else {
            cost = item.gia_ban * item.so_luong;
        }

        main.innerHTML += `
        <div class="item-product">
        <div class="thumb"><img src=${item.hinh_anh} alt="" /></div>
    
        <div class="container-flex">
            <div class="info-product">
                <h3 id="product-name">${item.ten_san_pham}</h3>
            </div>
            <div class="trash" onClick="removePro(${item.id})"><i class="fa-solid fa-trash-can"></i></div>
            <div class="item-bottom">
                <div class="quantity" data-id="${item.id}">
                    <div class="quantity-left" onClick="reduce(this)"><i class="fa-solid fa-minus"></i></div>
                    <input type="number" value="${
                        item.so_luong
                    }" id="quantity-number" onChange="typeValue(this, this.value)"/>
                    <div class="quantity-right" onClick="increase(this)"><i class="fa-solid fa-plus"></i></div>
                </div>
    
                <div class="item-price">${new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 3,
                    currencyDisplay: "symbol",
                }).format(cost)}</div>
            </div>
        </div>
    </div>
    `;
    });
};

const makeTotal = () => {
    let result = 0;

    arrPro.forEach((item) => {
        if (item.phan_tram_giam > 0) {
            result += item.gia_ban * item.so_luong * (1 - item.phan_tram_giam / 100);
        } else {
            result += item.gia_ban * item.so_luong;
        }
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
    let result = arrPro.reduce((count, item) => count + item.so_luong, 0);
    listNumberCart[0].innerText = listNumberCart[1].innerText = result;
};

const makeDataShop = (arrPro) => {
    makeShop();

    makeTotal();

    makeCountPro();

    if (arrPro && arrPro.length > 0) {
        uploadCartToServer(arrPro);
    }
};

localStorage.getItem("cart")
    ? (function running() {
          arrPro = JSON.parse(localStorage.getItem("cart"));

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
        return item.id == product.id;
    });

    if (find == -1) {
        if (value) {
            item = { ...item, so_luong: value };
        } else {
            item = { ...item, so_luong: 1 };
        }

        arrPro.push(item);

        Swal.fire({
            title: "Success!",
            text: "Đã thêm vào giỏ hàng",
            icon: "success",
            confirmButtonText: "Xác nhận",
        });
    } else {
        if (arrPro[find].so_luong == 99) {
            Swal.fire({
                title: "Error!",
                text: "Vượt quá số lượng",
                icon: "error",
                confirmButtonText: "Xác nhận",
            });
        } else {
            if (value) {
                let result = arrPro[find].so_luong + value;

                if (result > 99) {
                    Swal.fire({
                        title: "Error!",
                        text: "Vượt quá số lượng",
                        icon: "error",
                        confirmButtonText: "Xác nhận",
                    });
                } else {
                    arrPro[find].so_luong = result;

                    Swal.fire({
                        title: "Success!",
                        text: "Đã thêm vào giỏ hàng",
                        icon: "success",
                        confirmButtonText: "Xác nhận",
                    });
                }
            } else {
                arrPro[find].so_luong += 1;

                Swal.fire({
                    title: "Success!",
                    text: "Đã thêm vào giỏ hàng",
                    icon: "success",
                    confirmButtonText: "Xác nhận",
                });
            }
        }
    }

    makeDataShop(arrPro);

    localStorage.setItem("cart", JSON.stringify(arrPro));
};

const reduce = (item) => {
    let productId = item.parentElement.getAttribute("data-id");
    arrPro.forEach((obj, index) => {
        if (obj.id == productId) {
            if (arrPro[index].so_luong != 1) {
                arrPro[index].so_luong -= 1;
            }
        }
    });

    makeDataShop(arrPro);

    localStorage.setItem("cart", JSON.stringify(arrPro));
};

const increase = (item) => {
    let productId = item.parentElement.getAttribute("data-id");
    arrPro.forEach((obj, index) => {
        if (obj.id == productId) {
            console.log(obj.id);
            if (arrPro[index].so_luong == 99) {
                Swal.fire({
                    title: "Error!",
                    text: "Vượt quá số lượng",
                    icon: "error",
                    confirmButtonText: "Xác nhận",
                });
            } else {
                arrPro[index].so_luong += 1;
            }
        }
    });

    makeDataShop(arrPro);

    localStorage.setItem("cart", JSON.stringify(arrPro));
};

const removePro = (id) => {
    let productId = id;
    arrPro.forEach((obj, index) => {
        if (obj.id == productId) {
            arrPro.splice(index, 1);
        }
    });

    makeDataShop(arrPro);

    localStorage.setItem("cart", JSON.stringify(arrPro));
};

const typeValue = (element, value) => {
    if (Number(value) > 0 && Number(value) < 100) {
        let productId = element.parentElement.getAttribute("data-id");
        arrPro.forEach((obj, index) => {
            if (obj.id == productId) {
                arrPro[index].so_luong = Number(value);
            }
        });
    }

    if (Number(value) > 99) {
        let productId = element.parentElement.getAttribute("data-id");
        arrPro.forEach((obj, index) => {
            if (obj.id == productId) {
                element.value = arrPro[index].so_luong;
            }
        });

        Swal.fire({
            title: "Error!",
            text: "Vượt quá số lượng",
            icon: "error",
            confirmButtonText: "Xác nhận",
        });
    }

    makeDataShop(arrPro);

    localStorage.setItem("cart", JSON.stringify(arrPro));
};

const uploadCartToServer = async (cartData) => {
    console.log(JSON.stringify(cartData));
    try {
        const response = await fetch("http://localhost/DuAn/views/updatecart.php", {
            method: "POST", // Gửi yêu cầu POST
            headers: {
                "Content-Type": "application/json", // Định nghĩa kiểu dữ liệu gửi là JSON
            },
            body: JSON.stringify(cartData), // Chuyển đổi dữ liệu giỏ hàng thành chuỗi JSON
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const responseData = await response.json(); // Chuyển đổi phản hồi từ server thành JSON
        console.log("Giỏ hàng đã được cập nhật", responseData);

        // Nếu cần, cập nhật giao diện giỏ hàng ở đây
    } catch (error) {
        console.error("Đã xảy ra lỗi khi cập nhật giỏ hàng:", error);
    }
};
