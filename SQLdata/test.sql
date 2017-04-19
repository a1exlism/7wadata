USE wadataco_7wadata;
# excels demo 动态创建的表给命名1,2,....
# user_id: 1 excel no: 1
CREATE TABLE 1_1_1 (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  income_side  INT,
  expense_side INT,
  amount       INT
)
  CHARACTER SET = utf8;

CREATE TABLE 1_2_1 (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  income_side  INT,
  expense_side INT,
  amount       INT
)
  CHARACTER SET = utf8;

CREATE TABLE 2_1_1 (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  income_side  INT,
  expense_side INT,
  amount       INT
)
  CHARACTER SET = utf8;

INSERT projs (user_id, proj_id, excel_id, type) VALUES
  (
    1,
    1,
    '1_1_1',
    1
  ),
  (
    2,
    1,
    '2_1_1',
    1
  ),
  (
    1,
    2,
    '1_2_1',
    1
  );

INSERT user_privilege (user_id, proj_id) VALUES
  (
    1,
    1
  ),
  (
    2,
    1
  );