<?php include ('./view/admin/adminMenu.php'); ?>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-10 blog-main">
            <div class="blog-post">
                <div>
                    <h2>Modifier le billet</h2>
                    <br>
                </div>
                <div>
                    <form class="category-form" action="./index.php?action=admin&p=modifyPost&id=<?= $_GET['id']; ?>" method="post">
                        <p>Auteur :<br/>
                            <select id="author" name="author">
                                <?php foreach ($dataUsers as $user) {?>
                                    <option value="<?= $user->getUsername(); ?>"><?= $user->getUsername(); ?></option>
                                <?php } ?>
                            </select>
                        </p>
                        <p>Titre :<br/>
                            <input type="text" name="title" value="<?= $dataPosts->getTitle(); ?>" size="80px"></p>
                        <p>Chapo :<br/>
                            <input type="chapobox" name="chapo" value="<?= $dataPosts->getChapo(); ?>" size="150px"></p>
                        <p>Texte :<br/>
                            <input type="textbox" name="text" value="<?= $dataPosts->getText(); ?>" size="30px"></p>
                        <p>Categorie :<br/>
                            <select id="category" name="category">

                            </select></p>
                        <button type="submit">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>