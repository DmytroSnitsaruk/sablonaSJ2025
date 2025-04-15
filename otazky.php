<?php 
namespace otazkyodpovede;
error_reporting(error_level:E_ALL);
ini_set(option:"display_errors", value:"on");

require('data.php');

use PDO;
use PDOException;
use Database;

class QnA extends Database {
    
    public function readQnA() {
        try {
            
            // vytvorenie aj poslanie prikazu "SELECT" ktory vypiše otazky aj odpovede k nim
            $sql = "SELECT otazka, odpoved FROM otazky";
            $stmt = $this->conn->prepare($sql); 
            $stmt->execute();

            // konvertovanie vystupu prikazu SELECT z tabuľky otazok do array v PHP
            $results = $stmt->fetchAll();

            // vytvorenie prvkov v akordeone aj použivanie udajov z DB

            foreach ($results as $row) {
                echo '<div class="accordion">';
                echo '<div class="question">' . htmlspecialchars($row['otazka']) . '</div>';
                echo '<div class="answer">' . htmlspecialchars($row['odpoved']) . '</div>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo "Chyba pri načítaní dát: " . $e->getMessage();
        }
    }
}
?>
