<?php 

    if ($_SERVER["REQUEST_METHOD"] != "POST")
    {
        http_response_code(400);
    }
    else
    {
        if (isset($_POST["username"]) && isset($_POST["password"]))
        {
            include "conn.php";
            $q = "SELECT password,id  FROM user WHERE username = ?";
            $stmt = $conn->prepare($q);
            $stmt->execute([$_POST["username"]]);
            $userdata = $stmt->fetch();
            
            if ($userdata == false)
            {
                header("Location:". $server_name . "login.php?error=true");
            }
            else
            {
                $datapass = $userdata["password"];
            
                if (sha1($_POST["password"]) == $datapass)
                {
                    include "util.php";

                    setcookie("session", createSession($userdata["id"], $conn), strtotime(" +10 hours"), "/", $_SERVER["SERVER_NAME"]);
                    setcookie("id", $userdata["id"], strtotime(" +10 hours"), "/", $_SERVER["SERVER_NAME"]);
                    header("Location: ".$server_name);
                }
                else {
                    
                    header("Location: ".$server_name. "login.php?error=true");
                }
            }
        }
        else
        {
            http_response_code(400);
        }
    }

?>