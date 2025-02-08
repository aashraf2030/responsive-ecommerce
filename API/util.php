<?php

    function createSession($userid, $conn)
    {
        $q = "INSERT INTO session VALUES (?, ?)";

        $sessionID = bin2hex(random_bytes(25));

        while (true)
        {
            try {
                $stmt = $conn->prepare($q);
                $stmt->execute([$sessionID, $userid]);
                break;
            } catch (\Throwable $th) {
                
            }
        }

        return $sessionID;
    }

    function validateUserSession($userid, $sessionID, $conn)
    {
        $q = "SELECT id FROM session WHERE user = ?";

        $stmt = $conn->prepare($q);
        $stmt->execute([$userid]);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            if ($row["id"] == $sessionID)
            {
                return true;
            }
        }

        return false;
    }

    function destroySession($sessionID, $conn)
    {
        $q = "DELETE FROM session WHERE id = ?";

        $stmt = $conn->prepare($q);
        $stmt->execute([$sessionID]);
    }

?>