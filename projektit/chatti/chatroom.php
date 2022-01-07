<?php
session_start();
if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
    $type2 = $_SESSION['type'];
}else{
    $type2 = "member";
}
include '../../inc/incfiles/dblink.php';

$adminAction = "chatroom.php?x=admin";
$guestAction = "chatroom.php?x=guest";

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
$user = '';
if(empty($_GET['x'])){
    //header('location: livechat.php');
}else{
    if(!empty($_GET['x']) && $_SESSION['adminChecked'] == '1'){
        //$msg = 'Toimii';
        $user = 'admin';
    }else{
        //$msg = 'Ei toimi';
        $user = 'guest';
    }
}

date_default_timezone_set('Europe/Tallinn');

if(isset($_POST['sendMes']) && trim($_POST['chatMessage']) != ''){
    $messageRaw = $_POST['chatMessage'];
    $nameRaw = $_POST['name'];
    if($user == 'admin'){
        $utype = 2;
        $type = 'public';
    }else{
        $utype = 1;
        $type = 'hidden';
    }

    $name = checkName($nameRaw, $link, $utype);
    $message = checkMessage($messageRaw, $link);
    $date = date("d/m/Y");
    $time = date("H:i:s");

    $sqlF = "INSERT INTO chatroom (date, time, message, name, type, utype) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($link, $sqlF)){
        mysqli_stmt_bind_param($stmt, "sssssi", $date, $time, $message, $name, $type, $utype);

        if(mysqli_stmt_execute($stmt)){
            //SUCCESS
            
        } else{
            //ERROR EXECUTING
        }
    } else{
        //ERROR PREPARING
    }

}

if(isset($_POST['public'])){
    $rowId = $_POST['rowId'];
    $sqlS = "UPDATE chatroom SET type = 'public' WHERE id = $rowId";
    if($stmt = mysqli_prepare($link, $sqlS)){
        if(mysqli_stmt_execute($stmt)){
            //SUCCESS
        } else{
            //ERROR EXECUTING
        }
    } else {
        //ERROR PREPARING
    }
}

if(isset($_POST['hide'])){
    $rowId = $_POST['rowId'];
    $sqlS = "UPDATE chatroom SET type = 'hidden' WHERE id = $rowId";
    if($stmt = mysqli_prepare($link, $sqlS)){
        if(mysqli_stmt_execute($stmt)){
            //SUCCESS
        } else{
            //ERROR EXECUTING
        }
    } else{
        //ERROR PREPARING
    }
}

if(isset($_POST['delMes'])){
    $rowId = $_POST['rowId'];
    $sqlS = "DELETE FROM chatroom WHERE id = $rowId";
    if($stmt = mysqli_prepare($link, $sqlS)){
        if(mysqli_stmt_execute($stmt)){
            //SUCCESS
        } else{
            //ERROR EXECUTING
        }
    } else{
        //ERROR PREPARING
    }
}

function checkName($string, $conn, $utype){
    $string = htmlspecialchars($string);
    $string = mysqli_real_escape_string($conn, $string);
    $string = trim($string);
    if (strlen($string) <= 30 && strlen($string) > 0){
        return $string;
    }elseif(strlen($string) == 0){
        if($utype == 1){
            return 'Guest';
        }else{
            return $string;
        }
    }
}

function checkMessage($string, $conn){
    $string = htmlspecialchars($string);
    $string = mysqli_real_escape_string($conn, $string);
    $string = trim($string);
    if (strlen($string) <= 750){
        return $string;
    }
}
?>
<!DOCTYPE html>
<html style="max-height: 100vh;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="../../inc/img/favicon2.png" rel="icon">

    <?php //$stylePath = $_SERVER['DOCUMENT_ROOT'];
        //$stylePath .= "/Projects/inc/css/style.css"; ?>
    <!--<link type="text/css" rel="stylesheet" href="<?php// echo $stylePath; ?>">-->
    <link type="text/css" rel="stylesheet" href="../../inc/css/style.css">

    <link type="text/css" rel="stylesheet" href="../css/styles.css">
    <link type="text/css" rel="stylesheet" href="../css/reset.css">
    <title>Chatti</title>
</head>
<body class="bg-dark" style="max-height: 100vh;">
    <main class="d-flex justify-content-center" style="max-height: 100vh;">
        <div class="col-md-8">
            <div class="page-header d-flex justify-content-center">
                <h1 class="text-light m-2">Chatti</h1>
                <a class="btn btn-secondary m-2 fw-bold fs-4" href="livechat.php">Palaa aulaan</a>
            </div>
            <div style="overflow-y: scroll; max-height: 70vh;" id="refresh" class="bg-light text-left d-flex flex-column justify-content-start">
                <?php
                    $sql = "SELECT * FROM chatroom;";
                    $result = mysqli_query($link, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0):
                        while ($row = mysqli_fetch_assoc($result)): ?>
                            <div class="text-left border border-dark m-2 p-2" style="background-color: rgb(185, 247, 244)">
                                <div class="justify-content-start d-flex fw-bold">
                                    <?php if($row['type'] == 'hidden' && $user == 'guest'): ?>
                                        <div class="">
                                            <p class="text-secondary">Admin ei ole vielä hyväksynyt tätä viestiä.</p>
                                        </div>
                                    <?php elseif($row['type'] == 'public' || $user == 'admin'): ?>
                                        <div class="">
                                            <span class="text-secondary"><?php echo $row['time']; ?></span>
                                            <?php if($row['utype'] == 2): ?>
                                                <span class="text-success"><span class="text-danger">[Admin]</span><?php echo $row['name']; ?>: </span>
                                            <?php else: ?>
                                                <span class="text-success"><?php echo $row['name']; ?>: </span>
                                            <?php endif; ?>
                                            <span class="<?php if($row['type'] == 'hidden'){echo "text-secondary";}else{echo "text-dark";}; ?>"><?php echo $row['message']; ?></span>
                                        </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <?php if($user == 'admin'): ?>
                                        <form method="POST" action="<?php echo $adminAction; ?>">
                                            <input type="hidden" name="rowId" value="<?php echo $row['id']; ?>">
                                            <div class="btn-group btn-group-sm m-2">
                                                <input class="btn btn-danger" type="submit" value="Poista" name="delMes">
                                                <input class="btn btn-secondary ms-1" type="submit" name="<?php if($row['type'] == 'hidden'){echo 'public';}else{echo 'hide';} ?>" value="<?php if($row['type'] == 'hidden'){echo 'Näkyville';}else{echo 'Piiloon';} ?>">
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; 
                ?>
            </div>
            <div class="mb-5 pt-2">
                <form class="" method="POST" action="<?php if($user == 'admin'){echo $adminAction; }else {echo $guestAction;} ?>">
                    <input class="form-control" type="text" name="chatMessage" placeholder="New message">
                    <input class="form-control" type="text" name="name" placeholder="Name (Optional)">
                    <div class="d-grid">
                        <input type="submit" class="btn btn-primary p-3" name="sendMes" value="Send">
                    </div>
                </form>
            </div>
        </div>
    </main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<?php if($user == 'admin'): ?>
    <script>
            
        $(document).ready(function(){
            $("#refresh").load("load.php?user=admin");
            setInterval(function(){
                $("#refresh").load("load.php?user=admin");
            }, 3000);
        });
        
    </script>
    <?php else: ?>
    <script>
            
        $(document).ready(function(){
            $("#refresh").load("load.php?user=guest");
            setInterval(function(){
                $("#refresh").load("load.php?user=guest");
            }, 3000);
        });
        
    </script>
    <?php endif; ?>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>