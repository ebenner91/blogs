# blogs
IT 328 Blogs Assignment

CREATE TABLE bloggers (
  id INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fname VARCHAR(50),
  lname VARCHAR(50),
  image_path VARCHAR(255),
  blog_count INT(3)
  );
  
  CREATE TABLE blogposts (
  id INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  blogger_id INT(3),
  blog_post TEXT,
  word_count INT(4),
  post_date TIMESTAMP
  );
