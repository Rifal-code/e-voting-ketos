# E-Voting System Implementation Plan

Sistem e-voting sederhana dengan skema database minimal dan pembagian role admin/voter.

---

## Prerequisites

### 1. Install Laravel Sanctum

```bash
composer require laravel/sanctum
```

Publish konfigurasi Sanctum:

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

Tambahkan trait `HasApiTokens` ke model `User`:

```php
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
}
```

---

## Database Layer

### Migration Order

> [!IMPORTANT]
> Urutan migration penting karena ada foreign key dependencies:
>
> 1. `classes` → harus sebelum `users`
> 2. `candidates` → bebas
> 3. `users` (modify) → setelah `classes`
> 4. `votes` → setelah `users` dan `candidates`

### Create Migrations

```bash
# 1. Create classes table
php artisan make:migration create_classes_table

# 2. Create candidates table
php artisan make:migration create_candidates_table

# 3. Add fields to users table
php artisan make:migration add_class_id_and_role_to_users_table

# 4. Create votes table
php artisan make:migration create_votes_table
```

---

### Migration: `create_classes_table`

```php
public function up(): void
{
    Schema::create('classes', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });
}
```

---

### Migration: `create_candidates_table`

```php
public function up(): void
{
    Schema::create('candidates', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });
}
```

---

### Migration: `add_class_id_and_role_to_users_table`

```php
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->foreignId('class_id')->nullable()->after('password')
              ->constrained()->nullOnDelete();
        $table->enum('role', ['admin', 'voter'])->default('voter')
              ->after('class_id');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['class_id']);
        $table->dropColumn(['class_id', 'role']);
    });
}
```

---

### Migration: `create_votes_table`

```php
public function up(): void
{
    Schema::create('votes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
        $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
        $table->timestamps();
    });
}
```

> [!NOTE]
> `user_id` unique constraint memastikan setiap user hanya bisa vote 1x

---

## Models

### Create Models

```bash
php artisan make:model SchoolClass
php artisan make:model Candidate
php artisan make:model Vote
```

| Model           | Table        | Relationships                        |
| --------------- | ------------ | ------------------------------------ |
| `SchoolClass`   | `classes`    | hasMany(User)                        |
| `Candidate`     | `candidates` | hasMany(Vote)                        |
| `Vote`          | `votes`      | belongsTo(Candidate, User)           |
| `User` (modify) | `users`      | belongsTo(SchoolClass), hasOne(Vote) |

---

## Middleware

### Create Admin Middleware

```bash
php artisan make:middleware AdminMiddleware
```

Register di `bootstrap/app.php`:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);
})
```

---

## Controllers

### Create Controllers

```bash
php artisan make:controller Api/AuthController
php artisan make:controller Api/ClassController --api
php artisan make:controller Api/CandidateController --api
php artisan make:controller Api/VoteController
php artisan make:controller Api/UserController
```

---

## API Endpoints

| Method | Endpoint               | Auth     | Description       |
| ------ | ---------------------- | -------- | ----------------- |
| POST   | `/api/register`        | Public   | Register user     |
| POST   | `/api/login`           | Public   | Login             |
| POST   | `/api/logout`          | Required | Logout            |
| GET    | `/api/user`            | Required | Get current user  |
| GET    | `/api/classes`         | Public   | List classes      |
| POST   | `/api/classes`         | Admin    | Create class      |
| GET    | `/api/classes/{id}`    | Public   | Get class         |
| PUT    | `/api/classes/{id}`    | Admin    | Update class      |
| DELETE | `/api/classes/{id}`    | Admin    | Delete class      |
| GET    | `/api/candidates`      | Public   | List candidates   |
| POST   | `/api/candidates`      | Admin    | Create candidate  |
| GET    | `/api/candidates/{id}` | Public   | Get candidate     |
| PUT    | `/api/candidates/{id}` | Admin    | Update candidate  |
| DELETE | `/api/candidates/{id}` | Admin    | Delete candidate  |
| POST   | `/api/votes`           | Voter    | Submit vote       |
| GET    | `/api/votes/results`   | Public   | Get results       |
| GET    | `/api/votes/status`    | Required | Check vote status |
| GET    | `/api/users`           | Admin    | List all users    |

---

## Routes

Edit file `routes/api.php`:

```php
<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CandidateController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoteController;
use Illuminate\Support\Facades\Route;

// Public routes (tanpa autentikasi)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/classes', [ClassController::class, 'index']);
Route::get('/classes/{class}', [ClassController::class, 'show']);

Route::get('/candidates', [CandidateController::class, 'index']);
Route::get('/candidates/{candidate}', [CandidateController::class, 'show']);

Route::get('/votes/results', [VoteController::class, 'results']);

// Protected routes (memerlukan autentikasi)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [UserController::class, 'me']);

    // Voting
    Route::post('/votes', [VoteController::class, 'store']);
    Route::get('/votes/status', [VoteController::class, 'status']);

    // Admin only routes
    Route::middleware('admin')->group(function () {
        // Classes CRUD (kecuali index & show yang public)
        Route::post('/classes', [ClassController::class, 'store']);
        Route::put('/classes/{class}', [ClassController::class, 'update']);
        Route::delete('/classes/{class}', [ClassController::class, 'destroy']);

        // Candidates CRUD (kecuali index & show yang public)
        Route::post('/candidates', [CandidateController::class, 'store']);
        Route::put('/candidates/{candidate}', [CandidateController::class, 'update']);
        Route::delete('/candidates/{candidate}', [CandidateController::class, 'destroy']);

        // Users management
        Route::get('/users', [UserController::class, 'index']);
    });
});
```

---

## Verification

```bash
# Run migrations
php artisan migrate

# Test endpoints
php artisan serve
```
