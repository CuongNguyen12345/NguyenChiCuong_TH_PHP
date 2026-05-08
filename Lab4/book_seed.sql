-- Seed du lieu mau cho Lab4 - Website ban sach
-- Cach dung:
-- 1) Tao database neu chua co: CREATE DATABASE book;
-- 2) Import file nay vao database book
-- 3) Dang nhap admin: username = admin, password = 123456

CREATE DATABASE IF NOT EXISTS `book`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `book`;

DROP TABLE IF EXISTS `tblbooks`;
DROP TABLE IF EXISTS `tblsubject`;
DROP TABLE IF EXISTS `tblusers`;

CREATE TABLE `tblusers` (
  `id_user` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` CHAR(32) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `uk_tblusers_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tblsubject` (
  `id_subject` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_subject` VARCHAR(120) NOT NULL,
  PRIMARY KEY (`id_subject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tblbooks` (
  `id_book` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_subject` INT UNSIGNED NOT NULL,
  `name_book` VARCHAR(255) NOT NULL,
  `price` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `images` VARCHAR(255) DEFAULT '',
  `des` TEXT,
  PRIMARY KEY (`id_book`),
  KEY `idx_tblbooks_subject` (`id_subject`),
  CONSTRAINT `fk_tblbooks_subject`
    FOREIGN KEY (`id_subject`) REFERENCES `tblsubject` (`id_subject`)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tblusers` (`username`, `password`) VALUES
('admin', 'e10adc3949ba59abbe56e057f20f883e'),
('manager', 'e10adc3949ba59abbe56e057f20f883e');

INSERT INTO `tblsubject` (`name_subject`) VALUES
('Lap trinh'),
('Co so du lieu'),
('Thiet ke web'),
('Khoa hoc du lieu'),
('Ky nang mem'),
('Kinh doanh');

INSERT INTO `tblbooks` (`id_subject`, `name_book`, `price`, `images`, `des`) VALUES
(1, 'PHP co ban trong 21 ngay', 129000, '', 'Sach nhap mon PHP cho nguoi moi bat dau, nhieu bai tap thuc hanh.'),
(1, 'Laravel tu co ban den nang cao', 189000, '', 'Huong dan xay dung ung dung web voi Laravel theo du an thuc te.'),
(1, 'Thuc chien JavaScript cho frontend', 175000, '', 'Tong hop ki thuat JS can thiet cho du an giao dien hien dai.'),
(2, 'MySQL can ban va toi uu truy van', 145000, '', 'Gioi thieu SQL, indexing, va cac meo toi uu hieu nang.'),
(2, 'Thiet ke co so du lieu thuc te', 168000, '', 'Phuong phap chuan hoa du lieu va model quan he cho he thong lon.'),
(3, 'HTML CSS cho nguoi moi hoc', 99000, '', 'Noi dung de hieu, minh hoa ro rang, phu hop tu hoc.'),
(3, 'Responsive Web Design Projects', 159000, '', 'Tap trung vao bo cuc responsive va trien khai giao dien da thiet bi.'),
(4, 'Python cho phan tich du lieu', 199000, '', 'Lam quen NumPy, Pandas va cac workflow phan tich co ban.'),
(4, 'Machine Learning nhap mon', 215000, '', 'Giai thich de hieu cac mo hinh hoc may pho bien va cach danh gia mo hinh.'),
(5, 'Giao tiep hieu qua trong doi nhom', 89000, '', 'Ky nang giao tiep va phan hoi giup tang hieu qua cong viec nhom.'),
(5, 'Quan ly thoi gian cho lap trinh vien', 109000, '', 'Ky thuat len ke hoach, uu tien cong viec va giam tri hoan.'),
(6, 'Khoi nghiep tinh gon', 175000, '', 'Tu duy Lean Startup va cach kiem chung gia thuyet kinh doanh.'),
(6, 'Marketing so thuc chien', 182000, '', 'Tong quan kenh digital marketing va cach do luong hieu qua.');
