#  from https://gist.github.com/a1exlism/a92459dfd4c92a663910f20e82ebb238
-- new database
CREATE DATABASE wadataco_7wadata;

-- new user && give privileges
GRANT ALL PRIVILEGES ON wadataco_7wadata.*
TO 'wadataco_root'@'localhost'
IDENTIFIED BY 'GelrfSkkz';

-- reload
FLUSH PRIVILEGES;