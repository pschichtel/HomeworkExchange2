<h1>
    Hallo! Ich bin die Stamdardseite!
</h1>
<?php if ($request->getArgc()): ?>
<span>Das sind meine Parameter:</span><br>
<ul>
    <?php foreach ($request->getArgs() as $arg): ?>
    <li><?php echo $arg ?></li>
    <?php endforeach ?>
</ul>
<?php endif ?>
<?php if (count($_GET)): ?>
<span>GET:</span><br>
<ul>
    <?php foreach ($_GET as $name => $arg): ?>
    <li><?php echo $name ?> => <?php echo $arg ?></li>
    <?php endforeach ?>
</ul>
<?php endif ?>