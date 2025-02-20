<?php
// Set Waktu
date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d H:i:s');

// Koneksi Database
$HOSTNAME = "localhost";
$DATABASE = "db_pos";
$USERNAME = "root";
$PASSWORD = "";


$KONEKSI = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if (!$KONEKSI) {

    die("ERROR BANG!!... BACA TUH EROR -->" . mysqli_connect_error($KONEKSI));
}

if (!function_exists('autonumber')) {
    function autonumber($tabel, $kolom, $lebar = 0, $awalan)
    {
        global $KONEKSI;
        $auto = mysqli_query($KONEKSI, "SELECT $kolom FROM $tabel WHERE $kolom LIKE '$awalan%' ORDER BY $kolom DESC LIMIT 1") or die(mysqli_error($KONEKSI));
        $jumlah_record = mysqli_num_rows($auto);

        if ($jumlah_record == 0) {
            $nomor = 1;
        } else {
            $row = mysqli_fetch_array($auto);
            $nomor = intval(substr($row[0], strlen($awalan))) + 1;
        }

        if ($lebar > 0) {
            $angka = $awalan . str_pad($nomor, $lebar, "0", STR_PAD_LEFT);
        } else {
            $angka = $awalan . $nomor;
        }

        return $angka;
    }
}

echo autonumber("tbl_users", "id_user", 3, "USR");

// Fungsi Register
if (!function_exists('registrasi')) {
    function registrasi($data)
    {

        global $KONEKSI;
        global $tgl;

        $id_user = stripslashes($data['id_user']);
        $nama = stripslashes($data['nama']); // Untuk cek form register dari input nama
        $email = strtolower(stripslashes($data['email'])); // Memastikan form register mengirim input enail berupa huruf kecil semua
        $password = mysqli_real_escape_string($KONEKSI, $data['password']);
        $password2 = mysqli_real_escape_string($KONEKSI, $data['password2']);

        //echo $nama ."|" . $email . "|" . $password . "|" . $password;

        // Cek Email yang di input ada belum di database
        $result = mysqli_query($KONEKSI, "SELECT email from tbl_users WHERE email='$email'");
        //var_dump($result);

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
    alert('Email yang di input sudah di database!!!');
    </script>";
            return false;
        }

        // Cek Konfirmasi password
        if ($password !== $password2) {
            echo "<script>
    alert('Konfirmasi Password tidak sesuai!!!');
    document.location.href='register.php';
    </script>";
            return false;
        }

        // Enkripsi password yang akan kita masukan kedatabase
        $password_hash = password_hash($password, PASSWORD_DEFAULT); // Mengunakan algoritma default dari hash
        //var_dump($password_hash);

        // Ambil id_tipe_user yang ada di tabel tbl_tipe_user

        $tipe_user = "SELECT * FROM tbl_tipe_user WHERE tipe_user='Admin'";
        $hasil = mysqli_query($KONEKSI, $tipe_user);
        $row = mysqli_fetch_assoc($hasil);
        $id = $row['id_tipe_user'];

        // Tambah user baru ke tbl_user
        $SQL = "INSERT INTO tbl_users SET
    id_user = '$id_user',
    role = '$id',
    email = '$email',
    password ='$password_hash',
    create_at = '$tgl' ";

        mysqli_query($KONEKSI, $SQL) or die("Gagal Menambahkan User" . mysqli_error($KONEKSI));

        // Tambah user baru ke tbl_admin
        $SQL = "INSERT INTO tbl_admin SET
    id_user = '$id_user',
    nama_admin = '$nama',
    create_at = '$tgl' ";

        mysqli_query($KONEKSI, $SQL) or die("Gagal Menambahkan User" . mysqli_error($KONEKSI));

        echo "<script>
    document.location.href='login.php';
    </script>";
        return mysqli_affected_rows($KONEKSI);
    }
}

if (!function_exists('login')) {
    function login($DATA)
    {
        global $KONEKSI;

        $email = strtolower(stripslashes($_POST['email'])); // email diinput user
        $userpass = mysqli_real_escape_string($KONEKSI, $_POST['password']); //pw di input user

        // echo $email ." ". $userpass;
        // query ke db
        $sql = mysqli_query($KONEKSI, "SELECT password, role FROM tbl_users WHERE email='$email'");

        list($paswd, $role) =  mysqli_fetch_array($sql);

        // ambil role/tipe user dari tbl_tipe_user

        // caraku 
        // $level = mysqli_fetch_assoc(mysqli_query($KONEKSI, "SELECT tipe_user FROM tbl_tipe_user WHERE id_tipe_user = '$role'"))['tipe_user'];

        // cara bapa 
        $tipe_user = "SELECT * FROM tbl_tipe_user WHERE id_tipe_user='$role'";
        $hasil = mysqli_query($KONEKSI, $tipe_user);
        $row = mysqli_fetch_assoc($hasil);
        $level = $row['tipe_user'];

        // jika data di db ditemukan , maka validasi dengan password_verify

        if (mysqli_num_rows($sql) > 0) {
            /* jika ada data (>0) maka kita lakukan validasi
        
        $userpass -> dari form
        $paswd -> dari db dalam bentuk hash
        */
            if (password_verify($userpass, $paswd)) {
                // kita buat session baru

                $_SESSION['email'] = $email;
                $_SESSION['level'] = $level;

                /* jika login berhasil, user akan di arahkan sesuai level user
            level admin --> admin/index.php
            level owner --> owner/index.php
            level petugas --> petugas/index.php
            level penyewa --> penyewa/index.php
            level karyawan --> karyawan/index.php
            */

                if ($_SESSION['level'] == 'Admin') {
                    header('location:../admin/index.php');
                } elseif ($_SESSION['level'] == 'Owner') {
                    header('location:../owner/index.php');
                } elseif ($_SESSION['level'] == 'Petugas') {
                    header('location:../petugas/index.php');
                } elseif ($_SESSION['level'] == 'Penyewa') {
                    header('location:../penyewa/index.php');
                } elseif ($_SESSION['level'] == 'Karyawan') {
                    header('location:../karyawan/index.php');
                }
                die();
            } else {
                echo '<script language="javascript">
                window.alert("LOGIN GAGAL  --> email/pw salah");
                window.document.location.href="login.php";
            </script>';
            }
        } else {
            echo '<script language="javascript">
            window.alert("LOGIN GAGAL  --> email tidak ditemukan");
            window.document.location.href="login.php";
        </script>';
        }
    }
}

if (!function_exists('cek_role_user')) {
    function cek_role_user($email, $level)
    {
        $current_path = $_SERVER['SCRIPT_NAME']; // Mendapatkan path file yang sedang diakses
        if ($email) {
            // Cek apakah file yang sedang diakses adalah register.php
            if (strpos($current_path, 'register.php') !== false) {
                // Hanya admin yang boleh mengakses halaman register.php
                if ($level != "Admin") {
                    header("location: ../" . strtolower($level) . "/index.php"); // Redirect ke index user yang sesuai
                    exit(); // Hentikan eksekusi skrip
                }
            }
            // strpos digunakan jika user sudah di path file yang sesuai maka kode tidak akan dikerjakan, berguna untuk mencegah redirect loop

            // Jika user level "Owner" dan saat ini tidak berada di folder admin
            elseif ($level == "Owner" && strpos($current_path, 'owner') === false) {
                header("location: ../owner/index.php"); // Arahkan ke halaman admin
                exit(); // Hentikan eksekusi skrip
            }
            // Jika user level "Admin" dan saat ini tidak berada di folder admin
            elseif ($level == "Admin" && strpos($current_path, 'admin') === false) {
                header("location: ../admin/index.php"); // Arahkan ke halaman admin
                exit(); // Hentikan eksekusi skrip
            }
            // Jika user level "Penyewa" dan saat ini tidak berada di folder penyewa
            elseif ($level == "Penyewa" && strpos($current_path, 'penyewa') === false) {
                header("location: ../penyewa/index.php"); // Arahkan ke halaman penyewa
                exit(); // Hentikan eksekusi skrip
            }
            // Jika user level "Petugas" dan saat ini tidak berada di folder petugas
            elseif ($level == "Petugas" && strpos($current_path, 'petugas') === false) {
                header("location: ../petugas/index.php"); // Arahkan ke halaman petugas
                exit(); // Hentikan eksekusi skrip
            }
            // Jika user level "Karyawan" dan saat ini tidak berada di folder admin
            elseif ($level == "Karyawan" && strpos($current_path, 'karyawan') === false) {
                header("location: ../karyawan/index.php"); // Arahkan ke halaman admin
                exit(); // Hentikan eksekusi skrip
            }
        } elseif (!$email && strpos($current_path, 'login') === false) {
            // Jika email tidak ada atau user tidak memiliki level yang sesuai
            header("location: ../inc/login.php");
            exit();
        }
    }
}

// FUngsi Tampil data
if (!function_exists('tampil')) {
    function tampil($DATA)
    {
        global $KONEKSI;
        $hasil = mysqli_query($KONEKSI, $DATA);
        $data = []; //Menyiapkan variabel/wadah yang masih kosong untuk nantinya akan kita gunakan untuk menyimpan data yang kita query/panggil dari database.

        while ($row = mysqli_fetch_assoc($hasil)) {
            $data[] = $row; // Kita Masukan datanya disimi

        }
        return $data; // kita kembalikan nilainya , dimunculkan
    }
}

