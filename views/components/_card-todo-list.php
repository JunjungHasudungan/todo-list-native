<?php 
    $todoList = [];
?>

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
            <?php if (count($todoList) > 0) :?>
                <?php foreach ($todoList as $index => $todo) :?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($index + 1); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($todo['name']);?>
                        </td>
                        <td class="px-6 py-4">
                            <?php if ($todo['status'] == 'active') :?>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-green-400 border border-green-400">
                                        <?php echo htmlspecialchars($todo['status']);?>
                                    </span>
                            <?php else: ?>
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">
                                    <?php echo htmlspecialchars($todo['status']);?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($todo['category']);?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($todo['description']);?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                        data todo list belum tersedia..
                </div>
            <?php endif; ?>
        </tbody>
    </table>
</div>