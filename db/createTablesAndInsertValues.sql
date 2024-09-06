

CREATE TABLE Customers(
  Customer_ID NUMBER(5),
  Fname VARCHAR2(50) NOT NULL,
  Lname VARCHAR2(50) NOT NULL,
  Phone VARCHAR2(20) NOT NULL,
  Passwrd VARCHAR2(50) NOT NULL,
  Email VARCHAR2(100) NOT NULL,
  Address VARCHAR2(200) NOT NULL,
  CONSTRAINT PK_Customers PRIMARY KEY(Customer_Id)
);

INSERT INTO Customers (Customer_ID, Fname, Lname, Phone, Passwrd, email, Address)
VALUES(1, 'Janeth','Sunday', '44-4566-222', 'janethsunday',  'janethsunday@gmail.com', '32, manhathan street, New York');

INSERT INTO Customers (Customer_ID, Fname, Lname, Phone, Passwrd, email, Address)
VALUES(2, 'Lopez','Anthony', '44-4576-2092', 'lopez anthony',  'lopezanthony@gmail.com', '32, Oak Avenue, Manchester')

INSERT INTO Customers (Customer_ID, Fname, Lname, Phone, Passwrd, email, Address)
VALUES(3, '	Benjamin','Taylor', '07798 76543', 'benjamin taylor',  'benjamintaylor@gmail.com', '8, Beech Road, Birmingham')

INSERT INTO Customers (Customer_ID, Fname, Lname, Phone, Passwrd, email, Address)
VALUES(4, 'Charlotte','Wilson', '07654 12398', 'charlottewilson',  'charlottewilson@gmail.com', '27, Pine close, Leeds')

INSERT INTO Customers (Customer_ID, Fname, Lname, Phone, Passwrd, email, Address)
VALUES(5, 'Emilly','Harris', '07676 23490', 'emillyharris',  'emillyharris@gmail.com', '10, Cedar lane, Glasgow')


CREATE TABLE STORES(
 Store_ID VARCHAR2(5) NOT NULL,
 Address VARCHAR2(200)NOT NULL,
 CONSTRAINT PK_Stores PRIMARY KEY(Store_ID)
);

INSERT INTO stores (Store_ID, Address)
VALUES(1, '54, Brandon street, New York');
INSERT INTO stores (Store_ID, Address)
VALUES(2, '10, Cedar lane, Glasgow');
INSERT INTO stores (Store_ID, Address)
VALUES(3, '3, Willow Avenue, Edinburgh');
INSERT INTO stores (Store_ID, Address)
VALUES(4, '5, Ash Street, Bristol');
INSERT INTO stores (Store_ID, Address)
VALUES(5, '22, Poplar Close, Newcastle');


CREATE TABLE Employees (
 Employee_ID NUMBER,
 Employee_Name VARCHAR2(100) NOT NULL,
 Email VARCHAR2(100),
 Address VARCHAR2(200),
 Phone VARCHAR2(20),
 Job_Role VARCHAR2(45),
 Store_ID VARCHAR2(5) NOT NULL,
 CONSTRAINT PK_Employees PRIMARY KEY (Employee_ID),
 CONSTRAINT FK_Employees_Stores FOREIGN KEY (Store_ID) REFERENCES
 Stores(Store_ID)
);

INSERT INTO Employees (Employee_ID, Employee_Name, Email, Address, Phone, Job_Role, Store_id)
VALUES(1, 'Mariam Ahmed', 'mariamahmed@gmail.com', '42, Elm street, London, Greater London',  '+44 7912 345078', 'delivery', 1);

INSERT INTO Employees (Employee_ID, Employee_Name, Email, Address, Phone, Job_Role, Store_id)
VALUES(2, 'Isabella Clark', 'isabellaclark@gmail.com', '4, Sycamore lane, Sheffield',  '07098 765432', 'pickup', 2);

INSERT INTO Employees (Employee_ID, Employee_Name, Email, Address, Phone, Job_Role, Store_id)
VALUES(3, 'Jack Mitchelle', 'jackmitchelle@gmail.com', '18, Birch Road, Liverpool',  '07218 775492', 'pickup', 2);

INSERT INTO Employees (Employee_ID, Employee_Name, Email, Address, Phone, Job_Role, Store_id)
VALUES(4, 'Federick Green', 'federickgreen@gmail.com', '18, Ash Street, Bristol',  '07333 778792', 'delivery', 3);


CREATE TABLE CATEGORIES (
 Category_ID NUMBER,
 Category_Name VARCHAR2(100) NOT NULL,
 Description VARCHAR2(200),
 CONSTRAINT PK_Categories PRIMARY KEY (Category_ID)
);

INSERT INTO CATEGORIES (Category_ID, Category_name, Description)
VALUES(1, 'sofas', 'comfortable seating options commonly found in rooms');

INSERT INTO CATEGORIES (Category_ID, Category_name, Description)
VALUES(2, 'table', 'aestethic pieces of art');

INSERT INTO CATEGORIES (Category_ID, Category_name, Description)
VALUES(3, 'chairs', 'pieces of furniture with four legs made for sitting');




CREATE TABLE SUPPLIERS (
 Supplier_ID NUMBER,
 Supplier_Name VARCHAR2(100) NOT NULL,
 Email VARCHAR2(100),
 Phone VARCHAR2(20) NOT NULL,
 Address VARCHAR2(200) NOT NULL,
 Store_ID VARCHAR2(5) NOT NULL,
 CONSTRAINT PK_Suppliers PRIMARY KEY (Supplier_ID),
 CONSTRAINT FK_Suppliers_Stores FOREIGN KEY (Store_ID) REFERENCES 
 Stores (Store_ID)
);

INSERT INTO Suppliers (Supplier_ID, Supplier_Name, Email, Phone, Address, Store_id)
VALUES(1, 'Taylor Sydney', 'taylorsydney@gmail.com',  '+44 3210 298078', '44, josh street, carlifonia, usa', 1);

INSERT INTO Suppliers (Supplier_ID, Supplier_Name, Email, Phone, Address, Store_id)
VALUES(2, 'Mary Joshua', 'maryjoshua@gmail.com',  '75210 098767', '22, Ash road, Bristol', 2);

INSERT INTO Suppliers (Supplier_ID, Supplier_Name, Email, Phone, Address, Store_id)
VALUES(3, 'Ava Hughes', 'avahughes@gmail.com',  '07332 876590', '22, Ash road, Bristol', 3);

create table FURNITURE (
 Furniture_ID NUMBER(5),
 Furniture_Name VARCHAR2(100) NOT NULL,
 Stock NUMBER,
 Price NUMBER(7, 2) NOT NULL,
 Description VARCHAR2(200),
 Color VARCHAR2(50),
 Manufacturer VARCHAR2(100),
 Ratings NUMBER,
 Image_Url VARCHAR2(200) NOT NULL,
 Weight NUMBER(7, 2) NOT NULL,
 Dimensions VARCHAR2(100) NOT NULL,
 Store_ID VARCHAR2(5),
 Category_ID NUMBER,
 Supplier_ID NUMBER,
 Category_Name VARCHAR2(100) NOT NULL;
 CONSTRAINT PK_Furniture PRIMARY KEY (Furniture_ID),
 CONSTRAINT FK_Furniture_Stores FOREIGN KEY (Store_ID) REFERENCES Stores(Store_ID),
 CONSTRAINT FK_Furniture_Suppliers FOREIGN KEY (Supplier_ID) REFERENCES Suppliers(Supplier_ID),
 CONSTRAINT FK_Furniture_Categories FOREIGN KEY (Category_ID)REFERENCES Categories(Category_ID) 
)

INSERT INTO FURNITURE (Furniture_ID, Furniture_Name, Stock, Price, Description, Color, Weight, Dimensions, Store_ID, Category_ID, Supplier_ID, Image_Url, Manufacturer, Ratings, Category_Name
)
VALUES (1, 'White table', 10, 599.99, 'round table with foldable legs', 'white', 50.5, '80" x 36" x 32"', '1', 1, 1, '23.jpg', 'POLYGON', 5, 'table');

INSERT INTO FURNITURE (Furniture_ID, Furniture_Name, Stock, Price, Description, Color, Weight, Dimensions, Store_ID, Category_ID, Supplier_ID, Image_Url, Manufacturer, Ratings, Category_Name)
VALUES (2, 'Chair', 20, 79.99, 'Swivel Chair', 'Brown', 12.3, '18" x 20" x 36"', '1', 1, 1, '20.jpg', 'Furniture Co.', 4,'chair');

INSERT INTO FURNITURE (Furniture_ID, Furniture_Name, Stock, Price, Description, Color, Weight, Dimensions, Store_ID, Category_ID, Supplier_ID, Image_Url, Manufacturer, Ratings, Category_Name)
VALUES (3, 'rack', 20, 54.99, 'Wooden rack for shoes and what have you', 'Brown', 56.9, '20" x 34" x 36"', '2', 2, 3, '13.jpg', 'Furniture Co.', 4, 'rack');

INSERT INTO FURNITURE (Furniture_ID, Furniture_Name, Stock, Price, Description, Color, Weight, Dimensions, Store_ID, Category_ID, Supplier_ID, Image_Url, Manufacturer, Ratings, Category_Name)
VALUES (4, 'cushion chair', 3, 16.89, 'Cushion chairs for relaxation', 'Brown', 56.9, '67" x 21" x 48"', '2', 2, 3, '17.jpg', 'POLYGON', 5, 'chair');

INSERT INTO FURNITURE (Furniture_ID, Furniture_Name, Stock, Price, Description, Color, Weight, Dimensions, Store_ID, Category_ID, Supplier_ID, Image_Url, Manufacturer, Ratings, Category_Name)
VALUES (5, 'Dining Chair', 7, 21.89, 'Dining chairs for your kitchen', 'white', 56.9, '34" x 43" x 22"', '3', 2, 3, '7.jpg', 'POLYGON', 4, 'chair');

INSERT INTO FURNITURE (Furniture_ID, Furniture_Name, Stock, Price, Description, Color, Weight, Dimensions, Store_ID, Category_ID, Supplier_ID, Image_Url, Manufacturer, Ratings, Category_Name)
VALUES (6, 'Work Desk', 9, 76.49, 'Wooden desk suitable for office and study', 'Brown', 56.9, '20" x 34" x 36"', '3', 1, 3, '34.jpg', 'Furniture Co.', 5, 'desk');

INSERT INTO FURNITURE (Furniture_ID, Furniture_Name, Stock, Price, Description, Color, Weight, Dimensions, Store_ID, Category_ID, Supplier_ID, Image_Url, Manufacturer, Ratings, Category_Name)
VALUES (7, 'Bar Chair', 0, 65.49, 'Chair for restaurants and bars', 'orange', 56.9, '24" x 69" x 21"', '1', 2, 3, '9.jpg', 'POLYGON', 5, 'chair');

INSERT INTO FURNITURE (Furniture_ID, Furniture_Name, Stock, Price, Description, Color, Weight, Dimensions, Store_ID, Category_ID, Supplier_ID, Image_Url, Manufacturer, Ratings, Category_Name)
VALUES (8, 'Bar Chair', 0, 43.79, 'Dining chair for bars, restuarants and kitchen', 'blue', 39.9, '40" x 65" x 21"', '2', 3, 1, '2.jpg', 'Furniture Co.', 4, 'chair');

INSERT INTO FURNITURE (Furniture_ID, Furniture_Name, Stock, Price, Description, Color, Weight, Dimensions, Store_ID, Category_ID, Supplier_ID, Image_Url, Manufacturer, Ratings, Category_Name)
VALUES (9, 'Comfy Recliner', 2, 90.79, 'Comfortable reclinner for relaxation', 'red', 58.89, '10" x 25" x 31"', '3', 2, 3, '12.jpg', 'Furniture Co.', 5, 'chair');

INSERT INTO FURNITURE (Furniture_ID, Furniture_Name, Stock, Price, Description, Color, Weight, Dimensions, Store_ID, Category_ID, Supplier_ID, Image_Url, Manufacturer, Ratings, Category_Name)
VALUES (10, 'Swivel Chair', 10, 33.79, 'Swivel chair to help you and your customers relax ', 'green', 89.59, '90" x 26" x 87"', '2', 3, 1, '24.jpg', 'POLYGON', 5, 'chair');

CREATE TABLE PURCHASES (
  Purchase_ID VARCHAR2(100) NOT NULL,
  Purchase_Date DATE NOT NULL,
  Quantity NUMBER NOT NULL,
  Collection_Arrangement VARCHAR2(100),
  Furniture_ID NUMBER(5),
  Store_ID VARCHAR2(5),
  Customer_ID NUMBER(5),
  Supplier_ID NUMBER,
  Employee_ID NUMBER,
  CONSTRAINT PK_Purchases PRIMARY KEY (Purchase_ID),
  CONSTRAINT FK_Purchases_Furniture FOREIGN KEY (Furniture_ID) REFERENCES FURNITURE (Furniture_ID),
  CONSTRAINT FK_Purchases_Stores FOREIGN KEY (Store_ID) REFERENCES STORES (Store_ID),
  CONSTRAINT FK_Purchases_Customers FOREIGN KEY (Customer_ID) REFERENCES CUSTOMERS (Customer_ID),
  CONSTRAINT FK_Purchases_Suppliers FOREIGN KEY (Supplier_ID) REFERENCES SUPPLIERS (Supplier_ID),
  CONSTRAINT FK_Purchases_Employees FOREIGN KEY (Employee_ID) REFERENCES EMPLOYEES (Employee_ID)
);


INSERT INTO PURCHASES (Purchase_ID, Purchase_Date, Quantity, Collection_Arrangement, Furniture_ID, Store_ID, Customer_ID, Supplier_ID, Employee_ID)
VALUES ('PUR-001', TO_DATE('2022-05-05', 'YYYY-MM-DD'), 1, 'Pickup', 1, 1, 1, 1, 1);

INSERT INTO PURCHASES (Purchase_ID, Purchase_Date, Quantity, Collection_Arrangement, Furniture_ID, Store_ID, Customer_ID, Supplier_ID, Employee_ID)
VALUES ('PUR-002', TO_DATE('2024-02-02', 'YYYY-MM-DD'), 3, 'Pickup', 1, 2, 1, 2, 2);

INSERT INTO PURCHASES (Purchase_ID, Purchase_Date, Quantity, Collection_Arrangement, Furniture_ID, Store_ID, Customer_ID, Supplier_ID, Employee_ID)
VALUES ('PUR-003', TO_DATE('2022-05-05', 'YYYY-MM-DD'), 1, 'Delivery', 2, 2, 2, 1, 3);

INSERT INTO PURCHASES (Purchase_ID, Purchase_Date, Quantity, Collection_Arrangement, Furniture_ID, Store_ID, Customer_ID, Supplier_ID, Employee_ID)
VALUES ('PUR-004', TO_DATE('2022-05-05', 'YYYY-MM-DD'), 1, 'Pickup', 3, 2, 1, 2, 3);

INSERT INTO PURCHASES (Purchase_ID, Purchase_Date, Quantity, Collection_Arrangement, Furniture_ID, Store_ID, Customer_ID, Supplier_ID, Employee_ID)
VALUES ('PUR-005', TO_DATE('2022-05-05', 'YYYY-MM-DD'), 1, 'Delivery', 4, 1, 4, 3, 2);

INSERT INTO PURCHASES (Purchase_ID, Purchase_Date, Quantity, Collection_Arrangement, Furniture_ID, Store_ID, Customer_ID, Supplier_ID, Employee_ID)
VALUES ('PUR-006', TO_DATE('2022-05-05', 'YYYY-MM-DD'), 1, 'Pickup', 5, 1, 3, 1, 1);

INSERT INTO PURCHASES (Purchase_ID, Purchase_Date, Quantity, Collection_Arrangement, Furniture_ID, Store_ID, Customer_ID, Supplier_ID, Employee_ID)
VALUES ('PUR-007', TO_DATE('2022-05-05', 'YYYY-MM-DD'), 1, 'Delivery', 6, 1, 5, 3, 2);

create TABLE ADMINS (
 username VARCHAR2(50) NOT NULL,
 password VARCHAR2(50) NOT NULL,
 CONSTRAINT PK_ADMINS PRIMARY KEY (username)
)

INSERT INTO ADMINS(username, password) VALUES ('kazeem@idea.com', 'kazeem')


COMMIT;