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
  id         INT UNSIGNED                            NOT NULL AUTO_INCREMENT PRIMARY KEY,
  type       INT UNSIGNED                            NOT NULL,
  city       VARCHAR(25),
  qq         VARCHAR(20),
  weixin     VARCHAR(25),
  mobile     CHAR(11),
  phone      VARCHAR(16),
  real_name  VARCHAR(25),
  id_card    VARCHAR(25),
  content    TEXT                                    NOT NULL,
  source_url VARCHAR(2048)                           NOT NULL,
  gmt_create TIMESTAMP DEFAULT '1971-01-01 00:00:02' NOT NULL,
  gmt_modify TIMESTAMP DEFAULT '1971-01-01 00:00:03' NOT NULL
)
  CHARACTER SET = utf8;

# projects manager
# 一个project 多张表
# type 默认为 0 用来判断excel数
CREATE TABLE projs (
  id       INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id  INT UNSIGNED NOT NULL,
  proj_id  INT UNSIGNED NOT NULL,
  excel_id VARCHAR(10)  NOT NULL,
  type     INT UNSIGNED          DEFAULT 0
)
  CHARACTER SET = utf8;

# record projects' details
CREATE TABLE proj_details (
  id               INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id          INT UNSIGNED NOT NULL,
  proj_id          INT UNSIGNED NOT NULL,
  proj_name        VARCHAR(20)  NOT NULL,
  proj_description TEXT
)
  CHARACTER SET = utf8;

# excels demo 动态创建的表给命名1,2,....
# excel_id = user_id.'_'.proj_id.'_'.ExcelNO;
# CREATE TABLE excel_id (
#   id INT AUTO_INCREMENT PRIMARY KEY ,
#   income_side  INT,
#   expense_side INT,
#   amount       INT
# )
#   CHARACTER SET = utf8;

# privileges
CREATE TABLE user_privilege (
  id         INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id    INT NOT NULL,
  is_manage  BOOL         DEFAULT 0,
  # for the user privileges with projects manager
  is_upload  BOOL         DEFAULT 0,
  is_query   BOOL         DEFAULT 0,
  is_graphic BOOL         DEFAULT 0
)
  CHARACTER SET = utf8;

# add an Admin by default (only one)
INSERT INTO users (user_id, username, password, is_admin) VALUE (
  1, 'root_admin', 'd667ede05ea3254fe70ccfe0a3963099', 1
);

INSERT INTO user_privilege (user_id) VALUE (
  1
);