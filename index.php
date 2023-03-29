<?php

  $username = "root";
  $password = "";
  $database = "graph";

  TRY {
    $pdo = new PDO("mysql:host=localhost;database=$database;", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  } 

  catch(PDOException $e) {
    die("ERROR: Could not connect" . $e->getMessage());
  }

  ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style type="text/css">
  body {
    background-color: #00a5a5;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .chartbox {
    width: 1000px;
    max-height: 700px;
    padding: 50px;
    border-radius: 20px;
    background-color: #e94a34;
    display: inline-block;
    margin: 90px;
    text-align: center;
  }

  .chartbox h2 {
    color: #fec800;
    margin-top: 0;
  }

  .chartbox canvas {
  background-color: #fff;
  width: 100%;
  max-height: 500px;
  height: auto;
}
</style>
  <title>chart</title>
</head>
<body>

<?php

try{
  $sql = "SELECT * FROM graph.base_entreprise_2022_2023___fichier";
  $result = $pdo->query($sql);
  if($result->rowCount() > 0) {
    $Codedepartement = array();
    $Comptefiche = array();
    $SIRET = array();
    $CategorieTPEPMEETIGE = array();

    while($row = $result->fetch()) {
      $Codedepartement[] = $row["Code département"];
      $Comptefiche[] = $row["Compte fiche"];
      $SIRET[] = $row["SIRET"];
      $CategorieTPEPMEETIGE[] = $row["Catégorie _TPE_PME_ETI_GE_"];
    }
  unset($result);
  } else {
    echo "no match";
  }
} catch(PDOException $e)
  {die("ERROR: can't execute sql " . $e->getMessage());}

  try {
    $sql = "SELECT COUNT(CASE WHEN `Trouvée via NWS` = 'OUI' THEN 1 END) as oui, COUNT(CASE WHEN `Trouvée via NWS` = 'NON' THEN 1 END) as non FROM graph.base_entreprise_2022_2023___fichier";
    $result = $pdo->query($sql);
    if ($result) {
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $oui = $row['oui'];
      $non = $row['non'];
    }
  } catch (PDOException $e) {
    die("ERROR: can't execute sql " . $e->getMessage());
  }

  try {
    $sql = "SELECT COUNT(CASE WHEN `Annonce reçue` = 'OUI' THEN 1 END) as iuo, COUNT(CASE WHEN `Trouvée via NWS` = '' THEN 1 END) as uou FROM graph.base_entreprise_2022_2023___fichier";
    $result = $pdo->query($sql);
    if ($result) {
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $iuo = $row['iuo'];
      $uou = $row['uou'];
    }
  } catch (PDOException $e) {
    die("ERROR: can't execute sql " . $e->getMessage());
  }
  

  try {
    $sql = "SELECT COUNT(CASE WHEN `Code département` = '27' THEN 1 END) as a ,COUNT(CASE WHEN `Code département` = '76' THEN 1 END) as b ,
    COUNT(CASE WHEN `Code département` = '50' THEN 1 END) as c ,COUNT(CASE WHEN `Code département` = '61' THEN 1 END) as d ,
    COUNT(CASE WHEN `Code département` = '14' THEN 1 END) as e  FROM graph.base_entreprise_2022_2023___fichier";
    $result = $pdo->query($sql);
    if ($result) {
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $a = $row['a'];
      $b = $row['b'];
      $c = $row['c'];
      $d = $row['d'];
      $e = $row['e'];

    }
  } catch (PDOException $e) {
    die("ERROR: can't execute sql " . $e->getMessage());
  }

  try {
    $sql = "SELECT COUNT(CASE WHEN `Catégorie _TPE_PME_ETI_GE_` = 'PME' THEN 1 END) as PME, COUNT(CASE WHEN `Catégorie _TPE_PME_ETI_GE_` = 'ETI' THEN 1 END) as ETI,
    COUNT(CASE WHEN `Catégorie _TPE_PME_ETI_GE_` = 'GE' THEN 1 END) as GE, COUNT(CASE WHEN `Catégorie _TPE_PME_ETI_GE_` = 'TPE' THEN 1 END) as TPE FROM graph.base_entreprise_2022_2023___fichier";
    $result = $pdo->query($sql);
    if ($result) {
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $tpe = $row['TPE'];
      $pme = $row['PME'];
      $eti = $row['ETI'];
      $ge = $row['GE'];
    }
  } catch (PDOException $e) {
    die("ERROR: can't execute sql " . $e->getMessage());
  }

  try {
    $sql = "SELECT COUNT(CASE WHEN `Secteur Activité` = 'Services' THEN 1 END) as Services, COUNT(CASE WHEN `Secteur Activité` = 'Commerce' THEN 1 END) as Commerce,
     COUNT(CASE WHEN `Secteur Activité` = 'Industrie' THEN 1 END) as Industrie, COUNT(CASE WHEN `Secteur Activité` = 'Administration' THEN 1 END) as Administration,
     COUNT(CASE WHEN `Secteur Activité` = 'Construction' THEN 1 END) as Construction, COUNT(CASE WHEN `Secteur Activité` = 'Agriculture, sylviculture et pêche' THEN 1 END) as agsp,
     COUNT(CASE WHEN `Secteur Activité` = 'restaurants et cafés' THEN 1 END) as reca, COUNT(CASE WHEN `Secteur Activité` = 'Programmation informatique' THEN 1 END) as prog FROM graph.base_entreprise_2022_2023___fichier";
    $result = $pdo->query($sql);
    if ($result) {
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $serv = $row['Services'];
      $comm =  $row['Commerce'];
      $indu =  $row['Industrie'];
      $admi =  $row['Administration'];
      $cons =  $row['Construction'];
      $agsp =  $row['agsp'];
      $reca =  $row['reca'];
      $prog =  $row['prog'];
    }
  } catch (PDOException $e) {
    die("ERROR: can't execute sql " . $e->getMessage());
  }

unset($pdo);
?>

<div class="chartbox">
  <h2>Graphiques en barres</h2>
  <canvas id="chart"></canvas>
</div>

<div class="chartbox">
  <h2>Graphiques en lignes</h2>
  <canvas id="chart2"></canvas>
</div>

<div class="chartbox">
  <h2>Graphiques en donuts</h2>
  <canvas id="chart3"></canvas>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   
<script>
const departement = <?php echo json_encode($Codedepartement); ?>;
const select = <?php echo json_encode($Comptefiche); ?>;
const siret = <?php echo json_encode($SIRET); ?>;
const categorie = <?php echo json_encode($CategorieTPEPMEETIGE); ?>;

const data1 = {
  labels: ['27', '76', '61', '50', '14'],
  datasets: [{
    label: 'Code département',
    data: [<?php echo $a; ?>, <?php echo $b; ?>, <?php echo $c; ?>, <?php echo $d; ?>, <?php echo $e; ?>],
    borderWidth: 1,
    backgroundColor: 'rgba(125, 0, 125, 0.2)'
  }]
};

const data2 = {
  labels: ['tpe', 'pme', 'eti', 'ge'],
  datasets: [{
    label: "Catégories",
    data: [<?php echo $tpe; ?>, <?php echo $pme; ?>, <?php echo $eti; ?>, <?php echo $ge; ?>],
    fill: false,
    borderColor: 'rgba(0, 200, 0, 0.2)',
    tension: 0.1
  }]
};

const data3 = {
  labels: ['OUI', 'NON'],
  datasets: [{
    label: 'Trouvée via NWS',
    data: [<?php echo $oui; ?>, <?php echo $non; ?>],
    backgroundColor: [
      'rgba(255, 99, 132, 0.6)',
      'rgba(54, 162, 235, 0.6)',
    ]
  },{
    label: 'Annonce reçues',
    data: [<?php echo $iuo; ?>, <?php echo $uou; ?>],
    backgroundColor: [
      'rgba(100, 132, 0, 0.6)',
      'rgba(0, 220, 235, 0.6)',
    ]
  }]
};


const config = {
  type: 'bar',
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
};

const config2 = {
  type: 'line',
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
};

const config3 = {
  type: 'doughnut',
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Répartition des résultats de la recherche'
      }
    }
  }
};

const chart1 = new Chart(
  document.getElementById('chart'),
  Object.assign({}, config, {data: data1})
);

const chart2 = new Chart(
  document.getElementById('chart2'),
  Object.assign({}, config2, {data: data2})
);

const chart3 = new Chart(
  document.getElementById('chart3'),
  Object.assign({}, config3, {data: data3})
);

</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>