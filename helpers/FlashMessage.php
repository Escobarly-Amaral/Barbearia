<?php
    session_start();
    if(isset($_SESSION['mensagem'])){
?>

 <p>
    <div>
        <?php echo $_SESSION['mensagem']?>
    </div>
 </p>

<?php
    };
    session_unset();

?>