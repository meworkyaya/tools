<?php
/* @var $this yii\web\View */
?>
<h1>influence/clear</h1>

<p>Data was cleared</p>
<p>Result: <?php 
foreach( $res as $item ){
    echo "{$item}<br>";
}
 ?></p>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
