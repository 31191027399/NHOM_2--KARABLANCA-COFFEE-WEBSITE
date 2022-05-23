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
    <title>PayInfo-Karablanca</title>
</head>
<header>
    <?php
    include "../HeaderandFooter/header.php";
    ?>
</header>

<body>
    <?php
    require_once "../Module/db_module.php";
    $link = NULL;
    taoketnoi($link);
    session_start();
    if (isset($_POST['thanhtoan']) && ($_POST['thanhtoan'])) {
        $tong = $_POST['tong'];
        $thanhtien = $_POST['thanhtien'];
        $maapdung = $_POST['maapdung'];
    }
    ?>
    <div class="Menu">
        <ul class="breadcrumb breadcrumb-cart">
            <li><a href="./Index.php">Trang chủ</a></li>
            <li><a href="./Cart.php">Giỏ hàng</a></li>
            <li><a>Thông tin vận chuyển </a></li>
        </ul>
    </div>
    <div class="cart-top">
        <div class="cart-top-cart-2nd cart-top-item">
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
        <div class="cart-top-address-2nd cart-top-item">
            <i class="fa-solid fa-location-dot"></i>
        </div>
        <div class="cart-top-payment-2nd cart-top-item">
            <i class="fa-solid fa-money-bill"></i>
        </div>
    </div>
    <div class="container">
        <h2>Thông tin thanh toán </h2>
        <div class="row" id="bill">
            <div class="col-12">
                <form action="./Bill.php" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="email">Họ và tên</label> </br>
                        <input type="text" name="name" class="form-control" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="email">Số điện thoại</label> </br>
                        <input type="text" name="phone" class="form-control" placeholder="..." 
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  maxlength='10' required>
                    </div>
                    <div class="form-group">
                        <label for="email">Địa chỉ</label> </br>
                        <input type="text" name="address" class="form-control" placeholder="..."required>
                    </div>
                    <div class="form-group">
                        <label for="email">Ghi chú</label> </br>
                        <input type="text" name="note" class="form-control" placeholder="...">
                    </div>
            </div>
        </div>
    </div>
    <div class="cartPayInfo">
        <h2> Danh sách sản phẩm</h2>
        <table class="tablecart" >
            <tr style="text-align: left;"> 
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền sản phẩm</th>
            </tr>
            <?php if (isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {

                for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                    $tt = $_SESSION['giohang'][$i][1] * $_SESSION['giohang'][$i][2];
                    echo
                    '<tr>
                            <td>' . ($i + 1) . '</td>
                            <td>' . $_SESSION['giohang'][$i][0] . '</td>
                            <td>' . number_format($_SESSION['giohang'][$i][1], 0, '', '.') . 'đ</td>
                            <td>' . number_format($_SESSION['giohang'][$i][2], 0, '', '.')  . '</td>
                            <td>
                                <div>' . number_format($tt, 0, '', '.') . 'đ</div>
                            </td>

                        </tr>';
                }
                echo '<tr>
                            <th colspan="4" style="text-align: left;">Tổng đơn hàng</th>
                            <th>
                                <div style="text-align: left;">' .  number_format($tong, 0, '', '.') . 'đ</div>
                            </th>
                            </tr>
                            <tr>
                            <th colspan="4" style="text-align: left;">Mã giảm giá áp dụng</th>
                            <th>
                                <div style="text-align: left;">' . $maapdung . '</div>
                            </th>
                            </tr>
                            <tr>
                            <th colspan="4" style="text-align: left;" >Tổng tiền cần thanh toán </th>
                            <th>
                                <div style="text-align: left;">' . number_format($thanhtien, 0, '', '.') . 'đ</div>
                            </th>
                            </tr>';
            }
            ?>
        </table>

    </div>

    <div class="payinfo-button">
        <button type="submit" class="payinfo-button payinfo-button_confirm" name="xacnhan" value="xacnhan" >Xác nhận đặt hàng</button>
        <input type="hidden" name="xacnhan" value="xacnhan">
        <input type="hidden" name="tong" value="<?php echo $tong?>">
        <input type="hidden" name="maapdung" value="<?php echo $maapdung?>">
        <input type="hidden" name="thanhtien" value="<?php echo $thanhtien?>">
        <input type="hidden" name="xacnhan" value="xacnhan">
        </form>
        <a href="./Cart.php"><button class="payinfo-button payinfo-button_cancel"> Hủy</button></a>
    </div>
</body>
<footer>
 <?php 
  include "../HeaderandFooter/footer.php"?>
</footer>

</html>