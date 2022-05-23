-- phpMyAdmin SQL Dump
-- version 5.2.1-dev+20220512.1c7aab1a4d
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 04:48 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karablanca`
--
CREATE DATABASE IF NOT EXISTS `karablanca` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci;
USE `karablanca`;

-- --------------------------------------------------------

--
-- Table structure for table `chitietdh`
--

CREATE TABLE `chitietdh` (
  `madh` varchar(10) CHARACTER SET utf8mb4 NOT NULL COMMENT 'mã đơn hàng',
  `masp` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'mã sản phẩm',
  `soluong` int(10) NOT NULL COMMENT 'số lượng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `chitietdh`
--

INSERT INTO `chitietdh` (`madh`, `masp`, `soluong`) VALUES
('DHKRB1', 'CAS1', 1),
('DHKRB2', 'CAS3', 1),
('DHKRB2', 'CAS5', 1),
('DHKRB2', 'MAN2', 1),
('DHKRB3', 'ARA5', 1),
('DHKRB3', 'CLB1', 1),
('DHKRB4', 'ARA3', 1),
('DHKRB4', 'CLB1', 1),
('DHKRB4', 'PRB3', 2);

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `madh` varchar(10) NOT NULL COMMENT 'mã đơn hàng',
  `ngaydh` date NOT NULL COMMENT 'ngày tạo đơn hàng',
  `giatridh` int(10) NOT NULL COMMENT 'giá trị đơn hàng',
  `maphivc` int(1) NOT NULL COMMENT 'mã phí vận chuyển',
  `sotienthanhtoan` int(10) NOT NULL COMMENT 'thành tiền',
  `mavoucher` varchar(10) DEFAULT NULL COMMENT 'mã voucher',
  `makh` varchar(10) NOT NULL COMMENT 'mã khách hàng',
  `ghichu` varchar(300) NOT NULL COMMENT 'ghi chú của khách hàng',
  `trangthaidh` varchar(300) NOT NULL COMMENT 'trạng thái đơn hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`madh`, `ngaydh`, `giatridh`, `maphivc`, `sotienthanhtoan`, `mavoucher`, `makh`, `ghichu`, `trangthaidh`) VALUES
('DHKRB1', '2022-05-22', 90000, 1, 120000, NULL, 'KHKRB1', '', ''),
('DHKRB2', '2022-05-22', 909000, 2, 924000, NULL, 'KHKRB2', 'Giao sau 10h', 'Mở lại'),
('DHKRB3', '2022-05-22', 268000, 1, 298000, NULL, 'KHKRB4', 'Bỏ 2 lớp chống sốc', ''),
('DHKRB4', '2022-05-22', 478000, 2, 349600, 'KARAWEB', 'KHKRB5', 'Đi đến hẻm 653 gọi ra lấy', '');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `makh` varchar(10) NOT NULL COMMENT 'mã khách hàng',
  `tenkh` varchar(100) NOT NULL COMMENT 'tên khách hàng',
  `sdt` varchar(100) NOT NULL COMMENT 'số điện thoại',
  `diachi` varchar(300) NOT NULL COMMENT 'địa chỉ giao hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`makh`, `tenkh`, `sdt`, `diachi`) VALUES
('KHKRB1', 'Hữu Phúc', '0884439343', '606 3 tháng 2'),
('KHKRB2', 'Nguyễn Hà', '0349324123', '546 Điện Biên Phủ'),
('KHKRB3', 'Nguyễn Dung', '0886754353', '3123 CMT8'),
('KHKRB4', 'Nguyễn Dung', '0877345112', '564 CMT8'),
('KHKRB5', 'Hoàng Cường', '0752342343', '653/34/12 Nguyễn Du, Phường 1, Q.1, TP.HCM');

-- --------------------------------------------------------

--
-- Table structure for table `loaisp`
--

CREATE TABLE `loaisp` (
  `maloaisp` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'mã loại sản phẩm',
  `tenloaisp` text COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'tên loại sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `loaisp`
--

INSERT INTO `loaisp` (`maloaisp`, `tenloaisp`) VALUES
('CPX', 'Cà phê xay'),
('MAC', 'Hạt Macca'),
('TRA', 'Trà');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user` varchar(10) NOT NULL COMMENT 'tên người dùng',
  `password` varchar(10) NOT NULL COMMENT 'mật khẩu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `phivanchuyen`
--

CREATE TABLE `phivanchuyen` (
  `maphivc` int(1) NOT NULL COMMENT 'Mã phí vận chuyển',
  `tienvc` int(10) NOT NULL COMMENT 'Tiền vận chuyển'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `phivanchuyen`
--

INSERT INTO `phivanchuyen` (`maphivc`, `tienvc`) VALUES
(1, 30000),
(2, 15000),
(3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `masp` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'mã sản phẩm',
  `tensp` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'tên sản phẩm',
  `maloaisp` varchar(10) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'mã loại sản phẩm',
  `khoiluong` int(10) NOT NULL COMMENT 'khối lượng',
  `gia` int(50) NOT NULL COMMENT 'giá sản phẩm',
  `mota` text COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'mô tả về sản phẩm',
  `anhsp` text COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'ảnh của sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`masp`, `tensp`, `maloaisp`, `khoiluong`, `gia`, `mota`, `anhsp`) VALUES
('ARA1', 'KRB ARABICA', 'CPX', 100, 109000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/128041987_719328759018242_5348186261257388053_n-300x300.jpg'),
('ARA3', 'KRB ARABICA', 'CPX', 300, 149000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/128041987_719328759018242_5348186261257388053_n-300x300.jpg'),
('ARA5', 'KRB ARABICA', 'CPX', 500, 179000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/128041987_719328759018242_5348186261257388053_n-300x300.jpg'),
('CAS1', 'KRB CÀ PHÊ TRÀ CASCARA', 'TRA', 100, 90000, 'Cascara thường được gọi là cà phê trà hay Cherry Tea Coffee, được làm từ vỏ của quả cà phê chín, sau vỏ được tách ra khỏi quả sẽ được phơi dưới ánh nắng mặt trời hoặc sấy khô, rang và sử dụng pha chế như các loại trà thông dụng.', 'https://karablanca.com/wp-content/uploads/2021/01/IMAGE-300x300.jpg'),
('CAS3', 'KRB CÀ PHÊ TRÀ CASCARA', 'TRA', 300, 250000, 'Cascara thường được gọi là cà phê trà hay Cherry Tea Coffee, được làm từ vỏ của quả cà phê chín, sau vỏ được tách ra khỏi quả sẽ được phơi dưới ánh nắng mặt trời hoặc sấy khô, rang và sử dụng pha chế như các loại trà thông dụng.', 'https://karablanca.com/wp-content/uploads/2021/01/IMAGE-300x300.jpg'),
('CAS5', 'KRB CÀ PHÊ TRÀ CASCARA', 'TRA', 500, 400000, 'Cascara thường được gọi là cà phê trà hay Cherry Tea Coffee, được làm từ vỏ của quả cà phê chín, sau vỏ được tách ra khỏi quả sẽ được phơi dưới ánh nắng mặt trời hoặc sấy khô, rang và sử dụng pha chế như các loại trà thông dụng.', 'https://karablanca.com/wp-content/uploads/2021/01/IMAGE-300x300.jpg'),
('CLA1', 'KRB CHOCOLATE AROMA', 'CPX', 100, 89000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/127888388_677608816454821_3797852299373836705_n-300x300.jpg'),
('CLA3', 'KRB CHOCOLATE AROMA', 'CPX', 300, 109000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/127888388_677608816454821_3797852299373836705_n-300x300.jpg'),
('CLA5', 'KRB CHOCOLATE AROMA', 'CPX', 500, 139000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/127888388_677608816454821_3797852299373836705_n-300x300.jpg'),
('CLB1', 'KRB CLASSIC BLEND', 'CPX', 100, 89000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/127888388_677608816454821_3797852299373836705_n-300x300.jpg'),
('CLB3', 'KRB CLASSIC BLEND', 'CPX', 300, 109000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/127888388_677608816454821_3797852299373836705_n-300x300.jpg'),
('CLB5', 'KRB CLASSIC BLEND', 'CPX', 500, 139000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/127888388_677608816454821_3797852299373836705_n-300x300.jpg'),
('MAN1', 'KRB MACCADAMIA NUTS', 'MAC', 500, 139000, 'Tách hạt mắc ca và ăn ngay, hoặc có thể lấy nhân hat mắc ca để chế biến những món ngon khác,..', 'https://karablanca.com/wp-content/uploads/2021/07/macca-300x300.jpg'),
('MAN2', 'KRB MACCADAMIA NUTS', 'MAC', 1000, 259000, 'Tách hạt mắc ca và ăn ngay, hoặc có thể lấy nhân hat mắc ca để chế biến những món ngon khác,..', 'https://karablanca.com/wp-content/uploads/2021/07/macca-300x300.jpg'),
('MKA1', 'KRB MOKA AROMA ', 'CPX', 100, 99000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/127888388_677608816454821_3797852299373836705_n-300x300.jpg'),
('MKA3', 'KRB MOKA AROMA ', 'CPX', 300, 119000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/127888388_677608816454821_3797852299373836705_n-300x300.jpg'),
('MKA5', 'KRB MOKA AROMA ', 'CPX', 500, 149000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/127888388_677608816454821_3797852299373836705_n-300x300.jpg'),
('PRB1', 'KRB PREMIUM BLEND', 'CPX', 100, 90000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/128041987_719328759018242_5348186261257388053_n-300x300.jpg'),
('PRB3', 'KRB PREMIUM BLEND', 'CPX', 300, 120000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/128041987_719328759018242_5348186261257388053_n-300x300.jpg'),
('PRB5', 'KRB PREMIUM BLEND', 'CPX', 500, 159000, 'Sô cô la thơm lừng bao bọc hạt Mắc ca bùi béo thiệt ngon – món ăn vặt đắng nhẹ, ngọt ngào không thể thiếu cho mùa Giáng sinh ấm áp, cắn 1 miếng là mê ngay và nhâm nhi với món nước nào cũng hợp đấy.', 'https://karablanca.com/wp-content/uploads/2020/11/128041987_719328759018242_5348186261257388053_n-300x300.jpg'),
('ROB1', 'KRB ROBUSTA', 'CPX', 100, 80000, 'Vị của Robusta nằm trong khoảng từ trung tính cho đến rất gắt. Vị của chúng thường được tả giống như bột yến mạch', 'https://karablanca.com/wp-content/uploads/2020/11/127589886_197428485290540_3926961767136788950_n-300x300.jpg'),
('ROB3', 'KRB ROBUSTA', 'CPX', 300, 105000, 'Vị của Robusta nằm trong khoảng từ trung tính cho đến rất gắt. Vị của chúng thường được tả giống như bột yến mạch', 'https://karablanca.com/wp-content/uploads/2020/11/127589886_197428485290540_3926961767136788950_n-300x300.jpg'),
('ROB5', 'KRB ROBUSTA', 'CPX', 500, 175000, 'Vị của Robusta nằm trong khoảng từ trung tính cho đến rất gắt. Vị của chúng thường được tả giống như bột yến mạch', 'https://karablanca.com/wp-content/uploads/2020/11/127589886_197428485290540_3926961767136788950_n-300x300.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tuongtacsp`
--

CREATE TABLE `tuongtacsp` (
  `masp` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL COMMENT 'mã sản phẩm',
  `date` date NOT NULL COMMENT 'ngày đăng bán sản phẩm',
  `doanhso` int(11) NOT NULL COMMENT 'số lượng sản phẩm đã bán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tuongtacsp`
--

INSERT INTO `tuongtacsp` (`masp`, `date`, `doanhso`) VALUES
('ARA1', '2021-05-21', 200),
('ARA3', '2021-05-21', 200),
('ARA5', '2020-05-20', 200),
('CAS1', '2015-11-21', 30),
('CAS3', '2015-11-21', 30),
('CAS5', '2015-11-21', 30),
('CLA1', '2021-05-21', 80),
('CLA3', '2021-05-21', 80),
('CLA5', '2021-05-21', 200),
('CLB1', '2015-11-21', 80),
('CLB3', '2015-11-21', 80),
('CLB5', '2015-11-21', 80),
('MAN1', '2015-11-21', 80),
('MAN2', '2015-11-21', 80),
('MKA1', '2021-05-21', 200),
('MKA3', '2021-05-21', 200),
('MKA5', '2021-05-21', 200),
('PRB1', '2020-05-20', 100),
('PRB3', '2020-05-20', 100),
('PRB5', '2020-05-20', 100),
('ROB1', '2020-05-20', 100),
('ROB3', '2020-05-20', 100),
('ROB5', '2020-05-20', 100);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `mavoucher` varchar(10) NOT NULL COMMENT 'mã voucher',
  `tile` double(6,2) NOT NULL COMMENT 'tỉ lệ phần trăm được giảm trên mỗi đơn hàng',
  `motavoucher` varchar(300) NOT NULL COMMENT 'mô tả ý nghĩa voucher'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`mavoucher`, `tile`, `motavoucher`) VALUES
('KARANEW', 0.15, 'Giảm 5% cho bạn mới'),
('KARAWEB', 0.30, 'Ưu đãi đặc biệt 30% nhân dịp ra mắt trang web');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdh`
--
ALTER TABLE `chitietdh`
  ADD PRIMARY KEY (`madh`,`masp`),
  ADD KEY `FK_chitietdh_sanpham` (`masp`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`madh`),
  ADD KEY `FK_donhang_voucher` (`mavoucher`),
  ADD KEY `FK_donhang_khachhang` (`makh`),
  ADD KEY `FK_donhang_phivanchuyen` (`maphivc`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`makh`);

--
-- Indexes for table `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`maloaisp`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `phivanchuyen`
--
ALTER TABLE `phivanchuyen`
  ADD PRIMARY KEY (`maphivc`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masp`),
  ADD KEY `FK_sanpham_loaisp` (`maloaisp`);

--
-- Indexes for table `tuongtacsp`
--
ALTER TABLE `tuongtacsp`
  ADD PRIMARY KEY (`masp`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`mavoucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phivanchuyen`
--
ALTER TABLE `phivanchuyen`
  MODIFY `maphivc` int(1) NOT NULL AUTO_INCREMENT COMMENT 'Mã phí vận chuyển', AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdh`
--
ALTER TABLE `chitietdh`
  ADD CONSTRAINT `FK_chitietdh_donhang` FOREIGN KEY (`madh`) REFERENCES `donhang` (`madh`),
  ADD CONSTRAINT `FK_chitietdh_sanpham` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`);

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `FK_donhang_khachhang` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`),
  ADD CONSTRAINT `FK_donhang_phivanchuyen` FOREIGN KEY (`maphivc`) REFERENCES `phivanchuyen` (`maphivc`),
  ADD CONSTRAINT `FK_donhang_voucher` FOREIGN KEY (`mavoucher`) REFERENCES `voucher` (`mavoucher`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `FK_sanpham_loaisp` FOREIGN KEY (`maloaisp`) REFERENCES `loaisp` (`maloaisp`);

--
-- Constraints for table `tuongtacsp`
--
ALTER TABLE `tuongtacsp`
  ADD CONSTRAINT `FK_tuongtacsp_sanpham` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
