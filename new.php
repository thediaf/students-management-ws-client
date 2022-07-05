<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <title>Gestion Etudiant</title>
</head>
<body>

    <?php
        if (isset($_POST['id'])) {
            # code...
            $client = new SoapClient("http://localhost:8020/?wsdl");
            
            $accounts = $client->__soapCall("getStudents", []);
            
            $param = new stdClass();
            $param->id = $_POST['id'];

            $student = $client->__soapCall("getStudent", array($param));
        }
    
?>


<form action="clientjws.php" method="post">
        <input type="hidden" name="id"  value="<?= $student->return->id ?>">
        Nom : <input type="text" name="nom" value="<?= $student->return->lastname ?>">
        Prenom : <input type="text" name="prenom" value="<?= $student->return->firstname ?>">
        <input type="submit" value="<?= $_POST['action'] ?>" name="method">
    </form>
</body>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
</head>
