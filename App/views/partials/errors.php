<?php if(isset($errors)) : ?>
    <?php foreach($errors as $error) :?>
       <div class="badge text-danger bg-danger-subtle ms-2" ><?= $error?></div>
    <?php endforeach ; ?>
<?php endif ; ?>