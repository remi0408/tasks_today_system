<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>
<body>
    <nav>
        <a href="<?= site_url('/') ?>">Welcome</a>
        <a href="<?= site_url('tasks') ?>">Task List</a>
        <a href="<?= site_url('profile') ?>">Profile</a>
        <a href="<?= site_url('about') ?>">About</a>
    </nav>

    <h1>Edit Task</h1>

    <?php if (session('errors')): ?>
        <ul style="color: red;">
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form
        method="post"
        action="<?= site_url('tasks/' . $task['id']) ?>"
    >
        <?= csrf_field() ?>

        <label for="title">Title</label><br>
        <input
            type="text"
            id="title"
            name="title"
            maxlength="150"
            value="<?= old('title', $task['title']) ?>"
            required
        ><br><br>

        <label for="status">Status</label><br>
        <select id="status" name="status" required>
            <option
                value="pending"
                <?= old('status', $task['status']) === 'pending'
                    ? 'selected'
                    : '' ?>
            >
                Pending
            </option>

            <option
                value="completed"
                <?= old('status', $task['status']) === 'completed'
                    ? 'selected'
                    : '' ?>
            >
                Completed
            </option>
        </select><br><br>

        <label for="task_date">Task Date</label><br>
        <input
            type="date"
            id="task_date"
            name="task_date"
            value="<?= old('task_date', $task['task_date']) ?>"
            required
        ><br><br>

        <button type="submit">Save Changes</button>
        <a href="<?= site_url('tasks') ?>">Cancel</a>
    </form>
</body>
</html>