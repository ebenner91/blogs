# blogs
IT 328 Blogs Assignment

CREATE TABLE bloggers (
  id INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  image_path VARCHAR(255),
  blog_count INT(3),
  bio TEXT,
  username VARCHAR(255),
  password VARCHAR(255),
  last_post TEXT
  );
  
  CREATE TABLE blogposts (
  id INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  blogger_id INT(3),
  title TEXT,
  blog_post TEXT,
  word_count INT(4),
  post_date TIMESTAMP
  );
