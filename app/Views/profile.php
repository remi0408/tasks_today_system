<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        .profile {
            border: 1px solid #cccccc;
            padding: 20px;
            max-width: 500px;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav>
        <a href="/">Welcome</a> |
        <a href="/tasks">Task List</a> |
        <a href="/profile">Profile</a> |
        <a href="/about">About</a>
    </nav>

    <hr>

    <h1>Demo User Profile</h1>

    <?php if ($user): ?>
        <div class="profile">
            <p>
                <span class="label">Username:</span>
                <?= esc($user['username']) ?>
            </p>

            <p>
                <span class="label">Full Name:</span>
                <?= esc($user['full_name']) ?>
            </p>

            <p>
                <span class="label">Email:</span>
                <?= esc($user['email']) ?>
            </p>
        </div>
    <?php else: ?>
        <p>No user record was found.</p>
    <?php endif; ?>
</body>
</html>