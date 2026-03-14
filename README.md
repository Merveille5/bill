# BILL P2P - Plateforme de Conversion Mobile Money vers USDT

Plateforme de conversion P2P pour la République Démocratique du Congo permettant aux utilisateurs d'échanger des Francs Congolais (FC) et USD contre des USDT via des agents validateurs.

## Fonctionnalités

### Pour les Utilisateurs
- Inscription et connexion sécurisées
- Dépôt en FC, USD ou USDT (validation par agent requise)
- Retrait en FC, USD ou USDT (validation par agent requise)
- Conversion interne FC ↔ USD ↔ USDT avec taux de change dynamique
- Historique des transactions avec statuts (en attente, confirmé, annulé)
- Wallet Tron automatique à l'inscription

### Pour les Agents
- Validation des dépôts/retraits en attente
- Gestion des transactions P2P
- Interface dédiée pour confirmer ou annuler les opérations

### Pour les Administrateurs
- Modification du taux de change USD/FC en temps réel
- Configuration système
- Supervision des opérations

## Architecture
Le projet suit une architecture MVC moderne :
- `app/` : Back-end (contrôleurs, modèles, config)
- `public/` : Point d'entrée (index.php)
- `views/` : Front-end (templates HTML avec TailwindCSS)

## Devises et Taux de Change

- **FC (Franc Congolais)** : Devise locale principale
- **USD** : Dollar américain
- **USDT** : Tether sur réseau Tron
- **Taux par défaut** : 1 USD = 2300 FC (modifiable par l'admin)
- **Conversion automatique** : FC ↔ USD basée sur le taux configuré

## Prérequis

- PHP 8.0+ avec extension PDO MySQL
- MySQL/MariaDB 5.7+
- Serveur web (Apache/Nginx) ou PHP built-in server
- Navigateur web moderne

## Installation

1. **Cloner le projet**
   ```bash
   git clone <repository-url>
   cd bill
   ```

2. **Configuration de la base de données**
   - Créer une base `billp2p`
   - Exécuter le script `app/config/schema.sql`
   - Modifier `app/config/database.php` si nécessaire

3. **Démarrage du serveur**
   ```bash
   cd public
   php -S localhost:8000
   ```

4. **Accès**
   - Application : http://localhost:8000
   - Panel Agent : http://localhost:8000/agent/dashboard
   - Administration : http://localhost:8000/admin/dashboard

## Base de Données

### Tables principales
- `users` : Utilisateurs et soldes
- `user_wallets` : Adresses Tron USDT
- `transactions` : Historique avec statuts (pending/confirmed/cancelled)
- `agents` : Agents validateurs avec numéros de téléphone
- `config` : Paramètres système (taux de change)
- `logs` : Journal d'activité

### Données de démonstration
Le script SQL inclut des agents pré-configurés pour les tests.

## Workflow Transactionnel

1. **Utilisateur** fait une demande de dépôt/retrait
2. **Système** assigne un agent aléatoire et met en statut "pending"
3. **Agent** reçoit la notification et valide/refuse l'opération
4. **Système** met à jour le solde selon la décision de l'agent

## Sécurité

- Mots de passe hashés (bcrypt)
- Sessions PHP sécurisées
- Validation des entrées
- Architecture MVC pour séparation des responsabilités

## Technologies

- **Backend** : PHP 8.0+, PDO, MySQL
- **Frontend** : HTML5, TailwindCSS, FontAwesome
- **Architecture** : MVC, routage personnalisé
- **Crypto** : Simulation USDT sur Tron (adresses générées)

## Développement

### Structure des fichiers
```
bill/
├── app/
│   ├── config/
│   │   ├── database.php
│   │   └── schema.sql
│   ├── controllers/
│   │   ├── AccountController.php
│   │   ├── AgentController.php
│   │   ├── AdminController.php
│   │   └── AuthController.php
│   └── models/
│       ├── User.php
│       ├── Transaction.php
│       ├── Agent.php
│       ├── Wallet.php
│       └── Config.php
├── public/
│   └── index.php
└── views/
    ├── account/
    ├── admin/
    ├── agent/
    └── auth/
```

### Tests
- Vérification syntaxique : `php -l fichier.php`
- Tests fonctionnels via interface web
- Validation des taux de change et conversions

## Support

Pour les questions ou problèmes :
1. Vérifier les logs PHP
2. Contrôler la configuration base de données
3. Tester avec les données de démonstration

## Licence

Propriétaire - Usage interne uniquement.

   Dans le dossier du projet (`d:\Mes travaux\Bill\bill`), ouvrez un terminal puis :

```powershell
php -S localhost:8000
```

   Cela démarre le serveur PHP intégré. Vous pouvez alors ouvrir `http://localhost:8000/connexion.php` dans votre navigateur.

3. **Tester les pages**
   - `register.php` : créer un nouveau compte utilisateur (formulaire basique).
   - `connexion.php` : formulaire de connexion pour accéder au dashboard.
   - `site.php` : tableau de bord avec solde Fc/USDT, liens vers dépôt, retrait, conversion et journal.
   - `depot.php` : dépôt via opérateurs (m-pesa, orange-money, airtel-money, afri-money), enregistre l'opérateur choisi.
   - `retrait.php` : retrait de solde.
   - `convert.php` : conversion de Fc en USDT à un taux fixe. Le solde USDT est mis à jour.
   - `logs.php` : affiche l'historique des actions de l'utilisateur (inscription, connexion, dépôts, retraits, conversions).

4. **Code**
   - `bd.php` gère la connexion à la base, ajoute les colonnes `usdt_balance`, crée/modifie les tables `transactions` (avec champ `operator` et `currency`) et `logs`.
   - `connexion.php`, `depot.php`, `retrait.php`, `convert.php` et `logs.php` implémentent respectivement l'authentification, les opérations financières et le journal des logs. Chaque action significative est écrite dans la table `logs`.
   - `site.php` présente le tableau de bord, solde global, historique complet des transactions et liens vers les autres pages.

5. **Évolution**
   - Ajouter la validation côté client.
   - Protéger contre les attaques CSRF et XSS.
   - Utiliser un framework ou un routeur pour une architecture plus propre.
   - Ajouter des fonctionnalités transactionnelles et historiques plus détaillées.

---

💡 **Astuce** : utilisez [XAMPP](https://www.apachefriends.org/fr/index.html) si vous préférez un environnement prêt à l'emploi avec Apache et MySQL.

**Scénario Etape 1**:
Scénario détaillé
Plateforme de conversion Mobile Money ↔ USDT avec validation par agent
1. Objectif de la plateforme

La plateforme permet aux utilisateurs de convertir leur argent Mobile Money en USDT et inversement.

Les moyens de paiement supportés sont :

Airtel Money

Orange Money

Vodacom M-Pesa

Afrimoney

La plateforme agit comme intermédiaire financier entre les utilisateurs et les agents qui gèrent les comptes Mobile Money.

Les transactions crypto utilisent :

Tether (USDT)

sur le réseau Tron

2. Rôle des agents

Les agents sont des opérateurs qui possèdent des comptes Mobile Money actifs.

Chaque agent possède par exemple :

un compte Airtel Money

un compte Vodacom M-Pesa

un compte Orange Money

Ces comptes servent à :

recevoir les paiements des utilisateurs

envoyer des paiements lors des retraits.

Les agents disposent également d’un stock d’USDT sur la plateforme.

3. Création de compte utilisateur

Un utilisateur qui veut utiliser la plateforme doit :

créer un compte

vérifier son identité (KYC simple)

obtenir automatiquement un wallet USDT.

Chaque utilisateur possède donc :

un compte sur la plateforme

un wallet crypto sur Tron

un historique de transactions.

4. Processus d’achat d’USDT
Étape 1 : demande de conversion

L’utilisateur choisit l’option :

Acheter USDT

Il indique :

le montant

le moyen de paiement Mobile Money.

Exemple :

Montant : 100 USD
Paiement via Airtel Money

La plateforme calcule :

le montant d’USDT correspondant

la commission de la plateforme.

Étape 2 : attribution d’un agent

La plateforme attribue automatiquement un agent disponible.

Les informations suivantes sont affichées :

Nom de l’agent
Numéro Mobile Money
Montant exact à envoyer

Exemple :

Envoyer 100 USD à :

Agent : Jean
Numéro : +243 XXX XXX XXX
Service : Airtel Money

Étape 3 : paiement Mobile Money

L’utilisateur effectue le paiement via son téléphone Mobile Money.

Une fois le paiement effectué, il clique :

Paiement effectué

La transaction passe à l’état :

En attente de confirmation.

5. Confirmation par l’agent

L’agent vérifie sur son téléphone Mobile Money si le paiement est arrivé.

Deux cas sont possibles.

Cas 1 : paiement reçu

L’agent confirme la réception.

La plateforme :

valide la transaction

envoie les USDT vers le wallet de l’utilisateur.

Les USDT sont transférés sur la blockchain Tron.

La transaction est marquée terminée.

Cas 2 : paiement non reçu

Si l’agent ne voit pas la transaction :

la plateforme maintient la transaction en attente.

L’utilisateur peut fournir une preuve :

capture d’écran

référence de transaction.

Un administrateur examine alors le cas et décide :

de valider

ou d’annuler la transaction.

6. Processus de vente d’USDT

Le processus inverse permet de retirer de l’argent Mobile Money.

Étape 1 : demande de retrait

L’utilisateur choisit :

Vendre USDT

Il indique :

le montant d’USDT

le service Mobile Money

son numéro.

Exemple :

50 USDT
Retrait via Vodacom M-Pesa

Étape 2 : blocage des USDT

La plateforme bloque les USDT de l’utilisateur.

Cela garantit que les fonds sont disponibles.

Étape 3 : paiement par l’agent

Un agent est assigné.

L’agent envoie l’argent Mobile Money à l’utilisateur via :

Airtel Money

Orange Money

Vodacom M-Pesa

Afrimoney

Une fois le paiement envoyé, l’agent confirme.

La plateforme libère les USDT vers le compte de l’agent.

7. Système de commission

La plateforme prélève une commission sur chaque transaction.

Exemple :

Transaction : 100 USDT
Commission : 1 %

L’utilisateur reçoit :

99 USDT

La plateforme garde :

1 USDT.

8. Sécurité

Le système inclut plusieurs protections :

vérification des transactions

confirmation manuelle

blocage temporaire des fonds

gestion des litiges

historique complet des transactions.

Les comptes suspects peuvent être suspendus.

9. Modèle économique

Les revenus de la plateforme proviennent :

des commissions sur transactions

des frais de retrait

éventuellement des frais de conversion.

Avec un volume élevé de transactions, ces commissions deviennent la principale source de revenus.

10. Évolution future

Après la phase initiale, la plateforme peut évoluer vers :

une application mobile

un réseau d’agents plus large

l’intégration d’API de paiement

l’ajout d’autres cryptomonnaies.

