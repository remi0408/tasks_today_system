<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Task</title>
</head>
<body>
    <nav>
        <a href="<?= site_url('/') ?>">Welcome</a>
        <a href="<?= site_url('tasks') ?>">Task List</a>
        <a href="<?= site_url('profile') ?>">Profile</a>
        <a href="<?= site_url('about') ?>">About</a>
    </nav>

    <h1>New Task</h1>

    <?php if (session('errors')): ?>
        <ul style="color: red;">
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="<?= site_url('tasks') ?>">
        <?= csrf_field() ?>

        <label for="title">Title</label><br>
        <input
            type="text"
            id="title"
            name="title"
            maxlength="150"
            value="<?= old('title') ?>"
            required
        ><br><br>

        <label for="task_date">Task Date</label><br>
        <input
            type="date"
            id="task_date"
            name="task_date"
            value="<?= old('task_date', date('Y-m-d')) ?>"
            required
        ><br><br>

        <button type="submit">Create Task</button>
        <a href="<?= site_url('tasks') ?>">Cancel</a>
    </form>
</body>
</html>