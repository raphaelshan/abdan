<?php
if(isset($_POST['submit'])){
    $angka1 = $_POST['angka1'];
    $angka2 = $_POST['angka2'];
    $operasi = $_POST['operasi'];

    switch($operasi){
        case 'tambah':
            $hasil = $angka1 + $angka2;
            break;
        case 'kurang':
            $hasil = $angka1 - $angka2;
            break;
        case 'kali':
            $hasil = $angka1 * $angka2;
            break;
        case 'bagi':
            $hasil = $angka1 / $angka2;
            break;
        default:
            echo "Operasi tidak valid!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator Sederhana</title>
</head>
<body>
    <h2>Kalkulator Sederhana</h2>
    <form method="POST" action="">
        <input type="number" name="angka1" required>
        <select name="operasi" required>
            <option value="tambah">+</option>
            <option value="kurang">-</option>
            <option value="kali">*</option>
            <option value="bagi">/</option>
        </select>
        <input type="number" name="angka2" required>
        <input type="submit" name="submit" value="Hitung">
    </form>
    <?php
    if(isset($hasil)){
        echo "Hasil: " . $hasil;
    }
    ?>
</body>
</html>
