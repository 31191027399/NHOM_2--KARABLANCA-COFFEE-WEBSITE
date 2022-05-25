<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location:index.php");
    exit;
}
include '../Module/db_admin.php';
$conn = OpenCon();
if (isset($_POST["sua"])) {
    $maloai = $_POST["id"];
} else {
    $maloai = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <script src="https://kit.fontawesome.com/4783db6fc6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Styles/admin.css">
    <title>Quản lý danh mục sản phẩm</title> <a href="../Module/logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
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
            <p>Thêm danh mục sản phẩm </p>
            <form method="POST" action>
                <table border="1" width="100%" style="border-collapse: collapse;">
                    <colgroup>
                        <col width="15%" span="1">
                        <col width="auto" span="1">
                    </colgroup>
                    <tr>
                        <td>Tên danh mục</td>
                        <td><input type="text" name="tensp" required autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="#" value="Thêm danh mục sản phẩm"></td>
                    </tr>
                </table>
            </form>

            <form method="POST" action>
                <table border="1" width="100%" style="border-collapse: collapse;">
                    <colgroup>
                        <col width="15%" span="1">
                        <col width="auto" span="1">
                    </colgroup>
                    <tr>
                        <td>Tên danh mục mới</td>
                        <td><input type="text" name="ten" required autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td>ID</td>
                        <td><input type="text" name="ma" value="<?php echo $maloai; ?>" disabled></td>
                    </tr>

                    <tr>
                        <td colspan="2"><input type="hidden" name="idsua" value="<?php echo  $maloai; ?>"><input type="submit" name="suadanhmuc" value="Sửa danh mục sản phẩm"></td>
                    </tr>
                </table>
            </form>

            <?php
            if (isset($_POST['#'])) {
                if (empty($_POST['tensp'])) {
                    echo '<script> alert("Vui lòng không để trống ") </script>';
                } else {
                    $tensp1 = trim($_POST['tensp']);
                    $flag = false;
                    //$conn = OpenCon();
                    //getloaisp()
                    $query = "SELECT * FROM loaisp";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        if (strcmp($row['tenloaisp'], $tensp1) !== 0) {
                            continue;
                        } else {
                            echo '<script> alert("Tên này đã tồn tại. Vui lòng nhập tên khác") </script>';
                            $flag = true;
                            break;
                        }
                    }
                    if ($flag == false) {
                        $s = preg_replace('/\b(\w)|./u', '$1', $tensp1);
                        $query_them = "INSERT INTO loaisp(maloaisp,tenloaisp) VALUE('" . $s . "','" . $tensp1 . "')";
                        mysqli_query($conn, $query_them);
                    }
                }
            } ?>
            <?php
            if (isset($_POST['suadanhmuc'])) {
                echo $maloai;
                $tam = $_POST['idsua'];
                //$conn = OpenCon();
                $tennew = trim($_POST['ten']);
                //updateloaisp_tenloaisp()
                $query_sua = "UPDATE loaisp SET tenloaisp='" . $tennew . "' WHERE maloaisp='" . $tam . "' ";
                mysqli_query($conn, $query_sua);
                echo "Sửa thành công";
                //CloseCon($conn);
            }

            ?>
            </table>
            <?php
            if (isset($_POST["xoa"])) {
                $id = $_POST["id"];
                $query2 = "SELECT COUNT(masp) as dem  FROM sanpham WHERE maloaisp='" . $id . "' group by maloaisp";
                $result2 = mysqli_query($conn, $query2);
                $row = mysqli_fetch_array($result2);
                //deleteloaisp()
                if ($result2->num_rows == 0) {
                    $query_xoa = "DELETE FROM loaisp WHERE maloaisp='" . $id . "'";
                    mysqli_query($conn, $query_xoa);
                    echo "Xóa thành công!";
                    //CloseCon($conn);  

                } else {
                    echo "Danh mục đã có sản phẩm. Không thể xóa!";
                }
            }
            ?>
            <div class="item-category-list">
                <p> Danh mục sản phẩm</p>
                <table border="1" width="100%" style="border-collapse: collapse;">
                    <colgroup>
                        <col width="5%" span="1">
                        <col width="60%" span="1">
                        <col width=auto span="1">
                    </colgroup>
                    <tr class="headline">
                        <td>ID </td>
                        <td>Tên danh mục</td>
                        <td>Quản lý</td>
                    </tr>
                    <tr>
                        <?php
                        //Lấy ID title tách trang
                        $sosp1trang = 10;

                        if (isset($_GET['title'])) {

                            $mid = ($_GET['title']);
                            $trang = str_replace('page', '', $mid);
                        } else {
                            $trang = 1;
                        }
                        $from = ($trang - 1) * $sosp1trang;
                        //getloaisp()
                        $query = "SELECT * FROM loaisp LIMIT $from,$sosp1trang";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {  ?>
                            <td><?php echo $row['maloaisp']; ?></td>
                            <td><?php echo $row['tenloaisp']; ?></td>

                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['maloaisp']; ?>">
                                    <input type="submit" name="xoa" value="Xóa" >
                                    <input type="submit" name="sua" value="Sửa" >
                                </form>
                            </td>


                    </tr>
                <?php
                        };
                ?>
                </table>
            </div>
        </div>
    </div>
    <?php
    $sql_trang = "SELECT * FROM loaisp";
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
                <a href="./QLDMSP.php?title=page<?php echo "$t" ?>" class="pagination-item__link"><?php echo "$t" ?></a>
            <?php } ?>

            <li class="pagination-item">
                <a href="" class="pagination-item__link">
                    <i class="pagination-item__icon fa-solid fa-chevron-right"></i>
                </a>
            </li>
    </ul>

</body>

<style>
    body {
        background-color: beige;
    }
</style>

</html>