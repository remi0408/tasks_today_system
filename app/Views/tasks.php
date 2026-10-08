<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        nav {
            margin-bottom: 20px;
        }

        nav form,
        .action-form {
            display: inline;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #cccccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eeeeee;
        }

        .success {
            padding: 10px;
            background-color: #dcfce7;
            color: #166534;
        }

        .button {
            display: inline-block;
            padding: 8px 12px;
            border: none;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .edit-link {
            margin-right: 8px;
            color: #2563eb;
            font-weight: bold;
        }

        .archive-button {
            padding: 6px 10px;
            border: none;
            background-color: #dc2626;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav>
        <a href="<?= site_url('/') ?>">Welcome</a> |
        <a href="<?= site_url('tasks') ?>">Task List</a> |
        <a href="<?= site_url('profile') ?>">Profile</a> |
        <a href="<?= site_url('about') ?>">About</a> |

        <?php if (session()->get('user_id')): ?>
            <span>
                Logged in as <?= esc(session()->get('full_name')) ?>
            </span>

            <form method="post" action="<?= site_url('logout') ?>">
                <?= csrf_field() ?>
                <button type="submit">Logout</button>
            </form>
        <?php else: ?>
            <a href="<?= site_url('login') ?>">Login</a>
        <?php endif; ?>
    </nav>

    <hr>

    <h1>All Tasks</h1>

    <?php if (session('success')): ?>
        <p class="success">
            <?= esc(session('success')) ?>
        </p>
    <?php endif; ?>

    <?php if (session()->get('user_id')): ?>
        <p>
            <a class="button" href="<?= site_url('tasks/new') ?>">
                New Task
            </a>
        </p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Task Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if (! empty($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= esc($task['title']) ?></td>
                        <td><?= esc(ucfirst($task['status'])) ?></td>
                        <td><?= esc($task['task_date']) ?></td>
                        <td>
                            <?php if (session()->get('user_id')): ?>
                                <a
                                    class="edit-link"
                                    href="<?= site_url(
                                        'tasks/' . $task['id'] . '/edit'
                                    ) ?>"
                                >
                                    Edit
                                </a>

                                <form
                                    class="action-form"
                                    method="post"
                                    action="<?= site_url(
                                        'tasks/' . $task['id'] . '/archive'
                                    ) ?>"
                                    onsubmit="return confirm(
                                        'Archive this task?'
                                    );"
                                >
                                    <?= csrf_field() ?>

                                    <button
                                        class="archive-button"
                                        type="submit"
                                    >
                                        Archive
                                    </button>
                                </form>
                            <?php else: ?>
                                <a href="<?= site_url('login') ?>">
                                    Login to manage
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No tasks found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>