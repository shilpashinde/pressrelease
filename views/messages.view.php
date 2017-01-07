<?php
if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])):
    $messages = @$_SESSION['messages'];
    foreach ($messages as $message):
        ?>
        <div class="<?php echo $message['type']; ?>"><?php echo $message['message']; ?></div>
    <?php
    endforeach;
    $_SESSION['messages'] = array();
endif;
?>