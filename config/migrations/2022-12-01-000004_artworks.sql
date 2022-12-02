-- ::Up
CREATE TABLE `artwork` (
    `ID` INT NOT NULL AUTO_INCREMENT, 
    `NAME` VARCHAR(50) NOT NULL, 
    `CUSTOMER` VARCHAR(50) NOT NULL, 
    `CUSTOMER_ID` INT NOT NULL, 
    `ATTACHMENT` VARCHAR(255) NOT NULL, 
    `STATUS` VARCHAR(20) NOT NULL, 
    `DEADLINE` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    `CREATED` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    `UPDATED` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (`ID`)
    FOREIGN KEY (CUSTOMER_ID) REFERENCES customers(ID)
);

-- ::Down
DROP TABLE `artwork`;