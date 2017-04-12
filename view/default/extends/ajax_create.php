<option value="0">вибирайте</option>
<?php   foreach ($region as $value): ?>

    <option value="<?php echo $value['id']; ?>"><?php echo $value['name'] ?></option>
<?php endforeach; ?>
