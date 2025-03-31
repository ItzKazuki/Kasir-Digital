.
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Admin
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── DiscountController.php
│   │   │   │   ├── MemberController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── ReportController.php
│   │   │   │   ├── TransactionController.php
│   │   │   │   └── UserController.php
│   │   │   ├── Auth
│   │   │   │   ├── ForgotPasswordController.php
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── LogoutController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   └── ResetPasswordController.php
│   │   │   ├── Controller.php
│   │   │   ├── DashboardController.php
│   │   │   └── Kasir
│   │   │       ├── KasirDashboardController.php
│   │   │       └── TransactionController.php
│   │   └── Middleware
│   │       ├── AdminMiddleware.php
│   │       └── KasirMiddleware.php
│   ├── Models
│   │   ├── Category.php
│   │   ├── Discount.php
│   │   ├── Member.php
│   │   ├── OrderDetail.php
│   │   ├── Order.php
│   │   ├── Product.php
│   │   ├── Transaction.php
│   │   └── User.php
│   └── Providers
│       └── AppServiceProvider.php
├── artisan
├── bootstrap
│   ├── app.php
│   ├── cache
│   │   ├── packages.php
│   │   └── services.php
│   └── providers.php
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   └── session.php
├── database
│   ├── factories
│   │   ├── CategoryFactory.php
│   │   ├── DiscountFactory.php
│   │   ├── MemberFactory.php
│   │   ├── OrderDetailFactory.php
│   │   ├── OrderFactory.php
│   │   ├── ProductFactory.php
│   │   ├── TransactionFactory.php
│   │   └── UserFactory.php
│   ├── migrations
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2025_02_11_091459_create_categories_table.php
│   │   ├── 2025_02_11_091552_create_members_table.php
│   │   ├── 2025_02_11_100806_create_discounts_table.php
│   │   ├── 2025_02_19_091200_create_users_table.php
│   │   ├── 2025_02_19_091603_create_products_table.php
│   │   ├── 2025_02_19_100733_create_orders_table.php
│   │   ├── 2025_02_19_100827_create_order_details_table.php
│   │   └── 2025_02_19_101704_create_transactions_table.php
│   └── seeders
│       ├── CategoryProductSedder.php
│       ├── DatabaseSeeder.php
│       ├── MemberSedder.php
│       └── UserSedder.php
├── package.json
├── package-lock.json
├── phpunit.xml
├── public
│   ├── css
│   ├── favicon.ico
│   ├── img
│   │   ├── product
│   │   └── profile
│   │       └── user-01.png
│   ├── index.php
│   ├── js
│   │   └── dashboard.js
│   ├── robots.txt
│   └── static
│       ├── logo-340x180.png
│       ├── logo-500x350.png
│       └── logo-login.svg
├── README.md
├── resources
│   ├── css
│   │   └── app.css
│   ├── js
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views
│       ├── auth
│       │   ├── forgot.blade.php
│       │   ├── login.blade.php
│       │   ├── register.blade.php
│       │   └── reset.blade.php
│       ├── cart.blade.php
│       ├── categories.blade.php
│       ├── dashboard
│       │   ├── categories
│       │   │   └── index.blade.php
│       │   ├── discounts
│       │   │   └── index.blade.php
│       │   ├── index.blade.php
│       │   ├── members
│       │   │   └── index.blade.php
│       │   ├── products
│       │   │   └── index.blade.php
│       │   ├── transactions
│       │   │   └── index.blade.php
│       │   └── users
│       │       └── index.blade.php
│       ├── errors
│       │   ├── 401.blade.php
│       │   ├── 402.blade.php
│       │   ├── 403.blade.php
│       │   ├── 404.blade.php
│       │   ├── 419.blade.php
│       │   ├── 429.blade.php
│       │   ├── 500.blade.php
│       │   ├── 503.blade.php
│       │   ├── layout.blade.php
│       │   ├── minimal.blade.php
│       │   └── new-layout.blade.php
│       ├── home.blade.php
│       ├── kasir
│       │   ├── index2.blade.php
│       │   └── index.blade.php
│       ├── layouts
│       │   ├── app.blade.php
│       │   ├── auth.blade.php
│       │   ├── dashboard.blade.php
│       │   └── partials
│       │       ├── dashboard-nav.blade.php
│       │       └── nav.blade.php
│       ├── order.blade.php
│       ├── product.blade.php
│       └── profile.blade.php
├── routes
│   ├── console.php
│   └── web.php
├── structure.md
├── tests
│   ├── Feature
│   │   └── ExampleTest.php
│   ├── TestCase.php
│   └── Unit
│       └── ExampleTest.php
└── vite.config.js

44 directories, 123 files. v0.1
