<?php

class Lessen extends Controller
{
    private $lesModel;

    public function __construct()
    {
        // We maken een object van de model class en stoppen dit in $lesModel
        $this->lesModel = $this->model('Les');
    }

    public function index()
    {
        $result = $this->lesModel->getLessen();

        // var_dump($result);

        $rows ="";

        foreach ($result as $lesinfo)
        {
            $dateTimeObj = new DateTimeImmutable($lesinfo->DatumTijd, 
                           new DateTimeZone('Europe/Amsterdam'));
                        //    var_dump($dateTimeObj);
            $rows .= "<tr>
                        <td>{$dateTimeObj->format('d-m-Y')}</td>
                        <td>{$dateTimeObj->format('H:i:s')}</td>
                        <td>{$lesinfo->LENA}</td>
                        <td>{}</td>
                        <td>
                            <a href='" . URLROOT ."/lessen/topiclesson/{$lesinfo->LEID}'>
                            <img src='" . URLROOT . "/img/b_sbrowse.png' alt='table picture'>
                        </td>
                     </tr>";
        }
        $data = [
            'title' => 'Overzicht lessen',
            'rows' => $rows,
            'InstructorName' => $result[0]->INNA
        ];
        $this->view('lessen/index', $data);
    }

    public function topicLesson($id = NULL)
    {
        //roep de modelmethod aan om de topics op te halen
        $result = $this->lesModel->getTopics($id);
        // var_dump($result);
        if ($result) {
            	$dt = new DateTimeImmutable($result[0]->DatumTijd, new DateTimeZone('Europe/Amsterdam'));
                $date = $dt->format('d-m-Y');
                $time = $dt->format('H:i');
        } else
        {
            $date = "";
            $time = "";
        }
        

        $rows = "";

        foreach ($result as $topic)
        {
            $rows .= "<tr>
                        <td>{$topic->Onderwerp}</td>
                     </tr>";
        }


        $data = [
            'title' => 'Onderwerpen Les',
            'rows' => $rows,
            'date' => $date,
            'time' => $time,
            'lessonId' => $id
            
        ];
        $this->view('lessen/topiclesson', $data);
    }

    public function addTopic($id = NULL)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $result = $this -> lesModel -> addTopic($_POST['topic'], $id);

            if($result) {
                echo "<h3>de data is opgeslagen</h3>";
                header('Refresh: 2; URL=' . URLROOT . '/lessen/index/');
            } else {
                echo "<h3>er is iets misgegaan</h3>";
                header('Refresh: 2; URL=' . URLROOT . '/lessen/index/');
            }

            $data = [
                'title' => 'test',
                'id' => $id,
            ];

            $this->view('lessen/topiclesson', $data);

        } else {
            $data = [
                'title' => 'Onderwerp toevoegen',
                'id' => $id,
            ];

            $this->view('lessen/addtopic', $data);
        }
    }
}

