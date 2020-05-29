<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    public function start()
    {
        $path = storage_path() . "/json/data.json";

        $json = json_decode(file_get_contents($path), true);
        //dd($json);
        return view('practice', ['data' => $this->generateId($json)]);
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
}
