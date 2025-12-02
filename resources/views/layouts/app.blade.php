<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS SYSTEM') - POS System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #1376f8ff  0%, #1376f8ff 100%);
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .sidebar .logo {
            color: white;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
            padding: 0 20px;
        }

        .sidebar .logo i {
            margin-right: 10px;
        }

        .sidebar-nav {
            list-style: none;
        }

        .sidebar-nav li {
            margin: 0;
        }

        .sidebar-nav a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-nav a:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: #92ceffff;
        }

        .sidebar-nav a.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.2);
            border-left-color: #ffffffff ;
        }

        .sidebar-nav a i {
            width: 20px;
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
        }

        .header .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffffffff 0%, #1376f8ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .stat-card .stat-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .stat-card.suppliers .stat-icon {
            color: #667eea;
        }

        .stat-card.products .stat-icon {
            color: #f093fb;
        }

        .stat-card.customers .stat-icon {
            color: #4facfe;
        }

        .stat-card.transactions .stat-icon {
            color: #fa709a;
        }

        .stat-card h3 {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin: 0;
        }

        .stat-card p {
            color: #95a5a6;
            margin: 0;
            font-size: 14px;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background: linear-gradient(135deg, #1376f8ff 0%, #1376f8ff 100%);
            color: white;
            border-radius: 8px 8px 0 0;
            font-weight: bold;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1376f8ff 0%, #1376f8ff 100%);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.4);
        }

        .table thead {
            background: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .alert {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .pagination {
            gap: 5px;
        }

        .pagination .page-link {
            border: 1px solid #ddd;
            color: #667eea;
        }

        .pagination .page-link:hover {
            background-color: #667eea;
            color: white;
        }

        .pagination .page-link.active {
            background-color: #667eea;
            border-color: #667eea;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-label {
            color: #2c3e50;
            font-weight: 500;
        }

        .action-buttons {
            gap: 5px;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                min-height: auto;
            }

            .main-content {
                margin-left: 0;
            }

            .header {
                flex-direction: column;
                gap: 15px;
            }

            .stat-card {
                margin-bottom: 15px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-shopping-cart"></i> POS System
        </div>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) active @endif">
                    <i class="fas fa-dashboard"></i> Dashboard
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
                <li>
                    <a href="{{ route('suppliers.index') }}" class="@if(request()->routeIs('suppliers.*')) active @endif">
                        <i class="fas fa-truck"></i> Suppliers
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}" class="@if(request()->routeIs('products.*')) active @endif">
                        <i class="fas fa-box"></i> Products
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}" class="@if(request()->routeIs('categories.*')) active @endif">
                        <i class="fas fa-tag"></i> Categories
                    </a>
                </li>
                <li>
                    <a href="{{ route('employees.index') }}" class="@if(request()->routeIs('employees.*')) active @endif">
                        <i class="fas fa-users"></i> Employees
                    </a>
                </li>
            @endif

            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'cashier')
                <li>
                    <a href="{{ route('customers.index') }}" class="@if(request()->routeIs('customers.*')) active @endif">
                        <i class="fas fa-user-friends"></i> Customers
                    </a>
                </li>
            @endif

            <li>
                <a href="{{ route('transactions.index') }}" class="@if(request()->routeIs('transactions.*')) active @endif">
                    <i class="fas fa-exchange-alt"></i> Transactions
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>@yield('page-title', 'Dashboard')</h1>
            <div class="user-info">
                <div>
                    <div style="font-weight: 600; font-size: 14px;">{{ auth()->user()->name }}</div>
                    <div style="font-size: 12px; color: #95a5a6;">
                        <span class="badge @if(auth()->user()->role === 'admin') bg-danger @else bg-warning @endif">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>
                </div>
                <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Alerts -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Please fix the errors below.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js"></script>
    @yield('scripts')
</body>
</html>
