<?php
draw(5);

function draw($number){
    for($i=1; $i<=$number; $i++) {
        for($j=1; $j<=$i; $j++) //loop to print spaces
        {
        echo "&nbsp";
        }
        for ($star=$number;$star>=$i;$star--){
            echo '* ';
        }
        echo '<br>';
    }
    for($i=2; $i<=$number; $i++) {
        for($j=$number; $j>=$i; $j--)
        {
            echo "&nbsp";
        }
        for ($star=1;$star<=$i;$star++){
            echo '* ';
        }
        echo '<br>';
    }
}
?>