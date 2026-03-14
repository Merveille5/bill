CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    balance DECIMAL(15,2) NOT NULL DEFAULT 0,
    usdt_balance DECIMAL(15,8) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS user_wallets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tron_address VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS agents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    airtel_phone VARCHAR(20),
    orange_phone VARCHAR(20),
    vodacom_phone VARCHAR(20),
    afrimoney_phone VARCHAR(20),
    usdt_balance DECIMAL(15,8) NOT NULL DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type ENUM('deposit','withdrawal','convert') NOT NULL,
    amount DECIMAL(15,2) NOT NULL,
    currency VARCHAR(10) NOT NULL DEFAULT 'FC',
    operator VARCHAR(50) DEFAULT NULL,
    status ENUM('pending','confirmed','cancelled') DEFAULT 'pending',
    agent_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    confirmed_at TIMESTAMP NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_agent_id (agent_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (agent_id) REFERENCES agents(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS config (
    id INT AUTO_INCREMENT PRIMARY KEY,
    key_name VARCHAR(50) NOT NULL UNIQUE,
    value VARCHAR(255) NOT NULL,
    description TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Taux de change par défaut : 1 USD = 2300 FC
INSERT INTO config (key_name, value, description) VALUES
('usd_to_fc_rate', '2300', 'Taux de change USD vers Franc Congolais'),
('fc_to_usd_rate', '0.000434782608695652', 'Taux de change Franc Congolais vers USD (calculé automatiquement)');

CREATE TABLE IF NOT EXISTS logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_log_user_id (user_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample agents
INSERT INTO agents (name, airtel_phone, orange_phone, vodacom_phone, afrimoney_phone, usdt_balance) VALUES
('Jean Agent', '+243811111111', '+243822222222', '+243833333333', '+243844444444', 1000.00),
('Marie Agent', '+243811111112', '+243822222223', '+243833333334', '+243844444445', 1500.00);

-- Mise à jour de la table transactions existante
ALTER TABLE transactions MODIFY COLUMN currency VARCHAR(10) NOT NULL DEFAULT 'FC';
ALTER TABLE transactions ADD COLUMN IF NOT EXISTS status ENUM('pending','confirmed','cancelled') DEFAULT 'pending';
ALTER TABLE transactions ADD COLUMN IF NOT EXISTS agent_id INT;
ALTER TABLE transactions ADD COLUMN IF NOT EXISTS confirmed_at TIMESTAMP NULL;
ALTER TABLE transactions ADD INDEX IF NOT EXISTS idx_agent_id (agent_id);
ALTER TABLE transactions ADD CONSTRAINT fk_transactions_agent_id FOREIGN KEY IF NOT EXISTS (agent_id) REFERENCES agents(id) ON DELETE SET NULL;
