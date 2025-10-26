🧑‍💻 Workwise Login & Timeline App

This project is a simple web application built using HTML, CSS, JavaScript (Axios) on the frontend and Laravel Sanctum API on the backend.
It includes a clean login page and a user timeline page where users can create and manage posts.

🚀 Features

Laravel Sanctum authentication (API token-based login)

JWT-style token stored securely in localStorage

Create, fetch, and manage posts through APIs

Responsive and modern UI using Bootstrap

Reusable layout (header, footer, navbar components)

🧩 Tech Stack
Frontend	Backend	Tools
HTML, CSS, JS (Axios)	Laravel + Sanctum	Bootstrap, jQuery, Font Awesome
⚙️ Installation Guide
1️⃣ Clone the repository
git clone https://github.com/yourusername/your-repo-name.git
cd your-repo-name

2️⃣ Install Laravel dependencies
composer install

3️⃣ Install Node dependencies (if needed)
npm install
npm run dev

4️⃣ Setup .env file

Copy .env.example and update your DB credentials:

cp .env.example .env
php artisan key:generate


Then set your frontend URL for Sanctum (important!):

SANCTUM_STATEFUL_DOMAINS=localhost:8000
SESSION_DOMAIN=localhost

🔐 Sanctum Setup

Run the Sanctum installation and migrations:

php artisan migrate


If not already published:

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"


Make sure config/cors.php allows your frontend domain:

'paths' => ['api/*', 'sanctum/csrf-cookie'],
'allowed_origins' => ['http://localhost:8000'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
'supports_credentials' => true,

⚙️ Run the project
php artisan serve


Then visit your app at:
👉 http://127.0.0.1:8000

🌐 Frontend Setup (HTML + Axios)

If your HTML files are stored under /public, they’ll load automatically.
Otherwise, host them separately and update the Axios base URL:

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

🔑 API Endpoints (Sanctum Protected)
Endpoint	Method	Description	Auth
/api/v1/login	POST	Login user & get token	❌
/api/v1/register	POST	Register new user	❌
/api/v1/posts	GET	Get all posts	✅
/api/v1/posts	POST	Create new post	✅
/api/v1/logout	POST	Logout user (revoke token)	✅

✅ = Requires Sanctum token
❌ = Public route

![alt text](<Screenshot 2025-10-17 at 4.11.29 PM.png>)

![alt text](<Screenshot 2025-10-17 at 4.02.24 PM.png>)

![alt text](<Screenshot 2025-10-26 at 8.06.30 PM.png>)