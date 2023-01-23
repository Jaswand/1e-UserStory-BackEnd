<?php   
/**
 * Dit is de model van de controller Lessen
 */

class Les
{
    //properties
    private $db;
    // Dit is een contsructor van de country model class
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLessen()
    {
        $this->db->query("SELECT Les.DatumTijd
                                ,Les.Id as LEID
                                ,Leerling.Id
                                ,Leerling.Naam AS LENA
                                ,Instructeur.Naam AS INNA
                          FROM Les
                          INNER JOIN Leerling
                          ON Leerling.Id = Les.LeerlingId
                          INNER JOIN Instructeur
                          ON Instructeur.Id = Les.InstructeurId
                          WHERE Les.InstructeurId = :Id");

        $this->db->bind(':Id', 2, PDO::PARAM_INT);
        
        return $this->db->resultSet();
    }   

    public function getTopics($lessonid)
    {
        // Maak een query 
        $sql = "SELECT Les.DatumTijd
                      ,Les.Id
                      ,Onderwerp.Onderwerp
                FROM Onderwerp
                INNER JOIN Les
                ON Les.Id = Onderwerp.LesId
                WHERE LesId = :lessonId";

        // Prepare de query
        $this->db->query($sql);

        // Bind de echte waarden aan de placeholders
        $this->db->bind(':lessonId', $lessonid, PDO::PARAM_INT);

        // Voer de query uit
        return $this->db->resultSet();
    }

    public function addTopic($post)
    {
        // Maak een query 
        $sql = "INSERT INTO Onderwerp (Onderwerp
                                       ,LesId)
                VALUES (:onderwerp, :lesId)";

        // Prepare de query
        $this->db->query($sql);

        $this->db->bind(':lesId', $post['id'], PDO::PARAM_INT);
        $this->db->bind(':topic', $post['topic'], PDO::PARAM_STR);

        return $this->db->execute();
    }
}

?>