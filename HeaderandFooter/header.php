<?php
require_once("../Module/db_module.php");
$link = NULL;
taoketnoi($link);
$sql_loaisp = "SELECT * FROM loaisp ORDER BY maloaisp ASC";
$lenh_loaisp = mysqli_query($link, $sql_loaisp);
?>

<div class="header-container">
    <div class="grid">
        <div class="grid__row grid__row-header">
            <div class="grid__column-3 grid__column-3-header">
                <a href="../Pages/Index.php">
                    <div class="logo">
                        <img src="../Image/logoKara.svg" width="75%">
                    </div>
                </a>
            </div>
            <div class="grid__column-7 grid__column-7-header">
                <div class="grid_column-7-7 grid__column-7-7-header">
                    <div class="menu">
                        <li><a href="../Pages/Index.php">TRANG CHỦ</a></li>
                        <li><a href="../Pages/Product.php">SẢN PHẨM</a>
                            <ul class="sub-menu">
                                <?php
                                while ($row_loaisp = mysqli_fetch_array($lenh_loaisp)) { ?>
                                    <li>
                                        <a href="../Pages/ProductbyType.php?title=<?php echo $row_loaisp['maloaisp'] ?>" class="category-item__link"><?php echo $row_loaisp['tenloaisp'] ?></a>
                                    </li>

                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li>ĐẠO CÀ PHÊ</li>
                        <li> VỀ CHÚNG TÔI</li>
                        <li>LIÊN HỆ</li>
                    </div>
                </div>
                <div class="grid__column-7-3 grid__column-7-3-header">
                    <div class="searchbar searchbar-header">
                        <form action="./ProductbyWord.php" method="GET">
                        <input type="text" name="str" placeholder="Nhập để tìm kiếm" autocomplete="off" style="width: 80%" required>
                            <button class="fa-solid fa-magnifying-glass"></button>
                        </form>
                    </div>
                    <li><a class="fas fa-shopping-bag" href="../Pages/Cart.php"></a></li>
                </div>

            </div>
        </div>
    </div>
</div>
</div>