<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4783db6fc6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Styles/style.css">
    <title>ProductDetail-Karablanca</title>
</head>

<body>
    <header>
        <?php include '../HeaderandFooter/header.php' ?>
    </header>


    <body>
        <?php
        require_once '../Module/db_module.php';
        $link = NULL;
        taoketnoi($link); ?>
        <?php
        if (isset($_GET['title'])) {
            $searchmasp = mysqli_real_escape_string($link, $_GET['title']);

            $sql_searchmasp = "SELECT * FROM sanpham WHERE masp='$searchmasp'";

            $lenh_searchmasp = mysqli_query($link, $sql_searchmasp);
        } ?>
        <product-detail class="product">
            <?php foreach ($lenh_searchmasp as $detailitem) { ?>
                <div class="product-container">
                    <ul class="breadcrumb">
                        <li><a href="./Index.php">Trang chủ</a></li>
                        <li><a href="./Product.php">Sản phẩm</a></li>
                        <li> <?php echo $detailitem['tensp'] ?> <?php echo $detailitem['khoiluong'] ?>G</li>
                    </ul>
                    <div class="grid__row product-content">
                        <div class="grid__row product-content-left">
                            <div class="product-content-left-img">
                                <img src="<?php echo $detailitem['anhsp'] ?>" alt="">
                            </div>
                        </div>
                        <div class="product-content-right">
                            <div class="product-content-right-product-name">
                                <h1><?php echo $detailitem['tensp'] ?> <?php echo $detailitem['khoiluong'] ?> G</h1>
                                <hr width="100px" align="left" size="6px" color="orange">
                            </div>
                            <div class="product-content-right-product-price">
                                <p><?php echo number_format($detailitem['gia'], 0, '', '.') ?><sup>đ</sup></p>
                            </div>
                            <div class="product-content-right-product-detail">
                                <p><?php echo $detailitem['mota'] ?></p>
                            </div>
                            <form id="myForm" method="POST">
                                <div class="quantity">
                                    <p style="font-weight: bold">Số lượng
                                        <input type="number" name="soluong" min="1" max="10" value="1">
                                    </p>
                                </div>
                                <div class="product-content-right-product-button">
                                    <button type="submit" name="submit"><i class="fas fa-shopping-cart"></i>THÊM VÀO GIỎ</button>
                                </div>
                                <input type="hidden" name="tensp" value="<?php echo $detailitem['tensp'] ?> 
                                <?php echo $detailitem['khoiluong'] ?>G">
                                <input type="hidden" name="gia" value="<?php echo $detailitem['gia'] ?>">
                                <input type="hidden" name="anhsp" value="<?php echo $detailitem['anhsp'] ?>">
                                <input type="hidden" name="masp" value="<?php echo $detailitem['masp'] ?>">
                                <input type="hidden" name="submit" value="submit">
                            </form>
                            <script>
                                //Dùng Fetch để gửi dữ liệu mà không reload lại Form
                                const myForm = document.getElementById('myForm');
                                myForm.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    alert ("Thêm thành công");
                                    const formData = new FormData(this);
                                    fetch('./Cart.php', {
                                        method: 'POST',
                                        body: formData

                                    }).then(function(respond) {

                                        return respond.text();
                                    }).then(function(text){
                                        console.log(text);
                                    })

                                })
                            </script>

                        </div>
                    </div>
                </div>
        </product-detail>
    <?php } ?>
    <section class="product-related">
        <div class="product-related-title">
            <p>CÓ THỂ BẠN THÍCH</p>
        </div>
        <div class="product-related-line">
            <hr width="50%" align="center" size="2px" color="antiquewhite">
            <image src="../Image/beanicon-01.svg" width="60px" height="20px">
                <hr width="50%" align="center" size="2px" color="antiquewhite">
        </div>
        <button class="pre-btn"><img src="../Image/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="../Image/arrow.png" alt=""></button>
        <div class="product-related-container">
            <?php
            $sql_searchall = "SELECT * FROM sanpham";
            $lenh_searchall = mysqli_query($link, $sql_searchall);
            ?>
            <?php while ($row_searchall = mysqli_fetch_array($lenh_searchall)) { ?>
                <div class="product-card">
                    <a href='ProductDetail.php?title=<?php echo $row_searchall['masp'] ?>'>
                        <div class="product-image">
                            <img src="<?php echo $row_searchall['anhsp'] ?>" class="product-thumb" alt="">
                        </div>
                        <div class="product-info">
                            <p class="product-short-description"><?php echo $row_searchall['tensp'] ?> <?php echo $row_searchall['khoiluong'] ?>G</p>
                            <span class="price"><?php echo number_format($row_searchall['gia'], 0, '', '.') ?>đ</span>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <script src="../Scripts/script.js"> </script>
        <script>
            chuyentrang();
        </script>
    </section>
    </body>
    <footer>
        <?php include '../HeaderandFooter/footer.php' ?>
    </footer>

</html>