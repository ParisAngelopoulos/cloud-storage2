-- Database of Cloud Storage (SQLite). Created automatically by db.php the first time
-- private/database.sqlite does not exist yet.
-- All example accounts have the password "welkom123", the admin has "admin123".

CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(20) DEFAULT 'user'
);

CREATE TABLE files (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  file_name VARCHAR(255) NOT NULL,
  file_path VARCHAR(255) NOT NULL,
  uploaded_by INTEGER NOT NULL REFERENCES users (id) ON DELETE CASCADE,
  upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX files_uploaded_by ON files (uploaded_by);

CREATE TABLE shared_files (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  file_name VARCHAR(255) NOT NULL,
  shared_with INTEGER NOT NULL,
  shared_with_email VARCHAR(255) DEFAULT NULL,
  shared_by INTEGER NOT NULL,
  shared_by_name VARCHAR(255) NOT NULL
);
CREATE INDEX shared_files_shared_with ON shared_files (shared_with);

INSERT INTO users (id, username, email, password, role) VALUES
(1, 'admin', 'admin@voorbeeld.nl', '$2y$10$vG0ZdRCbBKa5nVToUotrhOxBOHQe2u3lYKDPjQ379RsArGEwl9D2a', 'admin'),
(2, 'paris', 'paris@voorbeeld.nl', '$2y$10$IMPAPY9Fi.iifo0SPHWkm.YJrpSPw7R1sv/kUZg9Y/rA45Y2jv/mS', 'user'),
(3, 'sanne', 'sanne@voorbeeld.nl', '$2y$10$IMPAPY9Fi.iifo0SPHWkm.YJrpSPw7R1sv/kUZg9Y/rA45Y2jv/mS', 'user'),
(4, 'daan', 'daan@voorbeeld.nl', '$2y$10$IMPAPY9Fi.iifo0SPHWkm.YJrpSPw7R1sv/kUZg9Y/rA45Y2jv/mS', 'user');

INSERT INTO files (id, file_name, file_path, uploaded_by, upload_date) VALUES
(1, 'cv-paris-angelopoulos.pdf', 'uploads/cv-paris-angelopoulos.pdf', 2, '2025-03-03 10:15:00'),
(2, 'vakantiefoto-kreta.png', 'uploads/vakantiefoto-kreta.png', 2, '2025-03-05 19:40:00'),
(3, 'rooster-week-12.pdf', 'uploads/rooster-week-12.pdf', 3, '2025-03-10 08:05:00'),
(4, 'notulen-projectgroep.pdf', 'uploads/notulen-projectgroep.pdf', 3, '2025-03-11 16:30:00'),
(5, 'logo-ontwerp.png', 'uploads/logo-ontwerp.png', 4, '2025-03-12 13:20:00');

INSERT INTO shared_files (id, file_name, shared_with, shared_with_email, shared_by, shared_by_name) VALUES
(1, 'rooster-week-12.pdf', 2, 'paris@voorbeeld.nl', 3, 'sanne'),
(2, 'notulen-projectgroep.pdf', 2, 'paris@voorbeeld.nl', 3, 'sanne'),
(3, 'logo-ontwerp.png', 2, 'paris@voorbeeld.nl', 4, 'daan'),
(4, 'vakantiefoto-kreta.png', 4, 'daan@voorbeeld.nl', 2, 'paris'),
(5, 'notulen-projectgroep.pdf', 4, 'daan@voorbeeld.nl', 3, 'sanne');
