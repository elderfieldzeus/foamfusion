<?php
    $primary_key = " INT AUTO_INCREMENT PRIMARY KEY NOT NULL";
    $tables = [
        "Name(
            NameID" . $primary_key . ",
            FirstName VARCHAR(255) NOT NULL,
            LastName VARCHAR(255) NOT NULL,
            MiddleName VARCHAR(255)
        )",

        "Contact(
            ContactID" . $primary_key . ",
            PhoneNum VARCHAR(255) NOT NULL,
            Email VARCHAR(255) NOT NULL,
        )",

        "Address(
            AddressID" . $primary_key . ",
            City VARCHAR(255) NOT NULL,
            Barangay VARCHAR(255) NOT NULL,
            Street VARCHAR(255) NOT NULL,
            PostalCode VARCHAR(255) NOT NULL,
        )",

        "Account(
            AccountID" . $primary_key . ",
            Password VARCHAR(255) NOT NULL,
            Role ENUM('Customer', 'Admin'),
            CreatedAt DATE DEFAULT CURRENT_DATE
        )",

        "Customers(
            CustomerID" . $primary_key . ",
            BirthDate DATE NOT NULL,
            NameID INT NOT NULL,
            ContactID INT NOT NULL,
            AddressID INT NOT NULL,
            AccountID INT NOT NULL,
            FOREIGN KEY(NameID) REFERENCES Name(NameID),
            FOREIGN KEY(ContactID) REFERENCES Contact(ContactID),
            FOREIGN KEY(AddressID) REFERENCES Address(AddressID),
            FOREIGN KEY(AccountID) REFERENCES Account(AccountID),
        )",

        "Products(
            ProductID" . $primary_key . ",
            ProductName VARCHAR(255)
        )",

        "Variations(
            VariationID" . $primary_key . ",
            VariationName VARCHAR(255),
            VariationDescription VARCHAR(255),
            MassInOZ INT NOT NULL,
            ProductID INT NOT NULL,
            FOREIGN KEY(ProductID) REFERENCES Products(ProductID)
        )",

        "Employees(
            EmployeeID" . $primary_key . ",
            BirthDate DATE NOT NULL,
            NameID INT NOT NULL,
            ContactID INT NOT NULL,
            AddressID INT NOT NULL,
            AccountID INT NOT NULL,
            FOREIGN KEY(NameID) REFERENCES Name(NameID),
            FOREIGN KEY(ContactID) REFERENCES Contact(ContactID),
            FOREIGN KEY(AddressID) REFERENCES Address(AddressID),
            FOREIGN KEY(AccountID) REFERENCES Account(AccountID),
        )",

        "Order(
            OrderID" . $primary_key . ",
            OrderTime DATETIME DEFAULT CURRENT_TIMESTAMP,
            OrderStatus ENUM('Pending', 'Failed', 'Success'),
            TotalPrice DECIMAL(10, 2) NOT NULL,
            CustomerID INT NOT NULL,
            FOREIGN KEY(CustomerID) REFERENCES Customers(CustomerID),
        )",

        "Delivery(
            DeliveryID" . $primary_key . ",
            DeliveryTime DATETIME DEFAULT CURRENT_TIMESTAMP,
            DeliveryStatus ENUM('Pending', 'Failed', 'Success'),
            TotalPrice DECIMAL(10, 2) NOT NULL,
            CustomerID INT NOT NULL,
            EmployeeID INT NOT NULL,
            FOREIGN KEY(CustomerID) REFERENCES Customers(CustomerID),
            FOREIGN KEY(EmployeeID) REFERENCES Employees(EmployeeID)
        )",

        ""
    ]

?>