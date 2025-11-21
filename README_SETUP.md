# UKK POS System

A complete Point of Sale (POS) Dashboard system built with Laravel, featuring a beautiful modern UI with statistics, charts, and full CRUD operations for managing suppliers, products, customers, and transactions.

## Features

### Dashboard
- **Statistics Cards**: Display total counts of suppliers, products, customers, and transactions
- **Sales Chart**: Monthly sales visualization (last 6 months)
- **Key Metrics**: Total revenue and average transaction amount
- **Recent Transactions**: Latest 10 transactions with quick links
- **Top Products**: Best-selling products list
- **New Transaction Button**: Quick access to create new transactions

### Core Modules

#### Suppliers Management
- Add, edit, view, and delete suppliers
- Track contact information and location
- View associated products for each supplier
- Paginated supplier list

#### Products Management
- Full product catalog management
- Link products to suppliers
- Track pricing and stock levels
- Unique SKU system
- Product descriptions

#### Customers Management
- Customer database with contact details
- Track customer transactions
- View customer purchase history
- Location-based filtering

#### Transactions
- Create sales and return transactions
- Real-time price calculation
- Automatic stock management
- Transaction code generation
- View transaction details

## Technology Stack

- **Backend**: Laravel 12
- **Database**: MySQL
- **Frontend**: Blade Templates
- **CSS Framework**: Bootstrap 5
- **Charts**: Chart.js
- **Icons**: Font Awesome 6

## Installation

1. **Clone/Navigate to the project**
```bash
cd c:\xampp\htdocs\UKK\ukk-pos
```

2. **Install dependencies** (already done)
```bash
composer install
```

3. **Run migrations** (already done)
```bash
php artisan migrate
```

4. **Start the development server**
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

5. **Access the application**
Open your browser and go to: `http://127.0.0.1:8000`

## Database Structure

### Suppliers Table
- id, name, contact_person, phone, email, address, city, state, timestamps

### Products Table
- id, name, description, price, stock, supplier_id, sku, timestamps
- Foreign key: supplier_id references suppliers.id

### Customers Table
- id, name, email, phone, address, city, state, timestamps

### Transactions Table
- id, customer_id, product_id, quantity, unit_price, total_price, type (sale/return), transaction_code, timestamps
- Foreign keys: customer_id references customers.id, product_id references products.id

## API Routes

### Suppliers
- `GET /suppliers` - List all suppliers
- `GET /suppliers/{id}` - View supplier details
- `POST /suppliers` - Create new supplier
- `PUT /suppliers/{id}` - Update supplier
- `DELETE /suppliers/{id}` - Delete supplier

### Products
- `GET /products` - List all products
- `GET /products/{id}` - View product details
- `POST /products` - Create new product
- `PUT /products/{id}` - Update product
- `DELETE /products/{id}` - Delete product

### Customers
- `GET /customers` - List all customers
- `GET /customers/{id}` - View customer details
- `POST /customers` - Create new customer
- `PUT /customers/{id}` - Update customer
- `DELETE /customers/{id}` - Delete customer

### Transactions
- `GET /transactions` - List all transactions
- `GET /transactions/{id}` - View transaction details
- `POST /transactions` - Create new transaction
- `PUT /transactions/{id}` - Update transaction
- `DELETE /transactions/{id}` - Delete transaction

### Dashboard
- `GET /dashboard` - Main dashboard
- `GET /suppliers-list` - Suppliers dashboard view
- `GET /products-list` - Products dashboard view
- `GET /customers-list` - Customers dashboard view
- `GET /transactions-list` - Transactions dashboard view

## Features Highlight

### Beautiful UI
- Modern gradient sidebar navigation
- Responsive card-based layout
- Interactive hover effects
- Professional color scheme (Purple gradient)
- Bootstrap 5 responsive design

### Data Management
- Real-time stock updates on transactions
- Automatic transaction code generation (TXN-YYYYMMDDHHmmss-XXXX)
- Pagination on all list views
- Input validation on all forms
- Error handling and user feedback

### Charts & Analytics
- Monthly sales bar chart
- Interactive product statistics
- Revenue metrics display
- Customer transaction tracking

## Customization

### Change Color Scheme
Edit the color variables in `resources/views/layouts/app.blade.php`:
- Sidebar: `background: linear-gradient(135deg, #667eea 0%, #764ba2 100%)`
- Accent: `#667eea`, `#764ba2`

### Modify Pagination
Change pagination count in controllers (default: 10 per page)

### Add Custom Fields
Edit migrations and models to add new fields to any table

## Troubleshooting

### Database Connection Error
- Verify MySQL is running
- Check `.env` file for correct database credentials
- Ensure database exists

### Port 8000 Already in Use
```bash
php artisan serve --host=127.0.0.1 --port=8001
```

### Missing Views
Ensure all blade templates exist in `resources/views/`

## File Structure

```
ukk-pos/
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php
│   │   ├── SupplierController.php
│   │   ├── ProductController.php
│   │   ├── CustomerController.php
│   │   └── TransactionController.php
│   └── Models/
│       ├── Supplier.php
│       ├── Product.php
│       ├── Customer.php
│       └── Transaction.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── dashboard/
│       ├── suppliers/
│       ├── products/
│       ├── customers/
│       └── transactions/
└── routes/
    └── web.php
```

## License

This project is free to use and modify for educational purposes.

---

**Created**: November 20, 2025
**Version**: 1.0
**Status**: Ready for Development
