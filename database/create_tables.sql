USE symfony;

CREATE TABLE cooks
(
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(24)
);

CREATE TABLE dishes
(
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(24),
    cook_id BIGINT UNSIGNED
);

CREATE TABLE receipts
(
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    dish_id TEXT,
    open_date DATETIME
);

INSERT cooks(name)
VALUES ('Gordon Ramsi');

INSERT cooks(name)
VALUES ('Alen Dukas');

INSERT cooks(name)
VALUES ('Volfgan Pak');

INSERT cooks(name)
VALUES ('Anthony Michael');

INSERT cooks(name)
VALUES ('Nobu Matsuhisa');

-- Dishes --
INSERT dishes(name, cook_id)
VALUES ('Baron of Beef', 1);

INSERT dishes(name, cook_id)
VALUES ('Roast beef', 2);

INSERT dishes(name, cook_id)
VALUES ('Yorkshire pudding', 3);

INSERT dishes(name, cook_id)
VALUES ('Panackelty', 4);

INSERT dishes(name, cook_id)
VALUES ('Pork pie', 5);
