<?php
class Task {
    public function __construct(
        public string $text,
        public bool $done = false
    ) {}

    public static function fromArray(array $data): self {
        return new self($data['text'], $data['done'] ?? false);
    }

    public function toArray(): array {
        return ['text' => $this->text, 'done' => $this->done];
    }
}