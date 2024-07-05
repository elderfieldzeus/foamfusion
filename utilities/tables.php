<?php
    $primary_key = " INT AUTO_INCREMENT PRIMARY KEY NOT NULL";
    $tables = [
        "Name(
            NameID" . $primary_key . ",
            FirstName VARCHAR(255) NOT NULL,
            LastName VARCHAR(255) NOT NULL,
            MiddleName VARCHAR(255)
        )",

        // "Contact(
        //     ContactID" . $primary_key . ",
        //     PhoneNum VARCHAR(255) NOT NULL,
        //     Email VARCHAR(255) NOT NULL
        // )",

        "Address(
            AddressID" . $primary_key . ",
            City VARCHAR(255) NOT NULL,
            Barangay VARCHAR(255) NOT NULL,
            Street VARCHAR(255) NOT NULL,
            PostalCode VARCHAR(255) NOT NULL
        )",

        "Account(
            AccountID" . $primary_key . ",
            Email VARCHAR(255) NOT NULL,
            Password VARCHAR(255) NOT NULL,
            Role ENUM('Customer', 'Admin') DEFAULT 'Customer',
            CreatedAt DATE DEFAULT CURRENT_DATE
        )",

        "Customers(
            CustomerID" . $primary_key . ",
            BirthDate DATE NOT NULL,
            PhoneNum VARCHAR(255) NOT NULL,
            NameID INT NOT NULL,
            AddressID INT NOT NULL,
            AccountID INT NOT NULL,
            FOREIGN KEY(NameID) REFERENCES Name(NameID),
            FOREIGN KEY(AddressID) REFERENCES Address(AddressID),
            FOREIGN KEY(AccountID) REFERENCES Account(AccountID)
        )",

        "Products(
            ProductID" . $primary_key . ",
            ProductName VARCHAR(255)
        )",

        "Variations(
            VariationID" . $primary_key . ",
            VariationName VARCHAR(255),
            VariationDescription VARCHAR(255),
            VariationImage VARCHAR(255),
            MassInOZ DECIMAL(10, 2) NOT NULL,
            UnitPrice DECIMAL(10, 2) NOT NULL,
            InStock INT NOT NULL DEFAULT 0,
            ProductID INT NOT NULL,
            FOREIGN KEY(ProductID) REFERENCES Products(ProductID)
        )",

        "Employees(
            EmployeeID" . $primary_key . ",
            BirthDate DATE NOT NULL,
            PhoneNum VARCHAR(255) NOT NULL,
            NameID INT NOT NULL,
            AddressID INT NOT NULL,
            AccountID INT NOT NULL,
            FOREIGN KEY(NameID) REFERENCES Name(NameID),
            FOREIGN KEY(AddressID) REFERENCES Address(AddressID),
            FOREIGN KEY(AccountID) REFERENCES Account(AccountID)
        )",

        "Orders(
            OrderID" . $primary_key . ",
            OrderTime DATETIME DEFAULT CURRENT_TIMESTAMP,
            OrderStatus ENUM('Failed', 'Pending', 'Success') DEFAULT 'Pending',
            TotalPrice DECIMAL(10, 2) NOT NULL,
            CustomerID INT NOT NULL,
            FOREIGN KEY(CustomerID) REFERENCES Customers(CustomerID)
        )",

        "Deliveries(
            DeliveryID" . $primary_key . ",
            DeliveryTime DATETIME DEFAULT NULL,
            DeliveryStatus ENUM('Failed', 'Pending', 'Success') DEFAULT 'Pending',
            TotalPrice DECIMAL(10, 2) NOT NULL,
            EmployeeID INT NOT NULL,
            OrderID INT NOT NULL,
            FOREIGN KEY(EmployeeID) REFERENCES Employees(EmployeeID),
            FOREIGN KEY(OrderID) REFERENCES Orders(OrderID)
        )",

        "OrderedProducts(
            OrderedProductID" . $primary_key . ",
            OrderedQuantity INT NOT NULL CHECK (OrderedQuantity > 0),
            OrderID INT NOT NULL,
            VariationID INT NOT NULL,
            FOREIGN KEY(OrderID) REFERENCES Orders(OrderID),
            FOREIGN KEY(VariationID) REFERENCES Variations(VariationID)
        )",

        "DeliveredProducts(
            DeliveredProductID" . $primary_key . ",
            DeliveredQuantity INT NOT NULL CHECK (DeliveredQuantity >= 0),
            DeliveryID INT NOT NULL,
            VariationID INT NOT NULL,
            FOREIGN KEY(DeliveryID) REFERENCES Deliveries(DeliveryID),
            FOREIGN KEY(VariationID) REFERENCES Variations(VariationID)
        )"
    ];

?>