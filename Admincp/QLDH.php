<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
include '../Module/db_admin.php';
$conn = OpenCon();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4783db6fc6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Styles/admin.css">
    <title>Quản lý đơn hàng</title><a href="../Module/logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</head>

<body>
    <h3 class="title-admin">Welcome to Karablanca AdminCP</h3>
    <div class="wrapper">
        <p> Menu </p>
        <ul class="admincp-list">
            <li><a href="./QLDMSP.php">Quản lý danh mục sản phẩm</a></li>
            <li><a href="./QLSP.php">Quản lý sản phẩm </a></li>
            <li><a href="./QLDH.php">Quản lý đơn hàng</a></li>
        </ul>
        <div class="clear"></div>
        <div class="main">
            <div class="order-list">
                <?php
                //updatedonhang_trangthai()
                if (isset($_POST["huy"])) {
                    $id = $_POST["id"];
                    $query_huy = "UPDATE donhang SET trangthaidh=N'Hủy' WHERE madh='" . $id . "'";
                    mysqli_query($conn, $query_huy);
                }
                if (isset($_POST["open"])) {
                    $id = $_POST["id"];
                    $query_mo = "UPDATE donhang SET trangthaidh=N'Mở lại' WHERE madh='" . $id . "'";
                    mysqli_query($conn, $query_mo);
                }
                ?>
                <p>Danh sách đơn hàng</p>
                <table border="1" width="100%" style="border-collapse: collapse;">
                    <colgroup>
                        <col width="10%" span="1">
                        <col width="10%" span="1">
                        <col width="15%" span="1">
                        <col width="12%" span="1">
                        <col width="10%" span="1">
                        <col width="12%" span="1">
                        <col width="8%" span="1">
                        <col width="10%" span="1">
                        <col width="18%" span="1">
                    </colgroup>
                    <tr class="headline">
                        <td>Mã đơn hàng</td>
                        <td>Ngày đơn hàng</td>
                        <td>Giá trị</td>
                        <td>Thành tiền</td>
                        <td>Discount</td>
                        <td>Khách hàng</td>
                        <td>Ghi chú</td>
                        <td>Trạng thái</td>
                        <td>Quản lý</td>
                    </tr>
                    <tr> <?php
                            $sosp1trang = 10;

                            if (isset($_GET['title'])) {

                                $mid = ($_GET['title']);
                                $trang = str_replace('page', '', $mid);
                            } else {
                                $trang = 1;
                            }
                            //getdonhang()
                            $from = ($trang - 1) * $sosp1trang;
                            $query = "SELECT * FROM donhang LIMIT $from,$sosp1trang";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) { ?>
                            <td>
                                <form method="POST"><input type="submit" name="ma" value="<?php echo $row['madh']; ?>"></form>
                            </td>
                            <td><?php echo $row['ngaydh']; ?></td>
                            <td><?php echo number_format($row['giatridh'],0,'','.') ?>đ</td>
                            <td><?php echo number_format($row['sotienthanhtoan'],0,'','.')?>đ</td>
                            <td><?php echo $row['mavoucher']; ?></td>
                            <td><?php echo $row['makh']; ?></td>
                            <td><?php echo $row['ghichu']; ?></td>
                            <td><?php echo $row['trangthaidh']; ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['madh']; ?>"><input type="submit" name="huy" value="Hủy">| <input type="submit" name="open" value="Mở">
                                </form>
                            </td>

                    </tr><?php
                            };
                            ?>
                </table>

                <input class="open-button" type="button" name="chitiet" value="Chi tiết" onclick="openForm()">
            </div>

        </div>
        <?php
        //getdonhang()
        $sql_trang = "SELECT * FROM donhang";
        $dssp = mysqli_query($conn, $sql_trang);
        $tongsosp = mysqli_num_rows($dssp);
        $sotrang = ceil($tongsosp / $sosp1trang);
        ?>
        <ul class="pagination search-product__pagination">
            <li class="pagination-item">
                <a href="" class="pagination-item__link">
                    <i class="pagination-item__icon fa-solid fa-chevron-left"></i>
                </a>
            </li>
            <?php for ($t = 1; $t <= $sotrang; $t++) { ?>
                <li class="pagination-item pagination-item--active">
                    <a href="./QLDH.php?title=page<?php echo "$t" ?>" class="pagination-item__link"><?php echo "$t" ?></a>
                <?php } ?>

                <li class="pagination-item">
                    <a href="" class="pagination-item__link">
                        <i class="pagination-item__icon fa-solid fa-chevron-right"></i>
                    </a>
                </li>
        </ul>
    </div>
    <div class="form-popup" id="myForm">
        <form action="" class="form-container">
            <p>Chi tiết sản phẩm</p>
            <table border="1" width="100%" style="border-collapse: collapse;">
                <colgroup>
                    <col width="22%" span="1">
                    <col width="31%" span="1">
                    <col width="15%" span="1">
                    <col width="15%" span="1">
                    <col width="17%" span="1">
                </colgroup>
                <tr class="popup-headline">
                    <td>Mã sản phẩm</td>
                    <td>Tên sản phẩm</td>
                    <td>Số lượng</td>
                    <td>Giá</td>
                    <td>Thành tiền</td>
                </tr>
                <tr>
                    <?php
                    //getchitietdh
                    if (isset($_POST['ma'])) {
                        $madh = $_POST['ma'];
                        $query1 = "SELECT ct.masp,sp.tensp,ct.soluong ,sp.gia, ct.soluong*sp.gia as cong FROM chitietdh ct join sanpham sp ON ct.masp=sp.masp WHERE madh='" . $madh . "'";
                        $result1 = mysqli_query($conn, $query1);
                        while ($row = mysqli_fetch_array($result1)) { ?>
                            <td style="text-align:center"><?php echo $row['masp']; ?></td>
                            <td><?php echo $row['tensp']; ?></td>
                            <td style="text-align:center"><?php echo $row['soluong']; ?></td>
                            <td style="text-align:right"><?php echo number_format($row['gia'],0,'','.'); ?>đ</td>
                            <td style="text-align:right"><?php echo number_format($row['cong'],0,'','.'); ?>đ</td>
                </tr>
        <?php
                        };
                    } else {
                        echo "Bạn cần chọn đơn hàng cần xem!";
                    }
        ?>
            </table>
            <?php
            if (isset($_POST['ma'])) {
                $query2 = "SELECT dh.sotienthanhtoan, dh.mavoucher,kh.tenkh, kh.sdt, kh.diachi FROM khachhang kh join donhang dh on dh.makh=kh.makh WHERE 
                madh='" . $madh . "'";
                $result2 = mysqli_query($conn, $query2);
                $row = mysqli_fetch_array($result2) ?>
                <label><b>Tên khách hàng</b></label><br>
                <td><?php echo $row['tenkh']; ?></td><br>
                <label><b>Số điện thoại</b></label><br>
                <td><?php echo $row['sdt']; ?></td><br>
                <label><b>Địa chỉ</b></label><br>
                <td><?php echo $row['diachi']; ?></td><br>
                <label><b>Discount</b></label><br>
                <td><?php echo $row['mavoucher']; ?></td><br>
                <label><b>Tổng cộng</b></label><br>
                <td><?php echo number_format($row['sotienthanhtoan'],0,'','.');?>đ</td><?php
                                                                };
                                                                    ?>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>

    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";

        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
    <style>
        body {
            background-color: beige;
        }
    </style>

</html>