<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
    <title>Gestion Etudiant</title>
</head>
<body>

    <?php
        $client = new SoapClient("http://localhost:8020/StudentController?wsdl");
        
        $accounts = $client->__soapCall("getStudents", []);
        if (isset($_POST['method'])) 
        {
            
            if ($_POST['method'] == "ajouter") 
            {
                $param = new stdClass();
                $param->lastname = $_POST['nom'];
                $param->firstname = $_POST['prenom'];
                var_dump($param);
                $result = $client->__soapCall("insert", array($param));
            }
            elseif ($_POST['method'] == "modifier") 
            {
                $param = new stdClass();
                $param->id = $_POST['id'];
                $param->lastname = $_POST['nom'];
                $param->firstname = $_POST['prenom'];
                var_dump($param);
                $result = $client->__soapCall("update", array($param));
            }
            
            elseif($_POST['method'] == "supprimer"){
                $param = new stdClass();
                $param->id = $_POST['id'];
                var_dump($param);
                $resdelete = $client->__soapCall("delete", array($param));
            }

        }
    ?>

    <nav class="navbar navbar-light bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1 text-center" style="color:white">Gestion Etudiant</span>
    </div>
    </nav>
    <div style="height: 40px">

    </div>
    <!-- Ajouter Etudiant -->
    <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Modal1" >
        Ajouter Etudiant
    </button> -->
    
    <form method="post" action="new.php"> 
        <input type="hidden" name="action" value="ajouter" />
        <input style="background-color: #9fccff" class="btn btn-success" type="submit" value="ajouter"/>
    </form>


<div class="container">
<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<div class="table-responsive">
				<table class="table user-list">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Prenom</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        if(isset($accounts)){

                        
                        foreach ($accounts->return as $account) {
                    ?>
						<tr>
                            <td> <?= $account->lastname ?></td>
                            <td> <?= $account->firstname ?></td>

                            <td style="width: 20%;">
                                <form method="post" action="new.php"> 
                                    <input type="hidden" name="id" value="<?php echo $account->id; ?>" />
                                    <input type="hidden" name="action" value="modifier" />
                                    <input style="background-color: #9fccff" type="submit" value="modifier"/>
                                </form>

                                <form method="post" action=""> 
                                    <input type="hidden" name="id" value="<?php echo $account->id; ?>" />
                                    <input style="background-color: red; color:azure" type="submit" value="supprimer" name="method"/>
                                </form>
                            </td>
						</tr>
						<?php
                             }
                            }
                        ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
