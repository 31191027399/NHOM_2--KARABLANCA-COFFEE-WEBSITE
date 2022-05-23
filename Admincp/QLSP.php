<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
include '../Module/db_admin.php';
$conn = OpenCon();
if (isset($_POST["sua"])) {
    $maloai = $_POST["id"];
} else {
    $maloai = "";
}
if (isset($_SESSION['dem']))
{
      if (isset($_POST['#'])){
       $_SESSION['dem']++;
   }
}
else { $_SESSION['dem']=0;} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4783db6fc6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Styles/admin.css">
    <title>Quản lý sản phẩm</title><a href="../Module/logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</head>

<body>
    <h3 class="title-admin">Welcome to Karablanca AdminCP</h3>
    <div class="wrapper">
        <p> Menu </p>
        <ul class="admincp-list">
            <li><a href="QLDMSP.php">Quản lý danh mục sản phẩm</a></li>
            <li><a href="QLSP.php">Quản lý sản phẩm </a></li>
            <li><a href="QLDH.php">Quản lý đơn hàng</a></li>
        </ul>
        <div class="clear"></div>
        <div class="main">

            <table border="1" width="100%" style="border-collapse: collapse;">

                <colgroup>
                    <col width="15%" span="1">
                    <col width="auto" span="1">
                </colgroup>
                <form method="POST">
                    <tr>
                        <td>Tên sản phẩm</td>
                        <td><input type="text" name="tensp" required autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td>Mã sản phẩm</td>
                        <td><input type="text" name="ma" value="<?php echo $maloai; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Giá sản phẩm</td>
                        <td><input type="text" name="gia" required autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td>Khối lượng</td>
                        <td><input type="text" name="khoiluong" required autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td>Hình ảnh</td>
                        <td><input type="text" name="anh" required autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td>Mô tả</td>
                        <td><textarea row="10" name="mota" style="resize:none" height="100px" width="100px" required autocomplete="off"></textarea></td>
                    </tr>
                    <tr>
                        <td>Tên loại sản phẩm</td>
                        <td>
                            <select name="tenloai">
                                <?php
                                $query = "SELECT * FROM loaisp";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <option><?php echo $row['tenloaisp']; ?></option> <?php };
                                   ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="#" value="Thêm sản phẩm">|<input type="hidden" name="idsua" value="<?php echo  $maloai; ?>"><input type="submit" name="suasp" value="Sửa sản phẩm"></td>
                    </tr>
                </form>
            </table>
            <?php 
            if (isset($_POST['#'])) {   
                if (empty($_POST['tensp'])) {
                    echo '<script> alert("Vui lòng không để trống ") </script>';
                } else {
                    $tensp = trim($_POST['tensp']);
                    $tenma = trim($_POST['tenloai']);
                    $khoiluong = $_POST['khoiluong'];
                    $gia = $_POST['gia'];
                    $anh = $_POST['anh'];
                    $mota = $_POST['mota'];
                    $masp = "KRB" . $_SESSION['dem'];
                    $querythem = "INSERT INTO sanpham(masp,tensp,maloaisp,khoiluong,gia,mota,anhsp) SELECT '" . $masp . "','" . $tensp . "',maloaisp,'" . $khoiluong . "','" . $gia . "',
                    '" . $mota . "','" . $anh . "' FROM loaisp  WHERE tenloaisp='" . $tenma . "'";
                   $querythem1 = "INSERT INTO tuongtacsp(masp,date,doanhso) SELECT '" . $masp . "',curdate(),0";
                   mysqli_query($conn, $querythem);
                    mysqli_query($conn, $querythem1);
                    echo "Thêm thành công";header("Refresh:0");
                }   
            }
            ?>

            <?php
            if (isset($_POST["xoa"])) 
                       { 
           	            $id = $_POST["id"];
                       $query2 = "SELECT masp  FROM chitietdh WHERE masp='" . $id . "'";
                       $result2 = mysqli_query($conn, $query2);
           	            if($result2->num_rows==0)
          	            {
           	                $query_xoatt = "DELETE FROM tuongtacsp WHERE masp='" . $id . "'";
           	                mysqli_query($conn, $query_xoatt);
           	                $query_xoa = " DELETE FROM sanpham WHERE masp='" . $id . "'";
           	                mysqli_query($conn, $query_xoa);
          	                echo "Xóa thành công mã sản phẩm  ";echo $id ;
           	            }
          	            else {
           	                echo " Sản phẩm có trong đơn hàng. Không thể xóa!";
           	            }}
           
           
            ?>
            <div class="item-list">
                <p>Danh sách sản phẩm</p>
                <table border="1" width="100%" style="border-collapse: collapse;">
                    <?php
                    if (isset($_POST['suasp'])) {
                        if (empty($_POST['tensp'])) {
                            echo '<script> alert("Vui lòng không để trống ") </script>';
                        } else {
                            $tam1 = $_POST['idsua'];
                            $tensp = trim($_POST['tensp']);
                            $tenma = ($_POST['tenloai']);
                            $khoiluong = $_POST['khoiluong'];
                            $gia = $_POST['gia'];
                            $anh = $_POST['anh'];
                            $mota = $_POST['mota'];
                            $query_sua = "UPDATE sanpham SET tensp='" . $tensp . "',maloaisp=(SELECT maloaisp from loaisp where tenloaisp='" . $tenma . "'),khoiluong='" . $khoiluong . "', 
                            gia='" . $gia . "',mota='" . $mota . "',anhsp='" . $anh . "' WHERE  masp='" . $tam1 . "' ";
                            mysqli_query($conn, $query_sua);
                            echo "Sửa thành công. ";
                        }
                    }
                    ?>
                    <colgroup>
                        <col width="3%" span="1">
                        <col width="10%" span="1">
                        <col width="5%" span="1">
                        <col width="7%" span="1">
                        <col width="7%" span="1">
                        <col width="10%" span="1">
                        <col width="43%" span="1">
                        <col width="15%" span="1">

                    </colgroup>
                    <tr class="headline">
                        <td>ID</td>
                        <td>Tên sản phẩm</td>
                        <td>Giá</td>
                        <td>Khối lượng</td>
                        <td>Danh mục</td>
                        <td>Ảnh sản phẩm</td>
                        <td>Mô tả</td>
                        <td>Quản lý</td>
                    </tr>
                    <tr>
                        <?php
                        $sosp1trang = 10;

                        if (isset($_GET['title'])) {

                            $mid = ($_GET['title']);
                            $trang = str_replace('page', '', $mid);
                        } else {
                            $trang = 1;
                        }
                        $from = ($trang - 1) * $sosp1trang;
                        $query1 = "SELECT masp,tensp,gia,khoiluong,tenloaisp,anhsp,mota,sp.maloaisp FROM sanpham sp 
                        join loaisp loai ON sp.maloaisp=loai.maloaisp LIMIT $from,$sosp1trang";
                        $result1 = mysqli_query($conn, $query1);
                        while ($row = mysqli_fetch_array($result1)) { ?>
                            <td><?php echo $row['masp']; ?> </td>
                            <td><?php echo $row['tensp']; ?></td>
                            <td><?php echo number_format($row['gia'],0,'','.'); ?>đ</td>
                            <td><?php echo $row['khoiluong']; ?>g</td>
                            <td><?php echo $row['tenloaisp']; ?></td>
                            <td><?php
                                $image = $row["anhsp"];
                                $imageData = base64_encode(file_get_contents($image));
                                echo '<img src="data:image/jpeg;base64,' . $imageData . '" style="height: 100%; width: 100%;object-fit: cover">';
                                ?></td>
                            <td style="text-align:left"><?php echo $row['mota']; ?></td>
                            <form method="POST">
                                <td>
                                    <input type="hidden" name="id" value="<?php echo $row['masp']; ?>"><input type="submit" name="xoa" value="Xóa"> | <input type="submit" name="sua" value="Sửa">
                                </td>
                            </form>
                    </tr> <?php
                        };
                            ?>
                </table>
            </div>
        </div>
    </div>
    <?php
    $sql_trang = "SELECT masp,tensp,gia,khoiluong,tenloaisp,anhsp,mota,sp.maloaisp FROM sanpham sp join loaisp loai ON sp.maloaisp=loai.maloaisp";
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
                <a href="./QLSP.php?title=page<?php echo "$t" ?>" class="pagination-item__link"><?php echo "$t" ?></a>
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