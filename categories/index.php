<?php
    include "../app/categoryController.php";
    $categoryController = new
    CategoryController();

    
    $categories = $categoryController->get();
    echo json_encode($categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style type="text/css">
        #updateform     
        {
            display: none;
        }
             
        
    </style>
</head>
<body>
    
    <div>
        <table>
            <thead>
                <th>
                    id
                </th>
                <th>
                    nombre
                </th>
                <th>
                desc
                </th>
                <th>
                    action
                </th>
                <tbody>
                    
                    <?php foreach ($categories as $category): ?>

							<tr>
								
								<td>
									<?= $category['id'] ?>
								</td>
								<td>
									<?= $category['name'] ?>
								</td>
								<td>
									<?= $category['description'] ?>
								</td>
								<td><button onclick="edit(<?= $category['id'] ?>,'<?= $category['name'] ?>',
                                '<?= $category['description'] ?>', '<?= $category['status'] ?>')">editar</button>
                                <button onclick="remove(<?= $category['id'] ?>)">
                                    borrar
                                </button>
                            
                            </td>
                                    
							</tr>
								
				<?php endforeach ?>

                </tbody>
            </thead>
        </table>
        <div>
        
        <form action="../app/categoryController.php" method="POST">
            <fieldset>

                <legend>
                    Add new Category
                </legend>

                <label>
                    Name
                </label>
                <input type="text"  name="name" placeholder="terror" required=""> 
                <br>

                <label>
                    Description
                </label>
                <textarea placeholder="write here" name="description" rows="5" required=""></textarea>
                <br>

                <label>
                    Status
                </label>
                <select name="status">
                    <option> active </option>
                    <option> inactive </option>
                </select>
                <br>

                <button type="sumbit" >Save Category</button>
                        <input type="hidden" name="action" value="store">
                        
            </fieldset>
        </form>

        <form id="storeForm" action="../app/categoryController.php" method="POST">


        </form>
        <form id="updateForm" style="display: none;" action="../app/categoryController.php" method="POST">
            <fieldset>

                <legend>
                    edit Form
                </legend>

                <label>
                    Name
                </label>
                <input id="name" type="text"  name="name" placeholder="terror" required=""> 
                <br>

                <label>
                    Description
                </label>
                <textarea id="description" placeholder="write here" name="description" rows="5" required=""></textarea>
                <br>

                <label>
                    Status
                </label>
                <select id="status" name="status">
                    <option> active </option>
                    <option> inactive </option>
                </select>
                <br>

                <button type="sumbit" >Save Category</button>
                        <input type="hidden" name="action" value="store">
                        <input type="hidden" id="hidden" name="id" value="update">
                        
            </fieldset>
        </form>

        <form action="../app/categoryController.php" id="destroyForm" method="POST">

        <input type="hidden" name="action" value="destroy">
        <input type="hidden" name="id" value="id_destroy">

        </form>


        </div>
    </div>
                        <script type="text/javascript">
                        function edit(id,name,description,status){
                            document.getElementById('storeForm').style.display="none";
                            document.getElementById('updateForm').style.display="block";

                            document.getElementById('name').value = name;
                            document.getElementById('description').value=description
                            document.getElementById('status').value=status;
                            document.getElementById('id').value=id;
                            alert("hola")

                        }

                        function remove(id){
                            var confirm = prompt("Si quires Eliminar el registro, escruba:"+id);
                            if(confirm == id){
                                document.getElementById('id_destroy').value = id;
                                documen.getElementById('destroyForm').sumbit();

                            }
                        }
                        </script>
</body>
</html>