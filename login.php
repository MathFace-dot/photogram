<?php
include 'libs/load.php';

?>

<!doctype html>
<html lang="en">
<?php load_template('_head'); ?>

<body>

    <?php load_template('_header'); ?>
    <main>

        <?php load_template('_login'); ?>

    </main>
    <?php load_template('_footer'); ?>
    <script src="<?php get_config('base_path')?>assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>