<?php
require_once 'Task.php';

class Storage {
    private string $file = 'tasks.json';

    public function load(): array {
        if (!file_exists($this->file)) return [];
        $data = json_decode(file_get_contents($this->file), true) ?: [];
        // Превращаю каждый элемент массива в объект Task
        return array_map(fn($item) => Task::fromArray($item), $data);
    }

    public function save(array $tasks): void {
        // Превращаю объекты обратно в массив для записи в JSON
        $data = array_map(fn($task) => $task->toArray(), $tasks);
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}