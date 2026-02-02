# E-Voting System Implementation Plan

Sistem e-voting sederhana dengan skema database minimal dan pembagian role admin/voter.

---

## Proposed Changes

### Database Layer

> [!IMPORTANT]
> **Migration Order**: `classes` harus dibuat **sebelum** `users` karena ada foreign key dependency.

#### [NEW] [0001_01_01_000001_create_classes_table.php](file:///Users/fauzi/Playgrounds/lks/e-voting/database/migrations/0001_01_01_000001_create_classes_table.php)

Dibuat dengan timestamp sebelum users table.

```php
Schema::create('classes', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});
```

---

#### [NEW] [0001_01_01_000002_create_candidates_table.php](file:///Users/fauzi/Playgrounds/lks/e-voting/database/migrations/0001_01_01_000002_create_candidates_table.php)

```php
Schema::create('candidates', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});
```

---

#### [MODIFY] [0001_01_01_000000_create_users_table.php](file:///Users/fauzi/Playgrounds/lks/e-voting/database/migrations/0001_01_01_000000_create_users_table.php)

Tambah `class_id` dan `role` langsung di migration existing:

```diff
 Schema::create('users', function (Blueprint $table) {
     $table->id();
     $table->string('name');
     $table->string('email')->unique();
     $table->timestamp('email_verified_at')->nullable();
     $table->string('password');
+    $table->foreignId('class_id')->nullable()->constrained()->nullOnDelete();
+    $table->enum('role', ['admin', 'voter'])->default('voter');
     $table->rememberToken();
     $table->timestamps();
 });
```

---

#### [NEW] [0001_01_01_000003_create_votes_table.php](file:///Users/fauzi/Playgrounds/lks/e-voting/database/migrations/0001_01_01_000003_create_votes_table.php)

```php
Schema::create('votes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
    $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
    $table->timestamps();
});
```

> [!NOTE]
> `user_id` unique constraint memastikan setiap user hanya bisa vote 1x

---

### Models

| Model           | File                         | Relationships                        |
| --------------- | ---------------------------- | ------------------------------------ |
| `SchoolClass`   | `app/Models/SchoolClass.php` | hasMany(User)                        |
| `Candidate`     | `app/Models/Candidate.php`   | hasMany(Vote)                        |
| `Vote`          | `app/Models/Vote.php`        | belongsTo(Candidate, User)           |
| `User` (modify) | `app/Models/User.php`        | belongsTo(SchoolClass), hasOne(Vote) |

---

### Middleware

#### [NEW] [AdminMiddleware.php](file:///Users/fauzi/Playgrounds/lks/e-voting/app/Http/Middleware/AdminMiddleware.php)

Membatasi akses hanya untuk user dengan `role === 'admin'`.

---

### Controllers

#### AuthController

| Method       | Endpoint             | Auth     |
| ------------ | -------------------- | -------- |
| `register()` | POST `/api/register` | Public   |
| `login()`    | POST `/api/login`    | Public   |
| `logout()`   | POST `/api/logout`   | Required |

#### ClassController

| Method      | Endpoint                   | Auth   |
| ----------- | -------------------------- | ------ |
| `index()`   | GET `/api/classes`         | Public |
| `store()`   | POST `/api/classes`        | Admin  |
| `show()`    | GET `/api/classes/{id}`    | Public |
| `update()`  | PUT `/api/classes/{id}`    | Admin  |
| `destroy()` | DELETE `/api/classes/{id}` | Admin  |

#### CandidateController

| Method      | Endpoint                      | Auth   |
| ----------- | ----------------------------- | ------ |
| `index()`   | GET `/api/candidates`         | Public |
| `store()`   | POST `/api/candidates`        | Admin  |
| `show()`    | GET `/api/candidates/{id}`    | Public |
| `update()`  | PUT `/api/candidates/{id}`    | Admin  |
| `destroy()` | DELETE `/api/candidates/{id}` | Admin  |

#### VoteController

| Method      | Endpoint                 | Auth     |
| ----------- | ------------------------ | -------- |
| `store()`   | POST `/api/votes`        | Voter    |
| `results()` | GET `/api/votes/results` | Public   |
| `status()`  | GET `/api/votes/status`  | Required |

#### UserController

| Method    | Endpoint         | Auth     |
| --------- | ---------------- | -------- |
| `me()`    | GET `/api/user`  | Required |
| `index()` | GET `/api/users` | Admin    |

---

### Routes

#### [MODIFY] [api.php](file:///Users/fauzi/Playgrounds/lks/e-voting/routes/api.php)

```php
// Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/classes', [ClassController::class, 'index']);
Route::get('/classes/{class}', [ClassController::class, 'show']);
Route::get('/candidates', [CandidateController::class, 'index']);
Route::get('/candidates/{candidate}', [CandidateController::class, 'show']);
Route::get('/votes/results', [VoteController::class, 'results']);

// Authenticated
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [UserController::class, 'me']);
    Route::post('/votes', [VoteController::class, 'store']);
    Route::get('/votes/status', [VoteController::class, 'status']);

    // Admin only
    Route::middleware('admin')->group(function () {
        Route::apiResource('classes', ClassController::class)->except(['index', 'show']);
        Route::apiResource('candidates', CandidateController::class)->except(['index', 'show']);
        Route::get('/users', [UserController::class, 'index']);
    });
});
```

---

## Summary

| Item                | Count |
| ------------------- | ----- |
| New Migrations      | 3     |
| Modified Migrations | 1     |
| New Models          | 3     |
| Modified Models     | 1     |
| New Middleware      | 1     |
| New Controllers     | 5     |
| Total API Endpoints | 16    |

---

## Verification Plan

1. **Database**: `php artisan migrate:fresh` - pastikan semua migration berjalan
2. **Auth Flow**: Register → Login → Logout
3. **Admin CRUD**: Create/Update/Delete classes & candidates
4. **Voting Flow**: Submit vote → Check status → View results
5. **Access Control**: Voter tidak bisa akses admin routes
