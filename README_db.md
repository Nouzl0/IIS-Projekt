## Info k databázi a k práci s databázou

### Deployment databázy
1. Vytvorenie tabuliek databázy + naplnenie tabuliek prvotnými dátami
  - `php artisan migrate` 
  - alebo `php artisan migrate:fresh` - toto urobí drop all tables a spustí migrácie (ak dostanete table already exists SQL error, tak tiež použite tento príkaz)

2. Zaplnenie databázy základnými dátami
  - `php artisan db:seed` - spustí všetky seedy
  - alebo konkrétny seed na konkrétnu tabuľku `php artisan db:seed --class=tableNameSeeder`

3. Vytvorenie celého SQL súboru z migrácii
  - `mysqldump -u <username> -p <database_name> > <output_file_name>.sql` (konkrétne `mysqldump -u root -p if0_35185317_db > dump.sql`)
  - SQL súbor bude vytvorený v priečinku v ktorom sa momentálne nachádzate
  - vytvorený SQL súbor bude obsahovať vytvorenie tabuliek a inserty do tabuliek
  - **tento vygenerovaný súbor sa importne do databázy na infinityfree !!!**

Potom ešte ako sa bude robiť deployment aplikácie, tak v `.env` súbore sa musia **korektne upraviť** polia týkajúce sa databázy !!!


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

