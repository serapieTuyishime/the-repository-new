<div class="">
<?php if (file_exists(getcwd()."\\application\\views\\pages\\agreement.txt")): ?>
    <?php
    $filename= getcwd()."\\application\\views\\pages\\agreement.txt";
    $fp = fopen($filename, "r");
    $contents = fread($fp, filesize($filename));
    echo "<pre>$contents</pre>";
    fclose($fp);
     ?>
<?php else: ?>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

<?php endif; ?>
</div>
