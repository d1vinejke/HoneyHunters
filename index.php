<?php
    include 'mysql.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container-fluid">
        <div class="container pt-5">
            <div class="logo d-flex justify-content-lg-start align-items-center px-7">
                <a href="/"><img src="images/logo.png" alt=""></a>
            </div>

            <div class="mail d-flex justify-content-center">
                <img src="images/icon.png" alt="">
            </div>

            <div class="form d-flex align-items-center">
                <form id="form" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col px-7">
                            <div class="inputs">
                                <label for="name" class="form-label position-relative">
                                    Имя
                                    <span class="star position-absolute top-50 start-75 translate-middle-y badge">
                                    *
                                </span>
                                </label>
                                <input type="text" id="name" name="nickname" class="form-control" required>
                            </div>
                            <div class="inputs pt-md-5">
                                <label for="po4ta" class="form-label position-relative">
                                    E-mail
                                    <span class="star position-absolute top-50 start-85 translate-middle-y badge">
                                    *
                                </span>
                                </label>
                                <input type="email" name="email" id="po4ta" class="form-control" required>
                            </div>
                        </div>
                        <div class="col px-7">
                            <div class="inputs">
                                <label for="textarea" class="form-label position-relative">
                                    Комментарий
                                    <span class="star position-absolute top-50 start-93 translate-middle-y badge">
                                        *
                                    </span>
                                </label>
                                <textarea name="text" class="form-control" id="textarea" required></textarea>
                            </div>
                            <div class="button float-end py-5">
                                <button class="btn btn-danger" type="submit" name="send_comment">Записать</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid notes">
        <div class="container">
            <div class="inner row px-2 px-md-2 px-sm-4 px-lg-3">
                <span class="zagolovok">Выводим комментарии</span>
                <?php
                $sql = "SELECT * FROM `comment`";
                if($result = $conn->query($sql)){
                    foreach ($result as $row){
                        echo    '<div class="count col-sm-6 col-md-5 col-xl pb-3">
                                         <div class="comments text-center">';
                        echo            '<div class="name">' . $row["name"] . '</div>';
                        echo            '<div class="info_block">';
                        echo                '<div class="email">' . $row["email"] . '</div>';
                        echo                '<div class="text">' . $row["text"] . '</div>';
                        echo            "</div>
                                         </div>
                                     </div>";
                    }
                    $result->free();
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <div class="footer container-fluid">
        <div class="container">
            <div class="d-flex justify-content-between">
                    <div class="logo">
                        <a href="/"><img src="images/logo.png" alt=""></a>
                    </div>
                    <div class="social">
                        <div class="vk d-inline-block">
                            <a href="#"><img src="images/vk.png" alt="" class="img-fluid"></a>
                        </div>
                        <div class="facebook d-inline-block">
                            <a href="#"><img src="images/facebook.png" alt="" class="img-fluid"></a>
                        </div>
                    </div>
            </div>
        </div>
    </div>


<script src="js/bootstrap.bundle.js"></script>
<script src="js/jquery-3.6.0.min.js"></script>
<script>
    formElem = document.getElementById("form");
    formElem.onsubmit = async (e) => {
        e.preventDefault();

        let response = await fetch('/functions.php', {
            method: 'POST',
            body: new FormData(formElem)
        });
        let result = await response.json();
        let row = document.querySelector(".inner");
        row.innerHTML += `
        <div class="count col-sm-6 col-md-5 col-xl pb-3">
            <div class="comments text-center">
                <div class="name">${result.name}</div>
                <div class="info_block">
                    <div class="email">${result.email}</div>
                    <div class="text">${result.text}</div>
                </div>
            </div>
        </div>`;
    };

    (function () {
        'use strict';

        let forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
</body>
</html>

