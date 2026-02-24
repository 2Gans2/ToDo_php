<?php
require_once 'Storage.php';

class TodoController {
    private Storage $storage;

    public function __construct() {
        $this->storage = new Storage();
    }

    public function handleRequest(): void {
        $tasks = $this->storage->load();
        $action = $_GET['action'] ?? null;
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        // Добавление
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task'])) {
            $tasks[] = new Task(trim($_POST['task']));
            $this->storage->save($tasks);
            header('Location: index.php'); exit;
        }

        // Переключение статуса
        if ($action === 'toggle' && isset($tasks[$id])) {
            $tasks[$id]->done = !$tasks[$id]->done;
            $this->storage->save($tasks);
            header('Location: index.php'); exit;
        }

        // Удаление
        if ($action === 'delete' && isset($tasks[$id])) {
            unset($tasks[$id]);
            $this->storage->save(array_values($tasks));
            header('Location: index.php'); exit;
        }

        include 'view.php';
    }
}

$controller = new TodoController();
$controller->handleRequest();