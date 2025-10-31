# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a multi-tenant real estate SaaS platform called "MultiEstate" (referenced in the codebase) built on Laravel 11. The application allows users to create their own real estate websites with custom domains/subdomains to list properties and projects for sale or rent.

## Architecture

### Multi-Tenant Structure

The application has three main user types, each with separate routes, controllers, views, and authentication:

1. **Admin** (`routes/admin.php`)
   - Super admin managing the entire platform
   - Manages users/tenants, packages, coupons, global settings
   - Controllers: `app/Http/Controllers/Admin/`
   - Views: `resources/views/admin/`

2. **Agent** (`routes/agent.php`)
   - Real estate agents within a tenant's website
   - Manage properties under tenant accounts
   - Controllers: `app/Http/Controllers/Agent/`
   - Views: `resources/views/agent/`

3. **Tenant/User** (`routes/tenant.php`)
   - Main subscribers who own their own real estate websites
   - Manage their site settings, agents, properties, projects
   - Controllers: `app/Http/Controllers/User/`
   - Views: `resources/views/user/`
   - Frontend: `routes/tenant_frontend.php` with controllers in `app/Http/Controllers/UserFrontend/`

### Multi-Tenancy Implementation

- Tenants can have custom subdomains (handled by `UserSubdomain` model)
- Tenants can have custom domains (handled by `UserCustomDomain` model)
- Tenant-specific models are in `app/Models/User/`
- Assets stored with tenant-specific paths (see `app/Constants/Constant.php`)
- Middleware: `CheckWebsiteOwner`, `UserMaintenance`, `CheckPackage`, `CheckUserPackageLimits`

### Key Architectural Patterns

- **Service Layer**: Payment gateway logic in `app/Services/PaymentGateway/`, tenant operations in `app/Services/Tenant/`
- **Helper Functions**: Globally autoloaded helpers in `app/Http/Helpers/Helper.php`
- **Permission System**: `UserPermissionHelper` and middleware (`CheckPermission`, `CheckPermissionUser`)
- **Package/Subscription System**: Tenants subscribe to packages with feature limits enforced via `CheckUserPackageLimits` middleware

## Common Commands

### Development Setup
```bash
# Copy environment file
cp .env.example .env

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database (if needed)
php artisan db:seed

# Build frontend assets
npm run dev          # Development build
npm run watch        # Watch for changes
npm run production   # Production build
```

### Running the Application
```bash
# Start development server
php artisan serve

# Run queue worker (if using queues)
php artisan queue:work
```

### Testing
```bash
# Run all tests
./vendor/bin/phpunit

# Run specific test suite
./vendor/bin/phpunit --testsuite=Feature
./vendor/bin/phpunit --testsuite=Unit

# Run specific test file
./vendor/bin/phpunit tests/Feature/ExampleTest.php
```

### Cache Management
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan optimize
```

## Important Directories

### Models Organization
- `app/Models/` - Core platform models (Admin, User, Package, etc.)
- `app/Models/User/` - Tenant-specific models (Property, Project, Agent, BasicSetting, etc.)
  - `Property/` - Property management models
  - `Project/` - Project management models
  - `Agent/` - Agent models for tenant agents
  - `HomePage/` - Homepage section models
  - `Journal/` - Blog/journal models

### Controllers Organization
- `app/Http/Controllers/Admin/` - Admin panel controllers
- `app/Http/Controllers/Agent/` - Agent dashboard controllers
- `app/Http/Controllers/User/` - Tenant dashboard controllers
- `app/Http/Controllers/UserFrontend/` - Tenant public-facing controllers
- `app/Http/Controllers/Front/` - Main platform frontend controllers

### Views Organization
- `resources/views/admin/` - Admin panel views
- `resources/views/agent/` - Agent dashboard views
- `resources/views/user/` - Tenant dashboard views
- `resources/views/tenant_frontend/` - Tenant public website views
- `resources/views/front/` - Main platform frontend views

## Key Features

### Payment Gateways
The application integrates with numerous payment gateways for subscription payments:
- Stripe, PayPal, Razorpay, Paytm, Mollie, Midtrans, Instamojo, MyFatoorah, Iyzico, Authorize.net
- Offline gateway support via `OfflineGateway` model
- Payment processing services in `app/Services/PaymentGateway/`
- Gateway configuration per tenant in `UserPaymentGeteway` model

### Multi-Language Support
- Global languages: `Language` model for admin panel
- Tenant languages: `User\Language` model for tenant websites
- Middleware: `AdminLocale`, `TenantDashboardLocale`, `TenantFrontendLocale`, `FrontendLocale`

### Content Management
- Custom pages (`CustomPage`, `Page` models)
- Menu builder (`MenuBuilderController`)
- Blog/Journal system
- FAQ, testimonials, partners
- Homepage sections (hero, about, testimonials, work process, etc.)

### Property & Project Management
- Properties and Projects are separate entities
- Support for countries, states, cities (location hierarchy)
- Categories, types, amenities
- Wishlist functionality
- Contact/inquiry messages

## Important Files

- `app/Http/Helpers/Helper.php` - Global helper functions (autoloaded)
- `app/Constants/Constant.php` - Asset path constants for tenant files
- `app/Http/Kernel.php` - Middleware registration and groups
- `routes/tenant.php` - Tenant dashboard routes
- `routes/tenant_frontend.php` - Tenant public website routes
- `routes/admin.php` - Admin panel routes
- `routes/agent.php` - Agent dashboard routes

## Middleware Patterns

Key middleware to be aware of when working on features:

- `CheckWebsiteOwner` - Ensures user owns the website they're accessing
- `CheckPackage` - Validates tenant has active package
- `CheckUserPackageLimits` - Enforces package feature limits
- `CheckPermission`/`CheckPermissionUser` - Role-based access control
- `UserMaintenance` - Handles tenant site maintenance mode
- `UserStatus` - Checks if user account is active
- `Demo` - Prevents certain actions in demo mode

## Database Conventions

- Tenant-specific tables typically have `user_` prefix
- Multi-language support: content often stored in JSON columns with language keys
- Soft deletes are used in many models
- Database uses MySQL by default (configured in `.env`)

## Asset Management

- Frontend assets compiled via Laravel Mix
- Tenant assets stored in tenant-specific subdirectories (see `Constant.php`)
- Public assets in `public/` directory
- File uploads organized by feature (properties, projects, blogs, etc.)

## Testing Configuration

Tests are configured to use SQLite in-memory database (see `phpunit.xml`):
- Unit tests: `tests/Unit/`
- Feature tests: `tests/Feature/`
- Test environment uses array drivers for cache, session, queue

## Special Considerations

### When Adding Features for Tenants
1. Check if the feature should be package-limited (add to package limits system)
2. Consider multi-language support (tenant language model)
3. Store tenant files in proper subdirectories using constants from `Constant.php`
4. Apply appropriate middleware (`CheckWebsiteOwner`, `CheckPackage`, etc.)
5. Create routes in correct file (`tenant.php` for dashboard, `tenant_frontend.php` for public)

### When Working with Payments
- Payment gateway configs are stored per tenant in `UserPaymentGeteway`
- Invoice generation uses PDF libraries (dompdf, mpdf)
- Payment logs tracked in `PaymentLog` model

### When Working with Permissions
- Use `UserPermissionHelper` to check permissions in tenant context
- Admin roles managed via `Role` model with granular permissions
- Permissions enforced via middleware and helper functions
