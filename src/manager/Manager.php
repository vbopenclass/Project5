<?php
namespace src\manager;

/**
 * Class Manager
 * @package src\manager
 */
class Manager
{
    /**
     * @return \PDO -> connexion to database
     */
    public static function getPDO ()
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=project5_bdd', 'root', '');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    /**
     * @param $statement
     * Prepare the results of a sql request
     */
    public function prepareStmt ( $statement)
    {
        $req = $this->getPDO()->prepare($statement);
        $req->execute();
    }

    /**
     * @param $statement
     * @param $class_name
     * @param bool $all
     * @return array|mixed
     * Prepare the results of a sql request - object layout
     */
    public function prepareObject ( $statement, $class_name, $all = false)
    {
        $req = $this->getPDO()->prepare($statement);
        $req->execute(array());
        $req->setFetchMode(\PDO::FETCH_CLASS, $class_name);
        if ($all) {
            return $req->fetchAll();
        } return $req->fetch();
    }
}
