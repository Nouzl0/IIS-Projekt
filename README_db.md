## Info k databázi a k práci s databázou

### Deployment databázy
1. Vytvorenie tabuliek databázy
  - `php artisan migrate` 
  - alebo `php artisan migrate:fresh` - toto urobí drop all tables a spustí migrácie (ak dostanete table already exists SQL error, tak tiež použite tento príkaz)

2. **TODO** Zaplnenie databázy základnými dátami
  - `php artisan db:seed` 
  - alebo konkrétny seed na konkrétnu tabuľku `php artisan db:seed --class=tableNameSeeder`

3. Vytvorenie SQL súboru z migrácií
  - `php artisan scheme:dump`
  - SQL súbor bude v IS_app/databse/schema/mysql-schema.sql
  - tento `mysql-schema.sql` súbor sa potom dá na infinityfree hosting !!!


### Migrácie (database/migrations/)
- slúžia na vytvorenie tabuľky v databáze
- slúžia na aktualizáciu tabuľky (napr. pridanie nového stĺpca, ...).
- každá tabuľka má vlastný migračný súbor (napr. tabuľka `linka` je definovaná v súbore `2023_10_22_000001_create_linka.php`)

#### ChatGPT extract :)
- Purpose: Migrations are used for defining and managing the structure of your database tables. They help you create, modify, or delete database tables and their columns.
- Schema Definition: Migrations define the blueprint or schema of the database tables, including the names of the tables, the names and data types of their columns, and any constraints or indexes.
- Database Changes: Migrations are primarily concerned with database schema changes and are typically used for tasks like creating tables, adding or modifying columns, and defining indexes or foreign keys.
- Files: Migrations are stored in the database/migrations directory of your Laravel project.

### Modely (app/Models/)
- slúžia ako komunikačný kanál medzi aplikáciou a databázou
- v aplikácii sa operácie insert, update, delete a select robia pomocou modelov
- každá tabuľka má vlastný model (napr. tabuľka `linka` má model `Linka.php`)

#### ChatGPT extract :)
- Purpose: Models are used to represent and interact with the data stored in the database. They define the structure and behavior of the data in your application.
- Data Access: Models define how your application interacts with the database records. They provide methods for querying, creating, updating, and deleting records, as well as defining relationships between different tables.
- Application Logic: Models are used for encapsulating application logic related to the data, such as validation rules, data manipulation, and business logic.
- Files: Models are typically stored in the app directory of your Laravel project, and each model corresponds to a database table.

### Seeders (database/seeders/)
- slúžia na vyplnenie tabuliek databázy prvotnými alebo esenciálnymi dátami

