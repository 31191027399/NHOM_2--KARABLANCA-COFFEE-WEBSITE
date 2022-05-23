<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4783db6fc6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Styles/style.css">
    <title>HomePage-Karablanca</title>
</head>

<header>
    <? require_once "../Module/db_module.php";
    $link = NULL;
    taoketnoi($link);
    ?>
    <?php
    include "../HeaderandFooter/header.php";
    ?>
</header>
<body>
    <?php
    session_start();
    if (isset($_GET['delcart']) && ($_GET['delcart'] == 1)) {
        unset($_SESSION['giohang']);
        $giohangrong = 1;
    };
    ?>
    <script> 
    //Script Chuyển ảnh
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");

            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }
     </script> 

    <div class="slideshow-container">

        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
            <img src="../Image/home-1-slider-image-1.jpg" style="width:100%">
            <div class="slider-logo">
                <img src="../Image/logoKara.svg">
            </div>
            <div class="text">Tách cà phê hoàn hảo được định nghĩa là tách cà phê có vị đắng đậm đà, chua thanh thoát, lan toả hương thơm nồng nàn, dễ dàng chinh phục vị giác của bất cứ ai. Tách cà phê đậm vị luôn luôn là thức uống giữ vị trí nhất định trong lòng những tín đồ cà phê Việt, dù văn hoá thưởng thức có nhiều thay đổi theo sự phát triển từng ngày của xã hội.
            </div>
        </div>

        <div class="mySlides fade">
            <img src="../Image/home-1-slider-image-2.jpg" style="width:100%">
            <div class="slider-logo">
                <img src="../Image/logoKara.svg">
            </div>
            <div class="text">Tách cà phê hoàn hảo được định nghĩa là tách cà phê có vị đắng đậm đà, chua thanh thoát, lan toả hương thơm nồng nàn, dễ dàng chinh phục vị giác của bất cứ ai. Tách cà phê đậm vị luôn luôn là thức uống giữ vị trí nhất định trong lòng những tín đồ cà phê Việt, dù văn hoá thưởng thức có nhiều thay đổi theo sự phát triển từng ngày của xã hội.
            </div>
        </div>

        <div class="mySlides fade">
            <img src="../Image/home-1-slider-image-3.jpg" style="width:100%">
            <div class="slider-logo">
                <img src="../Image/logoKara.svg">
            </div>
            <div class="text">Tách cà phê hoàn hảo được định nghĩa là tách cà phê có vị đắng đậm đà, chua thanh thoát, lan toả hương thơm nồng nàn, dễ dàng chinh phục vị giác của bất cứ ai. Tách cà phê đậm vị luôn luôn là thức uống giữ vị trí nhất định trong lòng những tín đồ cà phê Việt, dù văn hoá thưởng thức có nhiều thay đổi theo sự phát triển từng ngày của xã hội.
            </div>
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>


    <div class="small-container">
        <h2 class="title">SẢN PHẨM CỦA KARABLANCA</h2>
        <div class="row">
            <?php
            $sql_home = "SELECT sanpham.*,loaisp.tenloaisp FROM sanpham JOIN loaisp WHERE sanpham.maloaisp=loaisp.maloaisp LIMIT 0,8";
            $lenh_home = mysqli_query($link, $sql_home);
            ?>
            <?php while ($row_home = mysqli_fetch_array($lenh_home)) { ?>
                <div class="card">
                    <img src="<?php echo $row_home['anhsp'] ?>" style="width:100%">
                    <div class="product-info">
                        <p><a href="./ProductDetail.php?title=<?php echo $row_home['masp'] ?>"
                         class="index-product-detail">Xem chi tiết</a></p>
                        <p><a href="./ProductbyType.php?title=<?php echo $row_home['maloaisp'] ?>" 
                        class="product-catch"><?php echo $row_home['tenloaisp'] ?></a></p>
                        <p><b><a href="./ProductDetail.php?title=<?php echo $row_home['masp'] ?>" 
                        class="procuct-name"><?php echo $row_home['tensp'] ?> <?php echo $row_home['khoiluong'] ?>G</a></b></p>
                    </div>
                </div>
            <?php } ?>

        </div>

    </div>

    <div class="testimonial">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        Ngon, thơm
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h3>Khang</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        Chất lượng tuyệt vời, cà phê hảo hạng
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <h3>Phú</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>
                        Nhà tôi mấy đời uống cà phê này, rất hài lòng
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div>
                    <h3>Phúc</h3>
                </div>
            </div>
        </div>
    </div>

</body>

<footer>
    <?php include "../HeaderandFooter/footer.php" ?>
</footer>


</html>