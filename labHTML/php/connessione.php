<?php
namespace DB;

class DBAccess{

    private const HOST_DB = "127.0.0.1";
    private const DATABASE_NAME = "lmarcato";
    private const USERNAME = "lmarcato";
    private const PASSWORD = "vohr8xieleuj3Sak";

    private $connection;

    public function openDBConnection(): bool {

        mysqli_report(MYSQLI_REPORT_ERROR);

        $this->connection = mysqli_connect(DBAccess::HOST_DB,
                                           DBAccess::USERNAME,
                                           DBAccess::PASSWORD,
                                           DBAccess::DATABASE_NAME);

        if( mysqli_connect_errno() ) {
            return false;
        }
        
        return true;
        
    }

    public function closeDBConnection(): void {

        mysqli_close($this->connection);

    }

    public function getList(): array {

        $query = "SELECT * FROM giocatori ORDER BY ID ASC";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in DBConnection: ". mysqli_error($this->connection));
        
        if( !mysqli_num_rows($queryResult) ) {
            return null;
        }
        
        $result = array();

        while($row = mysqli_fetch_assoc($queryResult)) {
            array_push($result, $row);
        }

        $queryResult->free();
        return $result;
        
    }
}

?>