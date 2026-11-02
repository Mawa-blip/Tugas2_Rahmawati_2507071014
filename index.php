<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penghitung Nilai</title>
</head>
<h1>Penghitung Nilai Mahasiswa</h1>
<form method="POST">
    <div id="daftarMahasiswa">

    <fieldset>
        <legend>Data Mahasiswa 1</legend>

        <label>Nama Mahasiswa:</label>
        <input type="text" name="nama[]" required><br><br>

        <label>NIM:</label>
        <input type="text" name="nim[]" required><br><br>

        <label>Nilai Tugas:</label>
        <input type="number" name="tugas[]" min="0" max="100" step="any" required><br><br>

         <label>Nilai UTS:</label>
        <input type="number" name="uts[]" min="0" max="100" step="any" required><br><br>

        <label>Nilai UAS:</label>
        <input type="number" name="uas[]" min="0" max="100" step="any" required>
        </fieldset>
    </div><br>

    <button type="button" onclick="tambahMahasiswa()">+ Tambah Mahasiswa</button>
    <button type="submit" name="hitung">Hitung Nilai</button>
</form>

<script>
let jumlahMahasiswa = 1;

function tambahMahasiswa() {
    jumlahMahasiswa++;

    let daftar = document.getElementById("daftarMahasiswa");
    let formulir = document.createElement("fieldset");

    formulir.innerHTML = `
        <legend>Data Mahasiswa ${jumlahMahasiswa}</legend>

        <label>Nama Mahasiswa:</label>
        <input type="text" name="nama[]" required>
        <br><br>

        <label>NIM:</label>
        <input type="text" name="nim[]" required>
        <br><br>

        <label>Nilai Tugas:</label>
        <input type="number" name="tugas[]" min="0" max="100" step="any" required>
        <br><br>

        <label>Nilai UTS:</label>
        <input type="number" name="uts[]" min="0" max="100" step="any" required>
        <br><br>

        <label>Nilai UAS:</label>
        <input type="number" name="uas[]" min="0" max="100" step="any" required>
    `;

    daftar.appendChild(formulir);
}
</script>

<?php
function hitungNilaiAkhir($tugas, $uts, $uas ){
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);

}
function tentukanGrade($nilaiAkhir){
    if ($nilaiAkhir >= 85){
    return "A";
    }
    elseif($nilaiAkhir >= 75){
    return "B";

    }elseif ($nilaiAkhir >=65 ){
    return "C";
    }
    elseif ($nilaiAkhir >=50){
    return "D";
    }
    else {
    return "E";
    }
}
function tentukanStatus($nilaiAkhir){
    return $nilaiAkhir >= 65 ? "Lulus" : "Tidak Lulus";
}
function tentukanPredikat($nilaiAkhir){
    if ($nilaiAkhir >= 85) return "Sangat Baik";
    elseif ($nilaiAkhir >= 75) return "Baik";
    elseif ($nilaiAkhir >= 65) return "Cukup";
    elseif ($nilaiAkhir >= 50) return "Kurang";
    else return "Sangat Kurang";
}

function validasiNilai($nilai) {
    return is_numeric($nilai) && $nilai >= 0 && $nilai <= 100;
    }

if (isset($_POST['hitung'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $tugas = $_POST['tugas'];
    $uts = $_POST['uts'];
    $uas = $_POST['uas'];

    for ($i = 0; $i < count($nama); $i++) {
if (
    !validasiNilai($tugas[$i]) ||
    !validasiNilai($uts[$i]) ||
    !validasiNilai($uas[$i])
) {
    echo "Error: Semua nilai harus berada dalam rentang 0 sampai 100.<br>";
    continue;
}

        $nilaiAkhir = hitungNilaiAkhir($tugas[$i], $uts[$i], $uas[$i]);
        $grade = tentukanGrade($nilaiAkhir);
        $status = tentukanStatus($nilaiAkhir);
        $predikat = tentukanPredikat($nilaiAkhir);

    echo "<h2>Data Mahasiswa " . ($i + 1) . "</h2>";
    echo "Nama: " . htmlspecialchars($nama[$i]) . "<br>";
    echo "NIM: " . htmlspecialchars($nim[$i]) . "<br>";
    echo "Nilai Tugas: " . $tugas[$i] . "<br>";
    echo "Nilai UTS: " . $uts[$i] . "<br>";        echo "Nilai UAS: " . $uas[$i] . "<br>";

    echo "<h2>Hasil Perhitungan</h2>";
    echo "Nilai Akhir: " .number_format($nilaiAkhir, 2, ',', '.') . "<br>";
    echo "Grade: $grade <br>";
    echo "Status: $status <br>";
    echo "Predikat: $predikat <br>";
    echo "<hr>";
    }
}
?>

</body>
</html> 