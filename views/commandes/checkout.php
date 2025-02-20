<div class="container"><br>
    <h5>Date : <?= $date = date("d-m-y"); ?></h5>
    <hr>
    <h5>Expédition à : <b><?= $_SESSION['Utilisateur']->nom; ?></b></h5>
    <hr>
    <div class="row">
        Articles(<?= $_SESSION['quantite']; ?>): <?= $_SESSION['total']; ?> $
    </div>

    <div class="row">
        Frais d'expédition : 9 $
    </div>

    <div class="row">
        Total avant taxes : <?= $_SESSION['soustotal']; ?> $
    </div>

    <div class="row">
        Taxes estimées :<?= $_SESSION['taxesTotal']; ?>
    </div>

    <div class="row">
        <h3>Prix totale :<?= $_SESSION['prixTotal']; ?> $</h3>
    </div>
    <hr>
</div>

<h5>Addresse d'expédition :</h5>
<div class="container">
    <hr>
    <?php
    echo $_SESSION['Utilisateur']->nom . " " . $_SESSION['Utilisateur']->prenom . ".";
    echo "<br>";
    echo $_SESSION['adresseLivraison']->rue . "," . $_SESSION['adresseLivraison']->ville . "," . $_SESSION['adresseLivraison']->province . ".";
    echo "<br>";

    echo $_SESSION['Utilisateur']->telephone;
    ?>
    <hr>
    <?php if (isset($_SESSION['Utilisateur'])) { ?>
        <div id="paypal-button-container"></div>
        <script src="https://www.paypal.com/sdk/js?client-id=ARHzMtx2fgP1Yuqaoqtnpx3vgpclsuy4zkAaWRGYZOtbf8oyqNeeb-HhkKr5ZGo3Vp8eIZgP2_THlT8L&currency=CAD"></script>
        <script>
            paypal.Buttons().render('#paypal-button-container');
        </script>
    <?php } ?>
    <hr>
</div>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= $total; ?>'
                    }
                }]
            });
        },
        onApprove: async (data, actions) => {
            request.url = "<?= URI . "
        commandes / voirCommande
        "; ?>";
            const order = await actions.order.capture();
            console.log(order);
            alert('Transaction completed by ' + order.payer.name.given_name);
        }
    }).render('#paypal-button-container');
</script>