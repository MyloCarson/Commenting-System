<?php

class CMySQL {

    // variables
    var $sDbName;
    var $sDbUser;
    var $sDbPass;

    var $vLink;

    // constructor
    function CMySQL() {
        $this->sDbName = 'db_name';
        $this->sDbUser = 'db_username';
        $this->sDbPass = 'db_password';

        // create db link
        $this->vLink = mysqli_connect("localhost", $this->sDbUser, $this->sDbPass);

        //select the database
        mysqli_select_db( $this->vLink,$this->sDbName);

        mysql_query("SET names UTF8");
    }

    // return one value result
    function getOne($query, $index = 0) {
        if (! $query)
            return false;
        $res = mysql_query($query);
        $arr_res = array();
        if ($res && mysql_num_rows($res))
            $arr_res = mysql_fetch_array($res);
        if (count($arr_res))
            return $arr_res[$index];
        else
            return false;
    }

    // executing sql
    function res($query, $error_checking = true) {
        // echo $query;
        //exit;
        
        if(!$query)
            return false;
        $res = mysqli_query($this->vLink, $query);
        if (!$res)
            $this->error('Database query error', false, $query);
        return $res;
    }

    // return table of records as result in pairs
    function getPairs($query, $sFieldKey, $sFieldValue, $arr_type = MYSQL_ASSOC) {
        if (! $query)
            return array();

        $res = $this->res($query);
        $arr_res = array();
        if ($res) {
            while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
                $arr_res[$row[$sFieldKey]] = $row[$sFieldValue];
            }
            mysql_free_result($res);
        }
        return $arr_res;
    }

    // return table of records as result
    function getAll($query, $arr_type = MYSQL_ASSOC) {
        if (! $query)
            return array();

        if ($arr_type != MYSQL_ASSOC && $arr_type != MYSQL_NUM && $arr_type != MYSQL_BOTH)
            $arr_type = MYSQL_ASSOC;

        $res = $this->res($query);
        $arr_res = array();
        if ($res) {
            while ($row = mysqli_fetch_array($res,$arr_type))
                $arr_res[] = $row;
            mysqli_free_result($res);
        }
        return $arr_res;
    }

    // return one row result
    function getRow($query, $arr_type = MYSQL_ASSOC) {
        if(!$query)
            return array();
        if($arr_type != MYSQL_ASSOC && $arr_type != MYSQL_NUM && $arr_type != MYSQL_BOTH)
            $arr_type = MYSQL_ASSOC;
        $res = $this->res ($query);
        $arr_res = array();
        if($res && mysqli_num_rows($res)) {
            $arr_res = mysqli_fetch_array($res, $arr_type);
            mysqli_free_result($res);
        }
        return $arr_res;
    }

    // escape
    function escape($s) {
        return mysql_real_escape_string($s);
    }

    // get last id
    function lastId() {
        return mysql_insert_id($this->vLink);
    }

    // display errors
    function error($text, $isForceErrorChecking = false, $sSqlQuery = '') {
        echo $text; exit;
    }

    //add user
    function addUser($query){
        if(! $query){
        return array();
        }
        $res = $this->res($query);
        return $res;
    }

     //add user
    function addComment($query){
        if(! $query){
        return array();
        }
        $res = $this->res($query);
        return $res;
    }

// gets tutorials
    // function getTutorial($query){
    //     if(! $query){
    //         return array();
    //     }
    //     $res = $this->res($query);
    // }
}

$GLOBALS['MySQL'] = new CMySQL();
?>