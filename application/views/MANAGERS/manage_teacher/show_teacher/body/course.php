<td class="center">
    <ul>
    <?php 
    $course = $value['course'];
    $courseArr = explode(';', $value['course']);
    foreach ($courseArr as $value){
        echo '<li>' . $value . '</li>';
    }
   // echo $value['course']; ?>
    </ul>
</td>
