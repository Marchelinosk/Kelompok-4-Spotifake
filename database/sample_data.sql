CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(225) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabel songs (Master Lagu)
CREATE TABLE IF NOT EXISTS songs (
    id_song INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    artist VARCHAR(150) NOT NULL,
    album VARCHAR(150) NULL,
    genre VARCHAR(100) NULL,
    duration INT NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- 3. Tabel playlists
CREATE TABLE IF NOT EXISTS playlists (
    id_playlist INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    playlist_name VARCHAR(150) NOT NULL,
    description TEXT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);

-- 4. Tabel playlist_songs
CREATE TABLE IF NOT EXISTS playlist_songs (
    id_playlist INT NOT NULL,
    id_song INT NOT NULL,
    added_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_playlist, id_song),
    FOREIGN KEY (id_playlist) REFERENCES playlists(id_playlist) ON DELETE CASCADE,
    FOREIGN KEY (id_song) REFERENCES songs(id_song) ON DELETE CASCADE
);

-- 5. Tabel likes
CREATE TABLE IF NOT EXISTS likes (
    id_user INT NOT NULL,
    id_song INT NOT NULL,
    liked_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_user, id_song),
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_song) REFERENCES songs(id_song) ON DELETE CASCADE
);