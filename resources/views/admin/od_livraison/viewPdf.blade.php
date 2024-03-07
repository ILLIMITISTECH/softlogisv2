<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body style="display: flex; justify-content: center; align-items: center;">

    <div class="container" style="padding: 20px 50px; max-width: 90%; width: 90%;">
        <div class="header" style="display: flex ; justify-content: space-between; flex-direction: row; padding: 0 20px 0 20px; max-height: 90px; border-bottom: 1px solid black;;">
            <div class="col" style=" width: 32%; ">
                <img src="{{ asset('assets/images/logo_jalo.jpg') }}" alt="" class="border-dark-subtle" style="height: 50px;">
            </div>
            <div class="col" style=" width: 32%;"></div>
            <div class="col" style=" width: 32%;"></div>
        </div>

        <div class="title" style=" display: flex; justify-content: center; padding: 20px 0 20px 0; text-align: center;">
            <span style="text-transform: uppercase; font-size: 25px; text-decoration: underline; margin: auto">ordre de transport</span>
        </div>

        <div class="content" style="display: flex; flex-direction: row;">
            <div class="col" style=" min-width: 32%;">
                
            </div>
            <div class="col" style=" min-width: 32%;">
                
            </div>
            <div class="col" style=" min-width: 35%;">
                <div class="col">Nom transporteur</div>
                <div class="col" style="margin: 3px 0 3px 0;">Mail transporteur</div>
                <div class="col">phone transporteur</div>
            </div>
        </div>

        <div class="content" style="display: flex; justify-content: space-between; flex-direction: row;">
            <div class="col" style=" width: 35%;">
                Date : <span>24/10/2024</span> <br>
                N°OT : <span>200265</span> <br>
                N°dossier : <span>200265</span> <br>
                N°dossier : <span>200265</span> <br>
                Trajet : <span>yop à bouaké</span> <br>
                Ref : <span>yop à bouaké</span>
            </div>
            <div class="col" style=" width: 32%;">
                
            </div>
            <div class="col" style=" width: 32%;">
                
            </div>
            <div class="col" style=" width: 32%;">
                
            </div>
        </div>

        <div class="table">
            <div class="content " style="width: 100%; margin-top: 20px;">
                <div class="table-header" style="background: #ccc; width: 100%; border: 2px solid black;">
                    <div class="row" style="display: flex; justify-content: center; flex-direction: row; text-align: center;">
                        <div class="col" style="width: 10%;">Nombre</div>
                        <div class="col" style="width: 40%; border-left: 1px solid #000; border-right: 1px solid #000;">DESIGNATION</div>
                        <div class="col" style="width: 50%;">
                            <div style="border-bottom: 1px solid #000; width: 100%;">
                                DIMENSIONS
                            </div>
                            <div style="display: flex; justify-content: space-between; text-align: center; flex-direction: row;">
                                <div style="width: 22%;">LONG (m)</div>
                                <div style="border-left: 1px solid #000; width: 22%;">LARGE (m)</div>
                                <div style="border-left: 1px solid #000; width: 22%;">HAUTE (m)</div>
                                <div style="border-left: 1px solid #000; width: 22%;">POIDS (T)</div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="display: flex; justify-content: center; flex-direction: row; text-align: center;background: #fff; ">
                       <div class="content" style="border-top: 1px solid #000; width: 100%; min-height: 50px; max-height: 500px; display: flex; flex-direction: row;">
                            <div class="content-nbr" style="width: 10%; border-right: 1px solid #000; min-height: 50px; max-height: 500px;">
                             
                            </div>
                            <div class="content-nbr" style="width: 40%; border-right: 1px solid #000; min-height: 50px; max-height: 500px;">
                             
                            </div>
                            <div class="col" style="width: 50%;">
                                <div style="display: flex; justify-content: space-between; text-align: center; flex-direction: row;">
                                    <div style="width: 22%; min-height: 50px; max-height: 500px;">10</div>
                                    <div style="border-left: 1px solid #000; width: 22%; min-height: 50px; max-height: 500px;">20</div>
                                    <div style="border-left: 1px solid #000; width: 22%; min-height: 50px; max-height: 500px;">30</div>
                                    <div style="border-left: 1px solid #000; width: 22%; min-height: 50px; max-height: 500px;">40</div>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-signature" style="display: flex; justify-content: space-between; flex-direction: row; min-height: 150px; margin-top: 50px;">
            <div class="col" style="display: flex; align-self: flex-start; justify-content: start; text-align: start;">
                <h5>LE TRANSPORTEUR</h5>
            </div>
            <div class="col" style="display: flex; align-self: flex-start; justify-content: start; text-align: start;">
                <h5>LE DIRECTEUR OPERATION</h5>
            </div>
        </div>

        <div class="footer" style="display: flex; justify-content: space-between; flex-direction: row; align-items: center; margin: 0; text-align: center; margin-bottom: 20px !important; position: fixed; bottom: 0;">
            <div class="size_12" style="padding: 0 10px; display: flex; justify-content: center; align-items: center; align-self: center; text-align: center; font-size: 14px; margin-bottom: 0 !important;">
                01BP 8169 ABIDJAN 01, COCODY Deux Plateaux Rue des Jardins, Cote d'ivoire. SAS au capital de 200 000 000 CFA
                Régime d'imposition : Réel Normal Direction des Grandes Entreprises. (DGE), RCCM N° CI-ABJ-03-2023-B16-00087
                COFINA N° CI201 01001 109046290985 21 ECOBANK CI93 CI05 9010 5612 1686 9560 0148
            </div>
        </div>
    </div>

</body>
</html>