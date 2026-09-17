
<div class="flex fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="mb-2 text-center font-bold">
            <span><?php echo $pageTitle;?> | <?php echo $appName; ?> </span>
        </div>
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form id="form_register" class="space-y-4">
                    <input
                        type="hidden"
                        id="csrf_token"
                        name="csrf_token"
                        value="<?= htmlspecialchars(csrf_token()) ?>"
                    >
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Write your username" />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"> 
                        </p>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        </p>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        </p>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">password confirmation</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500" id="err_pass_confirm">
                        </p>
                    </div>
                    <button type="submit" 
                            id="btn_register"
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
<script>
    document.addEventListener("DOMContentLoaded",()=> {
        const form = document.getElementById("form_register")
        const input_nama = document.getElementById("name")
        const input_email = document.getElementById("email")
        const input_password = document.getElementById("password")
        const input_password_confirmation = document.getElementById("password_confirmation")
        const err_pass_confirm = document.getElementById("err_pass_confirm")
        const csrfToken = document.getElementById("csrf_token").value
        const button = document.getElementById("btn_register")
        const inputs = form.querySelectorAll("input")


        form.addEventListener("submit", btnRegister)

        async function btnRegister(event) {
            event.preventDefault()

            if(input_password.value != input_password_confirmation.value){
                err_pass_confirm.innerHTML = "password tidak cocok"
                return
            }else {
                 err_pass_confirm.innerHTML = ""
            }

            const dataUser = {
                name: input_nama.value,
                email: input_email.value,
                password: input_password.value,
            }

            const url = new URL(window.location.href)

            const baseUrl = url.origin + '/todo-list-native'

            try {
                const response = await fetch(baseUrl + "/services/authentikasi.php", {
                    method: "POST",
                    
                    headers: {
                        "Content-Type" : "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify(dataUser)
                })

                const data = await response.json()
                console.log('data', data)

            console.log("response server:", data)
            } catch (error) {
                console.log('error',error)
            }
            
        }

        function checkForm() {
            const isComplete = [...inputs].every(input => {
                return input.value.trim() !== ""
            })

            button.disabled = !isComplete

            if (isComplete) {
                button.classList.remove(
                    "bg-gray-400",
                    "cursor-not-allowed"
                )

                button.classList.add(
                    "bg-blue-700",
                    "hover:bg-blue-800",
                    "cursor-pointer"
                )

            } else {

                button.classList.remove(
                    "bg-blue-700",
                    "hover:bg-blue-800",
                    "cursor-pointer"
                )

                button.classList.add(
                    "bg-gray-400",
                    "cursor-not-allowed"
                )
            }
        }

        inputs.forEach(input => {
            input.addEventListener("input", checkForm)
        })
    })
</script>