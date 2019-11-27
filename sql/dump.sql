CREATE TABLE `metadata`
(
    `key`   varchar(255) NOT NULL,
    `value` varchar(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `metadata` (`key`, `value`)
VALUES ('name', 'Happy Writer Webshop');
INSERT INTO `metadata` (`key`, `value`)
VALUES ('version', '1.0');




CREATE TABLE `article`
(
    `id`             int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name`           varchar(255)  DEFAULT NULL,
    `description`    varchar(255)  DEFAULT NULL,
    `price`          decimal(5, 2) DEFAULT NULL,
    `icon`      varchar(255)  DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `article` (`id`, `name`, `description`, `price`, `icon`)
VALUES (1, 'Holzetui', 'Ein Etui aus Holz', 15.00, NULL),
       (2, 'Stoffetui', 'Ein Etui aus Stoff', 10.00, NULL);




CREATE TABLE `configuration`
(
    `id`         int(11) unsigned NOT NULL AUTO_INCREMENT,
    `article_id` int(11) DEFAULT NULL,
    `content_id` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;




CREATE TABLE `content`
(
    `id`             int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name`           int(11)       DEFAULT NULL,
    `description`    varchar(255)  DEFAULT NULL,
    `price`          decimal(5, 2) DEFAULT NULL,
    `icon`      varchar(255)  DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `content` (`id`, `name`, `description`, `price`, `icon`)
VALUES (1, 'Bleistift', 'Ein Bleistift aus Holz', 1.50, NULL),
       (2, 'Kugelschreiber', 'Ein Kugelschreiber mit schwarzer Tinte', 2.50, NULL),
       (3, 'Schere', 'Eine kleine Schere, passend für jedes Etui', 5.50, NULL);




CREATE TABLE `customer`
(
    `id`             int(11) unsigned NOT NULL AUTO_INCREMENT,
    `firstname`      varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
    `lastname`       varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
    `street`         varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
    `city`           varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
    `zipcode`        int(4)                            DEFAULT NULL,
    `telephone`      int(10)                           DEFAULT NULL,
    `customer_since` timestamp        NULL             DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = utf8;




CREATE TABLE `order`
(
    `id`          int(11) unsigned NOT NULL AUTO_INCREMENT,
    `customer_id` int(11)      DEFAULT NULL,
    `date`        datetime     DEFAULT NULL,
    `annotations` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;




CREATE TABLE `order_configuration`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;




CREATE TABLE `order_position`
(
    `id`         int(11) unsigned NOT NULL AUTO_INCREMENT,
    `order_id`   int(11) DEFAULT NULL,
    `article_id` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;