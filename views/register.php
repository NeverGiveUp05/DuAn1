<?php
if (isset($_SESSION['resultRegister']) && $_SESSION['resultRegister'] == 'success') {
?>
    <script>
        let timerInterval;

        Swal.fire({
            title: 'Success!',
            html: 'Đăng ký thành công! Về trang chủ sau: <b>3</b> giây.',
            icon: 'success',
            confirmButtonText: 'Xác nhận',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: () => {
                const b = Swal.getHtmlContainer().querySelector('b');
                let timeLeft = 3;
                timerInterval = setInterval(() => {
                    timeLeft -= 1;

                    b.textContent = timeLeft;
                }, 1000);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        }).then(() => {
            window.location.href = "<?php echo BASE_URL . '/?action=home' ?>";
        });
    </script>
<?php
    unset($_SESSION['resultRegister']);
};
?>

<?php
if (isset($_SESSION['resultRegister']) && $_SESSION['resultRegister'] == 'error') {
?>
    <script>
        Swal.fire({
            title: 'Error!',
            html: '<p style="font-weight: 500; font-size: 18px; margin-bottom: 0;">Có lỗi xảy ra, vui lòng thử lại sau!</p><p style="margin-top: 8px; font-size: 16px; margin-bottom: 0;"><i>Nếu vấn đề vẫn tiếp diễn, vui lòng liên hệ với chúng tôi để được hỗ trợ.</i></p>',
            icon: 'error',
            confirmButtonText: 'Xác nhận',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
        })
    </script>
<?php
    unset($_SESSION['resultRegister']);
} ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<main id="main">
    <section class="container">
        <h3 class="text-uppercase pt-4 text-center">Đăng ký</h3>

        <form class="row g-3 needs-validation mt-1" novalidate method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL . '/index.php/?action=userRegister' ?>">
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Email:<span style="color: red;">*</span></label>
                <input type="email" class="form-control p-2" id="validationCustom01" required name="email">
                <div id="emailError" class="invalid-feedback">
                    Vui lòng cung cấp địa chỉ email
                </div>
            </div>

            <div class="col-md-4">
                <label for="inputPassword" class="form-label">Mật khẩu:<span style="color: red;">*</span></label>
                <input autocomplete="off" type="password" class="form-control p-2" id="inputPassword" required name="password">
                <div class="invalid-feedback">
                    Vui lòng cung cấp mật khẩu
                </div>
            </div>

            <div class="col-md-4">
                <label for="inputRePassword" class="form-label">Xác nhận mật khẩu:<span style="color: red;">*</span></label>
                <input autocomplete="off" type="password" class="form-control p-2" id="inputRePassword" required>
                <div class="invalid-feedback" id="rePassword">
                    Vui lòng xác nhận mật khẩu
                </div>
                <div class="invalid-feedback d-none" id="rePasswordError">
                    Xác nhận mật khẩu không khớp
                </div>
            </div>

            <div class="col-md-4">
                <label for="validationCustom04" class="form-label">Họ tên:<span style="color: red;">*</span></label>
                <input type="text" class="form-control p-2" id="validationCustom04" required name="name">
                <div class="invalid-feedback">
                    Vui lòng cung cấp họ tên
                </div>
            </div>

            <div class="col-md-4">
                <label for="validationCustom05" class="form-label">Số điện thoại:<span style="color: red;">*</span></label>
                <input type="number" class="form-control p-2" id="validationCustom05" required name="phone">
                <div class="invalid-feedback">
                    Vui lòng cung cấp số điện thoại
                </div>
            </div>

            <div class="col-md-3">
                <label style="position: relative;" for="validationCustom06" class="form-label">Hình ảnh:
                    <img style="display: inline-block; border-radius: 50%; position: absolute; top: 10px; left: 428%; width: 100px; height: 100px" id="image-preview" class="d-none" width="100" alt="">
                </label>
                <input type="file" class="form-control" id="validationCustom06" name="image" onchange="previewImage(this.files[0])">
            </div>

            <div class="col-12 mt-4 mb-5 screen-end">
                <button name="submit" style="width: 224px;" class="btn btn--large register-btn" fdprocessedid="icvugw">Đăng ký</button>
            </div>

        </form>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    const emailInput = document.getElementById('validationCustom01');
    const emailError = document.getElementById('emailError');
    let checkEmail = false;

    // chua xoa duoc file truoc
    function previewImage(file) {
        const previewImage = document.getElementById('image-preview');
        previewImage.classList.remove('d-none');
        previewImage.src = URL.createObjectURL(file);
    }

    emailInput.addEventListener('input', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value)) {
            emailInput.classList.add('invalid');
            emailError.style.display = 'block';
            checkEmail = false;
        } else {
            emailInput.classList.remove('invalid');
            emailError.style.display = 'none';
            checkEmail = true;
        }
    });

    (() => {
        'use strict'

        const forms = document.querySelectorAll('.needs-validation')
        const inputPassword = document.getElementById('inputPassword')
        const inputRePassword = document.getElementById('inputRePassword')
        const rePassword = document.getElementById('rePassword')
        const rePasswordError = document.getElementById('rePasswordError')

        inputPassword.addEventListener('input', function() {
            if (inputPassword.value !== inputRePassword.value) {
                inputRePassword.classList.add('invalid');
                rePassword.classList.add('d-none');
                rePasswordError.classList.remove('d-none');
                rePasswordError.style.display = 'block';
            } else {
                inputRePassword.classList.remove('invalid');
                rePassword.classList.remove('d-none');
                rePasswordError.classList.add('d-none');
                rePasswordError.style.display = 'none';
            }
        })

        inputRePassword.addEventListener('input', function() {
            if (inputPassword.value !== inputRePassword.value) {
                inputRePassword.classList.add('invalid');
                rePassword.classList.add('d-none');
                rePasswordError.classList.remove('d-none');
                rePasswordError.style.display = 'block';
            } else {
                inputRePassword.classList.remove('invalid');
                rePassword.classList.remove('d-none');
                rePasswordError.classList.add('d-none');
                rePasswordError.style.display = 'none';
            }
        })

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                if (inputPassword.value !== inputRePassword.value) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                if (checkEmail == false) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })

    })()
</script>