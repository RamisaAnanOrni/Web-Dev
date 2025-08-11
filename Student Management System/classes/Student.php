<?php
require_once "FileManager.php";

class Student {
    private $file;

    public function __construct($file) {
        $this->file = $file;
    }

    public function getAll() {
        return FileManager::readJson($this->file);
    }

    public function add($data) {
        $students = $this->getAll();
        $data['id'] = count($students) > 0 ? max(array_column($students, 'id')) + 1 : 1;
        $students[] = $data;
        FileManager::writeJson($this->file, $students);
    }

    public function update($id, $data) {
        $students = $this->getAll();
        foreach ($students as &$student) {
            if ($student['id'] == $id) {
                $student = array_merge($student, $data, ['id' => $id]);
                break;
            }
        }
        FileManager::writeJson($this->file, $students);
    }

    public function delete($id) {
        $students = $this->getAll();
        $students = array_filter($students, fn($s) => $s['id'] != $id);
        FileManager::writeJson($this->file, array_values($students));
    }
}
