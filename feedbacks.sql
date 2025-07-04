CREATE TABLE feedbacks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  rollno VARCHAR(20),
  year VARCHAR(20),
  semester VARCHAR(20),
  subject VARCHAR(100),
  rating INT,
  comments TEXT,
  submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
