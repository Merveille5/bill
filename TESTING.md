# Guide de Test - Bill P2P Application

## Installation et Configuration

### 1. Créer la base de données

```sql
CREATE DATABASE billp2p CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 2. Importer le schéma

```bash
mysql -u root -p billp2p < app/config/schema.sql
```

### 3. Remplir avec des données de test

```bash
php seed_database.php
```

## Comptes de Test

Tous les utilisateurs ont le même mot de passe : **password123**

### Utilisateurs

| Username | Balance FC | Balance USDT | Description |
|----------|-----------|--------------|-------------|
| john_doe | 50,000.00 | 100.50 | Utilisateur standard avec solde moyen |
| jane_smith | 125,000.00 | 250.75 | Utilisateur avec solde élevé |
| bob_martin | 75,000.00 | 50.25 | Utilisateur standard |
| alice_wonder | 200,000.00 | 500.00 | Utilisateur VIP avec solde très élevé |
| charlie_brown | 30,000.00 | 25.00 | Utilisateur avec petit solde |

### Agents

| Nom | Balance USDT | Statut | ID |
|-----|-------------|--------|-----|
| Jean Kabongo | 2,500.50 | Actif | 1 |
| Marie Tshimanga | 3,200.75 | Actif | 2 |
| Pierre Mukendi | 1,800.25 | Actif | 3 |
| Sophie Kalala | 4,100.00 | Inactif | 4 |

## Données de Test Disponibles

### Transactions

- **19 transactions au total**
  - 11 confirmées (dépôts, retraits, conversions)
  - 6 en attente (pour tester le dashboard agent)
  - 2 annulées

### Transactions en Attente (pour tester le dashboard agent)

1. **john_doe** - Dépôt de 15,000 FC via Airtel Money (Agent 1)
2. **jane_smith** - Dépôt de 30,000 FC via Orange Money (Agent 1)
3. **bob_martin** - Retrait de 10,000 FC via Vodacom M-Pesa (Agent 2)
4. **alice_wonder** - Dépôt de 75 USDT (Agent 2)
5. **charlie_brown** - Dépôt de 20,000 FC via Afrimoney (Agent 1)
6. **charlie_brown** - Retrait de 5,000 FC via Airtel Money (Agent 1)

### Logs

22 entrées de logs pour tester l'historique des actions utilisateurs.

## Scénarios de Test

### 1. Test de Connexion

```
URL: http://localhost:8000/auth/login
Username: john_doe
Password: password123
```

### 2. Test du Dashboard Utilisateur

Après connexion, vous devriez voir:
- Solde en FC et USDT
- Historique des transactions
- Options de dépôt, retrait et conversion

### 3. Test du Dashboard Agent

```
URL: http://localhost:8000/agent/dashboard
```

Vous devriez voir:
- Informations de l'agent (Jean Kabongo par défaut)
- 6 transactions en attente
- Options pour confirmer ou annuler les transactions

### 4. Test de Dépôt

1. Connectez-vous avec un utilisateur
2. Allez sur "Dépôt"
3. Choisissez un opérateur (Airtel, Orange, Vodacom, Afrimoney)
4. Entrez un montant
5. La transaction sera créée en statut "pending"
6. Allez sur le dashboard agent pour la confirmer

### 5. Test de Retrait

1. Connectez-vous avec un utilisateur ayant un solde
2. Allez sur "Retrait"
3. Choisissez un opérateur
4. Entrez un montant (inférieur au solde)
5. La transaction sera créée en statut "pending"
6. Allez sur le dashboard agent pour la confirmer

### 6. Test de Conversion

1. Connectez-vous avec un utilisateur
2. Allez sur "Conversion"
3. Choisissez le type de conversion (FC → USD ou USD → FC)
4. Entrez un montant
5. La conversion est instantanée (pas besoin de confirmation agent)

### 7. Test du Dashboard Admin

```
URL: http://localhost:8000/admin/dashboard
```

Vous devriez voir:
- Statistiques globales
- Liste de tous les utilisateurs
- Liste de toutes les transactions
- Configuration des taux de change

## Taux de Change par Défaut

- **1 USD = 2,300 FC**
- **1 FC = 0.000434782608695652 USD**

## Opérateurs Mobile Money Disponibles

1. **Airtel Money** - +243811234567
2. **Orange Money** - +243822345678
3. **Vodacom M-Pesa** - +243833456789
4. **Afrimoney** - +243844567890

## Adresses TRON de Test

Chaque utilisateur a une adresse TRON unique pour les transactions USDT:

- john_doe: TXYZa1b2c3d4e5f6g7h8i9j0k1l2m3n4o5
- jane_smith: TABCd1e2f3g4h5i6j7k8l9m0n1o2p3q4r5
- bob_martin: TDEFg1h2i3j4k5l6m7n8o9p0q1r2s3t4u5
- alice_wonder: TGHIj1k2l3m4n5o6p7q8r9s0t1u2v3w4x5
- charlie_brown: TJKLm1n2o3p4q5r6s7t8u9v0w1x2y3z4a5

## Réinitialiser les Données

Pour réinitialiser la base de données avec de nouvelles données de test:

```bash
php seed_database.php
```

**Note:** Cette commande supprimera toutes les données existantes et les remplacera par les données de test.

## Dépannage

### Erreur de connexion à la base de données

Vérifiez les paramètres dans `app/config/database.php`:
- Host: 127.0.0.1
- Database: billp2p
- User: root
- Password: (vide par défaut)

### Aucune transaction en attente

Exécutez à nouveau le script de seeding:
```bash
php seed_database.php
```

### Erreur "Agent not found"

Le script de seeding créera automatiquement des agents. Si le problème persiste, vérifiez que la table `agents` contient des données.

## Fonctionnalités à Tester

- [x] Inscription d'un nouvel utilisateur
- [x] Connexion utilisateur
- [x] Dashboard utilisateur avec soldes
- [x] Dépôt via Mobile Money
- [x] Retrait vers Mobile Money
- [x] Conversion FC ↔ USD
- [x] Dépôt/Retrait USDT
- [x] Dashboard agent
- [x] Confirmation de transaction par agent
- [x] Annulation de transaction par agent
- [x] Historique des transactions
- [x] Logs des actions utilisateur
- [x] Dashboard admin
- [x] Gestion des taux de change

## Support

Pour toute question ou problème, consultez le fichier README.md principal.
