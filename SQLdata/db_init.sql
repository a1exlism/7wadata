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
  type       INT UNSIGNED NOT NULL,
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
# 一个project 多张表
CREATE TABLE projs (
  proj_id  INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id  INT UNSIGNED NOT NULL,
  excel_id VARCHAR(10) NOT NULL,
  type     INT UNSIGNED NOT NULL
)
  CHARACTER SET = utf8;

# excels demo 动态创建的表给命名1,2,....
# CREATE TABLE excel_id (
#   income_side  INT,
#   expense_side INT,
#   amount       INT
# )
#   CHARACTER SET = utf8;

# privileges
CREATE TABLE user_privilege (
  id        INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id   INT NOT NULL,
  proj_id   INT NOT NULL,
  is_create BOOL         DEFAULT 1,
  is_drop   BOOL         DEFAULT 1,
  is_select BOOL         DEFAULT 1,
  is_alter  BOOL         DEFAULT 1,
  is_insert BOOL         DEFAULT 1,
  is_update BOOL         DEFAULT 1
);

# add an Admin by default (only one)
INSERT INTO users (username, password, is_admin) VALUE (
  'root_admin', '116bcf2f16ee7e433226af275a679caf', 1
);