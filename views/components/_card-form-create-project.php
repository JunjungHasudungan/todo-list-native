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