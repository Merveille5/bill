-- Seed data for testing Bill application
-- Run this after schema.sql to populate the database with test data

-- Clear existing data (optional, comment out if you want to keep existing data)
SET FOREIGN_KEY_CHECKS = 0;
DELETE FROM logs;
DELETE FROM transactions;
DELETE FROM user_wallets;
DELETE FROM agents;
DELETE FROM users;
ALTER TABLE users AUTO_INCREMENT = 1;
ALTER TABLE agents AUTO_INCREMENT = 1;
ALTER TABLE transactions AUTO_INCREMENT = 1;
ALTER TABLE logs AUTO_INCREMENT = 1;
ALTER TABLE user_wallets AUTO_INCREMENT = 1;
SET FOREIGN_KEY_CHECKS = 1;

-- Insert test users
-- Password for all users: password123 (hashed with password_hash())
INSERT INTO users (id, username, password, balance, usdt_balance, created_at) VALUES
(1, 'john_doe', '$2y$10$dc6xtnV7G1m1WmlTkLWx4evJbm59GEgsw0IusL3hcZIGK5LLe8abC', 50000.00, 100.50000000, '2024-01-15 10:00:00'),
(2, 'jane_smith', '$2y$10$dc6xtnV7G1m1WmlTkLWx4evJbm59GEgsw0IusL3hcZIGK5LLe8abC', 125000.00, 250.75000000, '2024-01-20 14:30:00'),
(3, 'bob_martin', '$2y$10$dc6xtnV7G1m1WmlTkLWx4evJbm59GEgsw0IusL3hcZIGK5LLe8abC', 75000.00, 50.25000000, '2024-02-01 09:15:00'),
(4, 'alice_wonder', '$2y$10$dc6xtnV7G1m1WmlTkLWx4evJbm59GEgsw0IusL3hcZIGK5LLe8abC', 200000.00, 500.00000000, '2024-02-10 16:45:00'),
(5, 'charlie_brown', '$2y$10$dc6xtnV7G1m1WmlTkLWx4evJbm59GEgsw0IusL3hcZIGK5LLe8abC', 30000.00, 25.00000000, '2024-02-15 11:20:00');

-- Insert test agents
INSERT INTO agents (id, name, airtel_phone, orange_phone, vodacom_phone, afrimoney_phone, usdt_balance, is_active, created_at) VALUES
(1, 'Jean Kabongo', '+243811234567', '+243822345678', '+243833456789', '+243844567890', 2500.50000000, TRUE, '2024-01-01 08:00:00'),
(2, 'Marie Tshimanga', '+243811111222', '+243822222333', '+243833333444', '+243844444555', 3200.75000000, TRUE, '2024-01-05 09:30:00'),
(3, 'Pierre Mukendi', '+243815555666', '+243826666777', '+243837777888', '+243848888999', 1800.25000000, TRUE, '2024-01-10 10:15:00'),
(4, 'Sophie Kalala', '+243819999000', '+243820000111', '+243831111222', '+243842222333', 4100.00000000, FALSE, '2024-01-15 11:45:00');

-- Insert test user wallets (TRON addresses)
INSERT INTO user_wallets (user_id, tron_address, created_at) VALUES
(1, 'TXYZa1b2c3d4e5f6g7h8i9j0k1l2m3n4o5', '2024-01-15 10:05:00'),
(2, 'TABCd1e2f3g4h5i6j7k8l9m0n1o2p3q4r5', '2024-01-20 14:35:00'),
(3, 'TDEFg1h2i3j4k5l6m7n8o9p0q1r2s3t4u5', '2024-02-01 09:20:00'),
(4, 'TGHIj1k2l3m4n5o6p7q8r9s0t1u2v3w4x5', '2024-02-10 16:50:00'),
(5, 'TJKLm1n2o3p4q5r6s7t8u9v0w1x2y3z4a5', '2024-02-15 11:25:00');

-- Insert test transactions (mix of pending, confirmed, and cancelled)
INSERT INTO transactions (user_id, type, amount, currency, operator, status, agent_id, created_at, confirmed_at) VALUES
-- Confirmed deposits
(1, 'deposit', 25000.00, 'FC', 'Airtel Money', 'confirmed', 1, '2024-03-01 10:00:00', '2024-03-01 10:15:00'),
(1, 'deposit', 50.00000000, 'USDT', NULL, 'confirmed', 1, '2024-03-02 11:30:00', '2024-03-02 11:45:00'),
(2, 'deposit', 50000.00, 'FC', 'Orange Money', 'confirmed', 2, '2024-03-03 09:00:00', '2024-03-03 09:20:00'),
(3, 'deposit', 30000.00, 'FC', 'Vodacom M-Pesa', 'confirmed', 1, '2024-03-04 14:00:00', '2024-03-04 14:10:00'),
(4, 'deposit', 100.00000000, 'USDT', NULL, 'confirmed', 2, '2024-03-05 16:00:00', '2024-03-05 16:15:00'),

-- Confirmed withdrawals
(2, 'withdrawal', 20000.00, 'FC', 'Airtel Money', 'confirmed', 1, '2024-03-06 10:30:00', '2024-03-06 10:45:00'),
(3, 'withdrawal', 15000.00, 'FC', 'Orange Money', 'confirmed', 2, '2024-03-07 13:00:00', '2024-03-07 13:20:00'),
(4, 'withdrawal', 50.00000000, 'USDT', NULL, 'confirmed', 1, '2024-03-08 15:30:00', '2024-03-08 15:45:00'),

-- Confirmed conversions
(1, 'convert', 10000.00, 'FC', NULL, 'confirmed', NULL, '2024-03-09 11:00:00', '2024-03-09 11:00:00'),
(2, 'convert', 25000.00, 'FC', NULL, 'confirmed', NULL, '2024-03-10 12:30:00', '2024-03-10 12:30:00'),
(3, 'convert', 20.00000000, 'USDT', NULL, 'confirmed', NULL, '2024-03-11 14:00:00', '2024-03-11 14:00:00'),

-- Pending transactions (for agent dashboard testing)
(1, 'deposit', 15000.00, 'FC', 'Airtel Money', 'pending', 1, '2024-03-13 09:00:00', NULL),
(2, 'deposit', 30000.00, 'FC', 'Orange Money', 'pending', 1, '2024-03-13 10:30:00', NULL),
(3, 'withdrawal', 10000.00, 'FC', 'Vodacom M-Pesa', 'pending', 2, '2024-03-13 11:00:00', NULL),
(4, 'deposit', 75.00000000, 'USDT', NULL, 'pending', 2, '2024-03-13 13:30:00', NULL),
(5, 'deposit', 20000.00, 'FC', 'Afrimoney', 'pending', 1, '2024-03-13 14:00:00', NULL),
(5, 'withdrawal', 5000.00, 'FC', 'Airtel Money', 'pending', 1, '2024-03-13 15:30:00', NULL),

-- Cancelled transactions
(1, 'deposit', 5000.00, 'FC', 'Orange Money', 'cancelled', 1, '2024-03-12 10:00:00', NULL),
(3, 'withdrawal', 8000.00, 'FC', 'Airtel Money', 'cancelled', 2, '2024-03-12 14:30:00', NULL);

-- Insert test logs
INSERT INTO logs (user_id, action, created_at) VALUES
(1, 'Connexion réussie', '2024-03-13 08:00:00'),
(1, 'Dépôt de 25000 FC via Airtel Money', '2024-03-01 10:00:00'),
(1, 'Dépôt de 50 USDT confirmé', '2024-03-02 11:45:00'),
(1, 'Conversion de 10000 FC en USD', '2024-03-09 11:00:00'),
(1, 'Demande de dépôt de 15000 FC via Airtel Money', '2024-03-13 09:00:00'),
(2, 'Connexion réussie', '2024-03-13 08:30:00'),
(2, 'Dépôt de 50000 FC via Orange Money', '2024-03-03 09:00:00'),
(2, 'Retrait de 20000 FC via Airtel Money', '2024-03-06 10:30:00'),
(2, 'Conversion de 25000 FC en USD', '2024-03-10 12:30:00'),
(2, 'Demande de dépôt de 30000 FC via Orange Money', '2024-03-13 10:30:00'),
(3, 'Connexion réussie', '2024-03-13 09:00:00'),
(3, 'Dépôt de 30000 FC via Vodacom M-Pesa', '2024-03-04 14:00:00'),
(3, 'Retrait de 15000 FC via Orange Money', '2024-03-07 13:00:00'),
(3, 'Conversion de 20 USDT en FC', '2024-03-11 14:00:00'),
(3, 'Demande de retrait de 10000 FC via Vodacom M-Pesa', '2024-03-13 11:00:00'),
(4, 'Connexion réussie', '2024-03-13 09:30:00'),
(4, 'Dépôt de 100 USDT confirmé', '2024-03-05 16:15:00'),
(4, 'Retrait de 50 USDT confirmé', '2024-03-08 15:45:00'),
(4, 'Demande de dépôt de 75 USDT', '2024-03-13 13:30:00'),
(5, 'Connexion réussie', '2024-03-13 10:00:00'),
(5, 'Demande de dépôt de 20000 FC via Afrimoney', '2024-03-13 14:00:00'),
(5, 'Demande de retrait de 5000 FC via Airtel Money', '2024-03-13 15:30:00');

-- Update config with current exchange rates
UPDATE config SET value = '2300' WHERE key_name = 'usd_to_fc_rate';
UPDATE config SET value = '0.000434782608695652' WHERE key_name = 'fc_to_usd_rate';

-- Display summary
SELECT 'Database seeded successfully!' as message;
SELECT COUNT(*) as total_users FROM users;
SELECT COUNT(*) as total_agents FROM agents;
SELECT COUNT(*) as total_transactions FROM transactions;
SELECT COUNT(*) as pending_transactions FROM transactions WHERE status = 'pending';
SELECT COUNT(*) as confirmed_transactions FROM transactions WHERE status = 'confirmed';
SELECT COUNT(*) as total_logs FROM logs;
