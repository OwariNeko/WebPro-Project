# Host: 127.0.0.1  (Version 5.7.17-log)
# Date: 2018-05-12 17:58:23
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "admin"
#

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `adminID` varchar(4) NOT NULL DEFAULT '0',
  `adminName` varchar(20) DEFAULT NULL,
  `adminPass` varchar(20) DEFAULT NULL,
  `adminTel` varchar(10) DEFAULT NULL,
  `adminEmail` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "admin"
#

INSERT INTO `admin` VALUES ('1111','admin11','111','215487695','admin11@gmail.com'),('1112','admin22','222','854758124','admin22@gmail.com'),('1113','admin33','333','365987458','admin33@gmail.com'),('1114','admin44','444','895748546','admin44@gmail.com');

#
# Structure for table "produce"
#

DROP TABLE IF EXISTS `produce`;
CREATE TABLE `produce` (
  `productID` varchar(4) NOT NULL DEFAULT '0',
  `productName` varchar(20) DEFAULT NULL,
  `productDetail` varchar(50) DEFAULT NULL,
  `price` int(5) DEFAULT NULL,
  `qoh` int(5) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "produce"
#

INSERT INTO `produce` VALUES ('A001','ซองเอกสาร','ซองใส่เอกสารขนาด A4',300,30,NULL,NULL),('A002','ซองตะข่าย A5','ซองใส่เอกสารลายตะข่ายขนาด A5',100,25,NULL,NULL),('A003','กระเป๋าดินสอ','กระเป๋าดินสอมีซิป',100,20,NULL,NULL),('A004','แก้วน้ำ','แก้วใสสัญลักษณ์ KMITL',250,25,NULL,NULL),('A005','ชุดแก้วกาแฟ','แก้วกาแฟ 2 ใบ + จานลองแก้ว 2 ใบ',720,25,NULL,NULL),('A006','ไทร์','ไทร์สีแสด(ส้มแดง)',300,30,NULL,NULL),('A007','ไทร์พร้อมกล่อง','ไทร์สีแสด(ส้มแดง)+กล่อง',350,30,NULL,NULL),('A008','เข็ม','เข็มกลัดคณะวิทยาศาสตร์ ร.5',200,20,NULL,NULL);

#
# Structure for table "transfer"
#

DROP TABLE IF EXISTS `transfer`;
CREATE TABLE `transfer` (
  `transferID` varchar(4) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `bankName` varchar(20) DEFAULT NULL,
  `bankBranch` varchar(20) DEFAULT NULL,
  `cash` int(11) DEFAULT NULL,
  `transferProof` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`transferID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "transfer"
#


#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `userID` varchar(4) NOT NULL DEFAULT '0',
  `userName` varchar(255) DEFAULT NULL,
  `gender` varchar(4) DEFAULT NULL,
  `location` varchar(75) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `userTel` varchar(10) DEFAULT NULL,
  `userEmail` varchar(20) DEFAULT NULL,
  `userLogin` varchar(20) DEFAULT NULL,
  `userPass` varchar(20) DEFAULT NULL,
  `IDcard` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "user"
#

INSERT INTO `user` VALUES ('1111','นายแดง สีดำ','ชาย','65/8 ซ.5 หมู่ 10 ต.บางงาม อ.ศรีสุข จ.กรุงเทพ','1930-03-26','984571584','ddd@hotmail.com','ddd','ddd','154875948752'),('1112','นางสาวอ่าง สีทอง','หญิง','333/3 ถนนวิภาวดีรังสิต แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร 10900','1962-08-01','854978412','aaa@gmail.com','aaa','aaa','1548726459875'),('1113','นางสาวกัลญา ศรีสุวรรณ','หญิง','2/84 ม.15 แขวงบางจาก เขตพระโขนง กทม.','1978-02-28','874895885','www@hotmail.ac.th','www','www','1548625547523'),('1114','นางสาวพลพรรค กังหัน','หญิง','13 ม.3 ถ.สุราษฎร์ - ปากน้ำตาปี ต.บางกุ้ง อ.เมือง จ.สุราษฎร์ธานี','1988-11-05','958854469','rrr@kmitl.ac.th','rrr','rrr','2354687958458'),('1115','นายมิตร สิริสาร','ชาย','629 ม.2 ต.หนองปลิง อ.เมือง จ.นครสวรรค์ ','1991-11-01','945514453','ooo@gmail.com','ooo','ooo','6548751254458');

#
# Structure for table "order"
#

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `orderID` varchar(4) NOT NULL DEFAULT '0',
  `userID` varchar(4) DEFAULT NULL,
  `location` varchar(75) DEFAULT NULL,
  `transferID` varchar(4) DEFAULT NULL,
  `totalPrice` int(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`orderID`),
  KEY `transferID` (`transferID`),
  KEY `userID` (`userID`),
  CONSTRAINT `transferID` FOREIGN KEY (`transferID`) REFERENCES `transfer` (`transferID`),
  CONSTRAINT `userID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "order"
#


#
# Structure for table "list"
#

DROP TABLE IF EXISTS `list`;
CREATE TABLE `list` (
  `listID` varchar(4) NOT NULL DEFAULT '0',
  `orderID` varchar(4) NOT NULL,
  `productID` varchar(4) DEFAULT NULL,
  `productPrice` int(5) DEFAULT NULL,
  `qty` int(4) DEFAULT NULL,
  `price` int(7) DEFAULT NULL,
  PRIMARY KEY (`listID`,`orderID`),
  KEY `productID` (`productID`),
  KEY `orderID` (`orderID`),
  CONSTRAINT `orderID` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`),
  CONSTRAINT `productID` FOREIGN KEY (`productID`) REFERENCES `produce` (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "list"
#

