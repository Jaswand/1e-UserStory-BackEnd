<?php   
/**
 * Dit is de model van de controller
 */

class Country
{
    //properties
    private $db;
    // Dit is een contsructor van de country model class
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getCountries()
    {
        $this->db->query('SELECT * FROM Country');
        return $this->db->resultSet();
    }

    public function getSingleCountry($id)
    {
        $this->db->query('SELECT * FROM Country WHERE id = :id');
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function updateCountry($post)
    {
        $this->db->query("UPDATE country
                            SET Name = :name,
                                CapitalCity = :capitalcity,
                                Continent = :continent,
                                Population = :population
                            WHERE id = :id");

        $this->db->bind(':id', $post['id'], PDO::PARAM_INT);
        $this->db->bind(':name', $post['name'], PDO::PARAM_STR);
        $this->db->bind(':capitalcity', $post['capitalcity'], PDO::PARAM_STR);
        $this->db->bind(':continent', $post['continent'], PDO::PARAM_STR);
        $this->db->bind(':population', $post['population'], PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function deleteCountry($id) {
        $this->db->query("DELETE FROM country WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function createCountry($post) {
       $this->db->query("INSERT INTO country(id, name, capitalcity, continent, population) 
                         VALUES(:id, :name, :capitalcity, :continent, :population)");
    
        $this->db->bind(':id', NULL, PDO::PARAM_INT);
        $this->db->bind(':name', $post['name'], PDO::PARAM_STR);
        $this->db->bind(':capitalcity', $post['capitalcity'], PDO::PARAM_STR);
        $this->db->bind(':continent', $post['continent'], PDO::PARAM_STR);
        $this->db->bind(':population', $post['population'], PDO::PARAM_INT); 

        return $this->db->execute();
    }
}




?>