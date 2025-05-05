<div id="app">
    <button 
        v-if="!isShow"
        @click="openModal"
        type="button"
        class="mb-2 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        + Project
    </button>
    <div v-if="isShow" id="crud-modal" class="flex fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
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
               <?php include '_card-form-create-project.php'; ?>
            </div>
        </div>
    </div> 
    <div v-if="!isShow" class="overflow-x-auto shadow-md sm:rounded-lg">
        <?php include '_card-table-list-project.php'; ?>    
    </div>
</div>

<script type="module">
  import { createApp, ref, reactive, onMounted } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

  createApp({
    setup() {
      const isShow = ref(false);
      const project = reactive({
        name: '',
        description: '',
        status: '',
        category: '',
      });
      const listProject = ref([]);
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

      onMounted(
            async ()=> getDataProject()
        );

      const openModal = ()=> {
        isShow.value = true;
      }

      function btnDeleteProject(id) {
        let confirm = window.confirm('yakin untuk menghapus?')
        if(confirm) {
            sendDeleteProject(id);
        }
        return
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
                    await  getDataProject();
                }
        } catch (error) {
            console.log(error)
        }

      }

    async function getDataProject() {
        try {
            const response = await axios.get('/todo-list-native/services/project.php');
            listProject.value = response.data.data;
            
        } catch (error) {
            console.log(error)
        }
    }

    async function sendDeleteProject(projectId) {
        try {
            const formData = new FormData();
            formData.append('action', 'delete'); 
            formData.append('id', projectId);
            
            const response = await axios.post('/todo-list-native/services/project.php', formData);
            const result = response.data
            if (result.success) {
                await getDataProject();
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
        openModal, 
        name, 
        description, 
        status, 
        category, 
        closeModal, 
        isShow, 
        sendDataProject, 
        errors, 
        project,
        listProject,
        btnDeleteProject,
      }
    }
  }).mount('#app')
</script>
