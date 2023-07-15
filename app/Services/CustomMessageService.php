<?php
namespace App\Services;
use App\Models\CustomMessage;

class CustomMessageService {
    public function store(array $messageData): void
    {
        CustomMessage::create($messageData);
    }

    public function update(array $messageData, int $id): void
    {
        CustomMessage::findOrFail($id)->update($messageData);
    }

    public function destroy(int $id): void
    {
        CustomMessage::findOrFail($id)->delete();
    }

    public static function get($key)
    {
        $message = CustomMessage::active()
            ->where('code', $key)
            ->first();

        if (!$message) {
            throw new \Exception("Invalid custom message with key: $key");
        }

        return $message;
    }
}