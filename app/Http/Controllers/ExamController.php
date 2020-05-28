<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function start()
    {
        $path = storage_path() . "/json/data.json";

        $json = json_decode(file_get_contents($path), true);

        $data = $this->getRandomQuestion(60, $json);

        return view('exam', ['data' => $this->generateId($data)]);
    }

    private function generateId($data)
    {
        $result = [];
        $i = 1;
        foreach ($data as $question) {
            $question['id'] = $i;
            $result[] = $question;
            $i++;
        }

        return $result;
    }

    private function getRandomQuestion($num, $data)
    {
        $randIndex = array_rand($data, 60);
        shuffle($randIndex);

        $result = [];
        foreach ($randIndex as $index) {
            $result[] = $data[$index];
        }

        return $result;
    }
}
