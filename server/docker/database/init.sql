CREATE TABLE IF NOT EXISTS `portfolio`
(
    `id`         varchar(255) PRIMARY KEY,
    `created_at` datetime DEFAULT null,
    `updated_at` datetime DEFAULT null
);

CREATE TABLE IF NOT EXISTS `allocation`
(
    `id`           varchar(255) PRIMARY KEY,
    `shares`       integer,
    `portfolio_id` varchar(255) DEFAULT null
);

CREATE TABLE IF NOT EXISTS `order`
(
    `id`            varchar(255) PRIMARY KEY,
    `shares`        integer,
    `type`          varchar(50),
    `state`         varchar(50),
    `created_at`    datetime DEFAULT null,
    `updated_at`    datetime DEFAULT null,
    `portfolio_id`  varchar(255),
    `allocation_id` varchar(255)
);

ALTER TABLE `portfolio`
    ADD CONSTRAINT `pk_portfolio_id` PRIMARY KEY (`id`);
ALTER TABLE `allocation`
    ADD CONSTRAINT `pk_allocation_id` PRIMARY KEY (`id`);
ALTER TABLE `order`
    ADD CONSTRAINT `pk_order_id` PRIMARY KEY (`id`);

ALTER TABLE `order`
    ADD CONSTRAINT `fk_order_portfolio` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolio` (`id`);
ALTER TABLE `order`
    ADD CONSTRAINT `fk_order_allocation` FOREIGN KEY (`allocation_id`) REFERENCES `allocation` (`id`);
ALTER TABLE `allocation`
    ADD CONSTRAINT `fk_allocation_portfolio` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolio` (`id`);
