<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $page_title ?? 'IVY moda'; ?></title>
    <link rel="shortcut icon" href=<?php echo BASE_URL . "/public/images/favicon.ico" ?> type="image/x-icon" />
    <script src="https://kit.fontawesome.com/18ea624bf8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php if (isset($cssPaths)) {
        foreach ($cssPaths as $cssPath) { ?>
            <link rel="stylesheet" href="<?php echo $cssPath; ?>">
    <?php }
    }
    ?>

    <?php require BASE_PATH . '/views/header.php' ?>

    <?php require $view; ?>

    <?php require_once BASE_PATH . '/views/footer.php'; ?>

    <?php if (isset($jsPaths)) {
        foreach ($jsPaths as $jsPath) { ?>
            <script src="<?php echo $jsPath ?>"></script>
    <?php }
    }
    ?>

    <script>
        const subMenu = document.getElementById('sub-menu');
        const listShowMore = document.querySelectorAll('.list-title');
        const form = document.getElementById('form_900px');
        const searchBtn = document.getElementById('action_search');
        const nameSearch = document.querySelectorAll('.item-name');
        const inputSearch = document.getElementById('input-search');
        const inputSearch_900 = document.getElementById('input-search_900px');
        const nameSearch_900 = document.querySelectorAll('.item-name_900px');

        const openMenu = () => {
            subMenu.classList.add("open");

            document.documentElement.classList.add('disabled-scroll');
        }

        const closeMenu = () => {
            event.stopPropagation();

            subMenu.classList.remove("open");

            document.documentElement.classList.remove('disabled-scroll');
        }

        listShowMore.forEach(list => {
            list.addEventListener('click', function() {
                list.lastElementChild.classList.toggle('rotate');
                list.lastElementChild.classList.toggle('return');

                list.parentNode.lastElementChild.style.display = 'block';
                list.parentNode.style.height = 'auto';

                let height = list.parentNode.offsetHeight;

                if (list.lastElementChild.classList.contains('rotate')) {
                    list.parentNode.style.height = '38px';

                    setTimeout(() => {
                        list.parentNode.style.height = height + 'px';
                    }, 0)
                } else {
                    list.parentNode.style.height = height + 'px';

                    setTimeout(() => {
                        list.parentNode.style.height = '38px';
                    }, 0)
                }
            })
        })

        searchBtn.addEventListener('click', function() {
            form.classList.toggle('open');

            document.documentElement.classList.toggle('disabled-scroll');
        })

        nameSearch.forEach((item) => {
            item.addEventListener('click', function() {
                inputSearch.value = item.textContent.trim();
            })
        })

        nameSearch_900.forEach((item) => {
            item.addEventListener('click', function() {
                inputSearch_900.value = item.textContent.trim();
            })
        })
    </script>
</body>

</html>