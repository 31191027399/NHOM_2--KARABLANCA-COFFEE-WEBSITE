<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4783db6fc6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Styles/style.css">
    <title>SearchPage-Karablanca</title>
</head>
<header>
    <?php
    include "../HeaderandFooter/header.php" ?>
</header>

<body>
    <?php
    require_once '../Module/db_module.php';
    $link = NULL;
    taoketnoi($link); ?>
    <?php
    //getloaisp()
    $sql_loaisp = "SELECT * FROM loaisp ORDER BY maloaisp ASC";
    $lenh_loaisp = mysqli_query($link, $sql_loaisp);
    ?>
    <?php
    $sql_khoiluong = "SELECT DISTINCT * FROM (SELECT khoiluong FROM sanpham) AS A ORDER BY khoiluong ASC";
    $lenh_khoiluong = mysqli_query($link, $sql_khoiluong);
    ?>
    <div class="search__container">
        <div class="grid">
            <div class="grid__row search__content">
                <div class="grid__column-2">
                    <div class="category">
                        <h5 class="category__heading">
                            <i class="fa-solid fa-mug-saucer"></i>
                            Loại
                            sản phẩm
                        </h5>
                        <ul class="category-list">
                            <li class="category-item category-item">
                                <a href="./Product.php" class="category-item__link">Tất cả</a>
                            </li>
                            <?php while ($row_loaisp = mysqli_fetch_array($lenh_loaisp)) { ?>
                                <li class="category-item">
                                    <a href="./ProductbyType.php?title=<?php echo $row_loaisp['maloaisp'] ?>" class="category-item__link"><?php echo $row_loaisp['tenloaisp'] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                        <h5 class="category__heading">
                            <i class="fa-solid fa-weight-scale"></i>
                            Trọng lượng
                        </h5>
                        <ul class="category-list">
                            <li class="category-item category-item">
                                <a href="./Product.php" class="category-item__link">Tất cả</a>
                            </li>
                            <?php while ($row_khoiluong = mysqli_fetch_array($lenh_khoiluong)) { ?>
                                <li class="category-item">
                                    <a href="./ProductbyWeight.php?title=<?php echo $row_khoiluong['khoiluong'] ?>" class="category-item__link"><?php echo $row_khoiluong['khoiluong'] ?>gram</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="grid__column-10">


                    <div class="search-filter">
                        <span class="search-filter__label">Sắp xếp theo</span>
                        <a href="./ProductbyFilter.php?filter=date DESC"><button class="search-filter__btn"> Mới nhất
                            </button> </a>
                        <a href="./ProductbyFilter.php?filter=doanhso DESC"><button class="search-filter__btn">Bán chạy
                            </button> </a>
                        <div class="select-input">
                            <span class="select-input__label">Giá
                            </span>
                            <i class="select-input__icon fa-solid fa-angle-down"></i>
                            <ul class="select-input__list">
                                <li class="select-input__item">
                                    <a href="./ProductbyFilter.php?filter=gia ASC" class="select-input__link">Từ thấp
                                        đến
                                        cao</a>
                                </li>
                                <li class="select-input__item">
                                    <a href="./ProductbyFilter.php?filter=gia DESC" class="select-input__link">Từ cao đến
                                        thấp</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="search-result">
                        <div class="grid_row">
                            <?php
                            //PHP sOrt dieu kien tim trang va dieu kien tim kiem

                            if (isset($_GET['filter'])) {
                                $order=($_GET['filter']);
                                //getsanpham()
                                $sql_search = "SELECT sanpham.* FROM sanpham JOIN tuongtacsp ON sanpham.masp=tuongtacsp.masp ORDER BY $order";
                                $lenh_search = mysqli_query($link, $sql_search);
                            }           
                            ?>
                            <?php while ($row_search = mysqli_fetch_array($lenh_search)) { ?>
                                <a href='ProductDetail.php?title=<?php echo $row_search['masp'] ?>'>
                                    <div class="grid__column-2-4" style="width:19.6666%;">

                                        <div class="search-product-item">
                                            <div class="search-product-item__img" style="background-image:url(<?php echo $row_search['anhsp'] ?>);">
                                            </div>
                                            <h5 class="search-product-item__name"><?php echo $row_search['tensp'] ?>
                                                <?php echo $row_search['khoiluong'] ?>G</h5>
                                            <div class="search-product-item__price">
                                                <span class="search-product-item__newwprice"><?php echo number_format($row_search['gia'], 0, '', '.') ?>đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <?php include "../HeaderandFooter/footer.php" ?>
</footer>

</html>