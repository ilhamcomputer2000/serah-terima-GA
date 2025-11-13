<?php
require_once 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_karyawan = $_POST['id_karyawan'];
    $password = $_POST['password'];
    
    try {
        $stmt = $koneksi->prepare("SELECT * FROM users WHERE Id_Karyawan = :id_karyawan");
        $stmt->bindParam(':id_karyawan', $id_karyawan);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // Check if password matches
            if ($password === $user['password']) {
                // Set up session
                $_SESSION['user_id'] = $user['Id_Karyawan'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];
                
                // Redirect based on role
                switch($user['role']) {
                    case 'admin':
                        header("Location: admin/dashboard_admin.php");
                        break;
                    case 'super_admin':
                        header("Location: super_admin/dashboard_super_admin.php");
                        break;
                    case 'user':
                        header("Location: user/dashboard_user.php");
                        break;
                    default:
                        header("Location: login.php?error=invalid_role");
                }
                exit();
            } else {
                header("Location: login.php?error=invalid_credentials");
                exit();
            }
        } else {
            header("Location: login.php?error=invalid_credentials");
            exit();
        }
    } catch(PDOException $e) {
        header("Location: login.php?error=system_error");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
