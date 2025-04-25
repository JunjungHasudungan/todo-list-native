<?php 
    global $name, $email, $password, $password_confirmation, $pdo;
    $errors = [];

    function register() {
        global $name, $email, $password, $password_confirmation, $errors;
        $pdo = include  '../../config/database.php';
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); 
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = isset($_POST['name']) ? trim($_POST['name']) : '';  
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';  
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';  
            $password_confirmation = isset($_POST['password_confirmation']) ? trim($_POST['password_confirmation']) : '';  
            
            if (empty($name)) {
                $errors['name'] = 'nama wajib disi..';
            }
            if(!empty(strlen($name)) < 5){ 
                $errors['name'] = 'Nama minimal 4 karakter..';
            }

            if (empty($email)) {
                $errors['email'] = 'email wajib disi..';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL) && ! empty($email)) {
                $errors['email'] = 'Format email tidak valid';
            }

            if (empty($password)) {
                $errors['password'] = 'password wajib disi..';
            }

            if (! empty($password) && !empty(strlen($password)) < 6) {
                $errors['password'] = 'Password harus lebih dari 6 karakter';
            }

            if (empty($password_confirmation)) {
                $errors['password_confirmation'] = 'password confirmasi wajib disi..';
            }

            if (!empty($password) !== !empty($password_confirmation)) {
                $errors['password_confirmation'] = 'password confirmasi tidak cocok..';
            }

            // Cek apakah email sudah ada di database
            $sqlCheckEmail = "SELECT * FROM users WHERE email = :email";
            $stmtCheckEmail = $pdo->prepare($sqlCheckEmail);
            $stmtCheckEmail->execute([':email' => $email]);

            if ($stmtCheckEmail->rowCount() > 0) {
                $errors['email'] = 'Email sudah terdaftar';
            }

            if (empty($errors)) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                // Simpan ke database
                $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([
                        ':name' => $name,
                        ':email' => $email,
                        ':password' => $hashedPassword
                    ]);
    
                    if ($result) {
                        // Setelah pendaftaran berhasil, atur sesi
                        $userId = $pdo->lastInsertId();
            
                        // Ambil data pengguna berdasarkan ID
                        $sql = "SELECT id, name, email FROM users WHERE id = :id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([':id' => $userId]);
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
                        $_SESSION['logged_in'] = true;
                        $_SESSION['user_name'] = $name; // Atur nama pengguna di sesi
    
                        header("Location: ../dashboard.php");
                    }
            }

        }
    }

    register();
?>

<div class="flex fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="mb-2 text-center font-bold">
            <span><?php echo $pageTitle;?> | <?php echo $appName; ?> </span>
        </div>
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form method="POST" action="/todo-list-native/views/auth/register.php" class="space-y-4">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Write your username" />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"> 
                            <?php  echo isset($errors['name']) ? htmlspecialchars($errors['name']) : ''; ?> 
                        </p>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            <?php echo isset($errors['email']) ? htmlspecialchars($errors['email']) : ''; ?>
                        </p>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            <?php echo isset($errors['password']) ? htmlspecialchars($errors['password']) : ''; ?>
                        </p>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">password confirmation</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            <?php echo isset($errors['password_confirmation']) ? htmlspecialchars($errors['password_confirmation']) : ''; ?>
                        </p>
                    </div>
                    <button type="submit" 
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Register
                    </button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        already registered? <a href="/todo-list-native/views/auth/login.php" class="text-blue-700 hover:underline dark:text-blue-500">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<!-- <script>
    function registerForm() {
        return {
            username: '',
            password: '',
            email: '',
            password_confirmation: '',
            errors: {},
            sendRegister() {
                this.errors = {}

                if (!this.username) {
                    this.errors.username = 'nama tidak boleh kosong';
                }

                if (!this.email) {
                    this.errors.email = "Email tidak boleh kosong";
                } else if (!this.email.includes("@")) {
                    this.errors.email = "Email tidak valid";
                }

                if(!this.password) {
                    this.errors.password = 'password tidak boleh kosong';
                }
            }
        }
    }
</script> -->