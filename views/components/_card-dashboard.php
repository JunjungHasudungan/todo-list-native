<?php 
    global $userId;

    $listProjet = [
        ['name' => 'Galeri Photo', 'description'    => 'Bahan untuk Ukk', 'category'    => 'website', 'status'  => 'active'],
        ['name' => 'NewsPortal', 'description'    => 'Project Sisipan', 'category'    => 'website', 'status'  => 'non-active'],
    ];

?>

<div id="app">
        <button 
            v-if="!isShow"
            @click="openModal"
            type="button"
            class="mb-2 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            + Project
        </button>
        <!-- Main modal -->
        <div v-if="isShow" id="crud-modal" class="flex fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Create New Product
                        </h3>
                        <button 
                            @click="closeModal"
                            type="button" 
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form @submit.prevent="sendDataProject" method="POST"  enctype="multipart/form-data" class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Project</label>
                                <input type="text" v-model="project.name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type project name">
                                <p v-if="errors.name" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ errors.name }} </p>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                <select id="category" v-model="project.status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" disabled>Select status</option>
                                    <option value="active">Active</option>
                                </select>
                                <p v-if="errors.status" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ errors.status }} </p>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select id="category" v-model="project.category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" disabled>Select category</option>
                                    <option value="website">Website</option>
                                    <option value="desktip">Desktop</option>
                                    <option value="mobile">Mobile</option>
                                </select>
                                <p v-if="errors.category" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ errors.category }} </p>
                            </div>
                            <div class="col-span-2">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Description</label>
                                <textarea id="description" v-model="project.description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write project description here"></textarea>                    
                                <p v-if="errors.description" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ errors.description }} </p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Save
                            </button>
                            <button 
                                @click="closeModal"
                                type="button" 
                                class="text-white inline-flex items-center bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                            Close
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    <div v-if="!isShow" class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Project name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Keterangan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($listProjet) > 0) :?>
                    <?php foreach ($listProjet as $index => $project) :?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                <?php echo htmlspecialchars($index + 1); ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo htmlspecialchars($project['name']);?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($project['status'] == 'active') :?>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-green-400 border border-green-400">
                                            <?php echo htmlspecialchars($project['status']);?>
                                        </span>
                                <?php else: ?>
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">
                                        <?php echo htmlspecialchars($project['status']);?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo htmlspecialchars($project['category']);?>
                            </td>
                            <td class="px-6 py-4">
                            <?php echo htmlspecialchars($project['description']);?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                        <span class="font-medium">Warning alert!</span> Change a few things up and try submitting again.
                    </div>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<script type="module">
  import { createApp, ref, reactive } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

  createApp({
    setup() {
      const isShow = ref(false);
      const project = reactive({
        name: '',
        description: '',
        status: '',
        category: '',
      });
      const name = ref("");
      const description = ref("");
      const status = ref("");
      const category = ref("");
      const errors = reactive({
        name: '',
        description: '',
        status: '',
        category: '',
      });

      const openModal = ()=> {
        isShow.value = true;
      }

      function resetForm() {
        project.name = "";
        project.description = "";
        project.status = "";
        project.category = "";
      }

      function resetError() {
        errors.name = "";
        errors.description = "";
        errors.status = "";
        errors.category = "";
      }

      async function sendDataProject () {
        Object.keys(errors).forEach(key => errors[key] = '');

        if (!project.name) errors.name = "nama project wajib diisi.."

        if (!project.description) errors.description = "keterangan project wajib diisi.."

        if (!project.status) errors.status = "status project wajib diisi.."
       
        if (!project.category) errors.category = "category project wajib diisi.."

        if (Object.values(errors).some(error => error)) return; 

        try {
            const formData = new FormData();
            formData.append('action', 'store'); 
            formData.append('name', project.name);
            formData.append('status', project.status);
            formData.append('category', project.category);
            formData.append('description', project.description);

            // mengirim data project
            const response = await axios.post('/todo-list-native/services/project.php', 
                formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                });

                const result = response.data;
                if (result.success) {
                    resetForm();
                    isShow.value = false;
                }
        } catch (error) {
            console.log(error)
        }

      }
      const closeModal = () => {
        if (project.name != "" || project.description != "" || project.status != "" || project.description != "") {
            let confirm = window.confirm("yakin untuk membatalkan?")
            if (confirm) {
                isShow.value = false;
                resetForm();
                resetError();

            }
            return;
        }
        isShow.value = false;
        resetError();
        resetForm();
      }
      return {
        openModal, name, description, status, category, closeModal, isShow, sendDataProject, errors, project
      }
    }
  }).mount('#app')
</script>
