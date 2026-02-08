ALTER TABLE `live`.`cmf_slide`
DROP COLUMN `name`,
ADD COLUMN `position` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '幻灯片位置：1、PC首页大背景图，2、PC首页左小轮图，3PC首页右小轮图，4、PC顶部广告图，5APP首页轮播' AFTER `delete_time`,
ADD UNIQUE INDEX `unq_position`(`position`);

ALTER TABLE `live`.`cmf_slide_item`
ADD COLUMN `click_cnt` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '点击量' AFTER `list_order`;