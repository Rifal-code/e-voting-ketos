# E-Voting System Implementation

## Planning

- [ ] Review and approve implementation plan

## Prerequisites

- [ ] Install Laravel Sanctum
- [ ] Publish Sanctum config
- [ ] Add `HasApiTokens` trait to User model

## Database Setup

- [ ] Create `classes` migration
- [ ] Create `candidates` migration
- [ ] Update `users` migration (add `class_id` and `role`)
- [ ] Create `votes` migration
- [ ] Run migrations
- [ ] Create Eloquent Models:
    - [ ] SchoolClass model
    - [ ] Candidate model
    - [ ] Vote model
    - [ ] Update User model (relationships)
- [ ] Create database seeders

## Middleware

- [ ] Create AdminMiddleware
- [ ] Register middleware alias in `bootstrap/app.php`

## API Controllers

- [ ] Create AuthController (register, login, logout)
- [ ] Create ClassController (CRUD)
- [ ] Create CandidateController (CRUD)
- [ ] Create VoteController (store, results, status)
- [ ] Create UserController (me, index)

## Routes

- [ ] Setup public routes
- [ ] Setup authenticated routes (auth:sanctum)
- [ ] Setup admin-only routes (admin middleware)

## Testing & Documentation

- [ ] Test all endpoints
- [ ] Verify role-based access control
