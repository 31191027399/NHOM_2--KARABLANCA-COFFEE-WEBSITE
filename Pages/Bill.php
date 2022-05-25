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
    <title>Bill-Karablanca</title>
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
    // Xóa toàn bộ giỏ hàng
    if (isset($_GET['delcart']) && ($_GET['delcart'] == 1)) {
        unset($_SESSION['giohang']);
        $giohangrong = 1;
    };
    if (isset($_POST['xacnhan']) && ($_POST['xacnhan'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $note = $_POST['note'];
        $tong = $_POST['tong'];
        $maapdung = $_POST['maapdung'];
        $thanhtien = $_POST['thanhtien'];
    }
    //Nếu khách hàng chưa tồn tại thì thêm vào CSDL
    $querysearchkh = "SELECT * FROM khachhang WHERE sdt='$phone'";
    $result_timkh = mysqli_query($link, $querysearchkh);
    $thongtinkh=mysqli_fetch_array($result_timkh);
    $khachhangdatontai = mysqli_num_rows($result_timkh);
    if ($khachhangdatontai == 0) {
        //Tạo mã khách hàng
        $querykh = "SELECT * FROM khachhang";
        $result_dem = mysqli_query($link, $querykh);
        $sokh = mysqli_num_rows($result_dem);
        $max=$sokh+1;
        $makh = "KHKRB" . $max;
         // INSERT dữ liệu khách hàng
         //insertkhachhang()
        $sql = "INSERT INTO khachhang(makh,tenkh,sdt,diachi)
        VALUES ('$makh','$name','$phone','$address')";
        mysqli_query($link, $sql);
    }
    else {
        $makh=$thongtinkh['makh'];
    }
        //Tạo mã đơn hàng
        $querydh = "SELECT * FROM donhang";
        $result_demdh = mysqli_query($link, $querydh);
        $sodh = mysqli_num_rows($result_demdh);
        $maxdh=$sodh+1;
        $madh = "DHKRB" . $maxdh;
        $date = date('d-m-y');
        //Tính phí vận chuyển
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
        // INSERT dữ liệu đơn hàng
        //insertdonhang()
        if (strlen($maapdung) == 0) {
            $sql2 = "INSERT INTO donhang(madh,ngaydh,giatridh,maphivc,sotienthanhtoan,mavoucher,makh,ghichu)
        VALUES ('$madh','$date','$tong','$maphivc','$thanhtien',NULL,'$makh','$note')";
        } else {
            $sql2 = "INSERT INTO donhang(madh,ngaydh,giatridh,maphivc,sotienthanhtoan,mavoucher,makh,ghichu)
            VALUES ('$madh','$date','$tong','$maphivc','$thanhtien','$maapdung','$makh','$note')";
        }
        mysqli_query($link, $sql2);
    ?>
    <div class="Menu">
        <ul class="breadcrumb breadcrumb-cart">
            <li><a href="./Index.php">Trang chủ</a></li>
            <li><a href="./Cart.php">Giỏ hàng</a></li>
            <li><a>Hóa đơn</a></li>
        </ul>
    </div>
    <div class="cart-top">
        <div class="cart-top-cart-2nd cart-top-item">
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
        <div class="cart-top-address cart-top-item">
            <i class="fa-solid fa-location-dot"></i>
        </div>
        <div class="cart-top-payment-2nd cart-top-item" style="border: solid #0db7ea;">
            <i class="fa-solid fa-money-bill"></i>
        </div>
    </div>
    <div class="confirmorder">
        <h1>Bạn đã đặt hàng thành công</h1>
        <h1>Mã đơn hàng: <?php echo $madh ?></h1>
        <h2>Thông tin đặt hàng</h2>
        <table class="thongtinnhanhang">

            <tr>
                <td width="20%">Họ tên:</td>
                <td><?php echo $name ?></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><?php echo $address ?></td>
            </tr>
            <tr>
                <td>Điện thoại:</td>
                <td><?php echo $phone ?></td>
            </tr>
            <tr>
                <td>Ghi chú:</td>
                <td><?php echo $note ?></td>
            </tr>
        </table>
    </div>
    <div class="cartPayInfo">
        <h2>Danh sách sản phẩm</h2>
        <table class="tablecart">
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
                    $maspchitiet = $_SESSION['giohang'][$i][4];
                    $soluongspchitiet = $_SESSION['giohang'][$i][2];
                    //insertchitietdh()
                    $sql3 = "INSERT INTO chitietdh(madh,masp,soluong)
                    VALUES ('$madh','$maspchitiet','$soluongspchitiet')";
                    mysqli_query($link, $sql3);
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

    <div class="complete">
    <div class="returnhomepage"><a href="./Index.php?delcart=1">Trờ về trang chủ</a></div>
    </div>
</body>
<footer>
    <?php
    include "../HeaderandFooter/footer.php" ?>
</footer>

</html>