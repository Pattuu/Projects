<?php
if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
    $type = $_SESSION['type'];
}else{
    $type = "member";
}
include '../../inc/incfiles/dblink.php';

$adminAction = "chatroom.php?x=admin";
$guestAction = "chatroom.php?x=guest";

if($_GET['user'] == 'admin'){
    $user = 'admin';
}else {
    $user = 'guest';
}

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
                                <span class="text-success font-weight-bold"><span class="text-danger">[Admin]</span><?php echo $row['name']; ?>: </span>
                            <?php else: ?>
                                <span class="text-success font-weight-bold"><?php echo $row['name']; ?>: </span>
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
