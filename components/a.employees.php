<?php
$result = $this->select->selectEmployeeTable();  

            $i = 0;
            
            while($row = $result->fetch_assoc()): ?>
            <tr class="striped border-b">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?=
                    $row['EmployeeID']
                ?></td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap flex items-center gap-1">

                <p><?=$row['EmployeeName']?></p>
                <?php if($row['Role'] == 'Admin') : ?>
                    <span class="check--svg bg-blue-500 size-4"></span>
                <?php endif; ?>

               </td>
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
            
            <?php

                $EmployeeID = $row['EmployeeID'];
                $c = $this->select->selectEmployeeData($EmployeeID);
                $c_row = $c->fetch_assoc();

            ?>
            
            <div id="employee_dialog_<?= $row['EmployeeID'] ?>" class="dialog hidden">
                <div class="inner_dialog pt-2">
                    <span id="close_dialog_<?= $row['EmployeeID'] ?>" class="close--svg size-8 bg-red-500 absolute top-3 right-3 hover:cursor-pointer hover:bg-red-800 transition-colors"></span>
                
                    <form method="POST" action="../utilities/updateemployee.php" enctype="multipart/form-data" class="w-full px-8">
                        <p class="font-semibold text-gray-900 text-xl">Employee #<?= $row['EmployeeID'] ?></p>
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <input type="hidden" name="employee_id" value="<?= $row['EmployeeID'] ?>">
                            <div class="w-full">
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $c_row['FirstName'] ?>" required="">
                            </div>
                            <div class="w-full">
                                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
                                <input type="text" name="last_name" min="0" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $c_row['LastName'] ?>" required="">
                            </div>

                            <div>
                                <label for="birth_date" class="block mb-2 text-sm font-medium text-gray-900">Birth Date</label>
                                <input type="date" name="birth_date" min="0" id="birth_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $c_row['BirthDate'] ?>" required="">
                            </div> 
                            <div>
                                <label for="phone_num" class="block mb-2 text-sm font-medium text-gray-900">Phone Num</label>
                                <input type="text" pattern="[0-9]{11}" name="phone_num" min="0" id="phone_num" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $c_row['PhoneNum'] ?>" required="">
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <input type="text" name="email" min="0" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $c_row['Email'] ?>" required="">
                            </div> 
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                <input type="password" name="password" min="0" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $c_row['Password'] ?>" required="">
                            </div> 

                            <div>
                                <label for="city" class="block mb-2 text-sm font-medium text-gray-900">City</label>
                                <input type="text" name="city" min="0" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $c_row['City'] ?>">
                            </div> 
                            <div>
                                <label for="barangay" class="block mb-2 text-sm font-medium text-gray-900">Barangay</label>
                                <input type="text" name="barangay" min="0" id="barangay" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $c_row['Barangay'] ?>">
                            </div>
                            <div>
                                <label for="street" class="block mb-2 text-sm font-medium text-gray-900">Street Name</label>
                                <input type="text" name="street" min="0" id="street" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $c_row['Street'] ?>">
                            </div> 
                            <div>
                                <label for="postal_code" class="block mb-2 text-sm font-medium text-gray-900">Postal Code</label>
                                <input type="text" name="postal_code" min="0" id="postal_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $c_row['PostalCode'] ?>">
                            </div> 
                        </div>
                        <div>
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                            <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            <option value="<?= $c_row['Role'] == 'Admin' ? 'Admin' : 'Employee' ?>"><?= $c_row['Role'] == 'Admin' ? 'Admin' : 'Employee' ?></option>
                                <option value="<?= $c_row['Role'] == 'Admin' ? 'Employee' : 'Admin' ?>"><?= $c_row['Role'] == 'Admin' ? 'Employee' : 'Admin' ?></option>
                            </select>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="inline-flex items-center px-8 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                                UPDATE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
<?php $i++;
endwhile;?>