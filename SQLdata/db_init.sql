SET NAMES "utf8";
USE wadataco_7wadata;

# table users
CREATE TABLE users (
  user_id  INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(40)  NOT NULL,
  password VARCHAR(40)  NOT NULL,
  is_admin BOOLEAN               DEFAULT 0
)
  CHARACTER SET = utf8;

# data query field
CREATE TABLE data_query (
  id         INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  type       VARCHAR(20)  NOT NULL,
  city       VARCHAR(20),
  qq         INT UNSIGNED,
  weixin     VARCHAR(25),
  mobile     INT UNSIGNED,
  phone      INT UNSIGNED,
  real_name  VARCHAR(25),
  id_card    VARCHAR(19),
  content    TEXT         NOT NULL,
  source_url VARCHAR(70)  NOT NULL,
  gmt_create DATETIME     NOT NULL,
  gmt_modify DATETIME     NOT NULL
)
  CHARACTER SET = utf8;

# projects manager
CREATE TABLE projs (
  p_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  u_id INT UNSIGNED NOT NULL ,
  excel_id INT UNSIGNED NOT NULL
)
  CHARACTER SET = utf8;

# excel
CREATE CREATE TABLE excels (
  exc_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,

);
