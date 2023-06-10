-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 21, 2023 lúc 02:34 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_ql_shopbanhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `Id` int(11) NOT NULL,
  `noidung` varchar(255) NOT NULL,
  `ngay` date NOT NULL,
  `mataikhoan` int(11) NOT NULL,
  `masanpham` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`Id`, `noidung`, `ngay`, `mataikhoan`, `masanpham`, `trangthai`) VALUES
(34, 'sản phẩm này rất đẹp', '2023-04-25', 2, 7, 1),
(35, 'sản phẩm rất tốt', '2023-04-25', 2, 12, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `MaHD` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `Size` varchar(255) NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`MaHD`, `MaSP`, `Size`, `SoLuong`) VALUES
(14, 1, 'S', 1),
(14, 2, 'S', 1),
(15, 1, 'L', 1),
(16, 4, 'S', 2),
(16, 8, 'S', 4),
(17, 11, 'S', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmucsanpham`
--

CREATE TABLE `danhmucsanpham` (
  `MaDanhMuc` int(11) NOT NULL,
  `TenDanhMuc` varchar(255) NOT NULL,
  `HinhAnh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmucsanpham`
--

INSERT INTO `danhmucsanpham` (`MaDanhMuc`, `TenDanhMuc`, `HinhAnh`) VALUES
(1, 'Top', '../img/ao.png'),
(2, 'Bottoms', '../img/quan.png'),
(3, 'Outerwear', '../img/aokhoac.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `MaHoaDon` int(11) NOT NULL,
  `NgayLap` date NOT NULL,
  `TenNguoiNhan` varchar(255) NOT NULL,
  `TrangThai` int(11) NOT NULL,
  `SDT` varchar(11) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Ghichu` varchar(255) NOT NULL,
  `ThanhTien` float NOT NULL,
  `Phuongthucthanhtoan` int(11) NOT NULL,
  `mataikhoan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`MaHoaDon`, `NgayLap`, `TenNguoiNhan`, `TrangThai`, `SDT`, `DiaChi`, `Email`, `Ghichu`, `ThanhTien`, `Phuongthucthanhtoan`, `mataikhoan`) VALUES
(14, '2023-05-12', 'Le Thanh Long', 2, '123456', 'Tây Ninh', 'long@gmail.com', '', 800000, 1, 2),
(15, '2023-05-15', 'Tran Vu Kha', 3, '0933026960', 'Tan Phu', 'lethanhlonghufi@gmail.com', 'Giao tai nha', 250000, 1, 2),
(16, '2023-05-16', 'Ngô Thành Tiến', 1, '02541785', 'Gò Chùa', 'lethanhlonghufi@gmail.com', '', 1720000, 1, 2),
(17, '2023-05-18', 'Trần Vũ Kha', 0, '012345685', 'Long An', 'khavu@gmail.com', '', 390000, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSanPham` int(11) NOT NULL,
  `TenSanPham` varchar(255) NOT NULL,
  `GiaNhap` float NOT NULL,
  `GiaBan` float NOT NULL,
  `MaDanhMuc` int(11) NOT NULL,
  `MoTa` varchar(500) NOT NULL,
  `HinhAnh1` varchar(255) NOT NULL,
  `HinhAnh2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSanPham`, `TenSanPham`, `GiaNhap`, `GiaBan`, `MaDanhMuc`, `MoTa`, `HinhAnh1`, `HinhAnh2`) VALUES
(1, 'CAKE TEE 01 MATERIAL: TICI SPANDEX\r\n', 220000, 250000, 1, 'Size và form áo được đo theo chuẩn của người Việt Nam\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\nBảng size nhằm mục đích hướng dẫn và kích thước có tỉ lệ dung size ± 0.5cm\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn.\n', '../img/ao1_1.png', '../img/ao1_2.png'),
(2, 'PROLONG TEE MATERIAL: TICI SPANDEX', 280000, 300000, 1, 'Size và form áo được đo theo chuẩn của người Việt NamNên chọn size lớn hơn nếu bạn thích mặc thoải máiSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kgSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kgSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kgBảng size nhằm mục đích hướng dẫn và kích thước có tỉ lệ dung size ± 0.5cmNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn.', '../img/ao2_1.png', '../img/ao2_2.png'),
(3, 'ROLLING PAINT TEE MATERIAL: TICI SPANDEX\r\n', 220000, 250000, 1, 'Size và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\r\nBảng size nhằm mục đích hướng dẫn và kích thước có tỉ lệ dung size ± 0.5cm\r\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn.\r\n', '../img/ao3_1.png', '../img/ao3_2.png'),
(4, 'ORANGE 02 TEE MATERIAL: COTTON\r\n', 280000, 300000, 1, 'Size và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\r\nBảng size nhằm mục đích hướng dẫn và kích thước có tỉ lệ dung size ± 0.5cm\r\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn\r\n', '../img/ao4_1.png', '../img/ao4_2.png'),
(5, 'WIFI TEE MATERIAL: COTTON\r\n', 220000, 250000, 1, 'Size và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\r\nBảng size nhằm mục đích hướng dẫn và kích thước có tỉ lệ dung size ± 0.5cm\r\n', '../img/ao5_1.png', '../img/ao5_2.png'),
(6, 'BEE TEE MATERIAL: COTTON\r\n', 280000, 300000, 1, 'Size và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\r\nBảng size nhằm mục đích hướng dẫn và kích thước có tỉ lệ dung size ± 0.5cm\r\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn\r\n', '../img/ao6_1.png', '../img/ao6_2.png'),
(7, 'CAKE TEE 02 MATERIAL: TICI SPANDEX\r\n', 220000, 250000, 1, 'Size và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\r\nBảng size nhằm mục đích hướng dẫn và kích thước có tỉ lệ dung size ± 0.5cm\r\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn\r\n', '../img/ao7_1.png', '../img/ao7_2.png'),
(8, 'HARDMODE | ANGLE SHIRT', 100000, 130000, 1, 'Form áo cơ bản, cổ vest cách điệu FIT size theo form và tiêu chuẩn tương đối của người Việt Nam. Nếu bạn đang cân nhắc giữa hai size, nên chọn size lớn hơn\r\nSize M : Chiều cao từ 1m50 – 1m65, cân nặng trên 60kg\r\nSize L : Chiều cao từ 1m65 – 1m75, cân nặng dưới 70kg\r\nSize XL : Chiều cao từ 1m70 – 1m77, cân nặng dưới 85kg\r\n', '../img/ao8_1.png', '../img/ao8_2.png'),
(9, 'HARDMODE | SHARK SHIRT', 100000, 250000, 1, 'Form áo cơ bản, cổ vest cách điệu FIT size theo form và tiêu chuẩn tương đối của người Việt Nam. Nếu bạn đang cân nhắc giữa hai size, nên chọn size lớn hơn\r\nSize M : Chiều cao từ 1m50 – 1m65, cân nặng trên 60kg\r\nSize L : Chiều cao từ 1m65 – 1m75, cân nặng dưới 70kg\r\nSize XL : Chiều cao từ 1m70 – 1m77, cân nặng dưới 85kg\r\n', '../img/ao9_1.png', '../img/ao9_2.png'),
(10, 'HARDMODE | LIGHTNING SHIRT', 220000, 300000, 1, 'Form áo cơ bản, cổ vest cách điệu FIT size theo form và tiêu chuẩn tương đối của người Việt Nam. Nếu bạn đang cân nhắc giữa hai size, nên chọn size lớn hơn\r\nSize M : Chiều cao từ 1m50 – 1m65, cân nặng trên 60kg\r\nSize L : Chiều cao từ 1m65 – 1m75, cân nặng dưới 70kg\r\nSize XL : Chiều cao từ 1m70 – 1m77, cân nặng dưới 85kg\r\n', '../img/ao10_1.png', '../img/ao10_2.png'),
(11, 'Quần Short Đơn Giản Y Nguyên Bản Ver44', 100000, 130000, 2, 'Chất liệu: Kaki Nhung Cotton\r\nThành phần: 55% Cotton 27% Nylon 15% Rayon 3% Spandex\r\nHọa tiết thêu túi sau + Kẹp logo Y ORIGINALS\r\n', '../img/quan1_1.png', '../img/quan1_2.png'),
(12, 'Quần Short Tối Giản Ver14', 100000, 250000, 2, 'Thành phần : 100% Poly\r\nCấu trúc dệt WAFFLE đặc biệt\r\nChống ngăn\r\nMềm mại\r\nTỏa nhiệt bề mặt\r\nCo dãn tốt\r\nHọa tiết thêu\r\n', '../img/quan2_1.png', '../img/quan2_2.png'),
(13, 'Quần Short Đơn Giản Y Nguyên Bản Ver25', 220000, 250000, 2, 'Chất liệu: Kaki\r\nThành phần: 95% Cotton 5% spandex\r\nHọa tiết thêu\r\n', '../img/quan3_1.png', '../img/quan3_2.png'),
(14, 'Quần Short Đơn Giản Y Nguyên Bản Ver48', 100000, 130000, 2, 'Chất liệu: Nylon Spandex\r\nThành phần: 90% Nylon 10% Spandex\r\nHọa tiết in dẻo\r\n', '../img/quan4_1.png', '../img/quan4_2.png'),
(15, 'Quần Tây HG17', 100000, 130000, 2, 'Chất liệu: Vải Quần Tây\r\nThành phần: 82% polyester 14% rayon 4% spandex\r\nMềm mại\r\nThoáng khí\r\nThân thiện với mối trường\r\nHút ẩm tốt\r\n', '../img/quan5_1.png', '../img/quan5_2.png'),
(16, 'Quần Baggy Đơn Giản Y Nguyên Bản Ver14', 220000, 250000, 2, 'Chất liệu: Vải Kaki\r\nThành phần: 76% Polyester 18% Rayon 6% Spandex\r\nHọa tiết gắn logo #Y2010\r\n', '../img/quan6_1.png', '../img/quan6_2.png'),
(17, 'Jean Slimfit 12VAHDT', 100000, 250000, 2, 'Quần Jean Slimfit Thần Cổ Đại Poseidon\r\nChất liệu: Jean Cotton\r\nThành phần: 100% Cotton\r\nHọa tiết thêu túi trước + túi sau\r\n', '../img/quan7_1.png', '../img/quan7_2.png'),
(18, 'Quần Dài Vải Tối Giản M9', 220000, 300000, 2, 'Chất liệu: Kaki Thun\r\nThành phần: 95% Cotton 5% Spandex\r\nHọa tiết may logo\r\n', '../img/quan8_1.png', '../img/quan8_2.png'),
(19, 'Quần Dài Sweatpants Đơn Giản Y Nguyên Bản Ver3', 220000, 300000, 2, 'Chất liệu: Vải Dù\r\nThành phần: 100% poly\r\nCo giãn\r\nVải nhẹ\r\nMềm mịn\r\n', '../img/quan9_1.png', '../img/quan9_2.png'),
(27, 'BASIC HOODIE NEON YELLOW', 350000, 400000, 3, 'FLYING HEART TEE Size và form áo được đo theo chuẩn của người Việt Nam Nên chọn size lớn hơn nếu bạn thích mặc thoải mái \r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg \r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg \r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg Bảng size nhằm mục đích hướng dẫn và khích thước có tỉ lệ dung size ± 0.5cm\r\n', '../img/aokhoac1_1.png', '../img/aokhoac1_2.png'),
(28, 'HOODIE BASIC GREY - GREEN', 400000, 500000, 3, 'FLYING HEART TEE Size và form áo được đo theo chuẩn của người Việt Nam Nên chọn size lớn hơn nếu bạn thích mặc thoải mái \r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg \r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg \r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg Bảng size nhằm mục đích hướng dẫn và khích thước có tỉ lệ dung size ± 0.5cm \r\n', '../img/aokhoac2_1.png', '../img/aokhoac2_2.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham_size`
--

CREATE TABLE `sanpham_size` (
  `masp` int(11) NOT NULL,
  `masize` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham_size`
--

INSERT INTO `sanpham_size` (`masp`, `masize`) VALUES
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(7, 3),
(8, 1),
(8, 2),
(8, 3),
(9, 1),
(9, 2),
(9, 3),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 2),
(15, 1),
(15, 4),
(19, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size`
--

CREATE TABLE `size` (
  `MaSize` int(11) NOT NULL,
  `Size` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `size`
--

INSERT INTO `size` (`MaSize`, `Size`) VALUES
(1, 'S'),
(2, 'L'),
(3, 'XL'),
(4, 'XXL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `HoTen` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `MatKhau` varchar(20) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `DienThoai` varchar(12) NOT NULL,
  `LoaiTaiKhoan` tinyint(4) NOT NULL,
  `TenHienThi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `HoTen`, `Email`, `MatKhau`, `DiaChi`, `DienThoai`, `LoaiTaiKhoan`, `TenHienThi`) VALUES
(1, 'admin', 'lethanhlong@gmail.com', 'admin', 'Tây Ninh', '0933026960', 1, 'Lê Thành Long'),
(2, 'tranvukha', 'khavu@gmail.com', 'kha123', 'Long An', '012345685', 0, 'Trần Vũ Kha'),
(6, 'ngothanhtien', 'tien@gmail.com', 'tien123', '1A Do Nhuan, Son Ky, Tan Phu, TPHCM', '0378215764', 0, 'Ngô Thành Tiến'),
(8, 'thanhninh', 'lethanhlonghufi@gmail.com', 'thanhninh123', 'Thanh Hóa', '0933026960', 0, 'Lê Thanh Ninh');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_bl_tk` (`mataikhoan`),
  ADD KEY `fk_bl_sp` (`masanpham`);

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`MaHD`,`MaSP`,`Size`),
  ADD KEY `fk_sp_cthd` (`MaSP`);

--
-- Chỉ mục cho bảng `danhmucsanpham`
--
ALTER TABLE `danhmucsanpham`
  ADD PRIMARY KEY (`MaDanhMuc`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHoaDon`),
  ADD KEY `fk` (`mataikhoan`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSanPham`),
  ADD KEY `FK_DM_SP` (`MaDanhMuc`);

--
-- Chỉ mục cho bảng `sanpham_size`
--
ALTER TABLE `sanpham_size`
  ADD PRIMARY KEY (`masp`,`masize`),
  ADD KEY `fk_sps_s` (`masize`);

--
-- Chỉ mục cho bảng `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`MaSize`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `HoTen` (`HoTen`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `danhmucsanpham`
--
ALTER TABLE `danhmucsanpham`
  MODIFY `MaDanhMuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MaHoaDon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSanPham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `size`
--
ALTER TABLE `size`
  MODIFY `MaSize` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `fk_bl_sp` FOREIGN KEY (`masanpham`) REFERENCES `sanpham` (`MaSanPham`),
  ADD CONSTRAINT `fk_bl_tk` FOREIGN KEY (`mataikhoan`) REFERENCES `taikhoan` (`id`);

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `fk_hd_cthd` FOREIGN KEY (`MaHD`) REFERENCES `hoadon` (`MaHoaDon`),
  ADD CONSTRAINT `fk_sp_cthd` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSanPham`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `fk` FOREIGN KEY (`mataikhoan`) REFERENCES `taikhoan` (`id`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `FK_DM_SP` FOREIGN KEY (`MaDanhMuc`) REFERENCES `danhmucsanpham` (`MaDanhMuc`);

--
-- Các ràng buộc cho bảng `sanpham_size`
--
ALTER TABLE `sanpham_size`
  ADD CONSTRAINT `fk_sps_s` FOREIGN KEY (`masize`) REFERENCES `size` (`MaSize`),
  ADD CONSTRAINT `fk_sps_sp` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`MaSanPham`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
