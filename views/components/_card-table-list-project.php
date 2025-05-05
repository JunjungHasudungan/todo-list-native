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
        <template v-if="listProject.length > 0">
            <tr v-for="(project, index) in listProject" :key="project.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">
                    {{ index + 1 }}
                </td>
                <td class="px-6 py-4">
                    {{ project.name }}
                </td>
                <td class="px-6 py-4">
                        <span v-if="project.status == 'active' " class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-green-400 border border-green-400">
                            {{ project.status }}
                        </span>
                        <span v-else class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">
                                {{ project.status }}
                        </span>
                </td>
                <td class="px-6 py-4">
                    {{ project.category }}
                </td>
                <td class="px-6 py-4">
                    {{ project.description }}   
                </td>
                <td class="px-6 py-4 text-right flex gap-3">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <a @click="btnDeleteProject(project.id)" class="font-medium text-red-600 dark:text-red-500">Delete</a>
                </td>
            </tr>
        </template>
        <tr v-else>
            <td colspan="6" class="text-center p-4 text-sm text-yellow-800 bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300">
                <span class="font-medium">Belum ada data project.</span>
            </td>
        </tr>
    </tbody>
</table>