

### Step 1: Clone the Repository

Open your terminal and run the following command to clone the repository:

```bash
git clone https://github.com/agistarakha/AlumniCrud.git
```

### Step 2: Navigate to the Project Directory

Enter the project directory:

```bash
cd AlumniCrud
```

### Step 3: Install PHP Dependencies

Run Composer to install the PHP dependencies:

```bash
composer install
```

### Step 4: Create a Copy of the Environment File

Create a copy of the `.env.example` file and name it `.env`:

```bash
cp .env.example .env
```

### Step 5: Generate Application Key

Generate the application key with the following command:

```bash
php artisan key:generate
```

### Step 6: Configure Database

Open the `.env` file in a text editor of your choice. Update the database configuration with your credentials:

```env
DB_CONNECTION=mysql
DB_HOST=your_database_host
DB_PORT=your_database_port
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### Step 7: Migrate Database

Run the following command to migrate the database:

```bash
php artisan migrate
```

### Step 8: Install Node.js Dependencies

Install the Node.js dependencies using npm (or yarn if you prefer):

```bash
npm install
```

### Step 9: Compile Assets

Compile the assets using the following command:

```bash
npm run dev
```

### Step 10: Run the Development Server

Finally, start the Laravel development server:

```bash
php artisan serve
```

Visit `http://localhost:8000` in your web browser, and you should see the Laravel application running.

