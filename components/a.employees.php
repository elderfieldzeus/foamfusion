<?php
$result = $this->select->selectEmployeeTable();  

            $i = 0;
            
            while($row = $result->fetch_assoc()): ?>
            <tr class="striped border-b">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?=
                    $row['EmployeeID']
                ?></td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?=
                    $row['EmployeeName']
                ?></td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?=
                    $row['Email']
                ?></td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?=
                    $row['PhoneNum']
                ?></td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?=
                    $row['FullAddress']
                ?></td>
                <td class="pt-1">
                    <button onclick="openDialog('<?= $row['EmployeeID'] ?>')" class="size-10 bg-yellow-400 rounded-lg flex items-center justify-center"><span class="edit--svg size-6 bg-white"></span></button>
                </td>
            </tr>       
            
            <div id="employee_dialog_<?= $row['EmployeeID'] ?>" class="dialog hidden">
                <div class="inner_dialog">
                    <span id="close_dialog_<?= $row['EmployeeID'] ?>" class="close--svg size-8 bg-red-500 absolute top-3 right-3 hover:cursor-pointer hover:bg-red-800 transition-colors"></span>
                </div>
            </div>
<?php $i++;
endwhile;?>