CREATE DATABASE shopping;

USE shopping;

CREATE TABLE shoppingList (

    shoppingList_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    shoppingList_title VARCHAR(255) NOT NULL,
    shoppingList_date DATE NOT NULL,
    UNIQUE (shoppingList_title)

);

CREATE TABLE product (

    product_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    UNIQUE (product_name)

);

CREATE TABLE item (

    item_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    qtd float NOT NULL,
    fk_id_product int NOT NULL,
    fk_id_shoppingList int NOT NULL,
    UNIQUE (fk_id_product, fk_id_shoppingList)


);

ALTER TABLE item ADD CONSTRAINT fk_id_product FOREIGN KEY(fk_id_product) REFERENCES product(product_id);
ALTER TABLE item ADD CONSTRAINT fk_id_shoppingList FOREIGN KEY(fk_id_shoppingList) REFERENCES shoppingList(shoppingList_id);
