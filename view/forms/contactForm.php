<?php $title = 'Mon profil'; ?>

<?php ob_start(); ?>
<?php require './view/menu.php'; ?>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-10 blog-main">
            <div class="blog-post">
                <div>
                    <h2>Pour me contacter</h2>
                </div>
                <div class="warning">
                    <?php
                        $message->message();
                    ?>
                </div>
                <div>
                    <div>Tous les champs sont obligatoires.</div>
                    <form class="category-form" action="contact" method="post">
                        <p>Votre nom :<br/>
                            <textarea name="name" cols="50" rows="1"></textarea>
                        </p>
                        <p>Votre adresse email :<br/>
                            <textarea name="email" cols="100" rows="1"></textarea><br/>
                            <i>Le format de votre adresse email doit être XXX@XXX.XXX</i>
                        </p>
                        <p>Votre message :<br/>
                            <textarea name="text" cols="150" rows="10"></textarea>
                        </p>
                        <button type="submit">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require './view/blogFooter.php' ?>

<?php $content = ob_get_clean(); ?>

<?php require 'view/template.php'; ?>