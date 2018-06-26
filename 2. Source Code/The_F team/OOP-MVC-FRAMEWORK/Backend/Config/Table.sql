CREATE TABLE ADMIN
(
    id int PRIMARY key AUTO_INCREMENT,
    Admin_Id varchar(40),
    Admin_Name varchar(40),
    Admin_Phone varchar(15),
    Admin_Mail varchar(40),
    Admin_User_Name varchar(40),
    Admin_Password varchar(41),
    create_time datetime,
    update_time datetime
);
CREATE TABLE PRODUCT
(
	id int PRIMARY key AUTO_INCREMENT,
	Product_Id varchar(40),
	Product_Name varchar(40),
	Product_Cost bigint,
	Product_Instock smallint,
	Product_Description text,
	create_time datetime,
    update_time datetime
);
CREATE TABLE PRODUCT_IMAGES
(
	id int PRIMARY key AUTO_INCREMENT,
	Product_Id varchar(40),
	product_image_link 	text
);
CREATE TABLE CUSTOMER
(
	id int PRIMARY key AUTO_INCREMENT,
	Customer_Id varchar(40),
	Customer_Name varchar(40),
	Customer_Phone varchar(15),
	Customer_Mail varchar(40),
	Customer_Address text,
	create_time datetime,
    update_time datetime
);
CREATE TABLE INVOICE
(
	id int PRIMARY key AUTO_INCREMENT,
	Invoice_Id varchar(40),
	Customer_Id varchar(40),
	Note text,
	create_time datetime,
    update_time datetime
);
CREATE TABLE INVOICE_ITEM
(
	id int PRIMARY key AUTO_INCREMENT,
	Invoice_Id varchar(40),
	Product_Id varchar(40),
	Quantity smallint,
	Customer_Id varchar(40),
	create_time datetime,
    update_time datetime
);