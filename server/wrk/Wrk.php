<?php

class Wrk
{
    private $con;

    public function __construct()
    {
        $this->con = Connexion::getInstance();
    }

    public function getPixels()
    {
        try {
            $result = $this->con->selectQuery('SELECT * FROM t_pixel', null);
            $list = array();
            foreach ($result as $data) {
                $id = $data['row_pixel'] . " " . $data['column_pixel'];
                $color = $data['color_pixel'];
                $info = new Info($id, $color);
                echo "$id-$color,";
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die;
        }
    }

    public function resetDatabase()
    {
        try {
            $this->con->startTransaction();
            $result = $this->con->executeQuery('UPDATE t_pixel set color_pixel = "ffffff"', null);
            $ret = false;
            if ($result == 1) {
                $ret = true;
            } else {
                throw new PDOException("result is 0");
            }
            $this->con->commitTransaction();
        } catch (PDOException $e) {
            $this->con->rollbackTransaction();
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die;
        }
    }

    public function drawPixel($id, $color)
    {
        $coordiante = explode(" ", $id);
        $hex = substr($color, 1);

        try {
            $this->con->startTransaction();
            $result = $this->con->executeQuery('UPDATE t_pixel set color_pixel = ? where row_pixel = ? and column_pixel = ?', array($hex, $coordiante[0], $coordiante[1]));
            $ret = false;
            if ($result == 1) {
                $ret = true;
            } else {
                throw new PDOException("result is 0");
            }
            $this->con->commitTransaction();
        } catch (PDOException $e) {
            $this->con->rollbackTransaction();
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die;
        }
    }

    //DO NOT RUN THIS. IF YOU DO, IM GOING TO FIND YOU AND BE VERY MAD BECAUSE PUNCHING IS NOT good ?!!
    /*public function createDatabase(){
        try {
            echo "Starting";
            for ($i = 0; $i < 155; $i++) {
                for ($j = 0; $j < 75; $j++) {
                    $result = $this->con->executeQuery('INSERT INTO t_pixel (row_pixel, column_pixel, color_pixel)VALUES (?, ?,"ffffff")', array($i,$j));
                    echo $result;
                }
            }
        echo "Done";

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die;
        }
    }*/
}