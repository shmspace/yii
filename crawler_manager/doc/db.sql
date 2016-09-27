# 创建条目信息表
CREATE TABLE `items` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(64) DEFAULT NULL,
      `adress` varchar(128) DEFAULT NULL,
      `phone` varchar(32) DEFAULT NULL,
      `description` varchar(240) DEFAULT NULL,
      `item_url` varchar(128) DEFAULT NULL,
      `list_url` varchar(128) DEFAULT NULL,
      `category` varchar(64) DEFAULT NULL,
      `crawler` varchar(32) DEFAULT NULL,
      `updated_at` datetime NOT NULL,
      `created_at` datetime NOT NULL,
      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

# 创建爬取xpath类目列表
CREATE TABLE `tasks` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name`    varchar(32) DEFAULT NULL,
    `url`     varchar(128) DEFAULT NULL,
    `crawler` varchar(32) DEFAULT NULL,
    `xpath1`  varchar(240) DEFAULT NULL,
    `xpath2`  varchar(240) DEFAULT NULL,
    `xpath3`  varchar(240) DEFAULT NULL,
    `xpath4`  varchar(240) DEFAULT NULL,
    `updated_at` datetime NOT NULL,
    `created_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

# 创建爬取日志表
CREATE TABLE `crawler_log` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `crawler`    varchar(32) DEFAULT NULL,
    `tasks_id`   int(11) DEFAULT NULL,
    `items_id`   int(11) DEFAULT NULL,
    `item_url`   varchar(128) DEFAULT NULL,
    `task_url`   varchar(128) DEFAULT NULL,
    `logs`       varchar(240) DEFAULT NULL,
    `updated_at` datetime NOT NULL,
    `created_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

# 创建爬取日志表
CREATE TABLE `item_tasks` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `tasks_id`    int(11) DEFAULT NULL,
    `url`   varchar(128) DEFAULT NULL,
    `page_url`   varchar(128) DEFAULT NULL,
    `status`   int(11) DEFAULT NULL,
    `crawler`   varchar(32) DEFAULT NULL,
    `page`   int(11) DEFAULT NULL,
    `updated_at` datetime NOT NULL,
    `created_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

create index id_url on item_tasks(url);
create index id_item_url on items(item_url);

