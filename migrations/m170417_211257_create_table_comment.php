<?php

use yii\db\Migration;

class m170417_211257_create_table_comment extends Migration
{
    public function up()
    {
        $this->execute("
        CREATE TABLE IF NOT EXISTS `blg_comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `blog_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `comment` VARCHAR(255) NOT NULL,
  `create_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_blg_comment_1_idx` (`blog_id` ASC),
  INDEX `fk_blg_comment_2_idx` (`user_id` ASC),
  CONSTRAINT `fk_blg_comment_1`
    FOREIGN KEY (`blog_id`)
    REFERENCES `mydb`.`blg_blog` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_blg_comment_2`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`blg_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET UTF8;
        ");
    }

    public function down()
    {
        $this->execute("DROP TABLE IF EXISTS `blg_comment`");
    }
}
