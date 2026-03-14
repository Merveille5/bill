<?php
/**
 * Database Seeding Script
 * Run this script to populate the database with test data
 * Usage: php seed_database.php
 */

require_once __DIR__ . '/app/config/database.php';

echo "=== Bill Application - Database Seeding ===\n\n";

try {
    // Read the seed data SQL file
    $seedFile = __DIR__ . '/app/config/seed_data.sql';
    
    if (!file_exists($seedFile)) {
        throw new Exception("Seed file not found: $seedFile");
    }
    
    echo "Reading seed data file...\n";
    $sql = file_get_contents($seedFile);
    
    // Remove comments and split SQL into individual statements
    $lines = explode("\n", $sql);
    $cleanedLines = [];
    foreach ($lines as $line) {
        $line = trim($line);
        // Skip empty lines and comment lines
        if (empty($line) || preg_match('/^--/', $line)) {
            continue;
        }
        $cleanedLines[] = $line;
    }
    $cleanedSql = implode("\n", $cleanedLines);
    
    // Split by semicolon but keep multi-line statements together
    $statements = array_filter(
        array_map('trim', explode(';', $cleanedSql)),
        function($stmt) {
            return !empty($stmt) && !preg_match('/^SELECT.*as (message|count)/', $stmt);
        }
    );
    
    echo "Executing " . count($statements) . " SQL statements...\n\n";
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
    
    // Execute each statement
    $successCount = 0;
    foreach ($statements as $statement) {
        try {
            $stmt = $pdo->prepare($statement);
            $stmt->execute();
            $stmt->closeCursor(); // Close cursor to free resources
            $successCount++;
        } catch (PDOException $e) {
            // Ignore errors for statements that might fail (like TRUNCATE on empty tables)
            if (strpos($e->getMessage(), 'TRUNCATE') === false && 
                strpos($e->getMessage(), 'Cannot truncate') === false) {
                echo "Warning: " . $e->getMessage() . "\n";
            }
        }
    }
    
    echo "Successfully executed $successCount statements.\n\n";
    
    // Display summary
    echo "=== Database Summary ===\n";
    
    $result = $pdo->query("SELECT COUNT(*) as count FROM users");
    $count = $result->fetch(PDO::FETCH_ASSOC)['count'];
    echo "✓ Users: $count\n";
    
    $result = $pdo->query("SELECT COUNT(*) as count FROM agents");
    $count = $result->fetch(PDO::FETCH_ASSOC)['count'];
    echo "✓ Agents: $count\n";
    
    $result = $pdo->query("SELECT COUNT(*) as count FROM transactions");
    $count = $result->fetch(PDO::FETCH_ASSOC)['count'];
    echo "✓ Total Transactions: $count\n";
    
    $result = $pdo->query("SELECT COUNT(*) as count FROM transactions WHERE status = 'pending'");
    $count = $result->fetch(PDO::FETCH_ASSOC)['count'];
    echo "  - Pending: $count\n";
    
    $result = $pdo->query("SELECT COUNT(*) as count FROM transactions WHERE status = 'confirmed'");
    $count = $result->fetch(PDO::FETCH_ASSOC)['count'];
    echo "  - Confirmed: $count\n";
    
    $result = $pdo->query("SELECT COUNT(*) as count FROM transactions WHERE status = 'cancelled'");
    $count = $result->fetch(PDO::FETCH_ASSOC)['count'];
    echo "  - Cancelled: $count\n";
    
    $result = $pdo->query("SELECT COUNT(*) as count FROM logs");
    $count = $result->fetch(PDO::FETCH_ASSOC)['count'];
    echo "✓ Logs: $count\n";
    
    $result = $pdo->query("SELECT COUNT(*) as count FROM user_wallets");
    $count = $result->fetch(PDO::FETCH_ASSOC)['count'];
    echo "✓ User Wallets: $count\n";
    
    echo "\n=== Test Accounts ===\n";
    echo "All users have the password: password123\n\n";
    
    $result = $pdo->query("SELECT username, balance, usdt_balance FROM users ORDER BY id");
    $users = $result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $user) {
        echo "Username: {$user['username']}\n";
        echo "  Balance: " . number_format($user['balance'], 2) . " FC\n";
        echo "  USDT: " . number_format($user['usdt_balance'], 8) . " USDT\n\n";
    }
    
    echo "=== Test Agents ===\n";
    $result = $pdo->query("SELECT name, usdt_balance, is_active FROM agents ORDER BY id");
    $agents = $result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($agents as $agent) {
        $status = $agent['is_active'] ? 'Active' : 'Inactive';
        echo "Agent: {$agent['name']} ($status)\n";
        echo "  USDT Balance: " . number_format($agent['usdt_balance'], 8) . " USDT\n\n";
    }
    
    echo "=== Database seeding completed successfully! ===\n";
    echo "\nYou can now:\n";
    echo "1. Login with any username (e.g., john_doe) and password: password123\n";
    echo "2. Access agent dashboard at: http://localhost:8000/agent/dashboard\n";
    echo "3. Access admin dashboard at: http://localhost:8000/admin/dashboard\n";
    echo "4. Test deposits, withdrawals, and conversions\n\n";
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
?>
