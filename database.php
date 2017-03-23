<?php
class Database{
   
   function __construct(){
        mysql_connect("localhost","root","") or die('No connect to Server');
        mysql_select_db("userdatabase") or die('No connect to DB');
        mysql_query("SET NAMES 'UTF8'") or die('Cant set charset');        
   }
   
   function saveForm($login,$userName,$Email,$textArea,$ip,$filePath){
      $login = mysql_real_escape_string($login);
      $userName = mysql_real_escape_string($userName);
      $textArea = mysql_real_escape_string($textArea);
            $sql ="INSERT INTO users(
                     login,
                     userName,
                     Email,
                     textArea,
                     ip,
                     filePath,
                     dateTime)
                    VALUES(
                    '$login',
                    '$userName',
                    '$Email',
                    '$textArea',
                    '$ip',
                     '$filePath',
                     NOW()
                     )";
            
            $query = mysql_query($sql);
            if ($query == false){
                return false;
            }
            return true;            
    }
    
    function getUsers($from=0,$to=0,$f=0){

           $f ? $ordered="DESC" : $ordered="ASC";
           if($from and $to){
                $sql =  "SELECT id, login, userName, Email, textArea,ip,filePath,`dateTime` 
                            FROM `users` WHERE DATE_FORMAT(`dateTime`,'%d.%m.%Y') BETWEEN'$from' 
                                AND '$to' ORDER BY dateTime ".$ordered;
            }else{
                $sql = "SELECT id, login, userName, Email, textArea,ip,filePath,dateTime
                            FROM users ORDER BY dateTime ".$ordered;
            }

            $query = mysql_query($sql) or die(mysql_error());
            return $this->db_result_to_array($query);
        
    }
    function getDate(){
            $sql = "SELECT DATE_FORMAT(`dateTime`,'%d.%m.%Y') AS group_date 
            FROM `users` GROUP BY group_date";

            $query = mysql_query($sql) or die(mysql_error());
            return $this->db_result_to_array($query);
    }
            
    function db_result_to_array($result){
        $res_array = array();
        for($i = 0; $row = mysql_fetch_array($result,MYSQL_ASSOC) ;$i++){
            $res_array[$i] = $row;       
        }
        return $res_array;
    }
}


