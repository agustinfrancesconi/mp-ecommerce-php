<script src="https://sdk.mercadopago.com/js/v2"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Agrega credenciales de SDK
        const mp = new MercadoPago("<?= $mpPublicKey ?>", {
            locale: "es-AR",
        });

        // Inicializa el checkout
        mp.checkout({
            preference: {
                id: '<?= $preferenceId ?>',
            },
            render: {
                container: ".cho-container", // Indica el nombre de la clase donde se mostrará el botón de pago
                label: "Pagar la compra", // Cambia el texto del botón de pago (opcional)
            },
        });

    }, false);

</script>


<div class="as-search-results as-filter-open as-category-landing as-desktop" id="as-search-results">

    <div id="accessories-tab" class="as-accessories-details">
        <div class="as-accessories" id="as-accessories">
            <div class="as-accessories-header">
                <div class="as-search-results-count">
                    <span class="as-search-results-value"></span>
                </div>
            </div>
            <div class="as-searchnav-placeholder" style="height: 77px;">
                <div class="row as-search-navbar" id="as-search-navbar" style="width: auto;">
                    <div class="as-accessories-filter-tile column large-6 small-3">

                        <button class="as-filter-button" aria-expanded="true" aria-controls="as-search-filters"
                                type="button">
                            <h2 class=" as-filter-button-text">
                                Smartphones
                            </h2>
                        </button>


                    </div>

                </div>
            </div>
            <div class="as-accessories-results  as-search-desktop">
                <div class="width:60%">
                    <div class="as-producttile-tilehero with-paddlenav " style="float:left;">
                        <div class="as-dummy-container as-dummy-img">

                            <img src="./assets/wireless-headphones"
                                 class="ir ir item-image as-producttile-image  "
                                 style="max-width: 70%;max-height: 70%;" alt="" width="445" height="445">
                        </div>
                        <div class="images mini-gallery gal5 ">


                            <div class="as-isdesktop with-paddlenav with-paddlenav-onhover">
                                <div class="clearfix image-list xs-no-js as-util-relatedlink relatedlink"
                                     data-relatedlink="6|Powerbeats3 Wireless Earphones - Neighborhood Collection - Brick Red|MPXP2">
                                    <div class="as-tilegallery-element as-image-selected">
                                        <div class=""></div>
                                        <img src="./assets/003.jpg"
                                             class="ir ir item-image as-producttile-image" alt="" width="445"
                                             height="445"
                                             style="content:-webkit-image-set(url(<?php echo $_POST['img'] ?>) 2x);">
                                    </div>

                                </div>


                            </div>


                        </div>

                    </div>

                    <div class="as-producttile-info" style="float:left;min-height: 168px;">
                        <div class="as-producttile-titlepricewraper" style="min-height: 128px;">
                            <div class="as-producttile-title">
                                <h3 class="as-producttile-name">
                                    <p class="as-producttile-tilelink">
                                        <span data-ase-truncate="2"><?php $title ?></span>
                                    </p>

                                </h3>
                            </div>
                            <h3>
                                <?php $unitPrice ?>
                            </h3>
                        </div>
                        <input type="hidden" name="title" value="<?php $title ?>">
                        <input type="hidden" name="unit_price" value="<?php $unitPrice ?>">
                        <input type="hidden" name="quantity" value="<?php $quantity ?>">
                        <input type="hidden" name="picture_url" value="<?php $pictureUrl ?>">


                        <div class="cho-container">

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>