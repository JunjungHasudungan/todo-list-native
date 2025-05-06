<?php 
    global $email, $password, $pdo;
    $errors = [];

    function login() {
        global $email, $password, $errors;
        $pdo = include  '../../config/database.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';

            if (empty($email)) {
                $errors['email'] = 'Email wajib diisi..';
            }
    
            if (empty($password)) {
                $errors['password'] = 'Password wajib diisi..';
            }

            if (empty($errors)) {
                // Menghubungkan ke database dan mengecek email dan password
                $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['logged_in']  = true;
                    $_SESSION['user_name']  = $user['name'];
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_id']    = $user['id'];
                    header("Location: ../dashboard.php");
                } else {
                    $errors['password'] = "Email atau password salah!";
                }
            }
            
        }
    }

    login();
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
                <form method="POST" action="/todo-list-native/views/auth/login.php" class="space-y-4">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" />
                        <p id="emailError" class="mt-2 text-sm text-red-600 dark:text-red-500"> 
                            <?php echo isset($errors['email']) ? htmlspecialchars($errors['email']) : '' ?> 
                        </p>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                        <p id="emailError" class="mt-2 text-sm text-red-600 dark:text-red-500"> 
                            <?php echo isset($errors['password']) ? htmlspecialchars($errors['password']) : '' ?> 
                        </p>
                        <!-- <p id="passwordError" class="mt-2 text-sm text-red-600 dark:text-red-500"></p> -->
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Not registered? <a href="/todo-list-native/views/auth/register.php" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<script>
    $(document).ready(function() {
        console.log('script login is running..') // mengecek agar melihat script bekerja atau tidak
       $('#formLogin').on('submit', function(event) { // mengaktifkan event submit dan menghandle event / peristiwa
            event.preventDefault(); // melindungi peristiwa pada formLogin
            
            let email = $('#email').val().trim(); // mengambil data value email 
            let password = $('#password').val().trim(); // mengambil data value/nilai password yang diinput

            let errorEmail = $('#emailError').text(''); // memghapus text error 
            let errorPassword = $('#passwordError').text(''); // memghapus text error 
            let errors = {}; // membuat objek errors untuk tempat menampung error yang terjadi
            if (!email) {
                errors.email = 'Email wajib diisi..'; // memberi value string untuk pesan email error kosong
            }

            if (!password) {
                errors.password = 'Password wajib diisi..'; // memberi value string untuk pesan email error kosong
            }

            if (Object.keys(errors).length > 0) {
                if (errors.email) {
                    setTimeout(function() {
                        $('#emailError').text('')
                    }, 1000);
                    $('#emailError').text(errors.email);
                }

                if (errors.password) {
                    setTimeout(function() {
                        $('#passwordError').text('')
                    }, 1000);
                    $('#passwordError').text(errors.password);
                }
            }

            $.ajax({
                url: '/todo-list-native/helpers/function.php',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ email: email, password: password }),
            });
       });
        
    });
</script>