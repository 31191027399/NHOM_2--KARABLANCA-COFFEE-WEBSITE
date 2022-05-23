<?php
session_start();
$tong = 0;
$thanhtien = 0;
$giohangrong = 0;
if (!isset($_SESSION['giohang'])) {
    $_SESSION['giohang'] = [];
    $giohangrong = 1;
}
// Xóa toàn bộ giỏ hàng
if (isset($_GET['delcart']) && ($_GET['delcart'] == 1)) {
    unset($_SESSION['giohang']);
    $giohangrong = 1;
};
// Xóa sản phẩm trong giỏ hàng
if (isset($_GET['delid']) && ($_GET['delid'] >= 0)) {
    array_splice(($_SESSION['giohang']), ($_GET['delid']), 1);
    if (sizeof($_SESSION['giohang']) == 0) {
        $giohangrong = 1;
    }
}
//lấy dữ liệu từ form
if (isset($_POST['submit']) && ($_POST['submit'])) {
    $tensp = $_POST['tensp'];
    $gia = $_POST['gia'];
    $soluong = $_POST['soluong'];
    $anhsp = $_POST['anhsp'];
    $masp = $_POST['masp'];
    // Kiểm tra sản phẩm có trong giỏ hàng
    $flag = 0; // Kiểm tra sản phẩm có trùng
    for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
        if ($_SESSION['giohang'][$i][4] == $masp) {
            $flag = 1;
            $soluongnew = $soluong + $_SESSION['giohang'][$i][2];
            $_SESSION['giohang'][$i][2] = $soluongnew;
            break;
        }
    }
    //Nếu không trùng sp trong giỏ hàng thì thêm mới
    if ($flag == 0) {
        $sp = [$tensp, $gia, $soluong, $anhsp, $masp];
        $_SESSION['giohang'][] = $sp;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4783db6fc6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Styles/style.css">
    <title>Cart-Karablanca</title>

</head>
<header>
    <?PHP include "../HeaderandFooter/header.php" ?>
</header>

<body>
    <div class="Menu">
        <ul class="breadcrumb breadcrumb-cart">
            <li><a href="./Index.php">Trang chủ</a></li>
            <li><a href="./Cart.php">Giỏ hàng</a></li>
        </ul>
    </div>
    <div class="cart-top">
        <div class="cart-top-cart cart-top-item">
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
        <div class="cart-top-adress cart-top-item">
            <i class="fa-solid fa-location-dot"></i>
        </div>
        <div class="cart-top-payment cart-top-item">
            <i class="fa-solid fa-money-bill"></i>
        </div>
    </div>
    <div class="cart__container">
        <div class="grid">
            <div class="grid__row cart__content">
                <div class="grid__column-8 grid__column-8-cart">
                    <div class="cart__label-list">
                        <div class="cart__label">
                            <h3>Danh sách sản phẩm</h3>
                        </div>
                        <div class="cart__item-delall"><a href="Cart.php?delcart=1">Xóa giỏ hàng </a></div>
                    </div>
                    <?php
                    if (isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
                        for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                            $tt = $_SESSION['giohang'][$i][1] * $_SESSION['giohang'][$i][2];
                            $tong = $tong + $tt;
                    ?>
                            <div class="cart__item">
                                <tr>
                                    <td>
                                        <div class="cart__item-image" style="background-image:url(<?php echo  $_SESSION['giohang'][$i][3]  ?>)">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="cart__item-name">
                                            <a href="./ProductDetail.php?title=<?php echo $_SESSION['giohang'][$i][4] ?>">
                                                <h4><?php echo  $_SESSION['giohang'][$i][0] ?></h4>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="cart__item-number">
                                            <p style="font-weight: bold">Số lượng: <br>
                                                <?php echo  $_SESSION['giohang'][$i][2] ?>
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="cart__item-price"><?php echo number_format($_SESSION['giohang'][$i][1], 0, '', '.') ?>đ</div>
                                    </td>
                                    <td>
                                        <div class="cart__item-del"><a href="Cart.php?delid=<?php echo "$i" ?>">Xóa</a></div>
                                    </td>

                                </tr>
                            </div>

                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="grid__column-4 grid__column-4-cart">
                    <div class="cart__voucher">
                        <div class="cart__voucher-label">
                            <h5>Chọn mã giảm giá</h5>
                        </div>
                        <div class="cart__voucher-box">
                            <form method="POST" class="FormVoucher">
                                <div class="cart__voucher-type"><input type="text" name="mavoucher" placeholder="Nhập mã của bạn" required autocomplete="off" style="font-size:1.1vw" ;max-width: 60%; padding-right:10px;> </div>
                                <input type="submit" name="apvoucher" value="Áp dụng ngay!" style="background-color: crimson;color: white;font-size: 1.1vw">
                            </form>
                            <?php
                            //Tính phí vận chuyển
                            include_once "../Module/db_module.php";
                            $link = NULL;
                            taoketnoi($link);
                            if ($tong < 300000) {
                                $maphivc = 1;
                            } else if ($tong > 1000000) {
                                $maphivc = 3;
                            } else {
                                $maphivc = 2;
                            }
                            $sql_phivc = "SELECT * FROM phivanchuyen WHERE maphivc='$maphivc'";
                            $kq_phivc = mysqli_query($link, $sql_phivc);
                            $row_phivc = mysqli_fetch_assoc($kq_phivc);
                            $phivc = $row_phivc['tienvc'];
                            //Áp dụng voucher
                            if (isset($_POST['apvoucher'])) {
                                $mavoucher = mysqli_real_escape_string($link, $_POST['mavoucher']);
                                $sql_voucher = "SELECT * FROM voucher WHERE mavoucher='$mavoucher' ";
                                $kq_voucher = mysqli_query($link, $sql_voucher);
                                $row_voucher = mysqli_fetch_assoc($kq_voucher);
                                if (mysqli_num_rows($kq_voucher) > 0) {
                                    echo 'Mã giảm giá áp dụng thành công!' . '<br>' .
                                        'Bạn được giảm ' . 100 * $row_voucher['tile'] . '% giá trị đơn hàng không bao gồm phí vận chuyển';
                                    $tile = $row_voucher['tile'];
                                    $thanhtien = $tong - ($tong * $tile) + $phivc;
                                    $maapdung = $row_voucher['mavoucher'];
                                } else {
                                    echo 'Mã giảm giá không hợp lệ';
                                    $thanhtien = $tong + $phivc;
                                    $maapdung = "";
                                }
                            } else {
                                $thanhtien = $tong + $phivc;
                                $maapdung = "";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="cart__pay">
                        <div class="cart__pay-header">
                            <h4>Thanh toán</h4>
                        </div>
                        <div class="cart__pay-body">
                            <table class="cart__pay-content">
                                <tbody>
                                    <tr>
                                        <td class="cart__pay-content-tempt">Tạm tính</td>
                                        <td class="cart__pay-content-tempt-money"><?php echo number_format($tong, 0, '', '.') ?>đ</td>
                                    </tr>
                                    <tr>
                                        <td class="cart__pay-content-tempt">Phí vận chuyển</td>
                                        <td class="cart__pay-content-tempt-money"><?php echo number_format($phivc, 0, '', '.') ?>đ</td>
                                    </tr>
                                    <tr>
                                        <td class="cart__pay-content-real">Thành tiền</td>
                                        <td class="cart__pay-content-real-money"><?php echo  number_format($thanhtien, 0, '', '.') ?>đ</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="cart__pay-note">Đã bao gồm VAT</div>
                        </div>
                    </div>
                    <div class="cart__pay-button cart__pay-button" style="width: 98%;">
                        <?php if ($giohangrong == 0) { ?>
                            <form action="./PayInfo.php" method="POST">
                                <button class="cart__pay-button-sq cart__pay-button-sq-on" type="submit" name="thanhtoan">Thanh toán</button>
                                <input type="hidden" name="tong" value="<?php echo $tong ?>">
                                <input type="hidden" name="thanhtien" value="<?php echo $thanhtien ?>">
                                <input type="hidden" name="maapdung" value="<?php echo $maapdung ?>">
                                <input type="hidden" name="thanhtoan" value="thanhtoan">
                            </form>
                        <?php } else if ($giohangrong == 1) { ?>
                            <button class="cart__pay-button-sq cart__pay-button-sq-off">Thanh toán</button>
                        <?php } ?>
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