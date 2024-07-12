<?php 
namespace model;

class user {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function register($username,$email,$password,$repassword,$nama,$role){
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : $_POST['username'];
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : $_POST['email'];
        $password = md5($_POST['password'], false);
        $repassword = md5($_POST['repassword'], false);
        $nama = htmlentities($_POST['nama_pengguna']) ? htmlspecialchars($_POST['nama_pengguna']) : $_POST['nama_pengguna'];
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : $_POST['role'];

        if($password != $repassword){
            header("location:../auth/register.php?info=passconfirm");
            return;
            exit;
        }

        $table = "user";
        if($role == "admin"){
            $sql = "INSERT INTO $table (username,email,password,repassword,nama_pengguna,role)
             VALUES ('$username','$email','$password','$repassword','$nama','$role')";
            $data = $this->db->query($sql);

            if($data != null){
                if($data){
                    header("location:../auth/register.php?info=berhasil");
                    return;
                    exit;
                }
            }else{
                header("location:../auth/register.php?info=gagal");
                return;
                exit;
            }
        }else if($role == "pengguna"){
            $alamat = htmlentities($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : $_POST['alamat'];
            $telepon = htmlentities($_POST['no_telepon']) ? htmlspecialchars($_POST['no_telepon']) : $_POST['no_telepon'];
            
            $sql = "INSERT INTO $table (username,email,password,repassword,alamat,no_telepon,nama_pengguna,role)
             VALUES ('$username','$email','$password','$repassword','$alamat','$telepon','$nama','$role')";
            $data = $this->db->query($sql);
            
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../auth/register.php?info=berhasil'</script>";
                    exit;
                }
            }else{
                echo "<script>document.location.href = '../auth/register.php?info=gagal'</script>";
                exit;
            }
        }
    }

    public function Edit($username,$email,$password,$repassword,$nama,$role,$id){
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : $_POST['username'];
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : $_POST['email'];
        $password = md5($_POST['password'], false);
        $repassword = md5($_POST['repassword'], false);
        $nama = htmlentities($_POST['nama_pengguna']) ? htmlspecialchars($_POST['nama_pengguna']) : $_POST['nama_pengguna'];
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : $_POST['role'];
        $id = htmlentities($_POST['id_akun']) ? htmlspecialchars($_POST['id_akun']) : $_POST['id_akun'];

        $table = "user";

        if($password != $repassword){
            echo "<script>
            document.location.href = '../ui/header.php?page=pengguna&info=passconfirm'
            </script>";
            return;
            exit;
        }
        
        if($role == "admin"){
            $sql = "UPDATE $table SET username='$username', email='$email', password='$password', repassword='$repassword',
             nama_pengguna='$nama', role='$role' WHERE id_akun = '$id'";
            $data = $this->db->query($sql);

            if($data != null){
                if($data){
                    // header("location:../ui/header.php?page=pengguna&info=update");
                    echo "<script>
                        document.location.href = '../ui/header.php?page=pengguna&info=update'
                    </script>";
                    return;
                    exit;
                }
            }else{
                // header("location:../ui/header.php?page=pengguna&info=gagal");
                echo "<script>
                    document.location.href = '../ui/header.php?page=pengguna&info=gagal'
                </script>";
                return;
                exit;
            }
        }elseif($role == "pengguna"){
            $alamat = htmlentities($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : $_POST['alamat'];
            $telepon = htmlentities($_POST['no_telepon']) ? htmlspecialchars($_POST['no_telepon']) : $_POST['no_telepon'];
            
            $sql = "UPDATE $table SET username = '$username', email = '$email', password = '$password', repassword = '$repassword',
             alamat = '$alamat', no_telepon = '$telepon', nama_pengguna = '$nama', role = '$role' WHERE id_akun = '$id'";
            $data = $this->db->query($sql);
            
            if($data != null){
                if($data){
                    // header("location:../ui/header.php?page=editpengguna&info=update");
                    echo "<script>
                    document.location.href = '../ui/header.php?page=editpengguna&info=update'
                    </script>";
                    return;
                    exit;
                }
            }else{
                // header("location:../ui/header.php?page=editpengguna&info=gagal");
                echo "<script>
                    document.location.href = '../ui/header.php?page=editpengguna&info=gagal'
                </script>";
                return;
                exit;
            }
        }
    }

    public function delete($id){
        $id = htmlentities($_GET['id_akun']) ? htmlspecialchars($_GET['id_akun']) : $_GET['id_akun'];
        $table = "user";
        $sql = "DELETE FROM $table WHERE id_akun = '$id'";
        $data = $this->db->query($sql);
        if($data != null){
            if($data){
                header("location:../ui/header.php?page=editpengguna&info=hapus");
                return;
                exit;
            }
        }else{
            header("location:../ui/header.php?page=editpengguna&info=gagal");
            return;
            exit;
        }
    }

    public function signin($userInput, $password){
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : $_POST['userInput'];
        $password = md5($_POST['password'], false);
        password_verify($password, PASSWORD_DEFAULT);

        $table = "user";
        $sql = "SELECT * FROM $table WHERE username='$userInput' and password='$password' || email='$userInput' and password='$password'";
        $data = $this->db->query($sql);
        $cek = mysqli_num_rows($data);

        if($cek > 0){
            $response = array($userInput,$password);
            $responsed['user'] = $response;
            if($row = mysqli_fetch_assoc($data)){
                if($row['role'] == "admin"){
                    $_SESSION['id_akun'] = $row['id_akun'];
                    $_SESSION['nama_pengguna'] = $row['nama_pengguna'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role'] = "admin";
                    header("location:../ui/header.php?page=beranda");
                }else if($row['role'] == "pengguna"){
                    $_SESSION['id_akun'] = $row['id_akun'];
                    $_SESSION['nama_pengguna'] = $row['nama_pengguna'];
                    $_SESSION['nomor_telepon'] = $row['no_telepon'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role'] = "pengguna";
                    header("location:../page/ui/header.php?page=beranda");
                }
                $_SESSION['status'] = true;
                $_COOKIE['cookies'] = $userInput;
                setcookie($responsed['user'], $row, time() + (86400 * 30), "/");
                array_push($responsed['user'], $row);
                exit;
            }
        }else{
            $_SESSION['status'] = false;
            header("location:../auth/login.php");
            exit;
        }
    }
}
?>