<?php
    require_once '../lib/db.php';

    function TruyVan($sql){
        global $conn;
        $kq = '';
        $sta = $conn->prepare($sql);
        $sta->execute();
        if($sta->rowCount() > 0){
            $kq = $sta->fetchAll(PDO:: FETCH_ASSOC);
        }
        return $kq;
    }
    function Insert($sql){
        global $conn;
        $sta = $conn->prepare($sql);
        $kq = $sta->execute();
        return $kq;
    }
    function Update($sql){
        global $conn;
        $sta = $conn->prepare($sql);
        $kq = $sta->execute();
        return $kq;
    }

    function Delete($sql){
        global $conn;
        $sta = $conn->prepare($sql);
        $kq = $sta->execute();
        return $kq;
    }
    function countRow($sql){
        global $conn;
        $sta = $conn->prepare($sql);
        $sta->execute();
        return $sta->rowCount();
    }

    function LayDanhSach($sql){
        global $conn;
        $kq = '';
        $sta = $conn->prepare($sql);
        $sta->execute();
        if($sta->rowCount() > 0){
            $kq = $sta->fetchAll(PDO:: FETCH_ASSOC);
        }
        return $kq;
    }
?>