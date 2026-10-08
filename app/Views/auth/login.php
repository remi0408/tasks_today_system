<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Tasks for Today</title>
</head>
<body>
    <nav>
        <a href="<?= site_url('/') ?>">Welcome</a>
        <a href="<?= site_url('tasks') ?>">Task List</a>
        <a href="<?= site_url('profile') ?>">Profile</a>
        <a href="<?= site_url('about') ?>">About</a>
    </nav>

    <h1>Staff Login</h1>

    <?php if (session('error')): ?>
        <p style="color: red;"><?= esc(session('error')) ?></p>
    <?php endif; ?>

    <?php if (session('success')): ?>
        <p style="color: green;"><?= esc(session('success')) ?></p>
    <?php endif; ?>

    <?php if (session('errors')): ?>
        <ul style="color: red;">
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="<?= site_url('login') ?>">
        <?= csrf_field() ?>

        <label for="username">Username</label><br>
        <input
            type="text"
            id="username"
            name="username"
            value="<?= old('username') ?>"
            required
        ><br><br>

        <label for="password">Password</label><br>
        <input
            type="password"
            id="password"
            name="password"
            required
        ><br><br>

        <button type="submit">Log in</button>
    </form>
</body>
</html>