<?php
if(!empty($_GET)) {
    $str = $_GET['str'];
    $needle = $_GET['needle'];

    //занести строку в файл
    shell_exec("echo ".addslashes($str)." > file.txt");

    //сформировать строку запроса для терминала
    $expr = " grep -E ".escapeshellarg($needle)." file.txt ";

    //запустить поиск
    $iserrcode = exec($expr . '  2>&1; echo $?',$out,$status);

    $response=$out[0];
    $result = $iserrcode ? "FAIL" : "OK";
    $output = "$result  $response ";

} else {
    $str="";
    $needle="";
    $output="";
}
?>
<!DOCTYPE html>
<form>
    <input type="text" name="str" value="<?=$str?>" placeholder="строка">
    <input type="text" name="needle" value="<?=$needle?>" placeholder="регулярка">

    <input type="text" name="out" value="<?=$output?>" placeholder="вывод" disabled>
    <input type="submit" value="Проверить">
</form>
</html>