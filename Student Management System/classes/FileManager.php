<?php
class FileManager {
    public static function readJson($file) {
        if (!file_exists($file)) {
            return [];
        }
        $content = file_get_contents($file);
        return json_decode($content, true) ?? [];
    }

    public static function writeJson($file, $data) {
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }
}
