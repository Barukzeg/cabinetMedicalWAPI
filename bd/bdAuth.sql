CREATE TABLE user_auth(
   login VARCHAR(50),
   mdp VARCHAR(50) NOT NULL,
   id_auth VARCHAR(50) NOT NULL,
   role VARCHAR(50),
   PRIMARY KEY(login),
   UNIQUE(id_auth)
);

ALTER TABLE user_auth MODIFY id_auth int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

INSERT INTO user_auth (login, mdp, id_auth, role) VALUES
('admin', 'pascal', 1, 'admin'),
('secretaire', 'password', 2, 'user');