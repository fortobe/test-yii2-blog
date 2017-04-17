<?php

use yii\db\Migration;

class m170417_211028_create_table_blog extends Migration
{
    public function up()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `blg_blog` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `article` TEXT NOT NULL,
  `create_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_blg_blog_1_idx` (`user_id` ASC),
  CONSTRAINT `fk_blg_blog_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`blg_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET UTF8;
        ");
    }

    public function down()
    {
        $this->execute("
        DROP TABLE IF EXISTS `blg_blog`
        ");
    }
}
