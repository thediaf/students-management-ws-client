<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banque Web Service</title>
</head>
<body>
    <?php
    if (isset($_POST['method'])) 
    {
        $client = new SoapClient("http://localhost:8020/StudentController?wsdl");

        $students = $client->__soapCall("getStudents", []);
    }
    ?>

    <form action="index.php" method="post">
        <input type="submit" value="etudiants" name="method">
    </form>
    <?php if (isset($students)) { ?>   
        <p>Liste des etudiants:</p> 
        <table border="2" style="margin: 7px;">
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Prenom</th>
            </tr>
        <?php foreach ($students->return as $student) { ?>
            <tr>
                <td> <?= $student->code ?></td>
                <td> <?= $student->firstname ?></td>
                <td> <?= $student->lastname ?></td>
            </tr>
        <?php } ?>
        </table>
    <?php } ?>
</body>
</html>