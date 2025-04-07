<?php 
    $listProjet = [
        ['name' => 'Galeri Photo', 'description'    => 'Bahan untuk Ukk', 'category'    => 'website', 'status'  => 'active'],
        ['name' => 'NewsPortal', 'description'    => 'Project Sisipan', 'category'    => 'website', 'status'  => 'non-active'],
    ];
?>

<div class="mb-2 px-2 py-2">
    <button type="button" class="mb-2 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        + Project
    </button>
</div>

<div class="overflow-x-auto shadow-md sm:rounded-lg">
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

