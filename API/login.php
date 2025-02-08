<?php 

    if ($_SERVER["REQUEST_METHOD"] != "POST")
    {
        http_response_code(400);
    }
    else
    {
        if (isset($_POST["user"]) && isset($_POST["pass"]))
        {
            include "conn.php";
            $q = "SELECT password,id  FROM user WHERE username = ?";
            $stmt = $conn->prepare($q);
            $stmt->execute([$_POST["user"]]);
            $userdata = $stmt->fetch();
            $datapass = $userdata["password"];
            
            if (sha1($_POST["pass"]) == $datapass)
            {
                include "util.php";

                setcookie("id", createSession($userdata["id"], $conn));
            }
            else {
                
                header("../index.php");
            }
        }
        else
        {
            http_response_code(400);
        }
    }

?>