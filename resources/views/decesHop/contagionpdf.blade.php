<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        margin: 0;
    }
    .header{
        display: flex;
        justify-content: space-around;
        font-size: 10px;
    }
    .content{
        display: flex;
        justify-content: space-around;
        font-size: 10px;
        margin-left: 0;
    }
    .containt{
        text-align: center;
        font-size: 15px;
        font-weight: bold;
        font-family: 'Courier New', Courier, monospace;
    }
    .union{
        margin-top: -155px;
        margin-left: 65%;
        margin-bottom: 150px;
    }
    .fait {
        margin-top: -50px;
        margin-left: 75%;
        margin-bottom: 70px;
    }
</style>
<body>
    <div class="header">
        <div>
            <h2>MINISTERE DE LA SANTE, <br>
                DE L'HYGIENE PUBLIQUE ET <br>
            DE LA COUVERTURE MALADIE UNIVERSELLE</h2>
            <hr style="width: 20%; margin-top: -10px;  margin-left: 50px; margin-bottom: 1px;">
            <h2 style="margin-top: 0px">DIRECTION REGIONALE DE LA SANTE ABIDJAN</h2>
            <hr style="width: 20%; margin-top: -10px; margin-left: 50px; margin-bottom: 1px;">
            <h2 >DISTRICT SANITAIRE {{ strtoupper($sousadmin->commune) }}</h2>
        </div>
        <div class="union">
            <h2>REPUBLIQUE DE CÔTE D'IVOIRE</h2>
            <p style="font-size:12px; margin-left:55px; margin-top: -10px;">Union-Discipline-Travail</p>
        </div>
    </div>
    <div class="content">
        <h2 >{{ strtoupper($sousadmin->nomHop) }}</h2>
        <h2 class="fait">Abidjan le, {{ $sousadmin->created_at->format('d M Y') }}</h2>
    </div>
    <h1 style="text-align: center; font-family: algerian; font-size: 30px; "><u>CERTIFICAT DE NON CONTAGION</u></h1>
    <div class="containt">
        <p>Je sousigné monsieur le docteur {{ $sousadmin->name .' '.$sousadmin->prenom  }} Medecin en service à <br>
            {{ strtoupper($sousadmin->nomHop) }}, certifie que M./Mme/Mlle  {{ $decesHop->NomM }} {{ $decesHop->PrM }},<br>
            <br>
        de numéro de certificat de decès {{ $decesHop->codeCMD }} n'est affecté(e) d'aucune maladie contagieuse. </p>
        <p>En foi de quoi, le présent certificat lui est delivré pour servir et valoir ce que de droit</p>
    </div>
    <div>
        <p style="text-align: right;font-size:16px; margin-right: 50px; font-weight: bold;"><u>LE MEDECIN</u></p>
        <p style="text-align: right;font-size:13px; margin-right: 50px; font-weight: bold;"></u>{{ $sousadmin->name .' '.$sousadmin->prenom  }}</p>
    </div>
</body>
</html>