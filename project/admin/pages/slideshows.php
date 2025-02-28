<?php
// Assume these functions exist for database operations:
// - get_slideshows(): Returns an array of all slideshows.
// - get_slideshow($id): Returns a single slideshow by ID.
// - add_slideshow($data): Adds a new slideshow.
// - update_slideshow($id, $data): Updates an existing slideshow.
// - delete_slideshow($id): Deletes a slideshow.

// Handle POST requests for adding or editing slideshows
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $name = $_POST['name'] ?? '';
            $status = $_POST['status'] ?? 'inactive';
            // Basic validation (could be expanded)
            if (!empty($name)) {
                add_slideshow(['name' => $name, 'status' => $status]);
                $message = "Slideshow added successfully.";
            } else {
                $message = "Error: Name is required.";
            }
        } elseif ($_POST['action'] === 'edit' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $name = $_POST['name'] ?? '';
            $status = $_POST['status'] ?? 'inactive';
            if (!empty($name)) {
                update_slideshow($id, ['name' => $name, 'status' => $status]);
                $message = "Slideshow updated successfully.";
            } else {
                $message = "Error: Name is required.";
            }
        }
    }
}

// Handle GET requests for deleting slideshows
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
if ($action === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    delete_slideshow($id);
    $message = "Slideshow deleted successfully.";
    $action = 'list'; // Return to list view after deletion
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-image"></i>
                </span> Slideshows
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <?php if (isset($message)): ?>
            <div class="alert alert-<?php echo strpos($message, 'Error') === false ? 'success' : 'danger'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if ($action === 'add'): ?>
            <!-- Add Slideshow Form -->
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add New Slideshow</h4>
                            <form method="post" action="?p=slideshows">
                                <input type="hidden" name="action" value="add">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary">Save</button>
                                <a href="?p=slideshows" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($action === 'edit' && isset($_GET['id'])): ?>
            <!-- Edit Slideshow Form -->
            <?php
            $id = $_GET['id'];
            // $slideshow = get_slideshow($id); // Fetch slideshow data
            if ($slideshow):
            ?>
                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Slideshow</h4>
                                <form method="post" action="?p=slideshows">
                                    <input type="hidden" name="action" value="edit">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($slideshow['name']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="active" <?php echo $slideshow['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                                            <option value="inactive" <?php echo $slideshow['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-gradient-primary">Update</button>
                                    <a href="?p=slideshows" class="btn btn-light">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">Slideshow not found.</div>
            <?php endif; ?>

        <?php else: ?>
            <!-- List of Slideshows -->
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Slideshows</h4>
                            <a href="?p=slideshows&action=add" class="btn btn-gradient-primary mb-3">Add New Slideshow</a>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Number of Slides</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $slideshows = get_slideshows(); // Fetch all slideshows
                                        if ($slideshows):
                                            foreach ($slideshows as $slideshow):
                                        ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($slideshow['id']); ?></td>
                                                <td><?php echo htmlspecialchars($slideshow['name']); ?></td>
                                                <td><?php echo htmlspecialchars($slideshow['num_slides']); ?></td>
                                                <td>
                                                    <label class="badge badge-gradient-<?php echo $slideshow['status'] === 'active' ? 'success' : 'danger'; ?>">
                                                        <?php echo ucfirst(htmlspecialchars($slideshow['status'])); ?>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="?p=slideshows&action=edit&id=<?php echo htmlspecialchars($slideshow['id']); ?>" class="btn btn-sm btn-gradient-primary me-2">Edit</a>
                                                    <a href="?p=slideshows&action=manageslides&id=<?php echo htmlspecialchars($slideshow['id']); ?>" class="btn btn-sm btn-gradient-info me-2">Manage Slides</a>
                                                    <a href="?p=slideshows&action=delete&id=<?php echo htmlspecialchars($slideshow['id']); ?>" class="btn btn-sm btn-gradient-danger" onclick="return confirm('Are you sure you want to delete this slideshow?');">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                            endforeach;
                                        else:
                                        ?>
                                            <tr>
                                                <td colspan="5">No slideshows found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php endif; ?>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Existing Slideshows</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Number of Slides</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // $slideshows = get_slideshows(); // Fetch all slideshows
                                    if (!empty($slideshows)):
                                        foreach ($slideshows as $show):
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($show['id']); ?></td>
                                        <td><?php echo htmlspecialchars($show['name']); ?></td>
                                        <td><?php echo htmlspecialchars($show['num_slides']); ?></td>
                                        <td><?php echo htmlspecialchars($show['status']); ?></td>
                                        <td>
                                            <a href="?p=slideshows&action=edit&id=<?php echo $show['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="?p=slideshows&action=delete&id=<?php echo $show['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this slideshow?');">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                        endforeach;
                                    else:
                                    ?>
                                    <tr>
                                        <td colspan="5">No slideshows found.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php include "includes/layout/footer.php"; ?>
</div>