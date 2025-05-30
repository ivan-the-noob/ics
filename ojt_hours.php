<?php
session_start();

// Initialize array if not set
if (!isset($_SESSION['ojt_logs'])) {
    $_SESSION['ojt_logs'] = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $start = $_POST['start_hour'];
    $end = $_POST['end_hour'];

    $_SESSION['ojt_logs'][] = [$date, $start, $end];
}

// Calculate total hours
function calculateHours($start, $end) {
    $startTime = DateTime::createFromFormat('H:i', $start);
    $endTime = DateTime::createFromFormat('H:i', $end);
    $interval = $startTime->diff($endTime);

    $totalHours = $interval->h + ($interval->i / 60);
    $adjustedHours = $totalHours - 1; // Deduct 1 hour
    return max($adjustedHours, 0); // Prevent negative values
}

if (isset($_POST['reset'])) {
    unset($_SESSION['ojt_logs']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>OJT Hours Tracker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">

<div class="container">
    <h2>OJT Hours Tracker</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#ojtModal">
        Add OJT Entry
    </button>

    <!-- Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Start Hour</th>
                <th>End Hour</th>
                <th>Total Hours</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sum = 0;
            foreach ($_SESSION['ojt_logs'] as $log): 
                $total = calculateHours($log[1], $log[2]);
                $sum += $total;
            ?>
            <tr>
                <td><?= htmlspecialchars($log[0]) ?></td>
                <td><?= htmlspecialchars($log[1]) ?></td>
                <td><?= htmlspecialchars($log[2]) ?></td>
                <td><?= number_format($total, 2) ?> hrs</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total OJT Hours</th>
                <th><?= number_format($sum, 2) ?> hrs</th>
            </tr>
        </tfoot>
    </table>
</div>

<form method="POST" onsubmit="return confirm('Are you sure you want to reset all OJT entries?');">
    <button type="submit" name="reset" class="btn btn-danger">Reset All Entries</button>
</form>


<!-- Modal -->
<div class="modal fade" id="ojtModal" tabindex="-1" aria-labelledby="ojtModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ojtModalLabel">Add OJT Entry</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control">
            </div>

            <div class="mb-3">
                <label for="start_hour" class="form-label">Start Hour</label>
                <input type="time" name="start_hour" id="start_hour" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="end_hour" class="form-label">End Hour</label>
                <input type="time" name="end_hour" id="end_hour" class="form-control" required>
            </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save Entry</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
