<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Only-todo | Ilya</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #5266ff;
            --bg: #f5f7f9;
            --text: #333;
            --text-muted: #888;
        }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); margin: 0; display: flex; justify-content: center; }
        .app-container { width: 100%; max-width: 600px; margin-top: 60px; padding: 20px; }
        .header { margin-bottom: 24px; }
        .header h1 { font-size: 24px; font-weight: 600; margin: 0; display: flex; align-items: center; gap: 10px; }
        
        .input-section { position: relative; margin-bottom: 30px; }

        .input-section input { 
            width: 100%; padding: 16px 120px 16px 20px; border: none; border-radius: 12px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); font-size: 16px; outline: none; box-sizing: border-box;
        }
        .input-section button { 
            position: absolute; right: 10px; top: 8px; background: var(--primary); 
            color: white; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-weight: 500;
        }

        .task-list { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 15px rgba(0,0,0,0.04); padding: 0; list-style: none; margin: 0; }
        .task-item { 
            display: flex; align-items: center; padding: 14px 20px; border-bottom: 1px solid #f0f0f0;
            transition: background 0.2s;
        }
        .task-item:hover { background: #fafafa; }
        .task-item:last-child { border-bottom: none; }

        .checkbox { 
            width: 20px; height: 20px; border: 2px solid #ddd; border-radius: 50%; 
            margin-right: 15px; cursor: pointer; display: flex; align-items: center; justify-content: center;
            text-decoration: none; font-size: 12px; color: transparent; flex-shrink: 0;
        }
        .checkbox.checked { background: var(--primary); border-color: var(--primary); color: white; }
        .checkbox.checked::after { content: '✓'; }

        .task-text { flex-grow: 1; font-size: 15px; cursor: pointer; text-decoration: none; color: var(--text); }
        .task-text.done { color: var(--text-muted); text-decoration: line-through; }

        .delete-link { color: #ff4d4f; text-decoration: none; font-size: 18px; padding: 5px; opacity: 0; transition: 0.2s; }
        .task-item:hover .delete-link { opacity: 1; }

        .empty-state { text-align: center; padding: 40px; color: var(--text-muted); }
    </style>
</head>
<body>
    <div class="app-container">
        <div class="header">
            <h1>🔵 Сегодня</h1>
        </div>

        <div class="input-section">
            <form action="index.php" method="POST">
                <input type="text" name="task" placeholder="Добавить задачу" required autocomplete="off" autofocus>
                <button type="submit">Добавить</button>
            </form>
        </div>

        <ul class="task-list">
            <?php if (empty($tasks)): ?>
                <div class="empty-state">Список пуст. Добавьте первую задачу!</div>
            <?php else: ?>
                <?php foreach ($tasks as $id => $task): ?>
                    <li class="task-item">
                        <a href="?action=toggle&id=<?= $id ?>" class="checkbox <?= $task->done ? 'checked' : '' ?>"></a>

                        <a href="?action=toggle&id=<?= $id ?>" class="task-text <?= $task->done ? 'done' : '' ?>">
                            <?= htmlspecialchars($task->text) ?>
                        </a>

                        <a href="?action=delete&id=<?= $id ?>" class="delete-link" title="Удалить">×</a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>