To implement **Select, Insert, Update, and Delete (CRUD)** operations in an **Object-Oriented Programming (OOP)** way using **PDO** for your e-commerce website, we’ll create a structured approach with classes instead of standalone functions. This aligns with your database connection snippet and your project’s needs (e.g., admin and user pages with a clothing-related database). Below, I’ll design a solution based on your folder structure and the PDO connection you provided, using OOP principles like encapsulation and reusability.

---

### Design Overview

1. **Database Connection Class**: A singleton or reusable class to manage the PDO connection.
2. **Model Classes**: Separate classes for each entity (e.g., `User`, `Product`, `Order`) with CRUD methods.
3. **OOP Principles**:
   - **Encapsulation**: Keep database logic within classes.
   - **Reusability**: Use a base `Model` class to share common functionality.
   - **Type Safety**: Leverage PDO’s prepared statements for security.

---

### Folder Structure Adjustments
Based on your provided structure, I’ll assume:
- `db/` contains database-related files.
- `admin/pages/` and `pages/` will use these classes for admin and user functionality.

Updated structure:
```
D:.
├───db/
│   ├───Database.php       # PDO connection class
│   ├───Model.php          # Base model class
│   ├───User.php           # User model
│   ├───Product.php        # Product model
│   └───Order.php          # Order model
├───admin/
│   └───pages/
│       └───products.php   # Example admin page using Product model
├───pages/
│   └───account.php        # Example user page using User model
```

---

### Implementation

#### 1. Database Connection Class (`db/Database.php`)
This class manages the PDO connection and ensures it’s reusable across your application.

```php
<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=php_ecommerce", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Failed to connect to database: " . $e->getMessage());
        }
    }

    // Singleton pattern to get the PDO instance
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }

    // Prevent cloning or instantiation from outside
    private function __clone() {}
    private function __wakeup() {}
}
?>
```

- **Why Singleton?**: Ensures only one database connection exists, reducing resource usage.
- **Usage**: `Database::getInstance()` returns the PDO object.

---

#### 2. Base Model Class (`db/Model.php`)
A parent class with common CRUD methods that child classes can inherit or override.

```php
<?php
require_once 'Database.php';

abstract class Model {
    protected $pdo;
    protected $table;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    // Select all records
    public function all() {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Select by ID
    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE {$this->getPrimaryKey()} = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insert a record
    public function create(array $data) {
        $keys = array_keys($data);
        $fields = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} ($fields) VALUES ($placeholders)");
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }

    // Update a record
    public function update($id, array $data) {
        $set = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET $set WHERE {$this->getPrimaryKey()} = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Delete a record
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE {$this->getPrimaryKey()} = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Abstract method to define the primary key
    abstract protected function getPrimaryKey();
}
?>
```

- **Abstract**: Forces child classes to define their primary key.
- **Prepared Statements**: Uses PDO’s parameterized queries for security against SQL injection.

---

#### 3. User Model (`db/User.php`)
Handles user-related CRUD operations.

```php
<?php
require_once 'Model.php';

class User extends Model {
    protected $table = 'users';

    protected function getPrimaryKey() {
        return 'user_id';
    }

    // Additional method: Find by username (for login)
    public function findByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE username = :username");
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
```

---

#### 4. Product Model (`db/Product.php`)
Handles product-related CRUD operations.

```php
<?php
require_once 'Model.php';

class Product extends Model {
    protected $table = 'products';

    protected function getPrimaryKey() {
        return 'product_id';
    }

    // Additional method: Find by category
    public function findByCategory($category_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE category_id = :category_id");
        $stmt->execute([':category_id' => $category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
```

---

#### 5. Order Model (`db/Order.php`)
Handles order-related CRUD operations.

```php
<?php
require_once 'Model.php';

class Order extends Model {
    protected $table = 'orders';

    protected function getPrimaryKey() {
        return 'order_id';
    }

    // Additional method: Find by user
    public function findByUser($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
```

---

### Usage in Pages

#### Admin Page: Managing Products (`admin/pages/products.php`)
```php
<?php
session_start();
require_once '../../db/Product.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header('Location: /login');
    exit;
}

$productModel = new Product();

// Insert
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $data = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'stock_quantity' => $_POST['stock'],
        'category_id' => $_POST['category']
    ];
    $productModel->create($data);
}

// Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $data = [
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'stock_quantity' => $_POST['stock']
    ];
    $productModel->update($id, $data);
}

// Delete
if (isset($_GET['delete'])) {
    $productModel->delete($_GET['delete']);
}

// Select all products
$products = $productModel->all();
?>

<h1>Manage Products</h1>
<form method="POST">
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="description" placeholder="Description">
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <input type="number" name="stock" placeholder="Stock" required>
    <input type="number" name="category" placeholder="Category ID" required>
    <input type="submit" name="add" value="Add Product">
</form>

<ul>
    <?php foreach ($products as $product): ?>
        <li>
            <?php echo htmlspecialchars($product['name']); ?> - $<?php echo $product['price']; ?>
            <a href="?delete=<?php echo $product['product_id']; ?>">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>
```

#### User Page: Account (`pages/account.php`)
```php
<?php
session_start();
require_once '../db/User.php';
require_once '../db/Order.php';

if (!isset($_SESSION['logged_in'])) {
    header('Location: /login');
    exit;
}

$userModel = new User();
$orderModel = new Order();

// Select user info
$user = $userModel->findByUsername($_SESSION['username']);
// Select user orders
$orders = $orderModel->findByUser($user['user_id']);
?>

<h1>Your Account</h1>
<p>Welcome, <?php echo htmlspecialchars($user['username']);?>!</p>
<h2>Your Orders</h2>
<ul>
    <?php foreach ($orders as $order): ?>
        <li>Order #<?php echo $order['order_id']; ?> - $<?php echo $order['total_amount']; ?></li>
    <?php endforeach; ?>
</ul>
```

---

### Why This Approach?

1. **OOP Benefits**:
   - **Encapsulation**: Each model handles its own table-specific logic.
   - **Inheritance**: `Model` provides reusable CRUD methods.
   - **Extensibility**: Add custom methods (e.g., `findByCategory`) as needed.

2. **PDO Security**:
   - Uses prepared statements to prevent SQL injection.
   - Centralized connection management via `Database` class.

3. **Fits Your Structure**:
   - Models in `db/` can be included by both `admin/pages/` and `pages/`.
   - Matches your PDO connection snippet (`php_ecommerce` database).

---

### Notes
- **Database Connection**: Update `Database.php` with your actual credentials if they differ from `"root", ""`.
- **Error Handling**: Add try-catch blocks in page files for production use.
- **Routing**: This assumes you’re using the separate routing from my previous response (`index.php` and `admin/index.php`).
- **Enhancements**: Add validation (e.g., check if `price` is numeric) before calling CRUD methods.

This OOP approach provides a clean, maintainable way to implement CRUD operations with PDO for your e-commerce site. Let me know if you need further refinements!