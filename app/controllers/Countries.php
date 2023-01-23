<?php

class Countries extends Controller
{
    //properties
    private $countryModel;

    // Dit is de contructor van de controller
    public function __construct()
    {
        // Dit is de model van de controller
        $this->countryModel = $this->model('Country');
    }


    public function index($land = 'Nederland', $age = 21)
    {
        $records = $this->countryModel->getCountries();

        $rows = '';

        foreach ($records as $items)
        {
            $rows .= "<tr>
                        <td>$items->id</td>
                        <td>$items->Name</td>
                        <td>$items->CapitalCity</td>
                        <td>$items->Continent</td>
                        <td>$items->Population</td>
                        <td><a href='" . URLROOT . "/countries/update/$items->id'>Update</a></td>
                        <td><a href='" . URLROOT . "/countries/delete/$items->id'>Delete</a></td>
                       </tr>"; 
        }
        
        // var_dump($records);
        $data = [
            'title' => 'Overzicht van alle landen',
            'rows' => $rows
        ];

        $this->view('countries/index', $data);

    }

    public function update($id = null){
        // var_dump($id);exit();
        //var_dump($_SERVER);exit();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->countryModel->updateCountry($_POST);
        header("Location: " . URLROOT . "/countries/index");
        } else {
            $row = $this->countryModel->getSingleCountry($id);
            $data = [
                'title' => '<h1>Update land</h1>',	
                'row' => $row
            ];
            $this->view("countries/update", $data);
        }
        
    }

    public function delete($id){
        //echo $id;exit();
        $this->countryModel->deleteCountry($id);
        $data =[
            'deleteStatus' => "Het record met id  = $id is verwijdert"

        ];
        $this->view("countries/delete", $data); 
        header("Refresh:2; url=" . URLROOT . "/countries/index");
        } 

    public function create() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
           // var_dump($_POST);
           try {
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
             $this->countryModel->createCountry($_POST);
             header("Location: " . URLROOT . "/countries/index");
           } catch (PDOException $e) {
             echo "Het inserten van een record is niet gelukt.";
             header("Refresh:3; url=" . URLROOT . "/countries/index");
           }

        

        } else {
        $data = [
            'title' => 'Voeg een nieuw land toe'
        ];
            $this->view('countries/create', $data);
        }
    }
    

    public function test()
    {
        $data = [
            'title' => 'Ik ben slimmer dan Euer',
        ];
        $this->view('countries/test', $data);
    }
}